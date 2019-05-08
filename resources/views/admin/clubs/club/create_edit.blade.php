@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        <span><i class="fa fa-edit"></i></span>
                        <span>{{ isset($item)? 'Edit the ' . $item->name . ' entry': 'Create a new Club' }}</span>
                    </h3>
                </div>

                <div class="box-body no-padding">

                    @include('admin.partials.info')

					<form method="POST" action="{{$selectedNavigation->url . (isset($item)? "/{$item->id}" : '')}}" accept-charset="UTF-8">
                        <input name="_token" type="hidden" value="{{ csrf_token() }}">
                        <input name="_method" type="hidden" value="{{isset($item)? 'PUT':'POST'}}">

						<fieldset>
							<div class="row">
								<div class="col-md-6">
                                    <div class="form-group {{ form_error_class('name', $errors) }}">
                                        <label for="fullname">Name</label>
                                        <input type="text" class="form-control" id="name" name="name" placeholder="Please insert the Name" value="{{ ($errors && $errors->any()? old('name') : (isset($item)? $item->name : '')) }}">
                                        {!! form_error_message('name', $errors) !!}
                                    </div>
                                </div>
                                                            </div>
                                                    <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group {{ form_error_class('address', $errors) }}">
                                        <label for="address">Address</label>
                                        <input type="text" class="form-control" id="address" name="address" placeholder="Please insert the address" value="{{ ($errors && $errors->any()? old('address') : (isset($item)? $item->address : '')) }}">
                                        {!! form_error_message('address', $errors) !!}
                                    </div>
                                </div>
							</div>
                                                    <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group {{ form_error_class('zipcode', $errors) }}">
                                        <label for="zipcode">Zipcode</label>
                                        <input type="text" class="form-control" id="zipcode" name="zipcode" placeholder="Please insert the zipcode" value="{{ ($errors && $errors->any()? old('zipcode') : (isset($item)? $item->zipcode : '')) }}">
                                        {!! form_error_message('zipcode', $errors) !!}
                                    </div>
                                </div>
							</div>
                                                    <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group {{ form_error_class('location', $errors) }}">
                                        <label for="location">Location</label>
                                        <input type="text" class="form-control" id="location" name="location" placeholder="Please insert the location" value="{{ ($errors && $errors->any()? old('location') : (isset($item)? $item->location : '')) }}">
                                        {!! form_error_message('location', $errors) !!}
                                    </div>
                                </div>
							</div> 
                                                    <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group {{ form_error_class('email', $errors) }}">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control" id="email" name="email" placeholder="Please insert the email" value="{{ ($errors && $errors->any()? old('email') : (isset($item)? $item->email : '')) }}">
                                        {!! form_error_message('email', $errors) !!}
                                    </div>
                                </div>
							</div>                                                    
                                                    <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group {{ form_error_class('website', $errors) }}">
                                        <label for="website">Website</label>
                                        <input type="text" class="form-control" id="website" name="website" placeholder="Please insert the website" value="{{ ($errors && $errors->any()? old('website') : (isset($item)? $item->website : '')) }}">
                                        {!! form_error_message('website', $errors) !!}
                                    </div>
                                </div>
							</div>                                                    
                                                    <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group {{ form_error_class('manager', $errors) }}">
                                        <label for="manager">Manager</label>
                                        <input type="text" class="form-control" id="manager" name="manager" placeholder="Please insert the manager" value="{{ ($errors && $errors->any()? old('manager') : (isset($item)? $item->manager : '')) }}">
                                        {!! form_error_message('manager', $errors) !!}
                                    </div>
                                </div>
							</div>                                                    
						</fieldset>

						@include('admin.partials.form_footer')
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection