@extends('admin.admin-dashboard')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="mx-2 mb-3 d-md-flex align-items-center">
                <div class="mb-3 mb-md-0">
                    Welcome, <h3 class="mb-0 font-weight-bold">{{ auth()->user()->full_name }}</h3>
                </div>
            </div>
        </div>
    </div>
@endsection
