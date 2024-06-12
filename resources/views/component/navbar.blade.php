<!-- Navbar Dark -->

<nav
  class="navbar navbar-expand-lg navbar-dark bg-dark z-index-3 py-3">
  <div class="container">
    <a class="navbar-brand text-white" href="{{ route('HomePage') }}" rel="tooltip" title="Designed and Coded by Creative Tim" data-placement="bottom" target="_blank">
      <h4 style="color: rgb(255, 255, 255)"><b>BookFlow</b></h4>
    </a>
    <a href="https://www.creative-tim.com/product/now-ui-design-system-pro#pricingCard" class="btn btn-sm  bg-gradient-primary  btn-round mb-0 ms-auto d-lg-none d-block">Buy Now</a>
    <button class="navbar-toggler shadow-none ms-2" type="button" data-bs-toggle="collapse" data-bs-target="#navigation" aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon mt-2">
        <span class="navbar-toggler-bar bar1"></span>
        <span class="navbar-toggler-bar bar2"></span>
        <span class="navbar-toggler-bar bar3"></span>
      </span>
    </button>
    <div class="collapse navbar-collapse w-100 pt-3 pb-2 py-lg-0" id="navigation">
      <ul class="navbar-nav navbar-nav-hover mx-auto">
        <li class="nav-item mx-2">
          <a class="nav-link ps-2 d-flex justify-content-between cursor-pointer align-items-center" role="button">
            Pages
            <img src="../../assets/img/down-arrow-white.svg" alt="down-arrow" class="arrow ms-1">
          </a>
        </li>

        <li class="nav-item mx-2">
          <a class="nav-link ps-2 d-flex justify-content-between cursor-pointer align-items-center" role="button">
            Account
            <img src="../../assets/img/down-arrow-white.svg" alt="down-arrow" class="arrow ms-1">
          </a>
        </li>
        <li class="nav-item mx-2">
          <a class="nav-link ps-2 d-flex justify-content-between cursor-pointer align-items-center" role="button">
            Blocks
            <img src="../../assets/img/down-arrow-white.svg" alt="down-arrow" class="arrow ms-1">
          </a>
        </li>
      </ul>

        <ul class="navbar-nav">
            @if (Cookie::get('token') !== null)
                <div class="dropdown">
                    <li class="nav-item mx-2">
                        <a class="nav-link ps-2 d-flex justify-content-between cursor-pointer align-items-center dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" role="button">
                            Account
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Action</a></li>
                            <li><a class="dropdown-item" href="#">Another action</a></li>
                            <li><a class="dropdown-item" href="{{route('logout')}}">Logout</a>
                            </li>
                        </ul>
                    </li>
                </div>
            @else
                <a href="{{route('loginView')}}" class="btn btn-sm  bg-gradient-primary  btn-round mb-0 me-1" role="button">Login</a>
            @endif
      </ul>
    </div>
  </div>
</nav>
<!-- End Navbar -->
