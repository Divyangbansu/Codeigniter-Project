<div class="content-body">

    <!-- Edit Records Modal -->
				<!-- Modal -->
				<div class="modal fade" id="editRecords" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="exampleModalLabel">Edit Record</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<div class="container-fluid">
									<div class="row text-center">
										<div class="row" style="margin:10px">
											<div id="show_img"></div>
											<div id="show_img2"></div>
											<div id="show_img3"></div>
										</div>
										
									</div>
									<div class="row">
										<div class="col-md-12">

											<!-- Edit Record Form -->
											<form id="editForm">

												<!-- ID -->
												<input type="hidden" id="edit_id">

												<!-- Name -->
												<div class="input-group mb-3">
													<div class="input-group-prepend">
														<span class="input-group-text bg-info text-white" id="basic-addon1"><i class="fas fa-user"></i></span>
													</div>
													<input type="text" class="form-control" id="edit_name" placeholder="name" aria-label="name" aria-describedby="basic-addon1">
												</div>

												<!-- price -->
												<div class="input-group mb-3">
													<div class="input-group-prepend">
														<span class="input-group-text bg-info text-white" id="basic-addon1"><i class="fas fa-user"></i></span>
													</div>
													<input type="text" class="form-control" id="edit_price" placeholder="price" aria-label="price" aria-describedby="basic-addon1">
												</div>

												<!-- description -->
												<div class="input-group mb-3">
													<div class="input-group-prepend">
														<span class="input-group-text bg-info text-white" id="basic-addon1"><i class="fas fa-user"></i></span>
													</div>
													<textarea name="descr" id="edit_descr" class="form-control" placeholder="Enter Description" rows="4" ></textarea>
												</div>

												<!-- Image -->
												<div class="custom-file">
													<input type="file" class="custom-file-input" id="edit_img">
													<label class="custom-file-label" for="customFile">Choose file</label>
												</div>
												<div class="custom-file">
													<input type="file" class="custom-file-input" id="edit_img2">
													<label class="custom-file-label" for="customFile">Choose file</label>
												</div>
												<div class="custom-file">
													<input type="file" class="custom-file-input" id="edit_img3">
													<label class="custom-file-label" for="customFile">Choose file</label>
												</div>
											</form>
										</div>
									</div>
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

								<!-- Update Button -->
								<button type="button" class="btn btn-primary" id="update">Update Record</button>
							</div>

						</div>
					</div>
				</div>

            <!-- Datatable -->
            <div class="container-fluid">
                <!-- row -->
                <div class="row">
					<div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Nameplate Datatable</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="showname" class="display min-w850" style="margin:50px;">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Price</th>
                                                <th>Image</th>
                                                <th>Description</th>
                                                <th>Status(Active/Inactive)</th>
												<th>Action<th>
                                            </tr>
                                        </thead>
                                       <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
				</div>
            </div>
        </div>
	

        <script>
        var _base_url="<?php echo base_url();?>";
        </script>
        <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
	<!-- Popper JS -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js"></script>
	<!-- Bootstrap JS -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js"></script>
	<!-- Toastr JS -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
	<!-- Sweetalert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
 

	<?php require_once './application/views/admin/footer.php' ?>

    <!-- Datatable -->
    <script src="<?php echo base_url();?>assets/jsfiles/nameplate_list.js"></script>