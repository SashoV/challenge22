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
        <form action="{{ route('store') }}" method="POST" class="col-md-6">
            @csrf
            <div class="form-group @error('title') has-error @enderror">
                <label class="control-label" for="title">Title</label>
                <input type="text" class="form-control" name="title" id="title" value="{{ old('title') }}"
                    placeholder="Title">
            </div>
            <div class="form-group @error('image') has-error @enderror">
                <label class="control-label" for="image">Image URL</label>
                <input type="text" class="form-control" name="image" id="image" value="{{ old('image') }}"
                    placeholder="Image URL">
            </div>
            <div class="form-group @error('description') has-error @enderror">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" rows="3"
                    name="description">{{ old('description') }}</textarea>
            </div>
            <div class="form-group @error('category') has-error @enderror">
                <label for="description">Select Category</label>
                <select class="custom-select" name="category">
                    @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ ucfirst($category->name) }}</option>
                    @endforeach
                </select>
            </div>
            <button class="btn btn-info" type="submit">Create</button>
            <a href="{{ route('home') }}" class="btn btn-info">Cancel</a>
        </form>
    </div>
</div>
@endsection