<div class="modal fade"  id="AddPlant" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Plant +</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
            <form action="{{route('plant.save')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group row">
                        <div class="col-md"> 
                            <label class="text-sm">Plant Photo</label>
                            <input type="file" class="form-control form-control-sm"  name="photo" required  value ="{{old('photo')}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md"> 
                            <label class="text-sm">Plant Name</label>
                            <input type="text" class="form-control form-control-sm" name="name" required  value ="{{old('vac_name')}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md"> 
                            <label class="text-sm">Description</label>
                            <textarea class="form-control" name="desc" rows="3"  required value ="{{old('desc')}}"></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md"> 
                            <label class="text-sm">Planting Guide</label>
                            <textarea class="form-control" name="guide" rows="3"  required value ="{{old('desc')}}"></textarea>
                        </div>
                    </div>
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <button class="btn btn-success" type="submit">Save</button>
                </div>    
            </form>
        </div>
    </div> 
</div> 
<!-- Delete Animal Modal -->
<div class="modal fade"  id="deleteplant" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Remove Plant </h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
            <form action="/plant/delete/" method="POST" id="deleteform">
                @csrf
                <div class="modal-body">    
                    <h6> Are you sure you want to proceed deletion?</h6>  
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <button class="btn btn-danger" type="submit">Proceed</button>
                </div>    
            </form>
        </div>
    </div> 
</div> 