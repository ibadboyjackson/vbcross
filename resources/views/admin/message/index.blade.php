@extends('layouts.app')
@section('title' , 'Chat Messages')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-8">
                <div class="card">
                    <div class="card-header bg-primary text-white">Edit Message</div>
                    <div class="card-body">
                        @if($updateMode)
                            <form method="POST" action="{{ route('admin.message.update' , $chatMessage->id) }}">
                                @csrf
                                @method('PUT')

                                <div class="form-group row">
                                    <label for="message"
                                           class="col-md-4 col-form-label text-md-right">{{ __('Message') }}</label>

                                    <div class="col-md-6">
                                        <input id="message" type="text"
                                               class="form-control @error('message') is-invalid @enderror"
                                               name="message"
                                               value="{{ $chatMessage->message ?? old('message') }}" required
                                               autocomplete="message" autofocus>

                                        @error('message')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="users"
                                           class="col-md-4 col-form-label text-md-right">{{ __('Select Users who can see') }}</label>

                                    <div class="col-md-6">
                                        <select multiple id="users"
                                                class="form-control @error('users') is-invalid @enderror" name="users[]"
                                                required>
                                            @forelse($users as $user)

                                                <option
                                                     value="{{ $user->id }}">{{ $user->name }}
                                                    ({{ $user->email }})
                                                </option>
                                            @empty
                                                <option value="0">No User Found</option>
                                            @endforelse
                                        </select>

                                        @error('users')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Update') }}
                                        </button>
                                    </div>
                                </div>

                            </form>

                        @else
                            <form method="POST" action="{{ route('admin.message.store') }}">
                                @csrf

                                <div class="form-group row">
                                    <label for="message"
                                           class="col-md-4 col-form-label text-md-right">{{ __('Message') }}</label>

                                    <div class="col-md-6">
                                        <input id="message" type="text"
                                               class="form-control @error('message') is-invalid @enderror"
                                               name="message"
                                               value="{{ old('message') }}" required
                                               autocomplete="message" autofocus>

                                        @error('message')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="users"
                                           class="col-md-4 col-form-label text-md-right">{{ __('Select Users who can see') }}</label>

                                    <div class="col-md-6">
                                        <select multiple id="users"
                                                class="form-control @error('users') is-invalid @enderror" name="users[]"
                                                required>
                                            @forelse($users as $user)
                                                <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})
                                                </option>
                                            @empty
                                                <option value="0">No User Found</option>
                                            @endforelse
                                        </select>

                                        @error('users')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Add') }}
                                        </button>
                                    </div>
                                </div>

                            </form>
                        @endif
                    </div>
                </div>
            </div>


            <div class="col-8 mt-5">
                <div class="card">
                    <div class="card-header bg-primary text-white">Messages</div>

                    <div class="card-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">Message</th>
                                <th scope="col">Users</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($messages as $message)
                                @php
                                    $users = $message->users;
                                @endphp
                                <tr>
                                    <td>{{ $message->message }}</td>
                                    <td>
                                        @forelse($users as $user)
                                            {{ $user->name }} ({{ $user->email }})<br>
                                        @empty
                                            NA
                                        @endforelse
                                    </td>
                                    <td>

                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <form action="{{ route('admin.message.destroy', $message->id) }}"
                                                  method="POST">
                                                @method('DELETE')
                                                @csrf
                                                <button class="btn btn-sm btn-danger">Delete</button>
                                            </form>
                                            <a href="{{ route('admin.message.edit' , $message->id) }}">
                                                <button class="btn btn-sm btn-secondary">Edit</button>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3">No Data Found</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
