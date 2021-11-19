@extends("mainadmin")
@section("header")
Edit Plant
@endsection
@section("content")
<div class="row">
<div class="col-sm-7">
        <div class="card shadow mb-4">
            <!-- Animal header -->
    
<!-- Animal Content -->
<div class="card-body">
    <form action="{{route('plant.edit',$plants->id)}}"  method="POST" enctype="multipart/form-data">
        @csrf 
        <div class="form-group-row" style="display:flex">
            <div class="col-sm"> 
                <div style="text-align:center">
                    <img src="{{asset('uploads/plants/'.$plants->photo)}}"width="200px" height="200px" alt="">
                </div>
                <br><label class="text-sm" >Upload Image</label>      
                <input type="file" class="form-control form-control-sm" id="photo" name="photo">
    
                    <label class="text-sm">Plant Name</label>
                    <input type="text" value ="{{$plants->plant_name}}"  class="form-control form-control-sm" id="name" name="name">
                                    

                    <label class="text-sm">Description</label>
                    <textarea class="form-control" name="description" rows="3" >{{$plants->description}}</textarea>
           
                    <label>Planting Guide</label>
                    <textarea class="form-control" name="guide" rows="3" id="info">{{$plants->guide}}</textarea>           
                   <div style="margin-top:3%">
                        <a href="{{route('view.plants')}}"><button class="btn btn-secondary" type="button">Back</button></a>
                        <button class="btn btn-success" id="btn" type="submit">Update</button>
                   </div> 
               
            </div>   
        </form>                                 
    </div>               
</div>  
@endsection  
@push('js')

