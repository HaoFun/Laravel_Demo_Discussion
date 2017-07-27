@extends('layouts.app')

@section('content')
    <div class="jumbotron">
        <div class="container">
            <div class="media">
                <div class="media-left">
                    <a href="#">
                        <img  class="media-object img-circle" width="75" src="{{ $discussions->user->avatar }}" alt="">
                    </a>
                </div>
                <div class="media-body">
                    <h4 class="media-heading">{{ $discussions->title }}
                        @if(Auth::check() && Auth::user()->id == $discussions->user_id)
                            <div>
                                <form action="{{ route('discussions.destroy',$discussions->id) }}" method="post">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <button type="submit" class="btn btn-lg btn-danger pull-right">刪除帖子</button>
                                </form>
                            </div>
                            <div>
                                <a class="btn btn-lg btn-primary pull-right" href="{{ route('discussions.edit',$discussions->id) }}" role="button">編輯帖子</a>
                            </div>
                        @endif
                    </h4>
                    {{ $discussions->body }}
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-9" role="main">
                <hr>
                @foreach($discussions->comments as $comment)
                    <div class="media">
                        <div class="media-left">
                            <a href="#">
                                <img class="media-object img-circle" src="{{ $comment->user->avatar }}" width="50" alt="">
                            </a>
                        </div>
                        <div class="media-body">
                            <h4 class="media-heading">{{ $comment->user->name }}</h4>
                            {{ $comment->body }}
                        </div>
                    </div>
                @endforeach
                <hr>
                @if(Auth::check())
                    <form action="{{ route('user.comment') }}" method="post">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="body">Body:</label>
                            <input type="hidden" name="discussion_id" value="{{ $discussions->id }}">
                            <textarea name="body" class="form-control" id="" cols="30" rows="10"></textarea>
                        </div>
                        <div>
                            <button class="btn btn-primary form-control" type="submit">發表評論</button>
                        </div>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="btn btn-success form-control">登入後發表評論</a>
                @endif
            </div>
        </div>
    </div>
@endsection