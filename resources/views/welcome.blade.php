@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row mt-4">
        @foreach($posts as $post)

        <div class="col-md-6 pr-4">
            <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                <div class="col p-4 d-flex flex-column position-static">
                    <h3 class="mb-0">{{$post->title}}</h3>
                    
                    <a href="{{route('post.show',$post->slug) }}" class="stretched-link">Read more</a>
                </div>
                <div class="col-auto d-none d-lg-block">
                    <img src="/storage/{{$post->cover_image}}" width="200px" height="250px">

                </div>
            </div>
        </div>


        @endforeach
    </div>
</div>

@endsection