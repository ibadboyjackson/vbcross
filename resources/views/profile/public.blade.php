@extends('layouts.app')
@section('title' , $user->name)
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="mb-3">
                    @if(Auth::id() != $user->id)
                        <a href="{{ route('chat.start-conversation' , $user->id) }}" class="btn btn-sm btn-primary">Send Message</a>
                        @if($user->getRoleNames()->first() == 'user')
                            <a href="{{ route('chat.start-challenge' , $user->id) }}" class="btn btn-sm btn-primary">Challenge {{ $user->name }}</a>
                        @endif
                    @endif
                </div>
                <div class="card">
                    <div class="card-header bg-primary text-white">Public Profile</div>
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

                        <div class="form-group row">
                            <label for="likes"
                                   class="col-md-4 col-form-label text-md-right">{{ __('Total Likes') }}</label>

                            <div class="col-md-6">
                                    <p class="form-control">{{ $userTotalLikes }}</p>
                            </div>
                        </div>

                        <table>
                            @if($user->getRoleNames()->first() == 'user')

                                @php
                                    $userQA = $user->userQAs;
                                @endphp

                                <div class="form-group row">
                                    <label for="vii"
                                           class="col-md-4 col-form-label text-md-right">{{ __('Total Vii') }}</label>

                                    <div class="col-md-6">
                                        <p class="form-control">{{ $user->vii->amount ?? '0' }}</p>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="q1"
                                           class="col-md-4 col-form-label text-md-right">{{ \App\UserQA::QUESTIONS[$userQA[0]->question] }}</label>

                                    <div class="col-md-6">
                                        <p class="form-control">{{ \App\UserQA::QUESTION_ONE_OPTIONS[$userQA[0]->answer] }}</p>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="q2"
                                           class="col-md-4 col-form-label text-md-right">{{ \App\UserQA::QUESTIONS[$userQA[1]->question] }}</label>

                                    <div class="col-md-6">
                                            <p class="form-control">{{ \App\UserQA::QUESTION_TWO_OPTIONS[$userQA[1]->answer] }}</p>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="q3"
                                           class="col-md-4 col-form-label text-md-right">{{ \App\UserQA::QUESTIONS[$userQA[2]->question] }}</label>

                                    <div class="col-md-6">
                                        <p class="form-control">{{ \App\UserQA::QUESTION_THREE_OPTIONS[$userQA[2]->answer] }}</p>
                                    </div>
                                </div>

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
                                           <img src="{{ asset('storage/' .$user->userAvatar->avatar ) }}" width="100px">
                                        @endif
                                    </div>
                                </div>
                            @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
