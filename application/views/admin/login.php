<html>
    
<head>
    <title>BANSU ART</title>
    <link href="<?= base_url(ASSETS."css/style.css");?>" rel="stylesheet">
</head>
<body>

<div class="container" style="margin-top:20px;">
<h1 class="text-center" >Admin Form</h1>

<?php  if($error=$this->session->flashdata('Login_failed')):  ?>
<div class="row">
<div class="col-lg-10">
<div class="alert alert-danger">
<?= $error; ?>
</div>
</div>
</div>

<?php endif; ?>

   

 <div class="authincation h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-50 align-items-center">
                <div class="col-md-6">
                    <div class="authincation-content">
                        <div class="row no-gutters">
                            <div class="col-xl-12">
                                <div class="auth-form">
									<div class="text-center mb-3">
										<a href="index.html"><img src="images/logo-full.png" alt=""></a>
									</div>
                                    <h4 class="text-center mb-4 text-white">Log in your account</h4>
                                    <?php echo form_open('login/index'); ?>
                                        <div class="form-group">
                                        <label for="username" class="form-label">Username</label>
                                        <?php echo form_input(['class'=>'form-control','placeholder'=>'Enter Username','name'=>'username','value'=>set_value('username')]);?>
                                        </div>
                                        <div class="form-group">
                                        <?php  echo form_error('username');?>
                                        </div>
                                        <div class="form-group">
                                        <label for="password" class="form-label">Password</label>
                                        <input type="password" class="form-control" name="password" placeholder="Enter Password" id="exampleInputPassword1">
                                        </div>
                                        <div class="form-group">
                                        <?php  echo form_error('password',"<div class='text-danger'>","</div>");?>
                                        </div>
                                        <div class="text-center" style="margin-top:40px">
                                        <button type="submit" class="btn bg-white text-primary btn-block">Submit</button>
                                        </div>
                                   
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php include('footer.php') ?> 