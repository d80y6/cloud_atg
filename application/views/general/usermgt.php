<?php    $this->load->view('general/head') ; ?>




<div class="page-header">
              <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white mr-2">
                  <i class="mdi mdi-account"></i>
                </span> User Management </h3>
              <nav aria-label="breadcrumb">
                <ul class="breadcrumb">
                  <li class="breadcrumb-item active" aria-current="page">
                    <span></span>Overview <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                  </li>
                </ul>
              </nav>
			</div>



<div class="right_col" role="main">
<!-- dummy test page yo -->



<div class="row">
	<div class="col-md-12 grid-margin stretch-card">
		<div class="card">
			<div class="card-body">
				<div class="clearfix">
					<h4 class="card-title float-left">Users <hr> </h4>
					
					<h4 class="card-title float-right" id="addnew"><p class="float-right"><a style="padding:5px; " class="text-primary" href="#" onclick="addNew()"><i class="fa fa-plus-circle"></i> Add New User</a></p>
					<p class="float-right"><a style="padding:5px;" class="text-warning" href="#" onclick="loadUsertable()"><i class="fa fa-refresh"></i> Refresh</a></p></h4>
					<div id="visit-sale-chart-legend" class="rounded-legend legend-horizontal legend-top-right float-right"></div>
				</div>
			
<div style="overflow-x:auto;">

		<table id="tblusers" class="table table-hover responsive">
			<thead> 
					<tr>
					<th>Name <small></small></th>
					<th>Email</th>
					<th>Type</th>
					<th>Status</th>

					<th class="text-center">Actions</th>
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




  <!-- <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Users <small>Manage Users Here</small></h2>
                    <ul class="nav navbar-right  pull-right">
					<li class="pull-right" id="addnew"><a style="padding:5px; " class="text-primary" href="#" onclick="addNew()"><i class="fa fa-plus-circle"></i> Add New User</a></li>
						<li class="pull-right "><a style="padding:5px;" class="text-warning" href="#" onclick="loadUsertable()"><i class="fa fa-refresh"></i> Refresh</a></li>
										
                     
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <table id="tblusers" class="table table-hover">
						<thead> 
								<tr>
								<th>Name <small></small></th>
								<th>Email</th>
								<th>Type</th>
								<th>Status</th>

								<th class="text-center">Actions</th>
								</tr>
								
						</thead>
                      <tbody>
                     
                      </tbody>
                    </table>

                  </div>
                </div>
              </div>

              <div class="clearfix"></div>


</div> -->




<!-- ===========================Edit Modal============================ -->
<div class="modal" id="myModal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
			<b style="font-size:150%"  class="modal-title">View/Edit User</b>
        <button type="button" class="close" data-dismiss="modal" onclick="$('#myModal').modal('hide')">&times;</button>
      </div>

      <!--  Edit Modal body -->		
			<div class="modal-body">
				
				<div class="card-body">
                <form method="POST">
							
								<div class="row">
						<div class="form-group col-md-4 col-sm-4 col-xs-12">
								<select id='userType' class="form-control">
								<option value="">Choose Type</option>
								<option value="admin">Super Admin</option>
								<option value="companyAdmin">Company Admin</option>
								<option value="stationAdmin">Station Admin</option>
								<option value="regUser">Regular Super User</option>
								<option value="regCoyUser">Regular Company User</option>
								<option value="regStatUser">Regular Station User</option>
								</select>
											
							</div>

					

						<div class="form-group col-md-4 col-sm-4 col-xs-12">
							<!-- <label for="cpnum">Phone Number</label> -->
							<input id="fname" type="text" placeholder="First Name" class="form-control" name="fname">

							
						</div>

						<div class="form-group col-md-4 col-sm-4 col-xs-12">
								<!-- <label for="cpnum">Phone Number</label> -->
								<input id="lname" type="text" placeholder="Last Name" class="form-control" name="lname">

								
							</div>
							<!-- <div class="form-group col-md-4 col-sm-4 col-xs-12">
											<input id="uemail" placeholder="Email Address" type="email" class="form-control" name="uemail">
										
											
										</div> -->

					</div>



					<div class="clearfix" style="margin-top:20px"></div>


						<div class="row">
							<div class="form-group col-md-4 col-sm-4 col-xs-12">
											<!-- <label for="remail">Reorder Email</label> -->
											<input id="uemail" placeholder="Email Address" type="email" class="form-control" name="uemail">
										
											
										</div>

							<div class="form-group col-md-4 col-sm-4 col-xs-12">
								<!-- <label for="remail">Reorder Email</label> -->
								<input id="pword" placeholder="Password" type="password" class="form-control" name="pword">
							
								
							</div>
							<div class="form-group col-md-4 col-sm-4 col-xs-12">
								<!-- <label for="temail">Threshold Email</label> -->
								<input id="cpword" placeholder="Confirm Password" type="password" class="form-control" name="cpword">
							
								
							</div>

						</div>

					<div class="clearfix" style="margin-top:20px"></div>

						<div class="row">
							

							<div id="coysDiv" class="form-group col-md-6 col-sm-6 col-xs-12">
								<select id='coys' class="form-control">
															
								</select>							
								
							</div>
							<div class="form-group col-md-6 col-sm-6 col-xs-12">
								<select id='stations' class="form-control">
							
								</select>
								
							</div>

						</div>




            
									<div class="row">
										
									
									
										<div class="form-group col-md-12 col-sm-12 col-xs-12">
											<!-- <label for="nuemail">New User Email</label> -->
											<input id="keyhidden" placeholder="keyhidden" type="hidden" class="form-control" name="keyhidden">
										
											
										</div>
										
									
									</div>


						             

									 <div class="ln_solid"></div>

                 

									<div class="row">
										
										<div class="form-group col-md-4 col-sm-4 col-xs-12">
										</div>
									
										<div class="form-group col-md-4 col-sm-4 col-xs-12">
											<a id="btnAdd" onclick="editBtnClick()" type="submit" class="btn btn-primary btn-block">
											<!-- <a id="btn" type="submit" class="btn btn-primary btn-block"> -->
											Save Changes												
											</a>
										</div>

										<div class="form-group col-md-4 col-sm-4 col-xs-12">
										</div>

                  </div>
                </form>
              </div>




			</div>
      <!--  Edit Modal body -->

    

    </div>
  </div>
