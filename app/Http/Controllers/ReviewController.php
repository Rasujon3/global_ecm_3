<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ReviewController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'rating' => 'required|integer|min:1|max:5',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $exists = Review::where('user_id',auth()->id())
            ->where('product_id', $request->product_id)
            ->exists();

        if ($exists) {
            $notification=array(
                'messege' => 'Already submitted review.',
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);
        }

        try {
            $review = new Review();
            $review->product_id = $request->product_id;
            $review->user_id = auth()->id();
            $review->rating = $request->rating;
            $review->description = $request->description;
            $review->status = 'approved';

            if ($request->hasFile('image')) {
                $imageName = $this->storeFile($request->file('image'));
                $review->image = $imageName;
            }

            $review->save();

            $notification=array(
                'messege'=>"Review submitted successfully.",
                'alert-type'=>"success",
            );

            return redirect()->back()->with($notification);
        } catch(Exception $e) {
            // Log the error
            Log::error('Error in store: ', [
                'message' => $e->getMessage(),
                'code' => $e->getCode(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString()
            ]);

            $notification=array(
                'messege' => 'Something went wrong!!!',
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);
        }
    }
    private function storeFile($file)
    {
        // Define the directory path
        // TODO: Change path if needed
        $filePath = 'uploads/image'; # change path if needed
        $directory = public_path($filePath);

        // Ensure the directory exists
        if (!file_exists($directory)) {
            mkdir($directory, 0777, true);
        }

        // Generate a unique file name
        // TODO: Change path if needed
        $fileName = uniqid('image_', true) . '.' . $file->getClientOriginalExtension();

        // Move the file to the destination directory
        $file->move($directory, $fileName);

        // path & file name in the database
        $path = $filePath . '/' . $fileName;
        return $path;
    }
}
