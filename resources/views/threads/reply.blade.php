<div class="panel">
	<div class="panel-header"><a href="#">{{ $reply->owner->name }}</a> said {{ $reply->created_at->diffForHumans() }}...</div>

	<div class="panel-body">
	    {{ $reply->body }}
	</div>
</div>
<hr>