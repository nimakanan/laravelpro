<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(){
        $product=Product::latest()->paginate(12);
        return view("home.index",compact("product"));
    }
    public function single()
    {
        return view("",compact(""));
    }
}
