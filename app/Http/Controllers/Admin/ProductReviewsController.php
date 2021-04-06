<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ProductReviews;

class ProductReviewsController extends Controller
{

    protected $routePrefix = 'admin.';

    public function index()
    {
        $records = new ProductReviews();
        $paginate = config()->get('app.pagination');
        $records = $records->with('product')->paginate($paginate);
        return view($this->routePrefix.'product-reviews.index', compact('records'));
    }

    public function destroy($id)
    {
        $record = new ProductReviews();
        $record = $record->find($id);
        $record->delete();
        return redirect()->back()->withStatus(__('Record successfully Deleted.'));
    }
}
