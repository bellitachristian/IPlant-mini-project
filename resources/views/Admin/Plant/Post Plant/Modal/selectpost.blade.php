
<div class="modal fade"  id="selectpost" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
    <div class="modal-dialog" style="max-width: 50%;" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel">Select Plant to Post</h4>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
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
                        <button type="button" id="postplant" data-id="{{$plant->id}}" class="btn btn-success">Select</button>
                    </td>
                </tr>
                @endforeach
            @if(empty($plant))   
                <h6 class="alert alert-danger">No data available for plants</h6>
            @endif
            </tbody>
                    </table>
            </div>
    </div>  
</div>