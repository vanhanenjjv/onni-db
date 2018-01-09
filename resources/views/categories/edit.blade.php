@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">Edit category</div>

                <div class="panel-body">
                    <form method="post" action="{{ route('category.edit', ['category' => $category->id]) }}" autocomplete="off">
                        {{ csrf_field() }}
                        <div class="form-group{{ $errors->has('category') ? ' has-error' : '' }}">
                            <label for="question">Category</label>
                            <input type="text" name="category" class="form-control" value="{{ $category->category }}">

                            @if ($errors->has('category'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('category') }}</strong>
                                </span>
                            @endif
                        </div>

                        <input type="submit" class="btn btn-primary" value="Update">
                    </form>

                </div>
            </div>
        </div>

        @include('partials.categories-menu')
    </div>
</div>
@endsection
