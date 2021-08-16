<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\City;
use Carbon\Carbon;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
			    
        $location = 'تهران';
        
        $city = City::where('name', $location)->firstOrFail();

        $cityId = $city->id;
        $tourCatId = 13;
        $educationCatId = 2;
        $breakfastCatId = 14;
   
        $productModel = new Product();
        $educations = $productModel->getProductByCategoryAndCity($educationCatId, $cityId);
		
        $tours = $productModel->getProductByCategoryAndCity($tourCatId, $cityId);
        
        $breakfasts = $productModel->getProductByCategoryAndCity($breakfastCatId, $cityId);
        
        
        $now = Carbon::now()->toDateTimeString();
        $products = Product::where('status', 1)->where('ends_at', '>=', $now)->where('quantity', '>', 0)->take(4)->get();

        return view('front.index', compact('products', 'tours', 'educations', 'breakfasts'));
    }
}
