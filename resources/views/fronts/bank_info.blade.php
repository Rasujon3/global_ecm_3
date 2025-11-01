@extends('front_master')
@section('front_content')
    <div class="container py-5">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">Bank Account Information</h4>
            </div>
            <div class="card-body">
                <table class="table table-bordered mb-0">
                    <tr>
                        <th>Bank Name</th>
                        <td>{{ $settings->bank_name ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th>Branch Name</th>
                        <td>{{ $settings->branch_name ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th>Routing Number</th>
                        <td>{{ $settings->routing_number ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th>Account No.</th>
                        <td>{{ $settings->acc_no ?? 'N/A' }}</td>
                    </tr>
                </table>

                <div class="mt-4 text-end">
                    <a href="{{ url()->previous() }}" class="btn btn-secondary">Back</a>
                </div>
            </div>
        </div>
    </div>
@endsection
