<?php namespace App\Http\View\Composers;

use App\Products;
use Illuminate\View\View;

class VendorProductComposer
{
    public function compose(View $view)
    {
        $vendorProducts = new Products();

        $vendorProducts = $vendorProducts->all();

        $view->with('vendorProducts', $vendorProducts);
    }
}
