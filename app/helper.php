<?php
 use App\Models\Category;
use App\Models\Setting;
use App\Models\Unit;
 use App\Models\Subcategory;
 use App\Models\Brand;
 use App\Models\Product;
 use App\Models\Variant;
 use App\Models\Productvariant;
 use App\Models\Paymentmethod;

function categories(){
	$categories = Category::latest()->get();
	return $categories;
}

function units(){
	$units = Unit::latest()->get();
	return $units;
}

function brands(){
	$brands = Brand::latest()->get();
	return $brands;
}

function subcategories(){
	$subcategories = Subcategory::latest()->get();
	return $subcategories;
}

function user()
{
	$user = auth()->user();
	return $user;
}

function featuredCategoryIds()
{
	$categories = Category::whereHas('products')->where('status','Active')->where('is_featured',1)->pluck('id')->toArray();
	return $categories;
}

function categorySlug($category)
{
	$slug = strtolower(str_replace(" ", "-", $category->category_name));
	return $slug;
}

function stockCheck($request){
	if($request->use_for == 'product'){
		$product = Product::findorfail($request->element_id);
		if($product->stock_qty > 0){
			return true;
		}else{
			return false;
		}
	}else{
		if($request->use_for == 'variant'){
			$variant = Productvariant::findorfail($request->element_id);
			if($variant->stock_qty > 0){
				return true;
			}else{
				return false;
			}
		}
	}
}

function discount($product)
{
	$originalPrice = $product->product_price;
	$discountPercent = $product->discount;
    $discountedPrice = $originalPrice - ($originalPrice * ($discountPercent / 100));
    return round($discountedPrice, 2);
}

function paymentmethods()
{
	$data = Paymentmethod::where('status','Active')->get();
	return $data;
}

function variantNames($variants)
{
	//$values = Productvariant::whereIN('id',json_decode($variants))->pluck('variant_value')->toArray();
	$values = Productvariant::whereIN('id',json_decode($variants))->get();
	// $data = Variant::with(['productvariants' => function ($query) use($values) {

	// 		        $query->whereIN('id',$values);

	// 		    }])->get();
	return $values;
	//return implode(",",$data);
}

function setting()
{
    $setting = Setting::first();
    return $setting;
}
