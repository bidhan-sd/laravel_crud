@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit</div>
				
					<form action="{{ route('/update') }}" method="POST" enctype="multipart/form-data" name="crudForm">
					
						{{ csrf_field() }}
						
						<div class="col-md-6 offset-3">
							<label for="name"> Name </label>
							<input type="text" name="name" id="name" class="form-control" placeholder="Name" value="{{ $data->name }}">
							<input type="hidden" name="id" id="id"  value="{{ $data->id }}">
						</div>
						
						<div class="col-md-6 offset-3 mt-2">
							<label for="gender"> Gender </label>
							<input type="radio" id="gender" name="gender" value="male" @if($data->gender == "male") checked @endif> Male
							<input type="radio" id="gender" name="gender" value="female" @if($data->gender == "female") checked @endif> Female
						</div>
						
						<div class="col-md-6 offset-3  mt-2">
							<label for="sports"> Favourite Sports </label>
							<?php
								$sports = explode(",",$data->sports);
							?>
							
							<input type="checkbox" id="sports" name="sports[]" value="cricket" @if(in_array("cricket",$sports)) checked @endif > Cricket
							<input type="checkbox" id="sports" name="sports[]" value="football" @if(in_array("football",$sports)) checked @endif> Football
							<input type="checkbox" id="sports" name="sports[]" value="handball" @if(in_array("handball",$sports)) checked @endif> Handball
						</div>
						
						<div class="col-md-6 offset-3  mt-2">
							<label for="country"> Country </label>
							<select name="country" id="country">
								<option>Select Country</option>
								<option value="Bangladesh" @if($data->country == "Bangladesh") selected @endif >Bangladesh</option>
								<option value="India" @if($data->country == "India") selected @endif >India</option>
							</select>
						</div>
						
						<div class="col-md-6 offset-3  mt-2">
							<img src="{{ asset($data->image) }}" width="100"/>
						</div>
						<div class="col-md-6 offset-3  mt-2">
							<input type="file" name="image" id="image"/>
						</div>
						
						<div class="col-md-6 offset-3  mt-2">
							<input type="submit" name="submit" value="Update"/>
						</div>
						
					</form>
					
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
