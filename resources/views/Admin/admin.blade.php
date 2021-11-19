@extends('mainadmin')

@section('content')
<div class="row">

<!-- Earnings (Monthly) Card Example -->
<div class="col-xl">
    <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xl font-weight-bold text-primary text-uppercase mb-1">
                       Added Plants</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{$plants}}</div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-leaf fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Earnings (Monthly) Card Example -->
<div class="col-xl">
    <div class="card border-left-success shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xl font-weight-bold text-success text-uppercase mb-1">
                        Plants Posted</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{$posted}}</div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-calendar fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Earnings (Monthly) Card Example -->
<div class="col-xl">
    <div class="card border-left-info shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xl font-weight-bold text-info text-uppercase mb-1">Registered Users
                    </div>
                    <div class="row no-gutters align-items-center">
                        <div class="col-auto">
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$users}}</div>
                        </div>
                    </div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-users fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>
    </div>
</div>  
</div>
<div class="row">

<!-- Earnings (Monthly) Card Example -->
<div class="col-xl">
    <div class="card">
        <div class="card-body">
            <table style="text-align:center;margin-left:25%;">
                <thead>
                    <tr>
                        <th>Photo</th>
                        <th>Name</th> 
                    </tr>
                </thead>    
                <tbody>
                    @foreach($tanom as $tanoms)
                    <tr>
                        <td>
                        <img src="{{asset('uploads/plants/'.$tanoms->photo)}}" width="100px" height="100px" alt="">
                        </td>
                        <td>{{$tanoms->plant_name}}</td>
                    </tr>
                    @endforeach
                    @if(empty($tanoms))
                    <h6 class="alert alert-danger">No plants added!</h6>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Earnings (Monthly) Card Example -->
<div class="col-xl">
    <div class="card">
        <div class="card-body">
            <table style="text-align:center;margin-left:25%;">
                <thead>
                    <tr>
                        <th>Photo</th>
                        <th>Name</th> 
                    </tr>
                </thead>    
                <tbody>
                    @foreach($post as $tanoms)
                    <tr>
                        <td>
                        <img src="{{asset('uploads/plants/'.$tanoms->photo)}}" width="100px" height="100px" alt="">
                        </td>
                        <td>{{$tanoms->plant_name}}</td>
                    </tr>
                    @endforeach
                    @if($posted == 0)
                    <h6 class="alert alert-danger">No plants being posted!</h6>
                    @endif
                </tbody>
            </table>
            
        </div>
    </div>
</div>

<!-- Earnings (Monthly) Card Example -->
<div class="col-xl">
    <div class="card">
        <div class="card-body">
            <table style="text-align:center;margin-left:25%;">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th> 
                    </tr>
                </thead>    
                <tbody >
                    @foreach($user as $tanoms)
                    <tr>
                        <td>{{$tanoms->name}}</td>
                        <td>{{$tanoms->email}}</td>
                    </tr>
                    @endforeach
                    @if($users == 0)
                    <h6 class="alert alert-danger">No registered users!</h6>
                    @endif
                </tbody>
            </table>     
        </div>
    </div>
</div>  
</div>

@endsection
