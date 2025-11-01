<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Whishlist;

class WishlistController extends Controller
{
    public function wishlists()
    {
    	if(auth()->check()){
    		$data = Whishlist::with('product', 'product.images')->where('user_id',user()->id)->latest()->paginate(10);
    	    return view('fronts.my_wishlists', compact('data'));
    	}

    	$notification=array(
            'messege'=>"Please Logged In first",
            'alert-type'=>"error",
        );

        return redirect()->back()->with($notification);

    }
}
