<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ProductVariantReviews;

class ProductVariantReviewsController extends Controller
{
    protected $routePrefix = 'admin.';

    public function index()
    {
        $records = new ProductVariantReviews();
        $paginate = config()->get('app.pagination');
        $records = $records->with('productVarient.product')->paginate($paginate);
        return view($this->routePrefix.'product-reviews.variants', compact('records'));
    }

    public function destroy($id)
    {
        $record = new ProductVariantReviews();
        $record = $record->find($id);
        $record->delete();
        return redirect()->back()->withStatus(__('Record successfully Deleted.'));
    }
}
