@extends('admin.index')


@section('content')

<div class="col-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Categories</h3>
            <div class="card-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                    <a href="{{ route('categories.create') }}"> <button type="button" class="btn btn-block btn-primary">Create category</button></a>
                </div>
            </div>
        </div>

        <div class="card-body table-responsive p-0">
            <table class="table table-hover text-nowrap">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Genre</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categories as $key => $category)
                    <tr>
                        <td>{{ $key }}</td>
                        <td>{{ $category->genre }}</td>
                        <td><a href="{{ route('categories.edit', $category->id) }}"><button class="btn btn-info">Edit</button></a></td>
                        <td>
                            <form action="{{ route('categories.destroy', $category->id) }}" method="POST">
                                @method('DELETE')
                                @csrf
                                <input type="submit" class="btn btn-danger" value="Delete" />
                            </form>
                        </td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>

</div>

@endsection