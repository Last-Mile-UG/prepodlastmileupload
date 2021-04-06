<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\{ProductVariant, Products};

class ProductVariantsController extends Controller
{
    protected $routePrefix = 'vendor.products.';
    public function index()
    {
        $records = new ProductVariant();
        $records = $records->with('product')->where('vendor_id', auth()->user()->id)->paginate(config('app.pagination'));
        return view($this->routePrefix.'variants.index', compact('records'));
    }

    public function create()
    {
        $records = new Products();
        $products = $records->where('subscription', 0)->where('vendor_id', auth()->user()->id)->get();
        return view($this->routePrefix.'variants.create', compact('products'));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        extract($data);

        $productVarient = new ProductVariant();
        $productVarient->product_id = $product_id;
        $productVarient->vendor_id = auth()->user()->id;
        $productVarient->description = $prod_desc;
        $productVarient->price = $price;

        if(request()->hasFile('photo')){
            $image = request()->file('photo')->getClientOriginalName();
            $imageNewName = auth()->user()->id.'-'.$image;
            $file = request()->file('photo');
            $file->storeAs('images/product',$imageNewName, ['disk' => 'public']);
            $productVarient->image = $imageNewName;
        }
        
        $productVarient->save();

        return back()->withStatus(__('Product successfully created.'));
    }

    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // $records = new Products();
        // $products = $records->where('vendor_id', auth()->user()->id)->get();
        $productVarient = new ProductVariant();
        $record = $productVarient->with('product')->find($id);
        // print_r($record->toArray());
        // exit;
        return view($this->routePrefix.'variants.update', compact('record'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();
        extract($data);

        $productVarient = new ProductVariant();
        $productVarient = $productVarient->find($id);
        $productVarient->vendor_id = auth()->user()->id;
        $productVarient->description = $prod_desc;
        $productVarient->price = $price;

        if(request()->hasFile('photo')){
            $image = request()->file('photo')->getClientOriginalName();
            $imageNewName = auth()->user()->id.'-'.$image;
            $file = request()->file('photo');
            $file->storeAs('images/product',$imageNewName, ['disk' => 'public']);
            $productVarient->image = $imageNewName;
        }
        
        $productVarient->save();

        return back()->withStatus(__('Product successfully updated.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
            $record = new ProductVariant();
            $record = $record->findOrFail($id);
            $record->delete();
            return redirect()->back()->withStatus(__('Product variant successfully deleted.'));
     
    }
}
