@extends('admin.admin-dashboard')

@section('content')
    @include('component.books.book-list')
    @include('component.books.book-create')
    @include('component.books.book-delete')
    @include('component.books.book-update')
@endsection