</div>
<!-- ======================================================= -->

<!-- ===========================Add Modal============================ -->
<div class="modal" id="myAddModal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
			<b style="font-size:150%"  class="modal-title">Add A User</b>
        <button type="button" class="close" data-dismiss="modal" onclick="$('#myAddModal').modal('hide')">&times;</button>
      </div>

      <!--  Add Modal body -->		
			<div class="modal-body">
				
				<div class="card-body">
                <form method="POST">
							
								<div class="row">
						<div class="form-group col-md-4 col-sm-4 col-xs-12">
											<!-- <label for="cname">Company Name</label> -->
											<!-- <input id="cname" type="text" placeholder="Company Name" class="form-control" name="cname"> -->
						<select id='auserType' class="form-control">
						<option value="">Choose Type</option>
						<option value="admin">Super Admin</option>
						<option value="companyAdmin">Company Admin</option>
						<option value="stationAdmin">Station Admin</option>
						<option value="regUser">Regular Super User</option>
						<option value="regCoyUser">Regular Company User</option>
						<option value="regStatUser">Regular Station User</option>
            </select>
											
										</div>

					

						<div class="form-group col-md-4 col-sm-4 col-xs-12">
							<!-- <label for="cpnum">Phone Number</label> -->
							<input id="afname" type="text" placeholder="First Name" class="form-control" name="fname">

							
						</div>

						<div class="form-group col-md-4 col-sm-4 col-xs-12">
								<!-- <label for="cpnum">Phone Number</label> -->
								<input id="alname" type="text" placeholder="Last Name" class="form-control" name="lname">

								
							</div>
							<!-- <div class="form-group col-md-4 col-sm-4 col-xs-12">
											<input id="uemail" placeholder="Email Address" type="email" class="form-control" name="uemail">
										
											
										</div> -->

					</div>



					<div class="clearfix" style="margin-top:20px"></div>


						<div class="row">
							<div class="form-group col-md-4 col-sm-4 col-xs-12">
											<!-- <label for="remail">Reorder Email</label> -->
											<input id="auemail" placeholder="Email Address" type="email" class="form-control" name="uemail">
										
											
										</div>

							<div class="form-group col-md-4 col-sm-4 col-xs-12">
								<!-- <label for="remail">Reorder Email</label> -->
								<input id="apword" placeholder="Password" type="password" class="form-control" name="pword">
							
								
							</div>
							<div class="form-group col-md-4 col-sm-4 col-xs-12">
								<!-- <label for="temail">Threshold Email</label> -->
								<input id="acpword" placeholder="Confirm Password" type="password" class="form-control" name="cpword">
							
								
							</div>

						</div>

					<div class="clearfix" style="margin-top:20px"></div>

						<div class="row">
							

							<div id="acoysDiv" class="form-group col-md-6 col-sm-6 col-xs-12">
								<select id='acoys' class="form-control">
															
								</select>							
								
							</div>
							<div class="form-group col-md-6 col-sm-6 col-xs-12">
								<select id='astations' class="form-control">
							
								</select>
								
							</div>

						</div>



						             

									 <div class="ln_solid"></div>

                 

									<div class="row">
										
										<div class="form-group col-md-4 col-sm-4 col-xs-12">
										</div>
									
										<div class="form-group col-md-4 col-sm-4 col-xs-12">
											<a id="btnAdd" onclick="addBtnClick()" type="submit" class="btn btn-primary btn-block">
											<!-- <a id="btn" type="submit" class="btn btn-primary btn-block"> -->
											Submit												
											</a>
										</div>

										<div class="form-group col-md-4 col-sm-4 col-xs-12">
										</div>

                  </div>
                </form>
              </div>




			</div>
      <!--  Add Modal body -->

    

    </div>
  </div>
</div>
<!-- ======================================================= -->


<?php    $this->load->view('general/foot') ; ?>
<?php    $this->load->view('general/scriptUsermgt') ; ?>
