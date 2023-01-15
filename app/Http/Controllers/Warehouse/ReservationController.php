<?php 

namespace App\Http\Controllers\Warehouse;

use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ReservationController extends Controller
{
    public function index()
    {
        return view('warehouse.reservation.index');
    }

    public function getList(Request $request)
    {
        $limit = $request->input('limit') ?? 10;
        $search = $request->input('search.value');

        $reservations = Reservation::with(['user'])
            ->when($search, function($query, $value) {
                $query->where(DB::raw('lower(no_reservation)'), 'like', '%'.$value.'%');
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