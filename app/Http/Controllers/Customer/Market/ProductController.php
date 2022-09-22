<?php

namespace App\Http\Controllers\Customer\Market;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\Market\Product;

class ProductController extends Controller
{
    public function product(Product $product)
    {
        $relatedPosts = Product::all();
        return view('customer.market.product.product', compact('product', 'relatedPosts'));
    }

    
    public function addComment()
    {

    }

}
