
<div class="col-md-8 mb-5">
    <h2 class="card-title mt-3">Comments ({{ count($comments) ?? 0 }})</h2>
        <div class="ml-4">
            <div class="comment-widgets">

                @forelse($comments as $comment)
                    @php
                        $user = \App\User::findOrFail($comment->user_id);
                    @endphp
                <div class="d-flex flex-row comment-row mt-4">
                    <div class="p-2">
                        @if($user->getRoleNames()->first() === 'user')
                            @if($user->userAvatar)
                                <a href="{{ route('profile.public' , $user->id) }}"><img src="{{ asset('storage/' .$user->userAvatar->avatar ) }}" width="30px"></a>
                            @endif
                        @else
                            @if($user->userAvatar)
                                <img src="{{ asset('storage/' .$user->userAvatar->avatar ) }}" width="30px">
                            @endif

                        @endif
                    </div>
                    <div class="comment-text w-100">
                        <h6 class="font-medium text-muted">
                            @if($user->getRoleNames()->first() === 'user')
                            <a href="{{ route('profile.public' , $user->id) }}">{{ $user->name }}</a>
                            @else
                           {{ $user->name }}
                            @endif
                        </h6>

                        </h6> <span class="m-b-15 d-block">{!! $comment->trixRichText()->where('field', 'body')->first()->content !!}</span>
                        <div class="comment-footer"><span class="text-muted float-right">{{ \Carbon\Carbon::parse($comment->created_at)->diffForHumans() }}</span>
                            @if($user->id == Auth::id())<a wire:click="destroy({{ $comment->id }})" type="button" class="btn btn-sm btn-danger text-white">Delete</a>@endif
                            @php
                             $totalLikes =  $comment->likers()->count()
                            @endphp
                            @if($totalLikes == 0)
                                <a href="#" wire:click="toggleLike({{ $comment->id }})" class="btn btn-sm btn-secondary text-white"> Like</a>
                            @else

                                @if(Auth::check())
                                    @if($comment->isLikedBy(Auth::user()))
                                        <a href="#" wire:click="toggleLike({{ $comment->id }})" class="btn btn-sm btn-primary text-white">({{ $totalLikes }}) You Liked</a>
                                    @else
                                        <a href="#" wire:click="toggleLike({{ $comment->id }})" class="btn btn-sm btn-secondary text-white">({{ $totalLikes }}) Like</a>
                                    @endif
                                @else
                                    <a href="#" wire:click="toggleLike({{ $comment->id }})" class="btn btn-sm btn-secondary text-white">({{ $totalLikes }}) Like</a>
                                @endif

                            @endif


                        </div>
                    </div>
                </div>
                @empty
                @endforelse

            </div>

        </div>
 </div>


@push('styles')
    <style>
        .pb-cmnt-container {
            font-family: Lato;
        }

        .pb-cmnt-textarea {
            resize: none;
            padding: 20px;
            height: 130px;
            width: 100%;
            border: 1px solid #F2F2F2;
        }
    </style>
@endpush
