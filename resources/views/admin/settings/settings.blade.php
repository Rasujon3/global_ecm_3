@extends('admin_master')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Settings</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{URL::to('/dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{URL::to('/settings')}}">Settings</a></li>
                        <li class="breadcrumb-item active">Settings</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <section class="content">
        <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title">Settings</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form action="{{url('settings-app')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="shop_name">Shop Name <span class="required">*</span></label>
                                <input
                                    type="text"
                                    name="shop_name"
                                    class="form-control"
                                    id="shop_name"
                                    required
                                    placeholder="Shop Name"
                                    value="{{old('shop_name', ($setting && $setting->shop_name) ? $setting->shop_name : "")}}"
                                >
                                @error('shop_name')
                                    <span class="alert alert-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="welcome_msg">Welcome Message <span class="required">*</span></label>
                                <input
                                    type="text"
                                    name="welcome_msg"
                                    class="form-control"
                                    id="welcome_msg"
                                    placeholder="Welcome Message"
                                    required
                                    value="{{old('welcome_msg', $setting ? $setting->welcome_msg : "")}}"
                                >
                                @error('welcome_msg')
                                    <span class="alert alert-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="logo">Logo <span class="required">*</span></label>
                                <input
                                    name="logo"
                                    type="file"
                                    id="logo"
                                    accept="image/*"
                                    class="dropify"
                                    data-height="150"
                                    data-default-file="{{ URL::to($setting ? $setting->logo : '') }}"
                                />
                                @error('logo')
                                <span class="alert alert-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="favicon">Favicon <span class="required">*</span></label>
                                <input
                                    name="favicon"
                                    type="file"
                                    id="favicon"
                                    accept="image/*"
                                    class="dropify"
                                    data-height="150"
                                    data-default-file="{{ URL::to($setting ? $setting->favicon : '') }}"
                                />
                                @error('favicon')
                                <span class="alert alert-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="phone">Phone <span class="required">*</span></label>
                                <input
                                    type="text"
                                    name="phone"
                                    class="form-control"
                                    id="phone"
                                    required
                                    placeholder="Phone"
                                    value="{{old('phone', ($setting && $setting->phone) ? $setting->phone : "")}}"
                                >
                                @error('phone')
                                    <span class="alert alert-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email">Email <span class="required">*</span></label>
                                <input type="text" name="email" class="form-control" id="email"
                                       placeholder="Email" required value="{{old('email', $setting ? $setting->email : "")}}">
                                @error('email')
                                <span class="alert alert-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="address">Address <span class="required">*</span></label>
                                <input
                                    type="text"
                                    name="address"
                                    class="form-control"
                                    id="address"
                                    required
                                    placeholder="Address"
                                    value="{{old('address', ($setting && $setting->address) ? $setting->address : "")}}"
                                >
                                @error('address')
                                    <span class="alert alert-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="established">Established <span class="required">*</span></label>
                                <input type="text" name="established" class="form-control" id="established"
                                       placeholder="Established" required value="{{old('established', $setting ? $setting->established : "")}}">
                                @error('established')
                                <span class="alert alert-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="facebook">Facebook <span class="required">*</span></label>
                                <input
                                    type="text"
                                    name="facebook"
                                    class="form-control"
                                    id="facebook"
                                    required
                                    placeholder="Facebook"
                                    value="{{old('facebook', ($setting && $setting->facebook) ? $setting->facebook : "")}}"
                                >
                                @error('facebook')
                                    <span class="alert alert-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="twitter">Twitter <span class="required">*</span></label>
                                <input type="text" name="twitter" class="form-control" id="twitter"
                                       placeholder="Twitter" required value="{{old('twitter', $setting ? $setting->twitter : "")}}">
                                @error('twitter')
                                <span class="alert alert-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="instagram">Instagram <span class="required">*</span></label>
                                <input
                                    type="text"
                                    name="instagram"
                                    class="form-control"
                                    id="instagram"
                                    required
                                    placeholder="Facebook"
                                    value="{{old('instagram', ($setting && $setting->instagram) ? $setting->instagram : "")}}"
                                >
                                @error('instagram')
                                    <span class="alert alert-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="youtube">Youtube <span class="required">*</span></label>
                                <input type="text" name="youtube" class="form-control" id="youtube"
                                       placeholder="Youtube" required value="{{old('youtube', $setting ? $setting->youtube : "")}}">
                                @error('youtube')
                                <span class="alert alert-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="pinterest">Pinterest <span class="required">*</span></label>
                                <input type="text" name="pinterest" class="form-control" id="pinterest"
                                       placeholder="Youtube"  value="{{old('pinterest', $setting ? $setting->pinterest : "")}}">
                                @error('pinterest')
                                <span class="alert alert-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="contact_us_img">Contact Us Img <span class="required">*</span></label>
                                <input
                                    name="contact_us_img"
                                    type="file"
                                    id="contact_us_img"
                                    accept="image/*"
                                    class="dropify"
                                    data-height="150"
                                    data-default-file="{{ URL::to($setting ? $setting->contact_us_img : '') }}"
                                />
                                @error('contact_us_img')
                                <span class="alert alert-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="copyright_msg">Copyright Message <span class="required">*</span></label>
                                <input
                                    type="text"
                                    name="copyright_msg"
                                    class="form-control"
                                    id="copyright_msg"
                                    required
                                    placeholder="Copyright Message"
                                    value="{{old('copyright_msg', ($setting && $setting->copyright_msg) ? $setting->copyright_msg : "")}}"
                                >
                                @error('copyright_msg')
                                <span class="alert alert-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="footer_title">Footer Title <span class="required">*</span></label>
                                <input
                                    type="text"
                                    name="footer_title"
                                    class="form-control"
                                    id="footer_title"
                                    placeholder="Footer Title"
                                    required
                                    value="{{old('footer_title', $setting ? $setting->footer_title : "")}}"
                                >
                                @error('footer_title')
                                <span class="alert alert-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="footer_description">Footer Description <span class="required">*</span></label>
                                <input
                                    type="text"
                                    name="footer_description"
                                    class="form-control"
                                    id="footer_description"
                                    placeholder="Footer Description"
                                    required
                                    value="{{old('footer_description', $setting ? $setting->footer_description : "")}}"
                                >
                                @error('footer_description')
                                <span class="alert alert-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="meta_pixel_script">Meta Pixel ID</label>
                                <input
                                    type="text"
                                    name="meta_pixel_script"
                                    class="form-control"
                                    id="meta_pixel_script"
                                    placeholder="Meta Pixel ID"
                                    required
                                    value="{{old('meta_pixel_script', $setting ? $setting->meta_pixel_script : "")}}"
                                >
                                @error('meta_pixel_script')
                                <span class="alert alert-danger">{{ $message }}</span>
                                @enderror
                            </div>

{{--                            <div class="form-group">--}}
{{--                                <label for="meta_pixel_script">Meta Pixel Script</label>--}}
{{--                                <textarea--}}
{{--                                    id="meta_pixel_script"--}}
{{--                                    name="meta_pixel_script"--}}
{{--                                    class="form-control"--}}
{{--                                    style="display:none;"--}}
{{--                                >{!! old('meta_pixel_script', $settings->meta_pixel_script ?? '') !!}</textarea>--}}
{{--                                <div id="code-editor" style="height: 300px; border: 1px solid #ddd;"></div>--}}
{{--                            </div>--}}
                        </div>
                    </div>

                    <div class="form-group w-100">
                        <button type="submit" class="btn btn-success">Save Changes</button>
                    </div>
                </div>
                    <!-- /.card-body -->
            </form>
        </div>
    </section>
</div>
@endsection

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.4.12/ace.js"></script>
    <script>
        var editor = ace.edit("code-editor");
        editor.setTheme("ace/theme/monokai");
        editor.session.setMode("ace/mode/html");

        // Load existing value
        editor.setValue({!! json_encode(old('meta_pixel_script', $settings->meta_pixel_script ?? '')) !!});

        // Update textarea on form submit
        $('form').on('submit', function() {
            $('#meta_pixel_script').val(editor.getValue());
        });
    </script>
@endpush
