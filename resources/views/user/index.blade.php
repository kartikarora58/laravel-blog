@extends('layouts.app')
@section('content')
<div class="container-fluid">
<table style="width: 60%;margin: auto"   class="table table-striped table-condensed table-hover table">
	<thead>
		<tr>
			<td style="width: 10%">S.No</td>
			<td>Title</td>
			<td style="width: 30%;text-align: center" colspan="2">Actions</td>
		</tr>
	</thead>
	@php
	$i=0
	@endphp
	<tbody>
		@foreach($posts as $post)
		<tr>
			<td>{{++$i}}</td>
			<td>{{$post->title}}</td>
			<td><a href="{{url('/admin/update/'.$post->id)}}" class="btn btn-info">Edit</a></td>
			<td><a href="#" class="btn btn-danger">Delete</a></td>
		</tr>
		@endforeach
	</tbody>
</table>
</div>
@endsection