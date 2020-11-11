@section('title' , 'Chat')
<div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-8">
                <div class="card">
                    <div class="card-header bg-primary text-white">Online Members</div>

                    <div class="card-body">
                        <ul wire:poll class="list-group">
                            @forelse($users as $user)
                                @if($user->isOnline())
                                        <a href="{{ route('profile.public' , $user->id) }}"><li class="list-group-item list-group-item-success mt-1">
                                            @if($user->userAvatar)
                                            <img src="{{ asset('storage/' . $user->userAvatar->avatar) }}" width="50px">
                                            @endif
                                                {{ $user->name }}</li></a>
                                @else
                                    <a href="{{ route('profile.public' , $user->id) }}"><li class="list-group-item list-group-item-dark mt-1">
                                            @if($user->userAvatar)
                                                <img src="{{ asset('storage/' . $user->userAvatar->avatar) }}" width="50px">
                                            @endif
                                            {{ $user->name }}</li></a>
                                @endif
                            @empty
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('styles')
@endpush
