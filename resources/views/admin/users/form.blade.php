@extends('admin.admin-dashboard')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card border shadow-xs mb-4">
                <div class="card-header border-bottom pb-0">
                    <div class="d-sm-flex align-items-center">
                        <div>
                            <h6 class="font-weight-semibold text-lg mb-0">{{ isset($user) ? 'Edit ' : 'Add New' }}
                                User</h6>
                        </div>
                        <div class="ms-auto d-flex">
                            <a href="{{ route('admin.users.index') }}"
                               class="btn btn-sm btn-dark btn-icon d-flex align-items-center me-2">
                                <span class="btn-inner--icon">
                                    <svg width="16" height="16" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                         fill="currentColor" class="d-block me-2">
                                        <path d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M21 11H6.83l5.59-5.59L12 4l-8 8 8 8 1.41-1.41L6.83 13H21z"></path>
                                    </svg>
                                </span>
                                <span class="btn-inner--text">Back to list</span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body px-5 py-5">
                    <form
                            action="{{ isset($user) ? route('admin.users.update', $user->id) : route('admin.users.store') }}"
                            method="POST">
                        @csrf
                        @if (isset($user))
                            @method('PUT')
                        @endif
                        <div class="form-group">
                            <label for="role">User Type</label>
                            <select class="form-control @error('role') is-invalid @enderror"
                                    id="role" name="role" {{ !isset($user) ? 'required' : '' }}>
                                <option readonly>Select a role</option>
                                @foreach($roles as $role)
                                    <option value="{{ $role }}"
                                    @isset($user)
                                        {{ $user->role == $role ? 'selected' : '' }}
                                            @endisset
                                    >
                                        {{ ucwords($role) }}
                                    </option>
                                @endforeach
                            </select>

                            @error('role')
                            <div class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="first_name" class="form-control-label">First Name</label>
                            <input class="form-control @error('first_name') is-invalid @enderror" type="text"
                                   name="first_name" value="{{ $user->first_name ?? old('first_name') }}"
                                   id="first_name" {{ !isset($user) ? 'required' : '' }}>

                            @error('first_name')
                            <div class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="last_name" class="form-control-label">Last Name</label>
                            <input class="form-control @error('last_name') is-invalid @enderror" type="text"
                                   name="last_name" value="{{ $user->last_name ?? old('last_name') }}"
                                   id="last_name" {{ !isset($user) ? 'required' : '' }}>

                            @error('last_name')
                            <div class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email" class="form-control-label">Email</label>
                            <input class="form-control @error('email') is-invalid @enderror" type="email" name="email"
                                   value="{{ $user->email ?? old('email') }}"
                                   id="email" {{ !isset($user) ? 'required' : '' }}>

                            @error('email')
                            <div class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="phone" class="form-control-label">Phone</label>
                            <input class="form-control @error('phone') is-invalid @enderror" type="tel" name="phone"
                                   placeholder="01xxxxxxxxx" value="{{ $user->phone ?? old('phone') }}" id="phone">

                            @error('phone')
                            <div class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password" class="form-control-label">Password</label>
                            <input class="form-control @error('password') is-invalid @enderror" type="password"
                                   name="password" id="password" {{ !isset($user) ? 'required' : '' }}>
                        </div>
                        <div class="form-group">
                            <label for="confirm_password" class="form-control-label">Confirm Password</label>
                            <input class="form-control @error('password') is-invalid @enderror" type="password"
                                   name="password_confirmation"
                                   id="confirm_password" {{ !isset($user) ? 'required' : '' }}>
                        </div>

                        <button type="submit" class="btn btn-primary">
                            @isset($user)
                                Update
                            @else
                                Save
                            @endisset
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
