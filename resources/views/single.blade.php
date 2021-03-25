@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row mt-4">
        <div class="col-md-12 mb-4">
            <h3>{{$post->title}}</h3>
            @auth
            @if($post->isAuthUserLikedPost())
            <form method="post" action="{{ route('like.delete') }}">
                @csrf
                <input type="hidden" name="post_id" value="{{ $post->id }}" />
                <input type="submit" class="btn btn-primary float-right" value="Dislike">
            </form>
            @else
            <form method="post" action="{{ route('like.add') }}">
                @csrf
                <input type="hidden" name="post_id" value="{{ $post->id }}" />
                <input type="submit" class="btn btn-outline-primary float-right" value="Like">
            </form>
            @endif
            
            @endauth
        </div>
        <div class="col-md-12">
            <img src="/storage/{{$post->cover_image}}" height='350px' width="100%"/>
        </div>
        @auth
        <div class="col-md-12 mt-4 mb-4">
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <div class="card">
                <div class="card-body">
                    <h5>Comments</h5>

                    @include('comment', ['comments' => $post->comments, 'post_id' => $post->id,'replyCheck'=>0])

                    
                </div>


                <div class="card-body">
                    <h5>Leave a comment</h5>
                    <form method="post" action="{{ route('comment.add') }}">
                        @csrf
                        <div class="form-group">
                            <input type="text" name="comment" class="form-control" />
                            <input type="hidden" name="post_id" value="{{ $post->id }}" />
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn  btn-primary py-0" value="Add Comment" />
                        </div>
                    </form>
                </div>


            </div>
        </div>
        @endauth
        @guest
        <div class="col-md-12 mt-4 mb-4">
            <a href="/login" class="btn btn-primary btn-large">Please login to comment</a>
        </div>
        @endguest
    </div>

</div>
</div>

@endsection