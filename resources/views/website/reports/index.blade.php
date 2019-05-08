@extends('layouts.website')

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="box box-primary box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        <span><i class="fa fa-table"></i></span>
                        <span>Schedules</span>
                    </h3>
                </div>

                <div class="box-body">
                    <table id="tbl-list" data-server="false" data-page-length="25" class="dt-table table table-striped table-bordered" cellspacing="0" width="100%">
                        <tbody>
                        @php ($temp = '')
                        @foreach ($items as $item)
                            @php ($play_date =  date('d-m-Y', strtotime($item->datum)) )
                            @if($temp!=$play_date)
                            <tr>
                                <th>{{ date('l', strtotime($item->datum)) }} , {{ date('d. F. Y', strtotime($item->datum)) }}</th>
                            </tr>
                            <tr>    
                                <td>{{ $item->short_name }}  &nbsp; {{ date('H:i', strtotime($item->datum)) }} Uhr </td>
                            </tr>
                            @else
                            <tr>
                                <td>{{ $item->short_name }}  &nbsp; {{ date('H:i', strtotime($item->datum)) }} Uhr </td>
                            </tr>
                            @endif

                            @php ($temp = $play_date)                            
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection