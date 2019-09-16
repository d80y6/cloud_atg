<?php    $this->load->view('general/header') ; ?>




<div class="right_col" role="main">
<!-- dummy test page yo -->



    <div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">
			<div class="x_title">
			<h2><i class="fa fa-bars"></i> Settings <small>Global Configuration</small></h2>
			<ul class="nav navbar-right panel_toolbox">
				<!-- <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
				</li>
				<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
				<ul class="dropdown-menu" role="menu">
					<li><a href="#">Settings 1</a>
					</li>
					<li><a href="#">Settings 2</a>
					</li>
				</ul>
				</li> -->
				<!-- <li><a class="close-link"><i class="fa fa-close"></i></a> -->
				<!-- </li> -->
			</ul>
			<div class="clearfix"></div>
			</div>
			<div class="x_content">


			<div class="" role="tabpanel" data-example-id="togglable-tabs">
				<ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
				<li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true"><b>Keep Alive Time</b></a>
				</li>
				<li role="presentation" class=""><a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false"><b>Pasword Change Duration</b></a>
				</li>
				<!-- <li role="presentation" class=""><a href="#tab_content3" role="tab" id="profile-tab2" data-toggle="tab" aria-expanded="false">Profile</a> -->
				</li>
				</ul>
				<div id="myTabContent" class="tab-content">
				
				
				<div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
					<div class="row">
						
						
						<div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12" style="border-right:2px solid grey;">
							<div class="tile-stats">
								<div class="icon"><i class="fa fa-clock-o"></i>
								</div>
							<div class="count" id="count">00</div>

								<h3>Current Value</h3>
								<p>Time in Hours to Flag Controller Inactive.</p>
							</div>
						</div>

							
						<!-- <div class="form-group col-lg-1 col-md-1 col-sm-1 col-xs-12" style="border-left:2px solid grey; height:inherit">

						</div> -->
						<?php if($this->session->userdata('acctType') != "regUser"){?>

						<div id="setkat" class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12" >
							<input id="kat" placeholder="Keep Alive Time in Hours" type="number" class="form-control" name="kat">
							<div class="clearfix" style="margin-top:20px"></div>

							<a id="btnAdd" onclick="saveKat()" type="submit" class="btn btn-primary btn-block">
								Save 												
							</a>									
							
						</div>
						<?php  } ?>
						
					
					</div>
				</div>




				<div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">
					<div class="row">
						
						
						<div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12" style="border-right:2px solid grey;">
							<div class="tile-stats">
								<div class="icon"><i class="fa fa-clock-o"></i>
								</div>
							<div class="count" id="pcdcount">00</div>

								<h3>Current Value</h3>
								<p>Duration in Days Before Forcing Password Change.</p>
							</div>
						</div>

							
						<!-- <div class="form-group col-lg-1 col-md-1 col-sm-1 col-xs-12" style="border-left:2px solid grey; height:inherit">

						</div> -->
						<?php if($this->session->userdata('acctType') != "regUser"){?>

						<div id="setpcd" class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12" >
							<input id="pcd" placeholder="Password Change Duration in Days" type="number" class="form-control" name="pcd">
							<div class="clearfix" style="margin-top:20px"></div>

							<a id="btnAdd" onclick="savePcd()" type="submit" class="btn btn-primary btn-block">
								Save 												
							</a>									
							
						</div>
						<?php  } ?>

						
					
					</div>
				</div>
				<!-- <div role="tabpanel" class="tab-pane fade" id="tab_content3" aria-labelledby="profile-tab">
					<p>xxFood truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid. Exercitation +1 labore velit, blog sartorial PBR leggings next level wes anderson artisan four loko farm-to-table craft beer twee. Qui photo
					booth letterpress, commodo enim craft beer mlkshk </p>
				</div> -->
				</div>
			</div>

			</div>
		</div>
	</div>
					


</div>


<?php    $this->load->view('general/footer') ; ?>
<?php    $this->load->view('general/scriptSettingsmgt') ; ?>

