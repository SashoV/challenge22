@extends('layouts.app')

@section('content')
<div class="container">
    @auth
    <a href="{{ route('create') }}" class="btn btn-info">Create new Thread</a>
    @if (Auth::user()->role == 'admin')
    <a href="{{ route('admin') }}" class="btn btn-info">Threads For Approval</a>
    @endif
    @endauth
    <div class="row justify-content-center">
        @foreach ($categories as $category)
        <div class="col-md-10">
            <div class="card">
                <div class="card-header"><b>{{ ucfirst($category->name) }}</b></div>
                <div class="card-body">
                    @foreach ($threads as $thread)
                    @if ($thread->category->name == $category->name)
                    <div class="thread">
                        <img src="{{ $thread->image }}" width="60px">
                        <a href="{{ route('thread', $thread->id) }}" class="font-20">{{ $thread->title }}</a>
                        <p class="padding-top-20 text-justify">{{ $thread->description }}</p>
                        <div class="createdBy"><b class="float-right">Created by: {{ $thread->user->username }}</b></div>
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
                    @endif
                    @endforeach
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection