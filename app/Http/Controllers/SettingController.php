<?php

namespace App\Http\Controllers;

use App\Models\AboutUs;
use App\Models\LoginPageContent;
use App\Models\Setting;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth_check');
    }
    public function settings()
    {
        $setting = Setting::first();
        return view('admin.settings.settings',compact('setting'));
    }
    public function settingApp(Request $request)
    {
        try
        {
            $data = Setting::first();

            $defaults = [
                'logo'       => $data ? $data->logo : null,
                'favicon'    => $data ? $data->favicon : null,
                'phone'      => $data ? $data->phone : null,
                'email'      => $data ? $data->email : null,
                'address'    => $data ? $data->address : null,
                'established'=> $data ? $data->established : null,
                'facebook'   => $data ? $data->facebook : null,
                'twitter'    => $data ? $data->twitter : null,
                'instagram'  => $data ? $data->instagram : null,
                'youtube'    => $data ? $data->youtube : null,
                'pinterest'  => $data ? $data->pinterest : null,
                'contact_us_img'    => $data ? $data->contact_us_img : null,
                'inside_dhaka_dc'    => $data ? $data->inside_dhaka_dc : null,
                'outside_dhaka_dc'    => $data ? $data->outside_dhaka_dc : null,
                'sub_urban_areas_dc'    => $data ? $data->sub_urban_areas_dc : null,

                'bank_name'    => $data ? $data->bank_name : null,
                'branch_name'    => $data ? $data->branch_name : null,
                'routing_number'    => $data ? $data->routing_number : null,
                'acc_no'    => $data ? $data->acc_no : null,

                'bkash_no'    => $data ? $data->bkash_no : null,
                'account_type'    => $data ? $data->account_type : null,

                'welcome_msg'  => $data ? $data->welcome_msg : null,
                'shop_name'    => $data ? $data->shop_name : null,
                'copyright_msg'    => $data ? $data->copyright_msg : null,
                'footer_title'    => $data ? $data->footer_title : null,
                'footer_description'    => $data ? $data->footer_description : null,

                'meta_pixel_script'    => $data ? $data->meta_pixel_script : null,
            ];

            // Handle file upload
            $logo = $defaults['logo'];
            if ($request->hasFile('logo')) {
                $filePath = $this->storeFile($request->file('logo'));
                $logo = $filePath;
            }

            $favicon = $defaults['favicon'];
            if ($request->hasFile('favicon')) {
                $filePath = $this->storeFile($request->file('favicon'));
                $favicon = $filePath;
            }

            $contact_us_img = $defaults['contact_us_img'];
            if ($request->hasFile('contact_us_img')) {
                $filePath = $this->storeFile($request->file('contact_us_img'));
                $contact_us_img = $filePath;
            }

            if ($data) {
                Setting::where('id', $data->id)->update(
                    [
                        'logo'        => $logo,
                        'favicon'     => $favicon,
                        'contact_us_img' => $contact_us_img,
                        'phone'       => $request->phone ?? $defaults['phone'],
                        'email'       => $request->email ?? $defaults['email'],
                        'address'     => $request->address ?? $defaults['address'],
                        'established' => $request->established ?? $defaults['established'],
                        'facebook'    => $request->facebook ?? $defaults['facebook'],
                        'twitter'     => $request->twitter ?? $defaults['twitter'],
                        'instagram'   => $request->instagram ?? $defaults['instagram'],
                        'youtube'     => $request->youtube ?? $defaults['youtube'],
                        'pinterest'   => $request->pinterest ?? $defaults['pinterest'],
                        'inside_dhaka_dc'   => $request->inside_dhaka_dc ?? $defaults['inside_dhaka_dc'],
                        'outside_dhaka_dc'   => $request->outside_dhaka_dc ?? $defaults['outside_dhaka_dc'],
                        'sub_urban_areas_dc'   => $request->sub_urban_areas_dc ?? $defaults['sub_urban_areas_dc'],

                        'bank_name'   => $request->bank_name ?? $defaults['bank_name'],
                        'branch_name'   => $request->branch_name ?? $defaults['branch_name'],
                        'routing_number'   => $request->routing_number ?? $defaults['routing_number'],
                        'acc_no'   => $request->acc_no ?? $defaults['acc_no'],

                        'bkash_no'   => $request->bkash_no ?? $defaults['bkash_no'],
                        'account_type'   => $request->account_type ?? $defaults['account_type'],

                        'welcome_msg'     => $request->welcome_msg ?? $defaults['welcome_msg'],
                        'shop_name'   => $request->shop_name ?? $defaults['shop_name'],
                        'copyright_msg'   => $request->copyright_msg ?? $defaults['copyright_msg'],
                        'footer_title'   => $request->footer_title ?? $defaults['footer_title'],
                        'footer_description'   => $request->footer_description ?? $defaults['footer_description'],

                        'meta_pixel_script'   => $request->meta_pixel_script ?? $defaults['meta_pixel_script'],
                    ]
                );
            } else {
                Setting::create(
                    [
                        'logo'        => $logo,
                        'favicon'     => $favicon,
                        'contact_us_img' => $contact_us_img,
                        'phone'       => $request->phone ?? $defaults['phone'],
                        'email'       => $request->email ?? $defaults['email'],
                        'address'     => $request->address ?? $defaults['address'],
                        'established' => $request->established ?? $defaults['established'],
                        'facebook'    => $request->facebook ?? $defaults['facebook'],
                        'twitter'     => $request->twitter ?? $defaults['twitter'],
                        'instagram'   => $request->instagram ?? $defaults['instagram'],
                        'youtube'     => $request->youtube ?? $defaults['youtube'],
                        'pinterest'   => $request->pinterest ?? $defaults['pinterest'],
                        'inside_dhaka_dc'   => $request->inside_dhaka_dc ?? $defaults['inside_dhaka_dc'],
                        'outside_dhaka_dc'   => $request->outside_dhaka_dc ?? $defaults['outside_dhaka_dc'],
                        'sub_urban_areas_dc'   => $request->sub_urban_areas_dc ?? $defaults['sub_urban_areas_dc'],

                        'bank_name'   => $request->bank_name ?? $defaults['bank_name'],
                        'branch_name'   => $request->branch_name ?? $defaults['branch_name'],
                        'routing_number'   => $request->routing_number ?? $defaults['routing_number'],
                        'acc_no'   => $request->acc_no ?? $defaults['acc_no'],

                        'bkash_no'   => $request->bkash_no ?? $defaults['bkash_no'],
                        'account_type'   => $request->account_type ?? $defaults['account_type'],

                        'welcome_msg'     => $request->welcome_msg ?? $defaults['welcome_msg'],
                        'shop_name'   => $request->shop_name ?? $defaults['shop_name'],
                        'copyright_msg'   => $request->copyright_msg ?? $defaults['copyright_msg'],
                        'footer_title'   => $request->footer_title ?? $defaults['footer_title'],
                        'footer_description'   => $request->footer_description ?? $defaults['footer_description'],

                        'meta_pixel_script'   => $request->meta_pixel_script ?? $defaults['meta_pixel_script'],
                    ]
                );
            }

            $notification = [
                'messege'    => 'Successfully updated',
                'alert-type' => 'success',
            ];

            return redirect()->back()->with($notification);

        } catch (Exception $e) {
            // Log the error
            Log::error('Error in updating settings: ', [
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
    public function bkashInfo()
    {
        $setting = Setting::first();
        return view('admin.settings.bkashInfo',compact('setting'));
    }
    public function updateBkashInfo(Request $request)
    {
        try
        {
            $data = Setting::first();

            $defaults = [
                'bkash_no'    => $data ? $data->bkash_no : null,
                'account_type'    => $data ? $data->account_type : null,
            ];

            if ($data) {
                Setting::where('id', $data->id)->update(
                    [
                        'bkash_no'   => $request->bkash_no ?? $defaults['bkash_no'],
                        'account_type'   => $request->account_type ?? $defaults['account_type'],
                    ]
                );
            } else {
                Setting::create(
                    [
                        'bkash_no'   => $request->bkash_no ?? $defaults['bkash_no'],
                        'account_type'   => $request->account_type ?? $defaults['account_type'],
                    ]
                );
            }

            $notification = [
                'messege'    => 'Successfully updated',
                'alert-type' => 'success',
            ];

            return redirect()->back()->with($notification);

        } catch (Exception $e) {
            // Log the error
            Log::error('Error in updating updateBkashInfo: ', [
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
    public function bankInfo()
    {
        $setting = Setting::first();
        return view('admin.settings.bankInfo',compact('setting'));
    }
    public function updateBankInfo(Request $request)
    {
        try
        {
            $data = Setting::first();

            $defaults = [
                'bank_name'    => $data ? $data->bank_name : null,
                'branch_name'    => $data ? $data->branch_name : null,
                'routing_number'    => $data ? $data->routing_number : null,
                'acc_no'    => $data ? $data->acc_no : null,
            ];

            if ($data) {
                Setting::where('id', $data->id)->update(
                    [
                        'bank_name'   => $request->bank_name ?? $defaults['bank_name'],
                        'branch_name'   => $request->branch_name ?? $defaults['branch_name'],
                        'routing_number'   => $request->routing_number ?? $defaults['routing_number'],
                        'acc_no'   => $request->acc_no ?? $defaults['acc_no'],
                    ]
                );
            } else {
                Setting::create(
                    [
                        'bank_name'   => $request->bank_name ?? $defaults['bank_name'],
                        'branch_name'   => $request->branch_name ?? $defaults['branch_name'],
                        'routing_number'   => $request->routing_number ?? $defaults['routing_number'],
                        'acc_no'   => $request->acc_no ?? $defaults['acc_no'],
                    ]
                );
            }

            $notification = [
                'messege'    => 'Successfully updated',
                'alert-type' => 'success',
            ];

            return redirect()->back()->with($notification);

        } catch (Exception $e) {
            // Log the error
            Log::error('Error in updating updateBankInfo: ', [
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
    public function deliveryCharges()
    {
        $setting = Setting::first();
        return view('admin.settings.deliveryCharges',compact('setting'));
    }
    public function updateDeliveryCharges(Request $request)
    {
        try
        {
            $data = Setting::first();

            $defaults = [
                'inside_dhaka_dc'    => $data ? $data->inside_dhaka_dc : null,
                'outside_dhaka_dc'    => $data ? $data->outside_dhaka_dc : null,
                'sub_urban_areas_dc'    => $data ? $data->sub_urban_areas_dc : null,
            ];

            if ($data) {
                Setting::where('id', $data->id)->update(
                    [
                        'inside_dhaka_dc'   => $request->inside_dhaka_dc ?? $defaults['inside_dhaka_dc'],
                        'outside_dhaka_dc'   => $request->outside_dhaka_dc ?? $defaults['outside_dhaka_dc'],
                        'sub_urban_areas_dc'   => $request->sub_urban_areas_dc ?? $defaults['sub_urban_areas_dc'],
                    ]
                );
            } else {
                Setting::create(
                    [
                        'inside_dhaka_dc'   => $request->inside_dhaka_dc ?? $defaults['inside_dhaka_dc'],
                        'outside_dhaka_dc'   => $request->outside_dhaka_dc ?? $defaults['outside_dhaka_dc'],
                        'sub_urban_areas_dc'   => $request->sub_urban_areas_dc ?? $defaults['sub_urban_areas_dc'],
                    ]
                );
            }

            $notification = [
                'messege'    => 'Successfully updated',
                'alert-type' => 'success',
            ];

            return redirect()->back()->with($notification);

        } catch (Exception $e) {
            // Log the error
            Log::error('Error in updating updateDeliveryCharges: ', [
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

    public function aboutUs()
    {
        $aboutUs = AboutUs::first();
        return view('admin.settings.about_us',compact('aboutUs'));
    }
    public function storeAboutUs(Request $request)
    {
        DB::beginTransaction();
        try
        {
            $data = AboutUs::first();

            $defaults = [
                'title' => $data ? $data->title : null,
                'desc' => $data ? $data->desc : null,
                'img' => $data ? $data->img : null,
            ];

            // Handle file upload
            $img = $defaults['img'];
            if ($request->hasFile('img')) {
                $filePath = $this->storeFile($request->file('img'));
                $img = $filePath;
            }

            if ($data) {
                AboutUs::where('id', $data->id)->update(
                    [
                        'title' => trim($request->title) ?? $defaults['title'],
                        'desc' => trim($request->desc) ?? $defaults['desc'],
                        'img' => $img,
                    ]
                );
            } else {
                AboutUs::create(
                    [
                        'title' => trim($request->title) ?? $defaults['title'],
                        'desc' => trim($request->desc) ?? $defaults['desc'],
                        'img' => $img,
                    ]
                );
            }

            DB::commit();
            $notification = [
                'message'    => 'Successfully updated',
                'alert-type' => 'success',
            ];

            return redirect()->back()->with($notification);

        } catch (Exception $e) {
            DB::rollBack();
            // Log the error
            Log::error('Error in updating about us: ', [
                'message' => $e->getMessage(),
                'code' => $e->getCode(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString()
            ]);

            $notification=array(
                'message' => 'Something went wrong!!!',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
    }
    private function storeFile($file)
    {
        // Define the directory path
        // TODO: Change path if needed
        $filePath = 'uploads/logo'; # change path if needed
        $directory = public_path($filePath);

        // Ensure the directory exists
        if (!file_exists($directory)) {
            mkdir($directory, 0777, true);
        }

        // Generate a unique file name
        // TODO: Change path if needed
        $fileName = uniqid('logo_', true) . '.' . $file->getClientOriginalExtension();

        // Move the file to the destination directory
        $file->move($directory, $fileName);

        // path & file name in the database
        $path = $filePath . '/' . $fileName;
        return $path;
    }
    private function updateFile($file, $data)
    {
        // Define the directory path
        // TODO: Change path if needed
        $filePath = 'uploads/logo'; # change path if needed
        $directory = public_path($filePath);

        // Ensure the directory exists
        if (!file_exists($directory)) {
            mkdir($directory, 0777, true);
        }

        // Generate a unique file name
        // TODO: Change path following storeFile function
        $fileName = uniqid('logo_', true) . '.' . $file->getClientOriginalExtension();

        // Delete the old file if it exists
        $this->deleteOldFile($data);

        // Move the new file to the destination directory
        $file->move($directory, $fileName);

        // Store path & file name in the database
        $path = $filePath . '/' . $fileName;
        return $path;
    }
    private function deleteOldFile($data)
    {
        // TODO: ensure from database
        if (!empty($data->company_logo)) { # ensure from database
            $oldFilePath = public_path($data->company_logo); // Use without prepending $filePath
            if (file_exists($oldFilePath)) {
                unlink($oldFilePath); // Delete the old file
                return true;
            } else {
                Log::warning('Old file not found for deletion', ['path' => $oldFilePath]);
                return false;
            }
        }
    }
    private function storeLoginFile($file)
    {
        // Define the directory path
        // TODO: Change path if needed
        $filePath = 'uploads/login'; # change path if needed
        $directory = public_path($filePath);

        // Ensure the directory exists
        if (!file_exists($directory)) {
            mkdir($directory, 0777, true);
        }

        // Generate a unique file name
        // TODO: Change path if needed
        $fileName = uniqid('login_', true) . '.' . $file->getClientOriginalExtension();

        // Move the file to the destination directory
        $file->move($directory, $fileName);

        // path & file name in the database
        $path = $filePath . '/' . $fileName;
        return $path;
    }
    private function deleteLoginOldFile($data)
    {
        // TODO: ensure from database
        if (!empty($data->img)) { # ensure from database
            $oldFilePath = public_path($data->img); // Use without prepending $filePath
            if (file_exists($oldFilePath)) {
                unlink($oldFilePath); // Delete the old file
                return true;
            } else {
                Log::warning('Old file not found for deletion', ['path' => $oldFilePath]);
                return false;
            }
        }
    }
}
