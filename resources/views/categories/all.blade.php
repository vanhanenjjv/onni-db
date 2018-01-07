@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">Categories</div>

                <div class="panel-body">

                    @if(count($categories))
                        {{ $categories->links() }}
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Category</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($categories as $category)
                                    <tr>
                                        <td>{{ $category->id }}</td>
                                        <td>{{ $category->category }}</td>
                                        <td>
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Actions <span class="caret"></span>
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li><a href="{{ route('category.edit', ['category' => $category->id]) }}">Edit</a></li>
                                                    <li role="separator" class="divider"></li>
                                                    <li><a href="{{ route('category.delete', ['category' => $category->id]) }}">Delete</a></li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $categories->links() }}
                    @else
                        <p>There are no categories.</p>
                    @endif

                </div>
            </div>
        </div>

        @include('partials.categories-menu')
    </div>
</div>
@endsection
