@extends('layouts.app')
@section('title' , 'Edit User')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-primary text-white">Edit User Profile</div>

                    <div class="card-body">

                        <div class="form-group row">
                            <label for="name"
                                   class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <p class="form-control">{{ $user->name }}</p>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="username"
                                   class="col-md-4 col-form-label text-md-right">{{ __('Username') }}</label>

                            <div class="col-md-6">
                                <p class="form-control">{{ $user->username }}</p>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email"
                                   class="col-md-4 col-form-label text-md-right">{{ __('Email') }}</label>

                            <div class="col-md-6">
                                <p class="form-control">{{ $user->email }}</p>
                            </div>
                        </div>

                        @livewire('update-user', ['userId' => $user->id])

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
