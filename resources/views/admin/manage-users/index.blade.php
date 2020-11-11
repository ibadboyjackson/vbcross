@extends('layouts.app')
@section('title' , 'Users')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-primary text-white">Users</div>

                    <div class="card-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">Photo</th>
                                <th scope="col">Full Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Profile Text</th>
                                <th scope="col" colspan="2">QA</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($users as $user)
                            <tr>
                                <td>@if($user->userAvatar)
                                    <img src="{{ asset('storage/' . $user->userAvatar->avatar) }}" width="80px">
                                    @else
                                    NA
                                    @endif
                                </td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    @if($user->userProfileText)
                                        <p>{{ $user->userProfileText->text }}</p>
                                      @else
                                        NA
                                    @endif
                                </td>
                                <td colspan="2">
                                    @foreach($user->userQAs as $userQa)
                                    @if($userQa->question === '1')
                                    {{ \App\UserQA::QUESTIONS[1] }}: {{ \App\UserQA::QUESTION_ONE_OPTIONS[$userQa->answer] }} <br>
                                    @elseif($userQa->question === '2')
                                    {{ \App\UserQA::QUESTIONS[2] }}: {{ \App\UserQA::QUESTION_TWO_OPTIONS[$userQa->answer] }} <br>
                                    @elseif($userQa->question === '3')
                                    {{ \App\UserQA::QUESTIONS[3] }}: {{ \App\UserQA::QUESTION_THREE_OPTIONS[$userQa->answer] }} <br>
                                    @endif
                                    @endforeach
                                </td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        @if($user->isNotBanned())
                                        <a onclick="return confirm('Are you sure you want to ban this user?');" href="{{ route('admin.manage-users.ban' , $user->id) }}"><button type="button" class="btn btn-sm btn-danger">Ban</button></a>
                                        @elseif($user->isBanned())
                                        <a onclick="return confirm('Are you sure you want to unban this user?');" href="{{ route('admin.manage-users.unban' , $user->id) }}"><button type="button" class="btn btn-sm btn-success">Unban</button></a>
                                        @endif
                                        <a href="{{ route('admin.manage-users.edit', $user->id) }}"><button type="button" class="btn btn-sm btn-secondary">Edit</button></a>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4">No Data Found</td>
                            </tr>
                            @endforelse
                            </tbody>
                        </table>
                            {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
