@extends('admin.admin-dashboard')

@section('content')
    @include('component.subcategory.subcategory-list')
    @include('component.subcategory.subcategory-create')
    @include('component.subcategory.subcategory-update')
    @include('component.subcategory.subcategory-delete')
@endsection
