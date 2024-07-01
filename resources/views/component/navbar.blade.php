<!-- Navbar Dark -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark z-index-3 py-3">
    <div class="container">
        <a class="navbar-brand text-white" href="{{ route('HomePage') }}" rel="tooltip"
            title="Designed and Coded by Creative Tim" data-placement="bottom" target="_blank">
            <h4 style="color: rgb(255, 255, 255)"><b>BookFlow</b></h4>
        </a>
        <a href="https://www.creative-tim.com/product/now-ui-design-system-pro#pricingCard"
            class="btn btn-sm bg-gradient-primary btn-round mb-0 ms-auto d-lg-none d-block">Buy Now</a>
        <button class="navbar-toggler shadow-none ms-2" type="button" data-bs-toggle="collapse"
            data-bs-target="#navigation" aria-controls="navigation" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon mt-2">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
            </span>
        </button>
        <div class="collapse navbar-collapse w-100 pt-3 pb-2 py-lg-0" id="navigation">
            <ul class="navbar-nav navbar-nav-hover mx-auto">
                <li class="nav-item mx-2">
                    <a href="{{route('HomePage')}}" class="nav-link ps-2 d-flex justify-content-between cursor-pointer align-items-center"
                        role="button">
                        Home
                    </a>
                </li>
                <li class="nav-item dropdown dropdown-hover mx-2">
                    <a class="nav-link ps-2 d-flex justify-content-between cursor-pointer align-items-center"
                        id="dropdownMenuPages6" data-bs-toggle="dropdown" aria-expanded="false" role="button">
                        Categories
                    </a>
                    <div class="dropdown-menu dropdown-menu-animation dropdown-xl p-3 border-radius-xl mt-0 mt-lg-3"
                        aria-labelledby="dropdownMenuPages6">
                        <div class="row" id="categories">
                        </div>
                    </div>
                </li>
                <li class="nav-item mx-2">
                    <a href="{{route('AboutUs')}}" class="nav-link ps-2 d-flex justify-content-between cursor-pointer align-items-center"
                        role="button">
                        About Us
                    </a>
                </li>
                <li class="nav-item mx-2">
                    <a class="nav-link ps-2 d-flex justify-content-between cursor-pointer align-items-center"
                        role="button">
                        Blogs
                    </a>
                </li>
            </ul>

            <ul class="navbar-nav">
                @if(Cookie::get('token') !== null)
                    <div class="dropdown">
                        <li class="nav-item mx-2">
                            <a class="nav-link ps-2 d-flex justify-content-between cursor-pointer align-items-center dropdown-toggle"
                                data-bs-toggle="dropdown" aria-expanded="false" role="button">
                                Account
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{route('ProfilePage')}}">Profile</a></li>
                                <li><a class="dropdown-item" href="{{route('BookingPage')}}">Bookings</a></li>
                                <li><a class="dropdown-item" href="{{ route('logout') }}">Logout</a></li>
                            </ul>
                        </li>
                    </div>
                @else
                    <a href="{{ route('loginView') }}" class="btn btn-sm bg-gradient-primary btn-round mb-0 me-1"
                        role="button">Login</a>
                @endif
            </ul>
        </div>
    </div>
</nav>

<!-- End Navbar -->

<script>
    document.addEventListener('DOMContentLoaded', function() {
        allCategories();
    });

    async function allCategories() {
        try {
            let response = await axios.get('/category-list');
            if (response.status === 200) {
                let categories = response.data;
                let categoriesContainer = document.getElementById('categories');
                let categoriesHTML = '';

                categories.forEach(category => {
                    let subcategoriesHTML = '';
                    if (category.subcategories && category.subcategories.length > 0) {
                        subcategoriesHTML = category.subcategories.map(subcategory => `
                            <a href="#" class="dropdown-item border-radius-md">
                                <span class="ps-3">${subcategory.name}</span>
                            </a>
                        `).join('');
                    }

                    categoriesHTML += `
                        <div class="col-4 position-relative">
                            <div class="dropdown-header text-dark font-weight-bold d-flex justify-content-center align-items-center px-0">
                                <div class="icon icon-shape icon-xs rounded-circle bg-gradient-primary text-center me-2 d-flex align-items-center justify-content-center">
                                    <i class="ni ni-atom text-white text-xs opacity-10 top-0"></i>
                                </div>
                                ${category.name}
                            </div>
                            ${subcategoriesHTML}
                            <hr class="vertical dark mt-0">
                        </div>
                    `;
                });

                categoriesContainer.innerHTML = categoriesHTML;
            } else {
                console.error('Failed to fetch categories');
            }
        } catch (error) {
            console.error('Error fetching categories:', error);
        }
    }
</script>
