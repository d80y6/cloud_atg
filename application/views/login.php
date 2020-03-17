<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<title>ATG | V2</title>

		<!-- plugins:css -->
    <link rel="stylesheet" href="<?php echo base_url() ; ?>asset/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="<?php echo base_url() ; ?>asset/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="<?php echo base_url() ; ?>asset/css/style.css">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="<?php echo base_url() ; ?>asset/images/favicon.png" />
  </head>
  <body>
    <div class="container-scroller">
      <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-center auth">
          <div class="row flex-grow">
            <div class="col-lg-4 mx-auto">
              <div class="auth-form-light text-left p-5">
                <div class="brand-logo">
						<center>	<h1>	<i class="mdi mdi-bulldozer text-primary"></i> <font class="text-primary">ATG</font> </a></h1></center>
						<hr>

								</div>
                <h4>Hello! Sign in to Begin.</h4>
                <!-- <h6 class="font-weight-light">Sign in to Begin.</h6> -->
                <!-- <form class="pt-3"> -->

								<?php 
									// if ($id == null){ 
									echo form_open('login_submit'); 
								// } 
									
									?>

									<?php if(isset($validationError)){ ?>
									<div class="alert alert-danger">
										<?php echo $validationError?>
									</div>
									<?php } ?>
										<?php if(isset($error)){ ?>
									<div class="alert alert-danger">
										<?php echo $error?>
									</div>
									<?php } ?>


								<div class="form-group">
                    <input type="text" name="userId" id="userId" style="border-radius:4px" class="form-control form-control-lg"  placeholder="Email">
                  </div>
                  <div class="form-group">
                    <input type="password" name="password" id="password" style="border-radius:4px" class="form-control form-control-lg"  placeholder="Password">
                  </div>
                  <div class="mt-3">
                    <button type="submit" class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn" href="">SIGN IN</button>
                  </div>
                  <div class="my-2 d-flex justify-content-between align-items-center">
                    <div class="form-check">
                      <label class="form-check-label text-muted">
                        <!-- <input type="checkbox" class="form-check-input"> Keep me signed in </label> -->
                    </div>
                    <!-- <a href="#" class="auth-link text-black">Forgot password?</a> -->
                  </div>
                  <!-- <div class="mb-2">
                    <button type="button" class="btn btn-block btn-facebook auth-form-btn">
                      <i class="mdi mdi-facebook mr-2"></i>Connect using facebook </button>
                  </div> -->
                  <div class="text-center mt-4 font-weight-light"> Don't have an account? <a href="<?php echo base_url() ; ?>#join" class="text-primary">Create</a>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="<?php echo base_url() ; ?>asset/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="<?php echo base_url() ; ?>asset/js/off-canvas.js"></script>
    <script src="<?php echo base_url() ; ?>asset/js/hoverable-collapse.js"></script>
    <script src="<?php echo base_url() ; ?>asset/js/misc.js"></script>
    <!-- endinject -->
  </body>
</html>
