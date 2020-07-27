<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Blog;
use App\Models\Product;
use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $products = Product::orderBy('id', 'desc')->paginate(10);

        return view('frontend.product', compact('products', 'categories'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        // dd($blog->user->getShortName());

        $product = Product::findBySlug($product->slug);
        // dd($product->name);

        $relatedProducts = Product::select('name', 'slug', 'price', 'sale_price', 'image')->take(6)->get();

        // dd($relatedProducts);
        // $comments = $product->comments()->all();

        $latest_blog = Blog::latest();

        $categories = Category::all();

        $user = auth()->user();

        if (auth()->check()) {
            $user->avatar = $user->avatar ? $user->avatar : 'assets/img/user2-160x160.jpg';
        }

        return view('frontend.product_detail', compact('user', 'product', 'relatedProducts', 'latest_blog', 'categories'));
    }
}
