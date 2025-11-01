<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Orderdetail;
use App\Models\Product;
use App\Models\Review;
use App\Models\Slider;
use Illuminate\Http\Request;
use Auth;
class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth_check');
    }
    public function Dashboard()
    {
    	try {
            // Sliders
            $totalSliders = Slider::count();

            // Products
            $totalProducts = Product::where('status', 'Active')->count();

            // Reviews
            $totalReviews = Review::count();

            // Units (sub_domain_id ছাড়া)
            $totalBrands = Brand::where('status', 'Active')->count();

            // Orders (total, today, monthly, yearly)
            $totalOrders = OrderDetail::count();

            $todayOrders = OrderDetail::whereDate('created_at', now())->count();

            $monthlyOrders = OrderDetail::whereMonth('created_at', now()->month)
                ->whereYear('created_at', now()->year)
                ->count();

            $yearlyOrders = OrderDetail::whereYear('created_at', now()->year)->count();

    		return view('layouts.app', compact(
                'totalSliders',
                'totalProducts',
                'totalReviews',
                'totalBrands',
                'totalOrders',
                'todayOrders',
                'monthlyOrders',
                'yearlyOrders'
            ));
    	} catch(Exception $e) {

                $message = $e->getMessage();

                $code = $e->getCode();

                $string = $e->__toString();
                return response()->json(['message'=>$message, 'execption_code'=>$code, 'execption_string'=>$string]);
                exit;
        }
    }
}
