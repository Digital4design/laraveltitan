@extends('layouts.admin')

@section('content')
    @if(config('app.is_preview'))
        <div class="well well-sm bg-gray-light">
            <div class="row">
                <div class="col-md-6">
  
                </div>

                <div class="col-md-6">

                </div>
            </div>
        </div>
    @endif
@endsection