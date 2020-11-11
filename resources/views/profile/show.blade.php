@extends('layouts.app')
@section('title' , $user->name . 'Profile')
@section('content')
    <div class="container">
        <div class="row justify-content-center">

            @if(Auth::user()->getRoleNames()->first() == 'admin')
                @if($user->userProfileText or $user->userAvatar)
                    <div class="col-md-8 mt-5">
                        <div class="card">
                            <div class="card-header bg-primary text-white">{{ __('Profile Avatar') }}</div>
                            <div class="card-body">

                                <div class="form-group row">
                                    <label for="name"
                                           class="col-md-4 col-form-label text-md-right">{{ __('Avatar') }}</label>

                                    <div class="col-md-6">
                                        @if($user->userAvatar)
                                            <img src="{{ asset('storage/' . $user->userAvatar->avatar) }}"
                                                            width="150px">
                                        @endif
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                @endif
                    <div class="col-md-8 mt-5">
                        <div class="card">
                            <div class="card-header bg-primary text-white">{{ __('Update Avatar') }}</div>
                            <div class="card-body">
                            @livewire('upload-admin-avatar', ['userId' => $user->id])
                            </div>
                        </div>
                    </div>
                @else
                    @if($user->userProfileText or $user->userAvatar)
                        <div class="col-md-8 mt-5">
                            <div class="card">
                                <div class="card-header bg-primary text-white">{{ __('Profile Text and Avatar') }}</div>
                                <div class="card-body">

                                    <div class="form-group row">
                                        <label for="name"
                                               class="col-md-4 col-form-label text-md-right">{{ __('Profile Text') }}</label>

                                        <div class="col-md-6">
                                            @if($user->userProfileText)
                                                <p class="form-control">{{ $user->userProfileText->text }}</p>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="name"
                                               class="col-md-4 col-form-label text-md-right">{{ __('Avatar') }}</label>

                                        <div class="col-md-6">
                                            @if($user->userAvatar)
                                                <img src="{{ asset('storage/' . $user->userAvatar->avatar) }}"
                                                     width="150px">
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endif

                <div class="col-md-8 mt-5">
                    <div class="card">
                        <div class="card-header">{{ __('Update Profile') }}</div>

                        <div class="card-body">
                            <form method="POST" action="{{ route('profile') }}">
                                @csrf

                                <div class="form-group row">
                                    <label for="name"
                                           class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                                    <div class="col-md-6">
                                        <input id="name" type="text"
                                               class="form-control @error('name') is-invalid @enderror" name="name"
                                               value="{{ old('name') ?? $user->name}}" required autocomplete="name"
                                               autofocus>

                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="username"
                                           class="col-md-4 col-form-label text-md-right">{{ __('Username') }}</label>

                                    <div class="col-md-6">
                                        <input id="username" type="text"
                                               class="form-control @error('username') is-invalid @enderror" name="username"
                                               value="{{ old('username') ?? $user->username}}" required autocomplete="username"
                                               autofocus>

                                        @error('username')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="email"
                                           class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                    <div class="col-md-6">
                                        <input id="email" type="email"
                                               class="form-control @error('email') is-invalid @enderror" name="email"
                                               value="{{ old('email') ?? $user->email }}" required autocomplete="email">

                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                @if($user->getRoleNames()->first() == 'user')
                                    @php
                                        $userQA = $user->userQAs;
                                    @endphp
                                    <div class="form-group row">
                                        <label for="q1"
                                               class="col-md-4 col-form-label text-md-right">{{ \App\UserQA::QUESTIONS[$userQA[0]->question] }}</label>

                                        <div class="col-md-6">
                                            <select disabled id="q1" class="form-control @error('q1') is-invalid @enderror"
                                                    name="q1"
                                                    required>
                                                <option value="0" selected>Select Your Answer</option>
                                                @foreach(\App\UserQA::QUESTION_ONE_OPTIONS as $key => $label)
                                                    <option
                                                        {{ $userQA[0]->answer == $key ? 'selected' : '' }} value="{{ $key }}">{{ $label }}</option>
                                                @endforeach
                                            </select>
                                            @error('q1')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="q2"
                                               class="col-md-4 col-form-label text-md-right">{{ \App\UserQA::QUESTIONS[$userQA[1]->question] }}</label>

                                        <div class="col-md-6">
                                            <select disabled id="q2" class="form-control @error('q2') is-invalid @enderror"
                                                    name="q2"
                                                    required>
                                                <option value="0" selected>Select Your Answer</option>
                                                @foreach(\App\UserQA::QUESTION_TWO_OPTIONS as $key => $label)
                                                    <option
                                                        {{ $userQA[1]->answer == $key ? 'selected' : '' }} value="{{ $key }}">{{ $label }}</option>
                                                @endforeach
                                            </select>
                                            @error('q2')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="q3"
                                               class="col-md-4 col-form-label text-md-right">{{ \App\UserQA::QUESTIONS[$userQA[2]->question] }}</label>

                                        <div class="col-md-6">
                                            <select disabled id="q3" class="form-control @error('q3') is-invalid @enderror"
                                                    name="q3"
                                                    required>
                                                <option value="0" selected>Select Your Answer</option>
                                                @foreach(\App\UserQA::QUESTION_THREE_OPTIONS as $key => $label)
                                                    <option
                                                        {{ $userQA[2]->answer == $key ? 'selected' : '' }} value="{{ $key }}">{{ $label }}</option>
                                                @endforeach
                                            </select>
                                            @error('q3')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>
                                    </div>
                                @endif

                                <div class="form-group row mb-0">
                                    <div class="col-md-8 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Update Profile') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-md-8 mt-5">
                    <div class="card">
                        <div class="card-header">{{ __('Change Password') }}</div>

                        <div class="card-body">
                            <form method="POST" action="{{ route('profile.change-password') }}">
                                @csrf

                                <div class="form-group row">
                                    <label for="current_password"
                                           class="col-md-4 col-form-label text-md-right">{{ __('Current Password') }}</label>

                                    <div class="col-md-6">
                                        <input id="current_password" type="password"
                                               class="form-control @error('current_password') is-invalid @enderror"
                                               name="current_password"
                                               required>

                                        @error('current_password')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password"
                                           class="col-md-4 col-form-label text-md-right">{{ __('New Password') }}</label>

                                    <div class="col-md-6">
                                        <input id="password" type="password"
                                               class="form-control @error('password') is-invalid @enderror"
                                               name="password"
                                               required>

                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row mb-0">
                                    <div class="col-md-8 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Change Password') }}
                                        </button>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>

        </div>
    </div>
@endsection
