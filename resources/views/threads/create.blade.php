@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        
        <div class="col-md-12">
            <h2>Create Thread</h2>
        </div>
        
        <div class="col-md-12">
            <form action="{{ route('threads.channel.store')}}" method="POST">
                {{ csrf_field() }}
                <div class="form-group">
                    <input class="form-control" id="title" name="title" placeholder="TItle" required/>
                </div>

                <div class="form-group">
                    <textarea class="form-control" name="body" id="body" rows="5" placeholder="body" required></textarea>
                </div>

                <div class="form-group">
                    <input type="submit" name="submit" value="Post Thread" class="btn btn-primary">
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
