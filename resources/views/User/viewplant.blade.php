@extends('layouts.app')
<link href="{{asset('css/stylesview.css')}}" rel="stylesheet">
@section('content')
<div class="container" style="margin-top: 3%;">
    <a href="{{route('home')}}"><button class="btn btn-success">Back</button></a>
    <div class="row">
        <div class="col-md">
            <div style="display:flex">
                <div class="row">
                    <div class="col-md-6">
                        <div class="project-info-box mt-0">
                            <h3 style="text-transform:uppercase;font-weight:bold">{{$plants->plant_name}}</h3>
                            <p class="mb-0" style=" text-align:justify; text-align:justify">{{$plants->description}}</p>
                            
                            <div style="margin-top: 3%;">
                                <div style="text-align:center">
                                    @foreach($plants->photos as $pics)
                                        <img src="{{asset('uploads/post/'.$pics->imagename)}}" style="width: 170px; height: 120px;"alt="">     
                                    @endforeach
                                </div>
                            </div>      
                        </div><!-- / project-info-box -->
                    </div><!-- / column --> 
                    <div class="col-md ml-0">
                        <img src="{{asset('uploads/plants/'.$plants->photo)}}" style="width: 100%; height:100%"alt="project-image" class="rounded">
                    </div><!-- / column --> 
                </div>
            </div>
            <div class="project-info-box">
                <p><b>Date Posted:</b>  {{ \Carbon\Carbon::parse($plants->updated_at)->format('M. d, Y') }}</p>
                <p  style=" text-align:justify"><b>Guide:</b> {{$plants->guide}}</p>
            </div><!-- / project-info-box -->
        <div>  
    </div> 
</div>

@endsection

