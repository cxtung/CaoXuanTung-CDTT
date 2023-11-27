<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

class BrandController extends Controller
{
    //get list
    function index()
    {
        $brands = Brand::all();
        $data = [
            'status' => true,
            'message' => "Success",
            'brands' => $brands,
        ];
        return response()->json($data, 200);
    }
    //get show id
    function show($id)
    {
        $brand = Brand::find($id);
        if ($brand == null) {
            $data = [
                'status' => true,
                'message' => 'Erroro',
                //dữ liệu trả về
                'brands' => null
            ];
            return response()->json($data, 404);
        } else {
            $data = [
                'status' => true,
                'message' => 'Success',
                //dữ liệu trả về
                'brands' => $brand
            ];
            return response()->json($data, 200);
        }
    }
    //thêm
    function store(Request $request)
    {
        $brand = new Brand();
        $brand->name = $request->name;
        $brand->slug = Str::of($request->name)->slug('-');
        $brand->sort_order = $request->sort_order;
        $brand->description = $request->description;
        $brand->status = $request->status;
        $brand->created_at = date('Y-m-d H:i:s');
        $brand->created_by = 1; //login
        $image = $request->image;
        if ($image != null) {
            $extension = $image->getClientOriginalExtension();
            if (in_array($extension, ['png', 'jpg', 'gif', 'webp'])) {
                $fileName = date('ymdHis')  . '.' . $extension;
                $image->move(public_path('images/brand'), $fileName);
                $brand->image = $fileName;
            }
        }

        if ($brand->save() == true) {
            $data = [
                'status' => true,
                'message' => 'Success',
                'brands' => $brand
            ];
        }
    }
    //xóa
    public function destroy($id)
    {
        $brand = Brand::findOrFail($id);
        $brand->delete();
        return response()->json(
            [
                'success' => true,
                'message' => 'Xóa thành công',
                'brand' => null
            ],
            200
        );
    }
    //
}
