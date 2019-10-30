@extends('layouts.app')
@extends('layouts.dash')
@section('content')
<div class="container-fluid">
	<div class="jumbotron">
		<h1 align="center">Laravel Blog</h1>
	</div>
</div>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="container-fluid">
	<form style="width: 50%;margin: auto" method="post" action="{{url('/admin/create')}}">
		@csrf
		<div class="form-group">
			<label>Title:</label>
			<input type="text" name="title" class="form-control" placeholder="title" required>
		</div>
		<div class="form-group">
			<label>Slug:</label>
			<input type="text" name="slug" class="form-control" placeholder="slug" required>
		</div>
		<div class="form-group">
			<label>Category:</label>
			<select class="form-control" name="category">
				@foreach($categories as $c)
                <option value="{{$c->id}}">{{$c->name}}</option>
				@endforeach
			</select>
		</div>
		<div class="form-group">
			<label>Tags:</label>
			<select class="js-example-basic-multiple form-control" name="tags[]" multiple>
				@foreach($tags as $tag)
				<option value="{{$tag->id}}">{{$tag->name}}</option>
				@endforeach
			</select>
			
		</div>
		<div class="form-group">
			<label>Body:</label>
			<textarea class="mytextarea" style="height: 150px" name="body"></textarea>
		</div>
		<input type="submit" name="submit" class="btn btn-primary">
	</form>
	<script type="text/javascript">
		$(document).ready(function(){
            $('.js-example-basic-multiple').select2({
            	width:'100%'
            });
		});
	</script>
@endsection