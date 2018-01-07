@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">Add new category</div>

                <div class="panel-body">
                    <form method="post" action="{{ route('category.new') }}" autocomplete="off">
                        {{ csrf_field() }}
                        <div class="form-group{{ $errors->has('category') ? ' has-error' : '' }}">
                            <label for="category">Category</label>
                            <input type="text" name="category" class="form-control" value="{{ old('category') }}">

                            @if ($errors->has('category'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('category') }}</strong>
                                </span>
                            @endif
                        </div>

                        <input type="submit" class="btn btn-primary" value="Add">
                    </form>

                </div>
            </div>
        </div>

        @include('partials.categories-menu')
    </div>
</div>
@endsection
