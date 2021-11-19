@extends("mainadmin")
@section("header")
Plant Management
@endsection
@push("css")
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.2/css/jquery.dataTables.min.css">   
@endpush
@section("content")
<div class="row">
    <div class="col-md">
            <div class="card shadow mb-4">
                <!-- Animal header -->
                <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">

                    <div>
                    <button class="btn btn-success" data-toggle="modal" data-target="#AddPlant" >Add Plant +</button>
                    </div>
                </div>
    <!-- Animal Content -->
    <div class="card-body">
        <table id="datatable" class="table table-light table-hover">
            <thead>
                <tr>
                    <th> ID</th>
                    <th>Picture</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Planting Guide</th>
                    <th style="text-align:center">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($plants as $plant)
                <tr>
                    <td>{{$plant->id}}</td>
                    <td>
                    <img src="{{asset('uploads/plants/'.$plant->photo)}}" width="70px" height="70px" alt="">
                    </td>
                    <td>{{$plant->plant_name}}</td>
                    <td>{{$plant->description}}</td>
                    <td>{{$plant->guide}}</td>
                    <td style="text-align:center">
                        <a href="{{route('view.edit',$plant->id)}}"><i class="fas fa-edit" data-toggle="tooltip" title="Edit">&#xE254;</i></a>
                        <a href="#" id="delete"><i class="fas fa-trash-alt" data-toggle="modal" data-target="#deleteplant" title="Delete">&#xE872;</i></a>
                    </td>
                </tr>
                @endforeach
            @if(empty($plant))   
                <h6 class="alert alert-danger">No data available for plants</h6>
            @endif
            </tbody>
        </table>
</div>
@include('Admin.Plant.Modal.plant')
                    
@endsection
@push("js")
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.11.2/js/jquery.dataTables.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function(){
          var table = $('#datatable').DataTable();
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function(){
          var table = $('#datatable').DataTable();

            table.on('click','#delete', function(){
                $tr =$(this).closest('tr');
                var data = table.row($tr).data();
                if($($tr).hasClass('child')) {
                    $tr=$tr.prev('.parent');
                }
                var data = table.row($tr).data();
                console.log(data);

                $('#deleteform').attr('action','/plant/delete/'+data[0]);
                $('#deleteplant').modal('show');
            });
        });
    </script>
@endpush

