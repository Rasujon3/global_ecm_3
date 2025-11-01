<div class="footer-newsletter bg-primary">
    <div class="container">
        <div class="row justify-content-center align-items-center">
            <div class="col-xl-5 col-lg-6">
                <div class="icon-box icon-box-side text-white">
                    <div class="icon-box-icon d-inline-flex">
                        <i class="w-icon-envelop3"></i>
                    </div>
                    <div class="icon-box-content">
                        <h4 class="icon-box-title text-white text-uppercase font-weight-bold">Subscribe To
                            Our Newsletter</h4>
                        <p class="text-white">Get all the latest information on Events, Sales and Offers.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-xl-7 col-lg-6 col-md-9 mt-4 mt-lg-0 ">
                <form id="newsletter-form" class="input-wrapper input-wrapper-inline input-wrapper-rounded">
                    @csrf
                    <input type="email" class="form-control mr-2 bg-white" name="email" id="email"
                           placeholder="Your E-mail Address" required />
                    <button class="btn btn-dark btn-rounded" type="submit">Subscribe<i
                            class="w-icon-long-arrow-right"></i></button>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    $(document).ready(function() {
        $('#newsletter-form').on('submit', function(e) {
            e.preventDefault();

            let email = $('#newsletter-form #email').val();
            let _token = $('input[name="_token"]').val();

            $.ajax({
                url: '/newsletter/subscribe',
                type: 'POST',
                data: {
                    email: email,
                    _token: _token
                },
                success: function(response) {
                    if (response.status === 'success') {
                        toastr.success(response.message);
                        $('#newsletter-form #email').val('');
                    } else {
                        toastr.error(response.message);
                    }
                },
                error: function(xhr) {
                    let errors = xhr.responseJSON.message;
                    toastr.error(errors);
                }
            });
        });
    });
</script>
@endpush
