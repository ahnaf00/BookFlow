@extends('admin.admin-dashboard')

@section('content')
    @include('component.lendings.lending-list')
    @include('component.lendings.lending-update')
    @include('component.lendings.lending-delete')
@endsection
