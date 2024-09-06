@extends('admin.index')


@section('content')
<div class="card-body">
    <form action="{{ route('movies.update', $movie->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="card-body">
            <div class="form-group">
                <label for="name">Title</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $movie->name }}">
            </div>
            <div class="form-group">
                <label for="name">Genre</label>
                <select class="form-control" name="category_id[]" multiple>
                    @foreach($categories as $category)
                    <option value="{{ $category->id }}" @foreach($tags as $tag) @if($tag->category_id == $category->id) selected @endif @endforeach>{{$category->genre}}</option>
                    @endforeach
                </select>
            </div>
            <img src="{{ $movie->preview_image }}" width="100" height="200">
            <div class="form-group">
                <label for="preview_image">Preview image</label>
                <div class="input-group">
                    <div class="custom-file">
                        <input type="file" name="preview_image" class="custom-file-input" id="preview_image">
                        <label class="custom-file-label" for="preview_image">Choose file</label>
                    </div>
                </div>
            </div>
        </div>
        <div>
            @if ($errors->any())
            <div class="alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </form>
</div>

@endsection