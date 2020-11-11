@extends('layouts.app')

@section('content')
<div class="container">
    <a href="{{ route('home') }}" class="btn btn-info">Back To Home</a>
    <div class="row justify-content-center">
        @foreach ($categories as $category)
        <div class="col-md-10">
            <div class="card">
                <div class="card-header"><b>{{ ucfirst($category->name) }}</b></div>
                <div class="card-body">
                    @foreach ($threads as $thread)
                    @if ($thread->category->name == $category->name)
                    <div class="thread">
                        <img src="{{ $thread->image }}" width="80px">
                        <span>{{ $thread->title }}</span>
                        <p>{{ $thread->description }}</p>
                        <div><b class="float-right">Created by: {{ $thread->user->username }}</b></div>
                        <div>
                            <form action="{{ route('deleteThread', $thread->id) }}" method="post" class="deleteThread">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="deleteBtn">Delete</button>
                            </form>
                            <form action="{{ route('approve', $thread->id) }}" method="post" class="deleteThread">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="deleteBtn">Approve</button>
                            </form>
                        </div>
                    </div>
                    @endif
                    @endforeach
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection