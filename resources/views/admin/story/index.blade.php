@extends('layouts.app')
@section('title' , 'Stories')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-10">
                <div>
                    <a href="{{ route('admin.story.create') }}" style="float: right"><button class="btn btn-primary">Add New Story</button></a>
                </div>
                <div class="card mt-5">
                    <div class="card-header bg-primary text-white">Stories</div>

                    <div class="card-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Title</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($stories as $story)
                                <tr>
                                    <td>{{ $story->id }}</td>
                                    <td>{{ $story->title }}</td>
                                    <td>
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <a href="{{ route('admin.story.show' , $story->id) }}"><button type="button" class="btn btn-sm btn-secondary">View</button></a>
                                            <form onsubmit="return confirm('Do you really want to delete post?');" action="{{ route('admin.story.destroy', $story->id) }}" method="POST">
                                                @method('DELETE')
                                                @csrf
                                                <button class="btn btn-sm btn-danger">Delete</button>
                                            </form>
                                            <a href="{{ route('admin.story.edit' , $story->id) }}"><button type="button" class="btn btn-sm btn-primary">Edit</button></a>
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
                        {{ $stories->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
