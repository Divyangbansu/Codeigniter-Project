<?php require_once './application/views/users/header.php' ?>


    <!-- Page Content -->
    <!-- Banner Starts Here -->
    <div class="banner header-text">
    <div class="owl-banner owl-carousel">
    <?php
    foreach($banners as $list1)
    {
      if($list1->status==1){
        echo '
        <div class="banner-item" style="background-image:url('.base_url().'/upload/'.$list1->image.');">
          <div class="text-content">
            <h4>'.$list1->name.'</h4>
            <h2>'.$list1->descr.'</h2>
          </div>
        </div>
        ';}
    }
      ?>
      </div>
    </div>
    <!-- Banner Ends Here -->

     
     <!--**********************************
         nameplate Content body start
     ***********************************-->

    <div class="latest-products">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="section-heading">
              <h2>Latest Products</h2>
            </div>
          </div>
          <?php
                foreach($product as $list)
                {
                    if($list->status==1){
                echo '
                <div class="col-md-4" onclick="javascript:check('.$list->id.');">
                <div class="product-item">
                  <a href="#"><img src="'.base_url().'/upload/'.$list->image.'" alt=""></a>
                  <div class="down-content">
                    <a href="#"><h4>'.$list->name.'</h4></a>
                    <h6>₹ '.$list->price.'</h6>
                    <p>Lorem ipsume dolor sit amet, adipisicing elite. Itaque, corporis nulla aspernatur.</p>
                  </div>
                </div>
              </div>';}
            }
            ?>
           




        </div>
      </div>
    </div>
    
        <!--**********************************
            Content body end
        ***********************************-->
        <script>
        var _base_url="<?php echo base_url();?>";
</script>
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script>

<script src="<?php echo base_url();?>assets/jsfiles/carddetails.js"></script>
<?php include('./application/views/users/footer.php') ?> 