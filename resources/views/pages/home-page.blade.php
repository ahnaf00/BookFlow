@extends('layout.app')

@section('main-content')
    @include('component.navbar')
    @include('component.hero')
    @include('component.search')
    @include('component.allbooks')
    @include('component.footer')

    <script>
        // (async () => {
        //     userDetails()
        // })()
    </script>
@endsection
