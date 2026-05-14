<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::where('status', true)->take(8)->get();
        $featuredProducts = Product::where('status', true)->where('featured', true)->take(8)->get();
        $newArrivals = Product::where('status', true)->latest()->take(8)->get();

        return view('welcome', compact('categories', 'featuredProducts', 'newArrivals'));
    }
}
