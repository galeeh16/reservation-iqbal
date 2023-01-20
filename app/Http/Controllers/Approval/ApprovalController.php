<?php declare(strict_types=1);

namespace App\Http\Controllers\Approval;

use App\Models\Reservation;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ApprovalController extends Controller 
{
    public function getList(Request $request)
    {
        $limit = $request->input('limit') ?? 10;
        $search = $request->input('search.value');

        $reservations = Reservation::with(['user'])
            ->when($search, function($query, $value) {
                $query->where(DB::raw('lower(no_reservation)'), 'like', '%'.$value.'%');
            })
            ->where('status', '0')
            ->paginate($limit)
            ->toArray();

        return response()->json([
            'data' => $reservations['data'],
            'recordsTotal' => intval($reservations['total']),
            'recordsFiltered' => intval($reservations['total']),
            'draw' => intval($request->input('draw'))
        ], 200);
    }

    public function approveOrReject(Request $request)
    {
        $this->validate($request, [
            'id' => 'required|string',
            'type' => 'required|string|in:approve,reject',
        ]);

        try {
            $status = '';
            $message = '';

            if ($request->type == 'approve') {
                $status = '1';
                $message = 'Success approve reservation';
            } else {
                $status = '2';
                $message = 'Success unapprove reservation';
            }

            Reservation::where('id', $request->id)
                        ->update([
                            'status' => $status,
                            'tanggal_approve_matplan' => date('Y-m-d H:i:s'),
                            'remarks' => $request->remarks
                        ]);
            return response()->json(['message' => $message], 200);
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

        return view('approval.show', [
            'reservation' => $reservation,
            'materials' => $materials
        ]);
    }

    public function downloadPdf($no_reservation)
    {
        $reservation = Reservation::where('no_reservation', $no_reservation)->firstOrFail();
        
        $materials = DB::table('materials')
                        ->join('reservation_materials', 'materials.id', '=', 'reservation_materials.material_id')
                        ->where('reservation_id', $reservation->id)
                        ->get();

        $pdf = Pdf::loadView('pdf.reservation', [
            'reservation' => $reservation,
            'materials' => $materials
        ]);

        return $pdf->download('Reservation_'. $reservation->no_reservation .'.pdf');
    }
}