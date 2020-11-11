@extends('layouts.app')
@section('title' , 'Edit Post')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-8">
                <div class="card">
                    <div class="card-header bg-primary text-white">New Post</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('post.update' , $post->id) }}">
                            @csrf
                            @method('PUT')

                            <div class="form-group row">
                                <label for="category"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Category') }}</label>

                                <div class="col-md-6">
                                    <select id="category" type="text"
                                            class="form-control @error('category') is-invalid @enderror"
                                            name="category">
                                        <option value="0">Select Category</option>
                                        @forelse($categories as $category)
                                            <option
                                                {{ $post->category_id == $category->id ? 'selected' : '' }} value="{{ $category->id }}">{{ $category->name }}</option>
                                        @empty
                                            <option value="0">No Category Found</option>
                                        @endforelse
                                    </select>
                                    @error('category')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="name"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Title') }}</label>

                                <div class="col-md-6">
                                    <input id="title" type="text"
                                           class="form-control @error('title') is-invalid @enderror" name="title"
                                           value="{{ $post->title ?? old('title') }}" required autocomplete="title">

                                    @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-12">
                                    @trix($post, 'body')

                                    @error('content')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="publish"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Want to publish') }}</label>

                                <div class="col-md-6">
                                    <select id="publish" type="text"
                                            class="form-control @error('publish') is-invalid @enderror"
                                            name="publish">
                                        @if($post->published_at)
                                            <option value="1" selected>Yes</option>
                                            <option value="0">No</option>
                                        @else
                                            <option value="1">Yes</option>
                                            <option value="0" selected>No</option>
                                        @endif
                                    </select>
                                    @error('publish')
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
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
