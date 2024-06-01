<nav class=" px-0 mx-5 rounded shadow-none z-index-2 navbar navbar-main navbar-expand-lg" navbar-scroll="true"
     id="navbarBlur">
    <div class="container px-2 py-1 min-w-100">
        <nav aria-label="breadcrumb">
            <ol class="px-0 pt-1 pb-0 mb-1 bg-transparent breadcrumb me-sm-6 me-5">
                <li class="text-sm breadcrumb-item"><a class="opacity-5 p-0 breadcrumb-text  text-dark "
                                                       href="javascript:;">Dashboard</a></li>
                <li class="text-sm breadcrumb-item  breadcrumb-text  text-dark  active" aria-current="page">
                    Default
                </li>
            </ol>
            <h6 class="mb-0 font-weight-bold breadcrumb-text  text-dark ">Default</h6>
        </nav>

        {{--  --}}
        <li class="nav-item dropdown align-items-center" style="margin-right: 100px">
            <a href="#" class="p-0 text-white dropdown-toggle nav-link show"
               id="dropdownProfile" data-bs-toggle="dropdown" aria-expanded="true" data-bs-auto-close="outside">
                <div class="avatar avatar-sm position-relative">
                    <img src="{{ asset('backend/assets') }}/img/team-1.jpg" alt="profile_image"
                         class="w-100 border-radius-lg">
                    {{-- <img src="{{ $data['photo'] ? url($data['photo']) : asset('backend/assets/img/team-1.jpg') }}" alt="image" class="w-100 border-radius-lg shadow-sm"> --}}
                </div>
            </a>
            <ul class="dropdown-menu" aria-labelledby="dropdownProfile" data-bs-popper="static">
                <li class="mb-2">
                    <a href="#" class="dropdown-item border-radius-md">
                        Profile Overview
                    </a>
                </li>
                <li class="mb-2">
                    <a href="#}" class="dropdown-item border-radius-md">
                        Change Password
                    </a>
                </li>
                <li class="mb-2">
                    <form method="POST" action="{{ route('admin.logout') }}">
                        @csrf
                        <a href="#"
                           class="dropdown-item border-radius-md"
                           onclick="event.preventDefault();this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </a>
                    </form>
                </li>
            </ul>
        </li>

        {{--  --}}

    </div>
</nav>
