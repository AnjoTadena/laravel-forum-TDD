@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ $thread->title }}</div>

                <div class="card-body">
                    {{ $thread->body }}
                </div>
            </div>


        </div>
    </div>
    <div class="row justify-content-center" style="padding: 10px;">
        <div class="col-md-8">
            <hr>
            <h3>Replies</h3>

            @foreach ($thread->replies as $reply)
            <div class="panel">
                <div class="panel-header"><a href="#">{{ $reply->owner->name }}</a> said {{ $reply->created_at->diffForHumans() }}...</div>

                <div class="panel-body">
                    {{ $reply->body }}
                </div>
            </div>
            <hr>
            @endforeach
        </div>
    </div>
    
</div>
@endsection
