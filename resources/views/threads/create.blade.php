@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        
        <div class="col-md-12">
            <h2>Create Thread</h2>
        </div>
        
        <div class="col-md-12">
            @if ($errors->count())
            <ul class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            @endif
            <form action="{{ route('threads.channel.store')}}" method="POST">
                {{ csrf_field() }}
                <div class="form-group">
                    <select class="form-control" id="channel_id" name="channel_id" required>
                        <option value="">Please Select a channel</option>
                        @foreach ($channels as $channel)
                        <option value="{{$channel->id}}" {{ $channel->id == old('channel_id') ? 'selected' : '' }}>{{$channel->name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <input class="form-control" id="title" name="title" placeholder="TItle" value="{{old('title')}}" required/>
                </div>

                <div class="form-group">
                    <textarea class="form-control" name="body" id="body" rows="5" placeholder="body" required>{{old('body')}}</textarea>
                </div>

                <div class="form-group">
                    <input type="submit" name="submit" value="Post Thread" class="btn btn-primary">
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
