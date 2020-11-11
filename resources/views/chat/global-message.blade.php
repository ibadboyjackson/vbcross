@extends('layouts.app')
@section('title' , 'Global Message')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-8">
                <div class="card">
                    <div class="card-header bg-primary text-white">Send Global Message</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('chat.global-message') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="message" class="col-md-4 col-form-label text-md-right">{{ __('Message') }}</label>

                                <div class="col-md-6">
                                    <input id="message" type="text"
                                           class="form-control @error('message') is-invalid @enderror" name="message"
                                           value="{{ old('message') }}" required autocomplete="message" autofocus>

                                    @error('message')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Send') }}
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
