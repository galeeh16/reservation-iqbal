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
            ->where('status', '1') // 1 - Approve oleh matplan
            ->paginate($limit)
            ->toArray();

        return response()->json([
            'data' => $reservations['data'],
            'recordsTotal' => intval($reservations['total']),
            'recordsFiltered' => intval($reservations['total']),
            'draw' => intval($request->input('draw'))
        ], 200);
    }

    public function complete(Request $request)
    {
        $this->validate($request, [
            'id' => 'required|string',
        ]);

        try {
            Reservation::where('id', $request->id)
                        ->update([
                            'status' => '3',
                            'tanggal_complete_warehouse' => date('Y-m-d H:i:s')
                        ]);
            return response()->json(['message' => 'Success completed reservation'], 200);
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function show($no_reservation)
    {
        $reservation = Reservation::where('no_reservation', $no_reservation)->firstOrFail();
        
        $materials = DB::table('materials')
                        ->join('reservation_materials', 'materials.id', '=', 'reservation_materials.material_id')
                        ->where('reservation_id', $reservation->id)
                        ->get();

        return view('warehouse.reservation.show', [
            'reservation' => $reservation,
            'materials' => $materials
        ]);
    }

}