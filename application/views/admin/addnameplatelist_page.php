<div class="content-body">
    <div class="container-fluid">
        <div class="col-xl-10 col-lg-10">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Add Name Plate Details</h4>
                            </div>
                            <div class="card-body">
                                <div class="basic-form">
                                    <form id="form1">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Name</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="name" id="name" class="form-control" placeholder="Enter Nameplate">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Price</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="price" id="price" class="form-control" placeholder="Enter Price">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Description</label>
                                            <div class="col-sm-9">
                                            <textarea name="descr" id="descr" class="form-control" placeholder="Enter Description" rows="4" ></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Add 3 Images</label>
                                            <div class="col-sm-12  custom-file">
                                            <input type="file" class="custom-file-input" id="image" name="image" accept="image/*">
                                            <label class="custom-file-label" for="customFile">Choose file</label>
                                            </div>	
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-12 custom-file">
                                            <input type="file" class="custom-file-input" id="image2" name="image2" accept="image/*">
                                            <label class="custom-file-label" for="customFile">Choose file</label>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-12 custom-file">
                                            <input type="file" class="custom-file-input" id="image3" name="image3" accept="image/*">
                                            <label class="custom-file-label" for="customFile">Choose file</label>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group row">
                                            <div class="col-sm-9">
                                                <button type="submit" id="submit" class="btn btn-primary">Add</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
		</div>
    </div>
</div>

<script>
        var _base_url="<?php echo base_url();?>";
</script>
</script>
        <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
        <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script>

<script src="<?php echo base_url();?>assets/jsfiles/nameplate_list.js"></script>
</body>
</html>