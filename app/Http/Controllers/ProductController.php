<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
use App\Models\Category;
use App\Models\City;
use Illuminate\Support\Facades\Auth;

use App\Traits\UploadTrait;
use App\Traits\PersianToGregorianTrait;
use Exception;
use Carbon\Carbon;

class ProductController extends Controller
{

    use UploadTrait;

    use PersianToGregorianTrait;


    public function showProductsByCity($citySlug, Request $request)
    {
        try {
            $city = City::where('name', $citySlug)->firstOrFail();
            $cityId = $city->id;
    
            $productModel = new Product();
            $products = $productModel->paginateProductByCity($cityId);

            $productsHtml = '';

            if ($request->ajax()) {
                foreach ($products as $product) {
                    $productsHtml .= '<div class="col-md-3 col-sm-6 mb-3">
					<div class="col-md-12 border rounded">
                    <div class="product-box">
                        <a href="' . route('show-product-details', $product->slug) . '" class="text-decoration-none">
                            <div class="product-image">
                                <img class="pic-1"
                                    src="' . asset('storage/uploads/products/images/' . $product->menu_image_path) . '">
                                <span class="product-discount-label">٪ ' . $product->discount_percent . ' </span>
                            </div>
                            <div class="product-content">
                                <h3 class="title"> ' . $product->title . ' </h3>
                                <span class="product-location"><i class="fa fa-map-marker location-icon"
                                        aria-hidden="true"></i>' . $product->user->city->name . ' </span>
                                <div class="price"> <span>  ' . $product->price . '  </span>
                                    ' . $product->discount . ' تومان
                                </div>
                            </div>
                        </a>
                    </div>
				   </div>
                </div>';
                }
                return $productsHtml;
            }

            return view('front.products.showProductsByCity', compact('products'));
        } catch (Exception $ex) {
            return abort(404);
        }
    }


    public function showProductsByCategory($location, $parentSlug, Request $request)
    {
        if ($location == 'tehran') {
            $location = 'تهران';
        }

        try {
            $city = City::where('name', $location)->firstOrFail();
            $cityId = $city->id;
            $catId = Category::where('slug', $parentSlug)->pluck('id');

            $productModel = new Product();
            $products = $productModel->paginateProductsByCategoryAndCity($catId, $cityId);


            $productsHtml = '';

            if ($request->ajax()) {
                foreach ($products as $product) {
                    $productsHtml .= '<div class="col-md-3 col-sm-6 mb-3">
					<div class="col-md-12 border rounded">
                    <div class="product-box">
                        <a href="' . route('show-product-details', $product->slug) . '" class="text-decoration-none">
                            <div class="product-image">
                                <img class="pic-1"
                                    src="' . asset('storage/uploads/products/images/' . $product->menu_image_path) . '">
                                <span class="product-discount-label">٪ ' . $product->discount_percent . ' </span>
                            </div>
                            <div class="product-content">
                                <h3 class="title"> ' . $product->title . ' </h3>
                                <span class="product-location"><i class="fa fa-map-marker location-icon"
                                        aria-hidden="true"></i>' . $product->user->city->name . ' </span>
                                <div class="price"> <span>  ' . $product->price . '  </span>
                                    ' . $product->discount . ' تومان
                                </div>
                            </div>
                        </a>
                    </div>
				   </div>
                </div>';
                }
                return $productsHtml;
            }

            return view('front.products.showProductsByCategory', compact('products'));
        } catch (Exception $ex) {
            return abort(404);
        }
    }


