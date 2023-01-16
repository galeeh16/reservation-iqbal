<?php declare(strict_types=1);

namespace App\Http\Controllers\Requester;

use App\Models\Material;
use Illuminate\Http\Request;
use App\Models\MaterialRequester;
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
            'size' => 'required|string',
            'req_qty' => 'required|numeric',
            'issue_qty' => 'required|numeric',
            'stage_and_season' => 'required|string',
        ]);

        try {
            MaterialRequester::create([
                'material_id' => $request->material_id,
                'size' => $request->size,
                'req_qty' => $request->req_qty,
                'issue_qty' => $request->issue_qty,
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
}