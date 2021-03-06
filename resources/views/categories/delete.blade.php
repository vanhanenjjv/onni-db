@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="panel panel-danger">
                <div class="panel-heading">Delete category!</div>

                <div class="panel-body">

                    <p>Are you sure you want to delete the following category and its questions? This action cannot be undone.</p>

                    <p><b>{{ $category->category }}</b></p>
                    <form method="post" action="{{ route('category.delete', ['category' => $category->id]) }}" autocomplete="off">
                        {{ csrf_field() }}
                        <input type="submit" class="btn btn-danger btn-block" value="Remove">
                        <a class="btn btn-default btn-block">Take me back to safety</a>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
