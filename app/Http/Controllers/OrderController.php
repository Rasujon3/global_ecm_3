<?php

namespace App\Http\Controllers;

use App\Models\Productvariant;
use App\Models\Variant;
use Exception;
use Illuminate\Http\Request;
use App\Model\Order;
use App\Models\Orderdetail;
use DataTables;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{

	public function __construct()
    {
        $this->middleware('auth_check');
    }

    public function orderLists(Request $request)
    {
    	if ($request->ajax()) {
            $orders = Orderdetail::latest();

            return DataTables::of($orders)
                ->addIndexColumn()

                ->addColumn('serial', function ($row) {
                	return $row->id;
                })

                ->addColumn('payment_method', function ($row) {
                    return optional($row->paymentmethod)->name ?? 'N/A';
                })

//                ->addColumn('status', function ($row) {
//                    return $row->status;
//                })

                ->addColumn('status', function($row) {
                    $statuses = ['Pending', 'Order_Received', 'Processing','Shipped', 'In_Transit', 'Out_for_Delivery', 'Delivered'];

                    // Find the current status index
                    $currentIndex = array_search($row->status, $statuses);

                    $html = "<select class='form-control change-status' data-id='".$row->id."'>";

                    foreach ($statuses as $index => $status) {
                        // Disable previous statuses (index < currentIndex)
                        $disabled = ($index < $currentIndex && $row->status != 'Cancel') ? "disabled" : "";

                        // Mark current status as selected
                        $selected = ($row->status == $status) ? "selected" : "";

                        $html .= "<option value='{$status}' {$selected} {$disabled}>{$status}</option>";
                    }

                    $html .= "</select>";

                    return $html;
                })

                ->addColumn('action', function ($row) {
                    $viewUrl = url('/')."/show-order/".$row->id;

                    return '
                        <a href="' . $viewUrl . '"
                           class="btn btn-primary btn-sm action-button view-order"
                           data-id="' . $row->id . '">
                            <i class="fa fa-eye"></i>
                        </a>
                        &nbsp;
                        <button type="button"
                           class="btn btn-danger btn-sm delete-order action-button"
                           data-id="' . $row->id . '">
                            <i class="fa fa-trash"></i>
                        </button>
                    ';
                })->filter(function ($instance) use ($request) {

                    if ($request->get('from_date') != "") {
                        $instance->where(function($w) use($request){
                            $w->orWhereDate('orderdetails.created_at', '>=', $request->from_date);
                        });
                    }

                    if ($request->get('to_date') != "") {
                        $instance->where(function($w) use($request){
                            $w->orWhereDate('orderdetails.created_at', '<=', $request->to_date);
                        });
                    }

                    if ($request->get('status') != "") {
                        $instance->where(function($w) use($request){
                            $status = $request->get('status');
                            $w->orWhere('orderdetails.status', $status);
                        });
                    }

                    if ($request->has('search') && isset($request->search) && $request->search !== '') {
                        $searchValue = $request->search;
                        $instance->where(function ($q) use ($searchValue) {
                            $q->where('orderdetails.name', 'like', "%{$searchValue}%")
                                ->orWhere('orderdetails.id', 'like', "%{$searchValue}%")
                                ->orWhere('orderdetails.phone', 'like', "%{$searchValue}%")
                                ->orWhere('orderdetails.email', 'like', "%{$searchValue}%");
                        });
                    }
                })
                ->rawColumns(['status', 'action','serial','payment_method'])
                ->make(true);
        }

        return view('orders.order_lists');
    }

    public function showOrder($id)
    {
    	$data = Orderdetail::with('orders.product', 'paymentmethod')->findorfail($id);
    	return view('orders.show_invoice', compact('data'));
    }
    public function orderStatusUpdate(Request $request)
    {
        DB::beginTransaction();
        try
        {
            $order = Orderdetail::findOrFail($request->order_id);

            $order->status = $request->status;
            $order->update();

            DB::commit();
            return response()->json(['status'=>true, 'message'=>"Successfully the order's status has been changed"]);
        } catch(Exception $e) {
            DB::rollback();
            return response()->json(['status'=>false, 'code'=>$e->getCode(), 'message'=>$e->getMessage()],500);
        }
    }
}
