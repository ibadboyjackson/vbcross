@extends('layouts.app')
@section('title' , 'User Posts')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-10">
                <div>
                    <a href="{{ route('post.create') }}" style="float: right"><button class="btn btn-primary">Add New Post</button></a>
                </div>
                <div class="card mt-5">
                    <div class="card-header bg-primary text-white">Posts</div>

                    <div class="card-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">Title</th>
                                <th scope="col">Category</th>
                                <th scope="col">Published</th>
                                <th scope="col">Likes</th>
                                <th scope="col">Comments</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($posts as $post)
                                @php
                                $category = \App\Categories::findOrFail($post->category_id);
                                $published = $post->published_at;
                                @endphp
                                <tr>
                                    <td>{{ $post->title }}</td>
                                    <td>{{  $category->name }}</td>
                                    <td>
                                        @if($published)
                                            {{ \Carbon\Carbon::parse($published)->format('d/m/Y') }}
                                        @else
                                            No
                                        @endif
                                    </td>
                                    <td>{{ $post->likers()->count() }}</td>
                                    <td>{{ count($post->comments) ?? 'NA' }}</td>
                                    <td>
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <a href="{{ route('post.show' , $post->id) }}"><button type="button" class="btn btn-sm btn-secondary">View</button></a>
                                            <form onsubmit="return confirm('Do you really want to delete post?');" action="{{ route('post.destroy', $post->id) }}" method="POST">
                                                @method('DELETE')
                                                @csrf
                                                <button class="btn btn-sm btn-danger">Delete</button>
                                            </form>
                                            <a href="{{ route('post.edit' , $post->id) }}"><button type="button" class="btn btn-sm btn-primary">Edit</button></a>
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
                        {{ $posts->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
