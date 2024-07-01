<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 bg-slate-900 fixed-start " id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand d-flex align-items-center m-0"
            href="{{ route('admin.dashboard') }}"
            target="_blank">
            {{-- <img class="navbar-brand-img" src="{{ asset('backend/assets') }}/img/logo-ct.png" alt> --}}
            <span class="font-weight-bold ms-2"><h4 class="text-white">BookFlow</h4></span>
        </a>
    </div>
    <div class="collapse navbar-collapse px-3  w-auto h-auto" id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <li class="nav-item">
                {{-- <a data-bs-toggle="collapse" href="#pagesExamples" class="nav-link text-white opacity-9"
                    aria-controls="pagesExamples" role="button" aria-expanded="false">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center d-flex align-items-center justify-content-center">
                        <svg width="16px" height="16px" viewBox="0 0 42 42" version="1.1"
                            xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                            <title>office</title>
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <g transform="translate(-1869.000000, -293.000000)" fill="#FFFFFF"
                                    fill-rule="nonzero">
                                    <g transform="translate(1716.000000, 291.000000)">
                                        <g id="office" transform="translate(153.000000, 2.000000)">
                                            <path class="color-background"
                                                d="M12.25,17.5 L8.75,17.5 L8.75,1.75 C8.75,0.78225 9.53225,0 10.5,0 L31.5,0 C32.46775,0 33.25,0.78225 33.25,1.75 L33.25,12.25 L29.75,12.25 L29.75,3.5 L12.25,3.5 L12.25,17.5 Z"
                                                opacity="0.6"></path>
                                            <path class="color-background"
                                                d="M40.25,14 L24.5,14 C23.53225,14 22.75,14.78225 22.75,15.75 L22.75,38.5 L19.25,38.5 L19.25,22.75 C19.25,21.78225 18.46775,21 17.5,21 L1.75,21 C0.78225,21 0,21.78225 0,22.75 L0,40.25 C0,41.21775 0.78225,42 1.75,42 L40.25,42 C41.21775,42 42,41.21775 42,40.25 L42,15.75 C42,14.78225 41.21775,14 40.25,14 Z M12.25,36.75 L7,36.75 L7,33.25 L12.25,33.25 L12.25,36.75 Z M12.25,29.75 L7,29.75 L7,26.25 L12.25,26.25 L12.25,29.75 Z M35,36.75 L29.75,36.75 L29.75,33.25 L35,33.25 L35,36.75 Z M35,29.75 L29.75,29.75 L29.75,26.25 L35,26.25 L35,29.75 Z M35,22.75 L29.75,22.75 L29.75,19.25 L35,19.25 L35,22.75 Z">
                                            </path>
                                        </g>
                                    </g>
                                </g>
                            </g>
                        </svg>
                    </div>
                    <span class="nav-link-text ms-2">Pages</span>
                </a> --}}
                <div class="collapse show" id="pagesExamples">
                    <ul class="nav border-start ms-4">
                        
                        {{-- Admin Dashboard --}}
                        <li class="nav-item ">
                            <a class="nav-link text-white opacity-9"
                                href="{{ route('admin.dashboard') }}">
                                <span class="text-xs sidenav-mini-icon"> P </span>
                                <span class="sidenav-normal">Admin Dashboard</span>
                            </a>
                        </li>

                        {{-- Categories --}}
                        <li class="nav-item ">
                            <a class="nav-link text-white opacity-9"
                                href="{{ route('CategoryPage') }}">
                                <span class="text-xs sidenav-mini-icon"> P </span>
                                <span class="sidenav-normal">All Categories </span>
                            </a>
                        </li>

                        {{-- Subcategories --}}
                        <li class="nav-item ">
                            <a class="nav-link text-white opacity-9"
                                href="{{ route('SubCategoryPage') }}">
                                <span class="text-xs sidenav-mini-icon"> P </span>
                                <span class="sidenav-normal">All SubCategories </span>
                            </a>
                        </li>

                        {{-- All Books --}}
                        <li class="nav-item ">
                            <a class="nav-link text-white opacity-9"
                                href="{{ route('BooksPage') }}">
                                <span class="text-xs sidenav-mini-icon"> P </span>
                                <span class="sidenav-normal">All Books </span>
                            </a>
                        </li>

                        {{-- Lendings --}}
                        <li class="nav-item ">
                            <a class="nav-link text-white opacity-9"
                            href="{{route('LendingPage')}}">
                                <span class="text-xs sidenav-mini-icon"> P </span>
                                <span class="sidenav-normal">Lendings</span>
                            </a>
                        </li>

                        {{-- Users --}}
                        <li class="nav-item ">
                            <a class="nav-link text-white opacity-9"
                            href="{{route('UsersPage')}}">
                                <span class="text-xs sidenav-mini-icon"> P </span>
                                <span class="sidenav-normal">Users</span>
                            </a>
                        </li>

                        {{-- <li class="nav-item ">
                            <a class="nav-link text-white opacity-9 " data-bs-toggle="collapse" aria-expanded
                                href="#profileExample">
                                <span class="sidenav-mini-icon"> P </span>
                                <span class="sidenav-normal"> Property Type <b class="caret"></b></span>
                            </a>
                            <div class="collapse " id="profileExample">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a class="nav-link text-white opacity-9"
                                            href="#">
                                            <span class="text-xs sidenav-mini-icon"> P </span>
                                            <span class="sidenav-normal">All Property Type </span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li> --}}
                    </ul>
                </div>
            </li>
        </ul>
    </div>

</aside>
