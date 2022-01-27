<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\ProductVariantPrice;
use App\Models\Variant;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $paginate = 1;
        $total = Product::get()->count();
        if($request->page==null){
            $start = 1;
            $end   = 2;
        }else{
            $start = ($request->page*2)-2+1;
            $end  = ($request->page*2);
            if($end>$total){
                $end = $total;
            }
        }
//        $products = Product::with('varient_price')->paginate(2);
        $q = Product::with('varient_price');
      if($request->title!=null || $request->price_from!=null || $request->variant!=null || $request->date ) {
          if ($request->title != null) {
              $q->where('title', 'LIKE', "%{$request->title}%");
          }
          if($request->date!=null){
              $q->whereDate('created_at',$request->date);
          }
          if ($request->price_from != null && $request->price_to != null) {
              $q->whereHas("varient_price", function ($qr) use ($request) {
                  $qr->whereBetween("price", [$request->price_from, $request->price_to]);
              })->get();
          }
          if ($request->variant) {
              $q->whereHas("varient_price", function ($qr) use ($request) {
                  $qr->where("product_variant_one", $request->variant);
                  $qr->orWhere("product_variant_two", $request->variant);
                  $qr->orWhere("product_variant_three", $request->variant);
              })->get();
          }

          $products = $q->get();
          $start = 1;
          $total = count($products);
          $end   = $total;
          $paginate = 0;
      }else{
          $products = $q->paginate(2);
      }
        $variants = ProductVariant::select('id','variant')->get();
        return view('products.index',compact('products','start','end','total','variants','paginate'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function create()
    {
        $variants = Variant::all();
        return view('products.create', compact('variants'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {


    }


    /**
     * Display the specified resource.
     *
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function show($product)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $variants = Variant::all();
        return view('products.edit', compact('variants'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
