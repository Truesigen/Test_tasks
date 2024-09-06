@extends('admin.index')


@section('content')

<div class="col-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Movies</h3>
            <div class="card-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                    <a href="{{ route('movies.create') }}"> <button type="button" class="btn btn-block btn-primary">Create movie</button></a>
                </div>
            </div>
        </div>

        <div class="card-body table-responsive p-0">
            <table class="table table-hover text-nowrap">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>title</th>
                        <th>genre</th>
                        <th>image</th>
                        <th>status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($movies as $key => $movie)
                    <tr>
                        <td>{{ $key }}</td>
                        <td>{{ $movie->name }}</td>
                        <td> @foreach($movie->categories as $category){{ $category->genre  }} </br> @endforeach </td>
                        <td><img src="{{ $movie->preview_image }}" width="100" height="125"></td>
                        <td>{{ $movie->is_published ? 'published' : 'not published' }}</td>
                        <td><a href="{{ route('movies.edit', $movie->id) }}"><button class="btn btn-info">Edit</button></a></td>
                        <td>
                            <form action="{{ route('movies.destroy', $movie->id) }}" method="POST">
                                @method('DELETE')
                                @csrf
                                <input type="submit" class="btn btn-danger" value="Delete" />
                            </form>
                        </td>
                        <td>
                            <a href="{{ route('movies.status', $movie->id) }}"><input type="submit" class="btn btn-success" value="{{ $movie->is_published ? 'hide movie' : 'publish' }}" /></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>

</div>

@endsection