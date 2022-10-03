<?php

namespace App\Http\Controllers\Customer\Market;

 
use App\Http\Controllers\Controller;
use App\Models\Admin\Market\Product;

class ProductController extends Controller
{
    public function product(Product $product)
    {
        $relatedProduct = Product::all();
        return view('customer.market.product.product', compact('product', 'relatedProduct'));
    }


    public function addComment()
    {

    }

}
