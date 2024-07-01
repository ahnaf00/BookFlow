@extends('admin.admin-dashboard')

@section('content')
    @include('component.category.category-list')
    @include('component.category.category-create')
    @include('component.category.category-update')
    @include('component.category.category-delete')
@endsection
