@extends('layouts.app')
@section('title' , 'Posts')
@push('styles')
    <style>
        img {
            max-width: 700px;
            height: auto;

        }
        .attachment {
            display: inline-block;
            position: relative;
            max-width: 50%;
            margin: 0;
            padding: 0;
        }
    </style>
@endpush
@section('content')
    <div class="container bootstrap snippet">
        <div class="row justify-content-center">

            @forelse($posts as $post)
                @php
                    $category = \App\Categories::findOrFail($post->category_id);
                    $published = $post->published_at;
                    $by = $post->user;
                @endphp
                    <div class="col-md-8">
                     <div class="card mb-4">
                <div class="card-body">
                    <h2 class="card-title">{{ $post->title }}</h2>
                    <p class="font-weight-bold">Category: <span class="text-primary">{{ $category->name }}</span></p>
                    <p class="card-text">{!! $post->trixRichText()->where('field', 'body')->first()->content !!}</p>
                    <div class="btn-toolbar float-right" role="toolbar" aria-label="Toolbar with button groups">
                        <div class="btn-group mr-2" role="group" aria-label="First group">
                            @php
                            $totalComments = count($post->comments);
                            $totalLikes = $post->likers()->count();
                            @endphp
                            @if($totalComments == 0)
                            <a href="{{ route('post.comment' , $post->id) }}" class="btn btn-sm btn-primary">Comment &rarr;</a>
                            @else
                            <a href="{{ route('post.comment' , $post->id) }}" class="btn btn-sm btn-primary">({{ $totalComments }}) Comment &rarr;</a>
                            @endif
                        </div>
                        <div class="btn-group mr-2" role="group" aria-label="Second group">
                            @if($totalLikes == 0)
                                <a href="{{ route('post.like-toggle', $post->id) }}" class="btn btn-sm btn-secondary"> Like</a>
                            @else

                                @if(Auth::check())
                                    @if($post->isLikedBy(Auth::user()))
                                        <a href="{{ route('post.like-toggle', $post->id) }}" class="btn btn-sm btn-primary">({{ $post->likers()->count() }}) You Liked</a>
                                    @else
                                        <a href="{{ route('post.like-toggle', $post->id) }}" class="btn btn-sm btn-secondary">({{ $post->likers()->count() }}) Like</a>
                                    @endif
                            @else
                                <a href="{{ route('post.like-toggle', $post->id) }}" class="btn btn-sm btn-secondary">({{ $post->likers()->count() }}) Like</a>
                            @endif

                                @endif
                        </div>
                    </div>
                </div>
                <div class="card-footer text-muted">
                    Posted on {{ \Carbon\Carbon::parse($published)->format('M d, Y') }} by
                    @if($by->getRoleNames()->first() === 'user')
                        @if($by->userAvatar)
                        <a href="{{ route('profile.public' , $by->id) }}"><img src="{{ asset('storage/' .$by->userAvatar->avatar ) }}" width="30px"> {{ $by->name }}</a>
                        @else
                        <a href="{{ route('profile.public' , $by->id) }}">{{ $by->name }}</a>
                        @endif
                    @else
                        @if($by->userAvatar)
                            <img src="{{ asset('storage/' .$by->userAvatar->avatar ) }}" width="30px"><span> {{ $by->name }}</span>
                        @else
                            {{ $by->name }}
                        @endif

                    @endif
                </div>
            </div>
                </div>
            @empty
                <div class="col-md-8">
                    <center>
                        <h1>No Post Found</h1>
                    </center>
                </div>
            @endforelse

        </div>
    </div>
@endsection

