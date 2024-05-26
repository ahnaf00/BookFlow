@extends('admin.admin-dashboard')
@section('content')
    <form action="{{ route('admin.profile.store') }}" method="POST"  class="mb-8 multisteps-form__form" style="height: 443px;" enctype="multipart/form-data">
        @csrf
        <div class="p-4 bg-white card multisteps-form__panel js-active" data-animation="FadeIn">
            <h5 class="font-weight-bolder">Add your details</h5>
            <p class="text-sm">Here you can set all the personal details.</p>
            {{-- Image --}}
            <div class="col-lg-6">
                <div class="card card-body" id="profile">
                    <div class="row z-index-2 justify-content-center align-items-center">
                        <div class="col-sm-auto col-4">

                            <div class="avatar avatar-xl position-relative">
                                <img src="{{ $data['photo'] ? url($data['photo']) : asset('backend/assets/img/team-1.jpg') }}" alt="image" class="w-100 border-radius-lg shadow-sm">
                            </div>
                        </div>
                        <div class="col-sm-auto col-8 my-auto">
                            <div class="h-100">
                                <h5 class="mb-1 font-weight-bolder">
                                    {{ $data['name'] }}
                                </h5>
                                <p class="mb-0 font-weight-bold text-sm">
                                    {{ $data['role'] }}
                                </p>
                            </div>
                        </div>
                        <div class="col-sm-auto ms-sm-auto mt-sm-0 mt-3 d-flex">
                            <div class="form-check form-switch ms-2">
                                <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault23" checked=""
                                    onchange="visible()">
                            </div>
                            <label class="text-white form-check-label mb-0">
                                <small id="profileVisibility">
                                    Switch to invisible
                                </small>
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="multisteps-form__content">
                <div class="mt-3 row">
                    <div class="col-12 col-sm-6">
                        <label>Name</label>
                        <input class="multisteps-form__input form-control" type="text" name="name" value="{{ $data['name'] }}">
                    </div>
                    <div class="mt-3 col-12 col-sm-6 mt-sm-0">
                        <label>Username</label>
                        <input class="multisteps-form__input form-control" type="text" name="username" value="{{ $data['username'] }}">
                    </div>
                </div>
                <div class="mt-3 row">
                    <div class="mt-3 col-12 col-sm-6 mt-sm-0">
                        <label>Email Address</label>
                        <input class="multisteps-form__input form-control" type="email" name="email" value="{{ $data['email'] }}" disabled>
                    </div>
                    <div class="col-12 col-sm-6">
                        <label>Phone</label>
                        <input class="multisteps-form__input form-control" type="text" name="phone"
                            value="{{ $data['phone'] ? $data['phone'] : 'N/A' }}">
                    </div>
                </div>
                <div class="mt-3 row">
                    <div class="col-12 col-sm-6">
                        <label>Address</label>
                        <input class="multisteps-form__input form-control" type="text" name="address"
                            value="{{ $data['address'] ? $data['address'] : 'N/A' }}">
                    </div>
                    <div class="mt-3 col-12 col-sm-6 mt-sm-0">
                        <label>Image</label>
                        <div>
                            <div class="avatar avatar-xl position-relative">
                                <img id="showImage" src="{{ $data['photo'] ? url($data['photo']) : asset('backend/assets/img/team-1.jpg') }}" alt="image" class="w-100 border-radius-lg shadow-sm">

                            </div>
                            <input oninput="showImage.src=window.URL.createObjectURL(this.files[0])" class="multisteps-form__input form-control" type="file" name="image">
                        </div>
                    </div>
                </div>
                <div class="mt-4 button-row d-flex">
                    <button class="mb-0 text-white btn bg-dark ms-auto js-btn-next" type="submit"
                        title="Next">Save Changes</button>
                </div>
            </div>
        </div>

    </form>
@endsection
