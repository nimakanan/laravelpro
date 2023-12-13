<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\User;
use GrahamCampbell\ResultType\Success;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products=Product::query();
        if ($keyword=request("search")) {
            
           $products->where('name' , 'LIKE' ,"%{$keyword}%")->orwhere('label' , 'LIKE' ,"%{$keyword}%")->orwhere('id'  ,$keyword);
        //    return $keyword;
        }
        $products=$products->latest()->paginate(20);

        $title = 'Delete User!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);
        return view("admin.products.all",compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.products.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data=$request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'price'=>["required","integer"],
            'inventory'=>["required","integer"],
            'view_count'=>["required","integer"],
            
         ]);
         auth()->user()->product()->create($data);
         alert()->success("محصول مورد نظر با موفقیت ثبت شد.");
         return redirect (route("admin.products.index"));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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
    public function edit(Product $product)
    {
        return view("admin.products.edit",compact("product"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $data=$request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'price'=>["required","integer"],
            'inventory'=>["required","integer"],
            'view_count'=>["required","integer"],
         ]);
        auth()->user()->product()->update($data);
        alert()->success("مطلب مورد نظر با موفقیت ویرایش شد.");
        return redirect (route("admin.products.index"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $title = 'Delete User!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);
        
        return back();
    }
}
