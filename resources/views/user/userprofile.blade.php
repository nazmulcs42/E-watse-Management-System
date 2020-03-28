

@extends('layouts.userLayouts')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Users Profile') }} </div>

                <div class="card-body">
                    <table class="table table-hover table-bordered">
                     <tbody>
                          @foreach($results as $data)
                         <tr><th>Email Address</th> <td>{{$data->email}}</td></tr>
                         <tr><th>Name</th> <td>{{$data->name}}</td></tr>
                         <tr><th>Father Name</th><td>{{$data->father_name}}</td></tr>
                         <tr><th>Mobile_no</th><td>{{$data->mobile_no}}</td></tr>
                         <tr><th>House_no</th><td>{{$data->house_no}}</td></tr>
                         <tr><th>Address</th><td>{{$data->address}}</td></tr>
                         <tr><th>Birth_Date</th><td>{{$data->birth_date}}</td></tr>
                          @endforeach
                    </tbody>
                  </table>
                  
                   <button type="button" style="float: right"  class="btn btn-danger">Delete</button>
                   <button type="button" style="float: right" class="btn btn-primary">Edit</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
