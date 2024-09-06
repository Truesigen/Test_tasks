@extends('admin.index')


@section('content')
<div class="card-body">
    <form action="{{ route('categories.update', $category->id) }}" method="post">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="genre">Edit Genre</label>
            <input type="text" class="form-control" name="genre" placeholder="Enter genre" value="{{$category->genre}}">
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