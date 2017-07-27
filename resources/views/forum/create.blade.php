@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2" role="main">
                <form action="{{ route('discussions.store') }}" method="post">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input name="title" type="text" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="body">Body</label>
                        <textarea name="body" class="form-control" id="" cols="30" rows="10"></textarea>
                    </div>
                    <div>
                        <button class="btn btn-primary form-control" type="submit">發表帖子</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection