@extends('layouts.app')
@section('title' , 'Register')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-white">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="username" class="col-md-4 col-form-label text-md-right">{{ __('Username') }}</label>

                            <div class="col-md-6">
                                <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>

                                @error('username')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="q1" class="col-md-4 col-form-label text-md-right">{{ \App\UserQA::QUESTIONS[1] }}</label>

                            <div class="col-md-6">
                                <select id="q1" class="form-control @error('q1') is-invalid @enderror" name="q1" required>
                                    <option value="0" selected>Select Your Answer</option>
                                    @foreach(\App\UserQA::QUESTION_ONE_OPTIONS as $key => $label)
                                        <option {{ old('q1') == $key ? 'selected' : '' }} value="{{ $key }}">{{ $label }}</option>
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
                            <label for="q2" class="col-md-4 col-form-label text-md-right">{{ \App\UserQA::QUESTIONS[2] }}</label>

                            <div class="col-md-6">
                                <select id="q2" class="form-control @error('q2') is-invalid @enderror" name="q2" required>
                                    <option value="0" selected>Select Your Answer</option>
                                    @foreach(\App\UserQA::QUESTION_TWO_OPTIONS as $key => $label)
                                        <option {{ old('q2') == $key ? 'selected' : '' }} value="{{ $key }}">{{ $label }}</option>
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
                            <label for="q3" class="col-md-4 col-form-label text-md-right">{{ \App\UserQA::QUESTIONS[3] }}</label>

                            <div class="col-md-6">
                                <select id="q3" class="form-control @error('q3') is-invalid @enderror" name="q3" required>
                                    <option value="0" selected>Select Your Answer</option>
                                    @foreach(\App\UserQA::QUESTION_THREE_OPTIONS as $key => $label)
                                        <option {{ old('q3') == $key ? 'selected' : '' }} value="{{ $key }}">{{ $label }}</option>
                                    @endforeach
                                </select>
                                @error('q3')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
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
