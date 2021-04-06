<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\VendorReviews;

class VendorReviewsController extends Controller
{
    protected $routePrefix = 'admin.';

    public function index()
    {
        $records = new VendorReviews();
        $paginate = config()->get('app.pagination');
        $records = $records->with('user')->paginate($paginate);
        return view($this->routePrefix.'product-reviews.vendor', compact('records'));
    }

    public function destroy($id)
    {
        $record = new VendorReviews();
        $record = $record->find($id);
        $record->delete();
        return redirect()->back()->withStatus(__('Record successfully Deleted.'));
    }
}
