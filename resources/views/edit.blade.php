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
        <form action="{{ route('update', $thread->id) }}" method="POST" class="col-md-6">
            @csrf
            @method('PUT')
            <div class="form-group @error('title') has-error @enderror">
                <label class="control-label" for="title">Title</label>
                <input type="text" class="form-control" name="title" id="title"
                    value="@if(old('title') == '') {{ $thread->title }} @else {{ old('title') }} @endif"
                    placeholder="Title">
            </div>
            <div class="form-group @error('image') has-error @enderror">
                <label class="control-label" for="image">Image URL</label>
                <input type="text" class="form-control" name="image" id="image"
                    value="@if(old('image') == '') {{ $thread->image }} @else {{ old('image') }} @endif"
                    placeholder="Image URL">
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" rows="3"
                    name="description">@if(old('description') == '') {{ $thread->description }} @else {{ old('description') }} @endif</textarea>
            </div>
            <div class="form-group @error('category') has-error @enderror">
                <select class="custom-select" name="category">
                    @foreach ($categories as $category)
                    <option value="{{ $category->id }}" @if ( $category->id == $thread->category_id) {{ "selected" }}
                        @endif>
                        {{ ucfirst($category->name) }}</option>
                    @endforeach
                </select>
            </div>
            <button class="btn btn-info" type="submit">Update</button>
            <a href="{{ route('home') }}" class="btn btn-info">Cancel</a>
        </form>
    </div>
</div>
@endsection