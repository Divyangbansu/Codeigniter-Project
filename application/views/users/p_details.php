<?php include('header.php') ?> 

<!--**********************************
            Content body start
        ***********************************-->
        <div class=container" id="ajax-content-container" style="padding-top:100px;">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <?php
                                   
                                    echo '
                                    <div class="col-xl-4 col-lg-6  col-md-6 col-xxl-5 ">
                                        <!-- Tab panes -->
                                        <div class="tab-content">
                                            <div role="tabpanel" class="tab-pane fade show active" id="first">
                                                <img class="img-fluid" src="'.base_url().'/upload/'.$product->image.'" alt="">
                                            </div>
                                            <div role="tabpanel" class="tab-pane fade" id="second">
                                                <img class="img-fluid" src="'.base_url().'/upload/'.$product->image2.'" alt="">
                                            </div>
                                            <div role="tabpanel" class="tab-pane fade" id="third">
                                                <img class="img-fluid" src="'.base_url().'/upload/'.$product->image3.'" alt="">
                                            </div>
                                        </div>
                                        <div class="tab-slide-content new-arrival-product mb-4 mb-xl-0">
                                            <!-- Nav tabs -->
                                            <ul class="nav slide-item-list mt-3" role="tablist">
                                                <li role="presentation" class="show">
                                                    <a href="#first" role="tab" data-toggle="tab">
                                                        <img class="img-fluid" src="'.base_url().'/upload/'.$product->image.'" alt="" width="80">
                                                    </a>
                                                </li>
                                                <li role="presentation">
                                                    <a href="#second" role="tab" data-toggle="tab"><img class="img-fluid" src="'.base_url().'/upload/'.$product->image2.'" alt="" width="80"></a>
                                                </li>
                                                <li role="presentation">
                                                    <a href="#third" role="tab" data-toggle="tab"><img class="img-fluid" src="'.base_url().'/upload/'.$product->image3.'" alt="" width="80"></a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <!--Tab slider End-->
                                    <div class="col-xl-8 col-lg-6  col-md-6 col-xxl-7 col-sm-12">
                                        <div class="product-detail-content">
                                            <!--Product details-->
                                            <div class="new-arrival-content pr">
                                                <h1>'.$product->name.'</h1>
                                                <p>Availability: <span class="item"> In stock <i
                                                            class="fa fa-shopping-basket"></i></span>
                                                </p>
                                                <div class="d-table mb-2">
													<h2><p class="price float-left d-block">???'.$product->price.'</p></h2>
                                                </div>
                                                <p>Product code: <span class="item">0405689</span> </p>
                                                <p>Rate: <span class="item">Top Trend</span></p>
                                                <p>Product tags:&nbsp;&nbsp;
                                                    <span class="badge badge-success light">Creative</span>
                                                    <span class="badge badge-success light">New</span>
                                                    <span class="badge badge-success light">Trending</span>
                                                    <span class="badge badge-success light">Popular</span>
                                                </p>
                                                <p class="text-content"></p>
                                                <div class="shopping-cart mt-3">
                                                    <a class="btn btn-success btn-lg" target="_blank" href="" onclick="javascript:share();"><i
                                                    class="fa fa-shopping-basket mr-2"></i> Chat On Whatsapp</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    ';?>
					<!-- review -->
					<div class="modal fade" id="reviewModal">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title">Review</h5>
									<button type="button" class="close" data-dismiss="modal"><span>&times;</span>
									</button>
								</div>
								<div class="modal-body">
									<form>
										<div class="text-center mb-4">
											<img class="img-fluid rounded" width="78" src="./images/avatar/1.jpg" alt="DexignZone">
										</div>
										<div class="form-group">
											<div class="rating-widget mb-4 text-center">
												<!-- Rating Stars Box -->
												<div class="rating-stars">
													<ul id="stars">
														<li class="star" title="Poor" data-value="1">
															<i class="fa fa-star fa-fw"></i>
														</li>
														<li class="star" title="Fair" data-value="2">
															<i class="fa fa-star fa-fw"></i>
														</li>
														<li class="star" title="Good" data-value="3">
															<i class="fa fa-star fa-fw"></i>
														</li>
														<li class="star" title="Excellent" data-value="4">
															<i class="fa fa-star fa-fw"></i>
														</li>
														<li class="star" title="WOW!!!" data-value="5">
															<i class="fa fa-star fa-fw"></i>
														</li>
													</ul>
												</div>
											</div>
										</div>
										<div class="form-group">
											<textarea class="form-control" placeholder="Comment" rows="5"></textarea>
										</div>
										<button class="btn btn-success btn-block">RATE</button>
									</form>
								</div>
							</div>
						</div>
					</div>
                </div>
            </div>
        </div>
        <!--**********************************
            Content body end
        ***********************************-->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <script>
                function share()
                {
                    var whats_app_message = encodeURIComponent(document.URL);
                    var whatsapp_url = "https://wa.me/+918490803559/?text="+whats_app_message;
                    // "https://api.whatsapp.com/send?text="+whats_app_message+"&phone="+8490803559;
                    alert(whatsapp_url);
                    window.location.href= whatsapp_url;         
                }
        </script>
<?php include('footer.php') ?> 