    public function showProductsByChildCategory($location, $parentSlug, $childSlug, Request $request)
    {

        $firstSlug = Category::whereSlug($parentSlug)->exists();
        $secondSlug = Category::whereSlug($childSlug)->exists();

        if ($firstSlug == false or $secondSlug == false) {
            return abort(404);
        }

        if ($location == 'tehran') {
            $location = 'تهران';
        }

        try {
            $city = City::where('name', $location)->firstOrFail();
            $cityId = $city->id;

            $productModel = new Product();
            $products = $productModel->paginateProductsByChildCategoryAndCity($childSlug, $cityId);

            $productsHtml = '';

            if ($request->ajax()) {
                foreach ($products as $product) {
                    $productsHtml .= '<div class="col-md-3 col-sm-6 mb-3">
					<div class="col-md-12 border rounded">
                    <div class="product-box">
                        <a href="' . route('show-product-details', $product->slug) . '" class="text-decoration-none">
                            <div class="product-image">
                                <img class="pic-1"
                                    src="' . asset('storage/uploads/products/images/' . $product->menu_image_path) . '">
                                <span class="product-discount-label">٪ ' . $product->discount_percent . ' </span>
                            </div>
                            <div class="product-content">
                                <h3 class="title"> ' . $product->title . ' </h3>
                                <span class="product-location"><i class="fa fa-map-marker location-icon"
                                        aria-hidden="true"></i>' . $product->user->city->name . ' </span>
                                <div class="price"> <span>  ' . $product->price . '  </span>
                                    ' . $product->discount . ' تومان
                                </div>
                            </div>
                        </a>
                    </div>
				   </div>
                </div>';
                }
                return $productsHtml;
            }

            return view('front.products.showProductsByChildCategory', compact('products'));
        } catch (Exception $ex) {
            return abort(404);
        }
    }


	
	public function showAllProducts(Request $request)
    {

        try {
            $now = Carbon::now()->toDateTimeString();
   
            $products = Product::where('status', 1)->where('ends_at', '>=', $now)->where('quantity', '>', 0)->paginate(5);

            $productsHtml = '';

            if ($request->ajax()) {
                foreach ($products as $product) {
                    $productsHtml .= '<div class="col-md-3 col-sm-6 mb-3">
					<div class="col-md-12 border rounded">
                    <div class="product-box">
                        <a href="' . route('show-product-details', $product->slug) . '" class="text-decoration-none">
                            <div class="product-image">
                                <img class="pic-1"
                                    src="' . asset('storage/uploads/products/images/' . $product->menu_image_path) . '">
                                <span class="product-discount-label">٪ ' . $product->discount_percent . ' </span>
                            </div>
                            <div class="product-content">
                                <h3 class="title"> ' . $product->title . ' </h3>
                                <span class="product-location"><i class="fa fa-map-marker location-icon"
                                        aria-hidden="true"></i>' . $product->user->city->name . ' </span>
                                <div class="price"> <span>  ' . $product->price . '  </span>
                                    ' . $product->discount . ' تومان
                                </div>
                            </div>
                        </a>
                    </div>
				   </div>
                </div>';
                }
                return $productsHtml;
            }

            return view('front.products.showAllProducts');

        } catch (Exception $ex) {
            return abort(404);
        }
        


    }
	


    public function showProduct(Product $product)
    {
        return view('front.products.showProductDetails', compact('product'));
    }


    public function create()
    {

        $user = User::find(auth::user()->id);
        $category = Category::with('childs')->find($user->category_id);

        return view('merchant.products.create', compact('user', 'category'));
    }


    public function getServices($id)
    {
        $services = Category::where('parent_id', $id)->pluck('title', 'id');
        return json_encode($services);
    }



    //merchant

    public function merchantIndex()
    {
        $userId =  Auth::user()->id;
        $user = User::find($userId);
        $products = $user->products()->where('status', '1')->get();

        return view('merchant.products.index', compact('products'));
    }


    public function NotApprovedDeals(Request $request)
    {
        $userId =  Auth::user()->id;
        $user = User::find($userId);
        $products = $user->products()->where('status', '!=', '1')->get();

        return view('merchant.products.notApproved', compact('products'));
    }


    public function store(Request $request)
    {

        $request->validate([
            'service_id'   =>  ['required', 'max:191'],
            'subService_id' =>  ['required', 'max:191'],
            'title'   =>  ['required', 'max:191'],
            'description' =>  ['required', 'min:3', 'max:1000'],
            'menu_image_path'   =>  ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
            'terms_of_use' =>  ['required', 'min:3', 'max:1000'],
            'price'   =>  ['required'],
            'discount'  =>  ['required'],
            'deadline_for_use'  =>  ['required'],
            'quantity'  =>  ['required'],
            'starts_at'  =>  ['required'],
            'ends_at'  =>  ['required'],
        ]);
        

        $input = $request->all();


        $input['user_id'] = Auth::user()->id;
        $input['starts_at'] = $this->persianDateToGregorian($request->starts_at);
        $input['ends_at'] = $this->persianDateToGregorian($request->ends_at);

        if ($request->has('menu_image_path')) {

            $image = $request->file('menu_image_path');
            $folder = '/uploads/products/images';
            $imageName = $this->uploadFile($image, $folder, 'public');
            $input['menu_image_path'] = $imageName;
        }

        Product::create($input);

        return back()->with('success', 'محصول با موفقیت اضافه شد!');
    }



    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return back();
    }







    // admin


    public function adminIndex()
    {
        $products = Product::get();
        return view('back.products.index', compact('products'));
    }

    public function unapprovedProducts()
    {
        $products = Product::where('status', 0)->get();
        return view('back.products.unapprovedIndex', compact('products'));
    }


    public function productApproval($id)
    {
        $product = Product::findOrFail($id);

        $product->status = 1;

        $product->update();

        return back();
    }


    public function productDisapproval($id)
    {
        $product = Product::findOrFail($id);

        $product->status = 2;

        $product->update();

        return back();
    }
}
