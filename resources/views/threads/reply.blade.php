<div class="panel">
	<div class="panel-header level">
		
		<h4 class="flex">
			<a href="#">{{ $reply->owner_name }}</a> said {{ $reply->created_at->diffForHumans() }}...
		</h4>
		
		<div>
			
			<form method="POST" action="/replies/{{$reply->id}}/favorites">
				{{csrf_field()}}
				<button type="submit" class="btn btn-default" {{ $reply->isFavorited() ? 'disabled' : '' }}>{{ $reply->favorites()->count() }} {{ str_plural('Favorite', $reply->favorites()->count()) }}</button>
			</form>
		</div>
	</div>

	<div class="panel-body">
	    {{ $reply->body }}
	</div>
</div>
<hr>