@extends('layouts.app')

@section('content')

<div class="container">
    <a href="{{ route('home') }}" class="btn btn-info">To Home Page</a>
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <div class="thread">
                        <img src="{{ $thread->image }}" width="60px">
                        <b class="font-20">{{ $thread->title }}</b>
                        <p class="padding-top-20 text-justify">{{ $thread->description }}</p>
                        <div><span class="float-right">Created by: {{ $thread->user->username }}</span></div>
                        <div>
                            @auth
                            @if (Auth::user()->username == $thread->user->username || Auth::user()->role == 'admin')
                            <a href="{{ route('edit', $thread->id) }}">Edit</a>
                            <form action="{{ route('destroy', $thread->id) }}" method="post" class="deleteThread">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="deleteBtn">Delete</button>
                            </form>
                            @endif
                            @endauth
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @if ($thread->comments->count() == 0)
                    <div>No comments for this thread</div>
                    @endif
                    @foreach ($thread->comments as $comment)
                    <div class="thread">
                        <div class="padding-b-20 text-indent-30 text-justify">{{ $comment->body }}</div>
                        <div><b>{{ $comment->user->username }}</b>, {{ $comment->created_at }}</div>
                        <div></div>
                        <div>
                            @auth
                            @if (Auth::user()->username == $comment->user->username || Auth::user()->role == 'admin')
                            <a href="{{ route('editComment', ['id' => $thread->id, 'comment_id' => $comment->id]) }}">Edit</a>
                            <form
                                action="{{ route('destroyComment', ['id' => $thread->id, 'comment_id' => $comment->id]) }}"
                                method="post" class="deleteThread">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="deleteBtn">Delete</button>
                            </form>
                            @endif
                            @endauth
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        @auth
        <div class="col-md-10 padding-top-20">
            <form action="{{ route('storeComment', $thread->id) }}" method="POST">
                @csrf
                <div class="form-group @error('comment') has-error @enderror">
                    <label for="comment">Comment on this thread:</label>
                    <textarea class="form-control" id="comment" rows="3" name="comment">{{ old('comment') }}</textarea>
                </div>
                <button class="btn btn-info" type="submit">Place your comment</button>
            </form>
        </div>
        @endauth
    </div>
</div>

@endsection