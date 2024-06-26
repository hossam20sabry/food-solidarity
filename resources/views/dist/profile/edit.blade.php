

@extends('layout')

@section('content')
<div class="container my-4">
    <div class="row mb-4">
        <div class="col-12 box_shadow p-3 rounded">
            <h4 class="text-capitalize">Profile information</h4>
            <p class="text-capitalize">Update your account's profile information and email address.</p>
            <form action="{{ route('dist.profile.update', ['guard' => 'dist']) }}" method="post">
                @csrf
                @method('patch')

                <div class="mb-3">
                    <label for="name">Name</label>
                    <input type="text" name="name" value="{{ old('name', $user->name) }}" class="form-control">
                    @error('name')
                    <div class="form-error">
                        <p class="text-danger mb-3">{{$message}}</p>
                    </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="city_id">City</label>
                    <select name="city_id" class="form-control" id="">
                        @foreach ($cities as $city)
                            <option @if($city->id == $user->city_id) selected @endif value="{{ $city->id }}">{{ $city->name }}</option>
                        @endforeach
                    </select>
                    @error('city_id')
                    <div class="form-error">
                        <p class="text-danger mb-3">{{$message}}</p>
                    </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="email">Email</label>
                    <input type="email" name="email" value="{{ old('email', $user->email) }}" class="form-control">
                    @error('email')
                    <div class="form-error">
                        <p class="text-danger mb-3">{{$message}}</p>
                    </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>

                @if (session('status') === 'profile-updated')
                    <div>
                        <p class="text-sm mt-2 text-gray-800 dark:text-gray-200">
                            {{ __('Saved.') }}
                        </p>
                    </div>
                @endif

                

            </form>
            
        </div>
    </div>
    <div class="row mb-4">
        <div class="col-12 box_shadow p-3 rounded">
            <h4 class="text-capitalize">Update Password</h4>
            <p class="text-capitalize">Ensure your account is using a long, random password to stay secure.</p>
            <form action="{{ route('dist.password.update', ['guard' => 'dist']) }}" method="post">
                @csrf
                @method('put')

                <div class="mb-3">
                    <label for="current_password">Current Password</label>
                    <input type="password" name="current_password" class="form-control">
                    @error('current_password')
                    <div class="form-error">
                        <p class="text-danger mb-3">{{$message}}</p>
                    </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password">New Password</label>
                    <input type="password" name="password" class="form-control">
                    @error('password')
                    <div class="form-error">
                        <p class="text-danger mb-3">{{$message}}</p>
                    </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password_confirmation">Confirm Password</label>
                    <input type="password" name="password_confirmation" class="form-control">
                    @error('password_confirmation')
                    <div class="form-error">
                        <p class="text-danger mb-3">{{$message}}</p>
                    </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>

                @if (session('status') === 'password-updated1')
                    <div>
                        <p class="text-sm mt-2 text-gray-800 dark:text-gray-200">
                            {{ __('Saved.') }}
                        </p>
                    </div>
                @endif
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col-12 box_shadow p-3 rounded">
            <h4 class="text-capitalize">Delete Account</h4>
            <p>Once your account is deleted, all of its resources and data will be permanently deleted.</p>
            <div class="my-3">
                <form action="{{ route('dist.profile.destroy') }}" method="post">
                    @csrf
                    @method('delete')

                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">Delete Account</button>

                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Account</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>

                                <div class="modal-body">
                                    <h4 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                        {{ __('Are you sure you want to delete your account?') }}
                                    </h4>
                        
                                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                        {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
                                    </p>
                                    <div class="mb-3 p-2">
                                        <label for="password">Password</label>
                                        <input type="password" name="password" class="form-control">
                                        @error('password')
                                        <div class="form-error">
                                            <p class="text-danger mb-3">{{$message}}</p>
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-danger">Delete Account</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>

    
</div>
@endsection
