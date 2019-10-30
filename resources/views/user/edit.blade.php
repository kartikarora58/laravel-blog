@extends('layouts.app')
@extends('layouts.dash')
@section('content')
<div class="container-fluid">
	<div class="jumbotron">
		<h1 align="center">Laravel Blog</h1>
	</div>
</div>
<div class="container-fluid">
	<div class="row">
	<div class="col-7">
		<form method="post" action="{{url('/admin/update/'.$post->id)}}">
			@csrf
			<input type="hidden" name="_method" value="PATCH">
			<div class="form-group">
			   <label>Title:</label>
			   <input type="text" class="form-control" name="title" value="{{$post->title}}">
			</div>
			<div class="form-group">
			   <label>Slug:</label>
			   <input type="text" class="form-control" name="slug" name="slug" value="{{$post->slug}}">
			</div>
			<div class="form-group">
				<label>Category:</label>
				@php
				$selected="selected"
				@endphp
				<select name="category" class="form-control">
				@foreach($categories as $c)
                 <option value="{{$c->id}}" {{$c->id==$post->category_id?$selected:''}}>{{$c->name}}</option>
				@endforeach
				</select>
			</div>
			<div class="form-group">
			<label>Tags:</label>
			<select class="js-example-basic-multiple form-control" name="tags[]" multiple>
				@foreach($tags as $tag)
				@php
				$flag=0
				@endphp
                @foreach($qw as $q)
				@if($tag->id==$q)
                  <option value="{{$tag->id}}" selected>{{$tag->name}}</option>
                  @php
                  $flag=1
                  @endphp
				@endif
				@endforeach
				@if($flag==0)
				 <option value="{{$tag->id}}">{{$tag->name}}</option>
				@endif
				@endforeach
			</select>
		    </div>
			<div class="form-group">
				<label>Body:</label>
				<textarea class="mytextarea" name="body" class="form-control" style="height: 150px">{{$post->body}}</textarea>
			</div>
			<input type="submit" name="submit" id="submit" hidden>
		</form>
	</div>
	<div class="col-5">
		<div style="margin: auto" class="jumbotron container-fluid">
			Last Updated:&nbsp;&nbsp;{{date('M j,Y h:ia',strtotime($post->updated_at))}}<br><br>
			View Post:<a target="_blank" href="{{url('/'.$post->slug)}}">{{url('/'.$post->slug)}}</a><br><br>
			Posted By:&nbsp;&nbsp;Admin
			<div class="row">
				<div class="col">
					<a href="#" id="save"  type="" style="margin:auto" class="form-control btn btn-success">Save Changes</a>
				</div>
				<br>
				<div class="col">
					<a href="#" class="form-control btn btn-danger" style="margin:auto;">Cancel</a>
				</div>
			</div>
		</div>
		
	</div>
</div>
</div>
<script>
	$(document).ready(function(){

        $('#save').click(function(){
        	$('#submit').trigger('click');
        });
        $('.js-example-basic-multiple').select2({
            	width:'100%'
        });
        
        console.log({!! json_encode($post->tag()->pluck('tag_id')) !!});
      // $('.js-example-basic-multiple').select2().val('2').trigger('change');
    });
</script>
@endsection