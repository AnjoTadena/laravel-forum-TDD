@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <a href="#">{{ $thread->creatorName }}</a>
                    Posted: {{ $thread->title }}
                </div>

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
                @include ('threads.reply')
            @endforeach
        </div>
    </div>
    @if (auth()->check())
        <div class="row justify-content-center" style="padding: 10px;">
            <div class="col-md-8">
                @include ('partials.errors')
               <form class="form" action="{{route('threads.replies.store', $thread->id)}}" method="POST">
                    {{ csrf_field() }}
                   <textarea class="form-control" rows="4" name="body" required placeholder="What can you say?"></textarea>
                   <hr>
                   <button class="btn btn-default">Post</button>
               </form>
            </div>
        </div>
    @else
        <p class="text-center">Please <a href="{{route('login')}}">sign-in</a> to participate this discuss</p>
    @endif
</div>
@endsection
