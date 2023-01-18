<?php declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Material;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Rap2hpoutre\FastExcel\FastExcel;

class WarehouseController extends Controller 
{
    public function index()
    {
        return view('warehouse.index');
    }

    public function upload(Request $request)
    {
        $this->validate($request, [
            'attachment' => 'required|mimes:xls,xlsx'
        ]);

        DB::beginTransaction();

        try {
            // extract excel jadi sebuah collection
            $collection =  (new FastExcel)->import($request->file('attachment'))->toArray();

            // looping dan lakukan insert setiap barisnya
            $data_insert = [];
            $now = date('Y-m-d H:i:s');
            foreach ($collection as $row) {
                $data_insert[] = [
                    'material_code' => $row['Code Material'],
                    'material_name' => $row['Material'],
                    'description' => $row['Description'],
                    'colour' => $row['Colour'],
                    'size' => $row['Size'],
                    'uom' => $row['UoM'],
                    'created_at' => $now,
                    'updated_at' => $now,
                ];
            }   

            Material::insert($data_insert);
            
            DB::commit();

            return response()->json(['message' => 'Sukses menambah data'], 200);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'message' => $e->getMessage(),
                'line' => $e->getLine(),
                'file' => $e->getFile()
            ], 500);
        }
    }

    public function getList(Request $request)
    {
        $limit = $request->input('limit') ?? 10;
        $search = $request->input('search.value');

        $materials = Material::when($search, function($query, $value) {
                $query->where(DB::raw('lower(material_code)'), 'like', '%'.$value.'%');
                $query->orWhere(DB::raw('lower(material_name)'), 'like', '%'.$value.'%');
                $query->orWhere(DB::raw('lower(size)'), 'like', '%'.$value.'%');
                $query->orWhere(DB::raw('lower(uom)'), 'like', '%'.$value.'%');
            })
            ->paginate($limit)
            ->toArray();

        return response()->json([
            'data' => $materials['data'],
            'recordsTotal' => intval($materials['total']),
            'recordsFiltered' => intval($materials['total']),
            'draw' => intval($request->input('draw'))
        ], 200);

    }
    
}