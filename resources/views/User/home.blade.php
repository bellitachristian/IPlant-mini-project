@extends('layouts.app')

@section('content')
<div class="container pb-5 mb-sm-1" style="margin-top: 3%;">
        <!-- Categories grid-->
        <div class="row">
            <!-- Category-->
            @foreach($post as $posts)
            <div class="col-md-6">
                <div class="card border-0 mb-grid-gutter">
                    <a class="card-img-tiles" href="shop-style1-ls.html">
                        <div class="main-img"><img src="{{asset('uploads/plants/'.$posts->photo)}}" width="340" height="326" alt="Plant1"></div>
                        <div class="thumblist">
                                @foreach($posts->photos as $pics)
                                        <img src="{{asset('uploads/post/'.$pics->imagename)}}" width="200" height="157" alt="">     
                                @endforeach
                        </div>
                    </a>
                    <div class="card-body border mt-n1 py-4 text-center">
                        <h2 class="h5 mb-1" style="font-weight:bold; text-transform:uppercase">{{$posts->plant_name}}</h2>
                        <span class="d-block mb-3 font-size-xs text-muted">{{$posts->description}}</span>
                        <a class="btn btn-pill btn-outline-success btn-l" href="{{route('plant.detail',$posts->id)}}">View Details</a>
                    </div>
                    <div class="card-footer">
                    <label>&nbsp &nbsp<i style="color:green; font-size:12px" class="fa fa-circle"></i> {{$posts->status}}</label><span><label style="float:right"> posted {{ \Carbon\Carbon::parse($posts->updated_at)->diffForHumans() }} &nbsp 
                    </div>
                </div>
            </div>
            @endforeach
            @if($posted == 0)
                    <h6 class="alert alert-danger">No plants available as of this moment!</h6>
            @endif
       </div>
    </div>
@endsection
