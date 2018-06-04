@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        
        <div class="col-md-12">
            <h2 class="text-center">Threads</h2>
        </div>

        @foreach ($threads as $thread)
            <div class="col-md-8" style="margin: 10px 0;">
                <div class="card">
                    <div class="level card-header">
                        <a class="flex" href="{{ route('threads.channel.show', ['channel' => $thread->channel->slug, 'thread' => $thread->id]) }}">{{ $thread->title }}</a>
                        <strong><a href="{{$thread->path()}}">{{$thread->replies_count . ' ' . str_plural('reply', $thread->replies_count)}}</a></strong>
                    </div>
                    <div class="card-body">
						<div class="body">{{ $thread->body }}</div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
