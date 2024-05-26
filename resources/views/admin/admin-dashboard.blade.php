<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    @include('admin.inc.header')
</head>

<body class="g-sidenav-show   bg-gray-100">

    @include('admin.inc.sidebar')

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">

        @include('admin.inc.navbar')

        <div class="px-5 py-4 container-fluid">

            @yield('content')

            {{-- @include('admin.inc.footer') --}}
        </div>
    </main>

    @include('admin.inc.script')
</body>

</html>
