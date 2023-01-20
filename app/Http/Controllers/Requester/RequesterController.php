<?php declare(strict_types=1);

namespace App\Http\Controllers\Requester;

use App\Models\Material;
use App\Models\Reservation;
use Illuminate\Http\Request;
use App\Models\MaterialRequester;
use App\Models\ReservationCounter;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class RequesterController extends Controller
{
    public function getListMaterial() 
    {
        $material_requester = MaterialRequester::with(['material'])
                    ->where('user_id', session()->get('id'))
                    ->get();

        return response()->json($material_requester, 200);
    }

    public function searchCodeItem(Request $request)
    {
        $material = Material::select('id', 'description', 'size', 'colour', 'uom')
                    ->where('material_code', $request->code_item)
                    // ->orderBy('size', 'asc')
                    ->get();
        return response()->json($material, 200);
    }

    public function addMaterial(Request $request)
    {
        $this->validate($request, [
            'material_id' => 'required|string',
            'code_item' => 'required|string',
            'size' => 'required|string',
            'req_qty' => 'required|numeric',
            // 'issue_qty' => 'required|numeric',
            'stage_and_season' => 'required|string',
        ]);

        try {
            $m = DB::table('materials')->select('id')->where([
                'material_code' => $request->code_item,
                'size' => $request->size
            ])->first();

            MaterialRequester::create([
                'material_id' => $m->id,
                'code_item' => $request->code_item,
                'size' => $request->size,
                'req_qty' => $request->req_qty,
                'issue_qty' => '0', // gadipake sih
                'stage_and_season' => $request->stage_and_season,
                'user_id' => session()->get('id'),
            ]);

            return response()->json(['message' => 'Berhasil menambah material'], 200);
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function deleteMaterial($id_material)
    {
        MaterialRequester::where('id', $id_material)->delete();
        return response()->json(['message' => 'Success delete material'], 200);
    }

    public function updateMaterial(Request $request, $id_material)
    {
        $this->validate($request, [
            'size_edit' => 'required|string',
            'req_qty_edit' => 'required|string',
            'stage_and_season_edit' => 'required|string' 
        ]);

        MaterialRequester::where('id', $id_material)->update([
            'size' => $request->size_edit,
            'req_qty' => $request->req_qty_edit,
            'stage_and_season' => $request->stage_and_season_edit,
        ]);
        return response()->json(['message' => 'Success update material'], 200);
    }

    public function addReservation(Request $request)
    {
        $this->validate($request, [
            'section' => 'required|string',
            'reason' => 'required|string',
            'category' => 'required|string',
            'developer' => 'required|string',
            'model' => 'required|string',
            'article' => 'required|string',
        ]);

        DB::beginTransaction();

        try {
            $user_id = session()->get('id');

            // create reservation counter
            $res = ReservationCounter::create([
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]);
            $res_number = 'RES-' . str_pad("$res->id", 6, '0', STR_PAD_LEFT);
            
            // create reservation
            $reservation = Reservation::create([
                'no_reservation' => $res_number,
                'tanggal' => date('Y-m-d H:i:s'),
                'section' => $request->section,
                'reason' => $request->reason,
                'category' => $request->category,
                'developer' => $request->developer,
                'model' => $request->model,
                'article' => $request->article,
                'user_id' => $user_id,
                'status' => '0'
            ]);
            
            // create 1 reservation has many material
            // pindahin dari tabel material_requester ke tabel reservation_materials
            $material_requester = MaterialRequester::select('id', 'material_id', 'stage_and_season', 'req_qty')->where('user_id', $user_id)->get();
            foreach ($material_requester as $row) {
                DB::table('reservation_materials')->insert([
                    'reservation_id' => $reservation->id,
                    'material_id' => $row->material_id,
                    'req_qty' => $row->req_qty,
                    'stage_and_season' => $row->stage_and_season,
                ]);
            }

            // hapus data dari table material_requester
            MaterialRequester::where('user_id', $user_id)->delete();

            DB::commit();
            return response()->json(['message' => 'Success Add Reservation'], 200);
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }
}