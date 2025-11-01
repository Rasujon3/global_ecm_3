<?php

namespace App\Http\Controllers;

use App\Models\Newsletter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use DataTables;

class NewsletterController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $newsletters = Newsletter::latest();

            return DataTables::of($newsletters)
                ->addIndexColumn()
                ->addColumn('email', function($row){
                    return strip_tags($row->email);
                })
                ->addColumn('action', function ($row) {
                    return '
                        <button type="button"
                           class="btn btn-danger btn-sm delete-newsletter action-button"
                           data-id="' . $row->id . '">
                            <i class="fa fa-trash"></i>
                        </button>
                    ';
                })
                ->rawColumns([
                    'email',
                    'action'
                ])
                ->make(true);
        }

        return view('admin.newsletters.index');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:newsletters,email',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()->first(),
            ], 422);
        }

        try {
            Newsletter::create([
                'email' => $request->email,
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Thank you for subscribing!',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Something went wrong. Please try again later.',
            ], 500);
        }
    }

    public function destroy(Newsletter $newsletter)
    {
        $newsletter->delete();

        return response()->json(['status'=>true, 'message'=>"Successfully the newsletter has been deleted"]);
    }
}
