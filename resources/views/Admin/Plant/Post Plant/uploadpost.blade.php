@extends("mainadmin")
@section("header")
<meta name="csrf-token" content="{{ csrf_token() }}" />
@endsection
@push("css")
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.css" integrity="sha512-jU/7UFiaW5UBGODEopEqnbIAHOI8fO6T99m7Tsmqs2gkdujByJfkCbbfPSN4Wlqlb9TGnsuC0YgUgWkRBK7B9A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endpush
@section("content")
<div class="col-sm">
    <div class="card shadow mb-4">
        <div class="card-header">
          <form action="" method="POST" id="post">
            <div style="display:flex">
              <div class="col-sm">
                  <br>
                  <button type="submit"  style="padding:10px;width:150px" class="btn btn-success">Post</button>     
              </div>       
            </div>
          </form>
        </div>
        <div class="card-body">
            <div style="display:flex">
                <div class="col-sm-3">
                    <img src="{{asset('uploads/plants/'.$plants->photo)}}" style=" width:100%; height:100%;"alt="">   
                </div>   
                <div class="col-sm">
                    <label style="text-transform:uppercase">Plant Name</label>
                    <input type="text" readOnly class="form-control" value="{{$plants->plant_name}}">
                    <label style="text-transform:uppercase">All About  {{$plants->plant_name}}</label><br>
                    <textarea disabled cols="40" rows="5">{{$plants->description}}</textarea>
                </div>  
                <div class="col-sm">
                    <label style="text-transform:uppercase">Planting Guide for {{$plants->plant_name}}</label>
                        <textarea disabled cols="40" rows="5">{{$plants->guide}}</textarea>
                </div>
            </div>
                
        </div> 
        <div class="card-footer">

        </div>
    </div>
</div>
<div class="col-sm">
        <div class="card shadow mb-4">
            <div class="card-header">
               <h4 style="text-transform:uppercase; color:black">UPLOAD RELATED PHOTOS OF {{$plants->plant_name}}</h4> </div>
            <div class="card-body">
                <div style="display:flex">   
                    <div class="col-sm">
                        <div id="uploaded_image">
                           
                        </div>
                        <div>
                            <h6 style="text-align:center">Click to Upload Photos</h6>
                        </div>
                        <form id="dropzoneForm" enctype="multipart/form-data" action="{{ route('post.uploadphoto',$plants->id) }}" class="dropzone">
                            @csrf
                        </form>
                        <div style="text-align:center; margin-top:10px" >
                            <button type="button" class="btn btn-success" id="submit-all">Upload</button>     
                        </div>
                    </div>
                </div>
                 
            </div> 
        </div>
    </div>
@endsection 
@push("js")
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>  
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.js" integrity="sha512-oQq8uth41D+gIH/NJvSJvVB85MFk1eWpMK6glnkg6I7EdMqC1XVkW7RxLheXwmFdG03qScCM7gKS/Cx3FYt7Tg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


<script type="text/javascript">
    Dropzone.options.dropzoneForm = {
    autoProcessQueue : false,
    acceptedFiles : ".png,.jpg,.jpeg",
    addRemoveLinks: true,

    init:function(){
      var submitButton = document.querySelector("#submit-all");
      myDropzone = this;

      submitButton.addEventListener('click', function(){
        myDropzone.processQueue();
      });
      this.on("complete", function(){
        if(this.getQueuedFiles().length == 0 && this.getUploadingFiles().length == 0)
        {
          confirm("Photo added");
          var _this = this;
          _this.removeAllFiles();
        }
        load_images();
      });
    }
};
load_images();

  function load_images()
  {
    $.ajax({
      url:"{{ route('post.fetch',$plants->id) }}",
      success:function(data)  
      {
        $('#uploaded_image').html(data);
      }
    })
  }
  $(document).on('click', '.remove_image', function(){
    var name = $(this).attr('id');
    $.ajax({
      url:"{{ route('postphoto.delete') }}",
      data:{name : name},
      success:function(data){
        confirm('Removed Successfully!');
        load_images();
      }
    })
  });
</script>
<script>

$("#post").submit(function(e){
      e.preventDefault();

      let _token   = $('meta[name="csrf-token"]').attr('content');

      $.ajax({
        url: "{{route('post.save',$plants->id)}}",
        type:"POST",
        data:{
          _token: _token
        },
        success:function(html){
          confirm('Posted Successfully')
          window.location.href ="{{route('post.view')}}"
        },
        error: function(error) {
         alert('Something went wrong')
        }
       }); 
       return false;

  });
</script> 
@endpush
