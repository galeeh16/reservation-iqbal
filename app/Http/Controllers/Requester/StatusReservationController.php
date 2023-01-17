<?php

namespace App\Http\Controllers\Requester;

use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class StatusReservationController extends Controller
{
    public function index()
    {
        return view('requester.status-reservation.index');
    }

    public function getList(Request $request)
    {
        $limit = $request->input('limit') ?? 10;
        $search = $request->input('search.value');

        $reservations = Reservation::with(['user'])
            ->when($search, function($query, $value) {
                return $query->where(DB::raw('lower(no_reservation)'), 'like', '%'.$value.'%');
            })
            ->when(request('status') && request('status') !== 'all', function($query, $value) {
                return $query->where('status', $value);
            })
            ->when(request('date_from') && request('date_to'), function($query) {
                $start_date = date('Y-m-d', strtotime(request('date_from')));
                $end_date = date('Y-m-d', strtotime(request('date_to')));

                // return $query->whereBetween('created_at', [$start_date, $end_date]);
                return $query->whereRaw("DATE(created_at) BETWEEN '$start_date' AND '$end_date'");
            })
            ->paginate($limit)
            ->toArray();

        return response()->json([
            'data' => $reservations['data'],
            'recordsTotal' => intval($reservations['total']),
            'recordsFiltered' => intval($reservations['total']),
            'draw' => intval($request->input('draw'))
        ], 200);
    }
}
