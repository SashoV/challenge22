@extends('layouts.app')

@section('content')
<div class="container">
    @if ($errors->any())
    <div class="row justify-content-center">
        <div class="alert alert-danger col-md-6" role="alert">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
    @endif
    <div class="row justify-content-center">
        <form action="{{ route('updateComment', ['id' => $comment->thread_id, 'comment_id' => $comment->id]) }}"
            method="POST" class="col-md-6">
            @csrf
            @method('PUT')
            <div class="form-group @error('comment') has-error @enderror">
                <label for="comment">Edit your comment:</label>
                <textarea class="form-control" id="comment" rows="3"
                    name="comment">@if(old('comment') == '') {{ $comment->body }} @else {{ old('comment') }} @endif</textarea>
            </div>
            <button class="btn btn-info" type="submit">Update</button>
            <a href="{{ route('thread', $comment->thread_id) }}" class="btn btn-info">Cancel</a>
        </form>
    </div>
</div>
@endsection