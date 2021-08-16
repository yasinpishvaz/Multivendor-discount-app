<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Str;

use App\Traits\GregorianToPersianTrait;
use Carbon\Carbon;

class Product extends Model
{
    use HasFactory;

    use GregorianToPersianTrait;

    public function getRouteKeyName()
    {
        return 'slug';
    }

    protected $fillable = [
        'title', 'slug', 'price', 'discount', 'quantity', 'availability', 'menu_image_path', 'user_id', 'description',
        'starts_at', 'ends_at', 'service_id', 'subService_id', 'deadline_for_use', 'terms_of_use'
    ];

    protected $appends = ['discount_percent'];

    public function getDiscountPercentAttribute()
    {
        return ceil(($this->price - $this->discount) / $this->price * 100);
    }




    public static function boot()
    {
        parent::boot();

        static::creating(function ($product) {
            $product->slug = $product->generateSlug($product->title);
        });
    }


    private function generateSlug($title)
    {

        $slug = Str::slug($title);
        if (Product::whereSlug($slug)->exists()) {
            $latestMatch = Product::whereTitle($title)->latest('id')->value('slug');

            if (is_numeric($latestMatch[-1])) {
                return preg_replace_callback('/(\d+)/', function ($matches) {
                    return $matches[0] + 1;
                }, $latestMatch);
            }

            return "{$slug}-2";
        }

        return ($slug);
    }




    public function paginateProductByCity($cityId)
    {
        $now = Carbon::now()->toDateTimeString();

        $products = Product::whereHas('user', function ($query) use ($cityId) {
            $query->where('city_id', $cityId);
        })->where('status', 1)->where('ends_at', '>=', $now)->where('quantity', '>', 0)->paginate(5);

        return $products;
    }






    public function getProductByCategoryAndCity($catId, $cityId)
    {
        $now = Carbon::now()->toDateTimeString();

        $products = Product::whereHas('user', function ($query) use ($catId) {
            $query->where('category_id', $catId);
        })->whereHas('user', function ($query) use ($cityId) {
            $query->where('city_id', $cityId);
        })->where('status', 1)->where('ends_at', '>=', $now)->where('quantity', '>', 0)->take(4)->get();

        return $products;
    }


    public function paginateProductsByCategoryAndCity($catId, $cityId)
    {
        $now = Carbon::now()->toDateTimeString();

        $products = Product::whereHas('user', function ($query) use ($catId) {
            $query->where('category_id', $catId);
        })->whereHas('user', function ($query) use ($cityId) {
            $query->where('city_id', $cityId);
        })->where('status', 1)->where('ends_at', '>=', $now)->where('quantity', '>', 0)->paginate(5);

        return $products;
    }


    public function paginateProductsByChildCategoryAndCity($childSlug, $cityId)
    {
        $now = Carbon::now()->toDateTimeString();

        $products = Product::whereHas('service', function ($query) use ($childSlug) {
            $query->where('slug', $childSlug);
        })->whereHas('user', function ($query) use ($cityId) {
            $query->where('city_id', $cityId);
        })->where('status', 1)->where('ends_at', '>=', $now)->where('quantity', '>', 0)->paginate(5);

        return $products;
    }



    // public function productMetas()
    // {
    //     return $this->hasMany(ProductMeta::class);
    // }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function service()
    {
        return $this->belongsTo(Category::class, 'service_id');
    }

    public function subService()
    {
        return $this->belongsTo(Category::class, 'subService_id');
    }


    public function ordreItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class)->where('parent_id', 0);
    }
}
