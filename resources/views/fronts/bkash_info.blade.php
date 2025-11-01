@extends('front_master')
@section('front_content')
    <div class="container py-5">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">BKash Account Information</h4>
            </div>
            <div class="card-body">
                <table class="table table-bordered mb-0">
                    <tr>
                        <th>BKash Number</th>
                        <td>{{ $settings->bkash_no ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th>Account Type</th>
                        <td>{{ $settings->account_type ?? 'N/A' }}</td>
                    </tr>
                </table>

                <div class="mt-4 text-end">
                    <a href="{{ url()->previous() }}" class="btn btn-secondary">Back</a>
                </div>
            </div>
        </div>
    </div>
@endsection
