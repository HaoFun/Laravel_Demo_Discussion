@extends('layouts.app')

@section('content')
<div class="container">

    <!-- Main component for a primary marketing message or call to action -->
    <div class="jumbotron">
        <h1>Hao Club Demo <a class="btn btn-lg btn-primary pull-right" href="{{ route('discussions.create') }}" role="button">發布帖子</a></h1>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-9" role="main">
                @foreach($discussions as $discussion)
                    <div class="media">
                        <div class="media-left">
                            <a href="#">
                                <img src="{{ $discussion->user->avatar }}" class="img-circle" width="70" alt="">
                            </a>
                        </div>
                        <div class="media-body">
                            <h4 class="media-heading"><a href="{{ route('discussions.show',$discussion->id) }}">{{ $discussion->title }}</a></h4>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection