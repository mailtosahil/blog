@foreach($comments as $comment)
@if($replyCheck)
@php
$classCheck="ml-4";
@endphp
@else
@php
$classCheck="";
@endphp
@endif
<div class="display-comment {{$classCheck}}">
    <strong>{{ $comment->user->name }}</strong>
    <p>{{ $comment->comment }}</p>
    <a href="" id="reply"></a>
    <form method="post" action="{{ route('reply.add') }}">
        @csrf
        <div class="form-group">
            <input type="text" name="comment" required class="form-control" />
            <input type="hidden" name="post_id" value="{{ $post_id }}" />
            <input type="hidden" name="comment_id" value="{{ $comment->id }}" />
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-sm btn-danger float-right" value="Reply" />
        </div>
    </form>
    @include('comment', ['comments' => $comment->replies,'replyCheck'=>1])
</div>
@endforeach