@extends('layouts.app')
@section('title' , 'Story')
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

            <div class="col-md-8">
                <div class="card mb-4">
                    <div class="card-body">
                        <h2 class="card-title">Title: {{ $story->title }}</h2>
                        <p class="card-text">{!! $story->trixRichText()->where('field', 'body')->first()->content !!}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

