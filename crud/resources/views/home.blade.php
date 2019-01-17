@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>
					<?php
					$message = Session::get('message');
					?>
					@if(isset($message))
						{{ $message }}
					@endif
				
					<form action="{{ route('/save') }}" method="POST" enctype="multipart/form-data" name="crudForm">
					
						{{ csrf_field() }}
						
						<div class="col-md-6 offset-3">
							<label for="name"> Name </label>
							<input type="text" name="name" id="name" class="form-control" placeholder="Name">
						</div>
						
						<div class="col-md-6 offset-3 mt-2">
							<label for="gender"> Gender </label>
							<input type="radio" id="gender" name="gender" value="male" checked> Male
							<input type="radio" id="gender" name="gender" value="female"> Female
						</div>
						
						<div class="col-md-6 offset-3  mt-2">
							<label for="sports"> Favourite Sports </label>					
							<input type="checkbox" id="sports" name="sports[]" value="cricket"> Cricket
							<input type="checkbox" id="sports" name="sports[]" value="football"> Football
							<input type="checkbox" id="sports" name="sports[]" value="handball"> Handball
						</div>
						
						<div class="col-md-6 offset-3  mt-2">
							<label for="country"> Country </label>
							<select name="country" id="country">
								<option>Select Country</option>
								<option value="Bangladesh">Bangladesh</option>
								<option value="India">India</option>
							</select>
						</div>
						
						<div class="col-md-6 offset-3  mt-2">
							<input type="file" name="image" id="image"/>
						</div>
						
						<div class="col-md-6 offset-3  mt-2">
							<input type="submit" name="submit" value="Save"/>
						</div>
					</form>
					</br>
					<table class="table-bordered" style="text-align:center">
						<tr>
							<th>SL</th>
							<th>Name</th>
							<th>Gender</th>
							<th>Sports</th>
							<th>Country</th>
							<th>Image</th>
							<th>Action</th>
						</tr>
						@php($i=1)
						@foreach($datas as $data)
						<tr>
							<td>{{ $i++ }}</td>
							<td>{{ $data->name }}</td>
							<td>{{ $data->gender }}</td>
							<td>{{ $data->sports }}</td>
							<td>{{ $data->country }}</td>
							<td><img src="{{ asset($data->image) }}" width="50"/></td>
							<td>
								<a href="{{ url('/edit',['id'=>$data->id]) }}"> Edit </a> ||
								<a href="{{ url('/delete',['id'=>$data->id]) }}" onclick="return confirm('Are you sure delete')"> Delete </a> 								
							</td>
						</tr>
						@endforeach
					</table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
