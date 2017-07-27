@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <img src="{{ Auth::user()->avatar }}" width="75" class="img-circle" alt="">
                <form action="{{ route('change.avatar') }}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <input type="file" name="avatar">
                    <button class="btn btn-primary form-control" type="submit">上傳頭像</button>
                </form>
            </div>
        </div>
    </div>
@endsection