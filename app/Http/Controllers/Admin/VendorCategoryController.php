<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Exception;

use App\VendorCategory;

class VendorCategoryController extends Controller
{
    public function index()
    {
        $model =  new VendorCategory();
        $records = $model->get();
        return view('admin.category.index',compact('records'));
    }
    public function create()
    {

        return view('admin.category.create');
    }
    public function store(Request $request)
    {
    try {
        // print_r($request->all());exit;
        $data = $request->all();
        extract($data);
        $model =  new VendorCategory();
        $model->name = $name;
        if($request->hasfile('image'))
        {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time().'.'.$extension;
            $file->move('uploads/category/',$filename);
            $model->image =$filename;
        }
        
        $model->save();
        return redirect()->route('category-index');
    } catch (Exception $e) {
        return redirect()->back();
        
    }
    }

}
