@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
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

            <hr>
            
            <h3>Replies</h3>

            @foreach ($thread->replies as $reply)
                @include ('threads.reply')
            @endforeach

            @if (auth()->check())
                @include ('partials.errors')
               <form class="form" action="{{ route('threads.channel.reply.store', ['channel' => $thread->channel_id, 'thread' => $thread->id]) }}" method="POST">
                    {{ csrf_field() }}
                   <textarea class="form-control" rows="4" name="body" required placeholder="What can you say?"></textarea>
                   <hr>
                   <button class="btn btn-default">Post</button>
               </form>
		    @else
		        <p class="text-center">Please <a href="{{route('login')}}">sign-in</a> to participate this discuss</p>
		    @endif
        </div>
		<div class="col-md-4">
	        <div class="card">
	            <div class="card-body">
					This thread was published {{ $thread->created_at->diffForHumans() }}
					by <a href="#">{{ $thread->creator->name }}</a> and currenly has {{$thread->replies_count}} {{ str_plural('comment', $thread->replies_count) }}
	            </div>
	        </div>
	    </div>
    </div>
  
</div>
@endsection
