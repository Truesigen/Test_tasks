@extends('admin.index')


@section('content')
<div class="card-body">
    <form action="{{ route('movies.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label for="name">Title</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Enter title">
            </div>
            <div class="form-group">
                <label for="name">Genre</label>
                <select class="form-control" name="category_id[]" multiple>
                    @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{$category->genre}}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="preview_image">Preview image</label>
                <div class="input-group">
                    <div class="custom-file">
                        <input type="file" name="preview_image" class="custom-file-input" id="preview_image">
                        <label class="custom-file-label" for="preview_image">Choose image</label>
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
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
</div>

@endsection