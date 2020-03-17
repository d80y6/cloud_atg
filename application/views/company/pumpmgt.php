<?php    $this->load->view('company/head') ; ?>






<div class="page-header">
              <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white mr-2">
                  <i class="mdi mdi-gas-station"></i>
                </span> Pump Management </h3>
              <nav aria-label="breadcrumb">
                <ul class="breadcrumb">
                  <li class="breadcrumb-item active" aria-current="page">
                    <span></span><i id="nodeName" class="text-default"></i> &nbsp; <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                  </li>
                </ul>
              </nav>
			</div>




<div class="right_col" role="main">
<!-- dummy test page yo -->



  <!-- <div class="col-md-12 col-sm-12 col-xs-12"> -->
<!-- abdcd============================================ -->

								<div class="row">
									<div class="col-lg-7 col-md-7 col-sm-12 col-xs-12" style="">
										<!-- <input placeholder="Choose Date" class="pumpRange pull-right"  > -->
									</div>
									<!-- <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12" style="margin-bottom:10px">
									</div> -->
									<div class="col-lg-5 col-md-5 col-sm-12 col-xs-12" style="margin-bottom:10px">
										<input placeholder="Choose Date" class="pumpRangeLand pull-right" style="width: 45%;"  >
										<select id="stations" class="pull-right" style="width: 45%;margin-right:10px" >
											<option>Choose Station</option>
											
										</select>
									</div>
									
									
					<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 grid-margin stretch-card">

						<!-- <div class="col-md-12 grid-margin stretch-card "> -->
							<div class="card ">
								<div class="card-body">

						<div class="tile-stats" style="min-height:145px">
						<div class="icon"><i class="text-info fas fa-gas-pump"></i>
						</div>
						<h3 id="ptvps">00</h3>

						<div class="count" >Total PMS Volume <br>Dispensed </div>
						<hr>
						<small class="vdrange"> --- </small>
						</div>

								</div>
							</div>
						<!-- </div> -->

					</div>


					<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 grid-margin stretch-card">

						<!-- <div class="col-md-12 grid-margin stretch-card "> -->
							<div class="card ">
								<div class="card-body">

						<div class="tile-stats" style="min-height:145px">
						<div class="icon"><i class="text-warning fas fa-gas-pump"></i>
						</div>
						<h3  id="atvps">00</h3>

						<div class="count" >Total AGO Volume <br>Dispensed </div>
						<hr>
						<small class="vdrange"> --- </small>
						</div>

								</div>
							</div>
						<!-- </div> -->

					</div>



					<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 grid-margin stretch-card">

						<!-- <div class="col-md-12 grid-margin stretch-card "> -->
							<div class="card ">
								<div class="card-body">

						<div class="tile-stats" style="min-height:145px">
						<div class="icon"><i class="text-danger fas fa-gas-pump"></i>
						</div>
						<h3 id="dtvps">00</h3>

						<div class="count">Total DPK Volume <br>Dispensed </div>
						<hr>
						<small class="vdrange"> --- </small>
						</div>

								</div>
							</div>
						<!-- </div> -->

					</div>
									
								</div>

<!-- ===========================new=========================== -->

<div class="row">
	<div class="col-md-12 grid-margin stretch-card">
		<div class="card">
			<div class="card-body">
				<div class="clearfix">
					<h4 class="card-title float-left">Pumps <hr> </h4>
					
					<h4 class="card-title float-right" id="addnew"><p class="float-right"><a style="padding:5px; " class="text-primary" href="#" onclick="addNew()"><i class="fa fa-plus-circle"></i> Add New Pump</a></p>
					<p class="float-right"><a style="padding:5px;" class="text-warning" href="#" onclick="loadPumptable()"><i class="fa fa-refresh"></i> Refresh</a></p></h4>
					<div id="visit-sale-chart-legend" class="rounded-legend legend-horizontal legend-top-right float-right"></div>
				</div>
			
<div style="overflow-x:auto;">

		<table id="tblpumps" class="table table-hover responsive">
			<thead> 
					<tr>
					<th>Pump Name </th>
					<th>Product</th>
					<th>Manufacturer</th>
					<th>Model</th>
					<th>Station</th>

					<th>Timestamp</th>

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




<!-- ===========================curr Modal============================ -->
<div class="modal" id="myCurrModal">
  <div class="modal-dialog modal-lg" id="modDial">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <b style="font-size:150%" class="modal-title" id="pumpTitle"></b>
        <a type="button" class="close" data-dismiss="modal" onclick="$('#myCurrModal').modal('hide')">&times;</a>
      </div>

      <!--  Edit Modal body -->		
			<div class="modal-body">
				
				<div class="card-body">
								<div class="row">
									<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12" style="">
										<!-- <input placeholder="Choose Date" class="pumpRange pull-right"  > -->
									</div>
									<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12" style="margin-bottom:10px">
										<input placeholder="Choose Date" class="pumpRange pull-right"  >
									</div>
									<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
										<div class="tile-stats" style="min-height:145px">
										<div class="icon"><i class="fas fa-gas-pump"></i>
										</div>
										<div class="count" id="tvps">00</div>

										<h3>Total Volume <br>Dispensed </h3>
										<p>*1000 Litres</p>
										</div>
									</div>
									<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
										<div class="tile-stats" style="min-height:145px">
										<div class="icon"><i class="fas fa-list-ol"></i>
										</div>
										<div class="count" id="tnot">00</div>

										<h3>Total Number of Transactions </h3>
										<p>*100</p>
										</div>
									</div>
									<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
										<div class="tile-stats" style="min-height:145px">
										<div class="icon"><i class="fas fa-gas-pump"></i>
										</div>
										<div class="count" id="alpt">00</div>

										<h3>Average Volume Dispensed </h3>
										<p>*1000 Litres</p>
										</div>
									</div>
								</div>


								<div class="" role="tabpanel" data-example-id="togglable-tabs">
									<ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
										<li role="presentation" id="t1" style="margin:10px" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Recent Pump Data</a>
										</li>
										<li role="presentation" id="t2" style="margin:10px" class=""><a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Historic Trends</a>
										</li>
										<!--<li role="presentation" id="t3" class=""><a href="#tab_content3" role="tab" id="profile-tab2" data-toggle="tab" aria-expanded="false">Notification/Alerts</a>
										</li>-->
									</ul>
									<div id="myTabContent" class="tab-content">
										<div role="tabpanel" class="tab-pane fade active in row" id="tab_content1" aria-labelledby="home-tab">
										<!-- ================================================================ -->

											<div class="col-md-12 col-sm-12 col-xs-12">

												<table class="table table-striped" id='plogTab'>

												<thead id="plogsh" class="">
												</thead>

												<tbody id="plogs" class="cplogs">
												<!-- <tr>
												<td>soup</td>
												</tr> -->
												</tbody>
												
												</table>
											</div>




										<!-- ================================================================ -->
										</div>

										<div role="tabpanel" class="tab-pane fade row" id="tab_content2" aria-labelledby="profile-tab">
											<div class="col-md-12 col-sm-12 col-xs-12">
												<canvas id="canvas"></canvas>
											</div>
											
										</div>

										<!-- <div role="tabpanel" class="tab-pane fade" id="tab_content3" aria-labelledby="profile-tab">
											<div  >
											<ul class="list-unstyled msg_list" id="tankNotify">
											</ul>
											</div>
										</div> -->
									</div>
								</div>
			
			
				</div>




			</div>
      <!--  Edit Modal body -->

    

    </div>
  </div>
</div>
<!-- ======================================================= -->

<!-- ===========================Edit Modal============================ -->
<div class="modal" id="myModal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <b style="font-size:150%"  class="modal-title">View/Edit Pump</br>
        <button type="button" class="close" data-dismiss="modal" onclick="$('#myModal').modal('hide')">&times;</button>
      </div>

      <!--  Edit Modal body -->		
			<div class="modal-body">
				
				<div class="card-body">
                <form method="POST">
							
				<div class="row">
						<div class="form-group col-md-4 col-sm-4 col-xs-12">
											<!-- <label for="cname">Company Name</label> -->
											<!-- <input id="cname" type="text" placeholder="Company Name" class="form-control" name="cname"> -->
							<select id='stations' class="form-control">
							</select>
												
						</div>

					

						<div class="form-group col-md-4 col-sm-4 col-xs-12">
							<!-- <label for="cpnum">Phone Number</label> -->
							<input id="pname" type="text" placeholder="Pump Name" class="form-control" name="pname">

							
						</div>

						<div class="form-group col-md-4 col-sm-4 col-xs-12">
							<!-- <label for="cpnum">Phone Number</label> -->
							<input id="palias" type="text" placeholder="Pump Alias" class="form-control" name="palias">

							
						</div>



					</div>


              <div class="clearfix"></div>


                 <div class="row">
						<div class="form-group col-md-4 col-sm-4 col-xs-12">
								<!-- <label for="cpnum">Phone Number</label> -->
							<select id='prod' class="form-control">
							<option value="">Choose Product</option>
							<option value="PMS">PMS</option>
							<option value="AGO">AGO</option>
							<option value="DPK">DPK</option>
                        	</select>
								
							</div>
						<div class="form-group col-md-4 col-sm-4 col-xs-12">
							<!-- <label for="cpnum">Phone Number</label> -->
							<input id="pman" type="text" placeholder="Pump Manufacturer" class="form-control" name="pman">

							
						</div>
						<div class="form-group col-md-4 col-sm-4 col-xs-12">
							<!-- <label for="cpnum">Phone Number</label> -->
							<input id="pmod" type="text" placeholder="Pump Model" class="form-control" name="pmod">

							
						</div>

										
					</div>




								 


              <div class="clearfix"></div>



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
			<b style="font-size:150%"  class="modal-title">Add A Pump</b>
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
							<select id='astations' class="form-control">
							</select>
												
						</div>

					

						<div class="form-group col-md-4 col-sm-4 col-xs-12">
							<!-- <label for="cpnum">Phone Number</label> -->
							<input id="apname" type="text" placeholder="Pump Name" class="form-control" name="apname">

							
						</div>

						<div class="form-group col-md-4 col-sm-4 col-xs-12">
							<!-- <label for="cpnum">Phone Number</label> -->
							<input id="apalias" type="text" placeholder="Pump Alias" class="form-control" name="apalias">

							
						</div>



					</div>


              <div class="clearfix"></div>


                 <div class="row">
						<div class="form-group col-md-4 col-sm-4 col-xs-12">
								<!-- <label for="cpnum">Phone Number</label> -->
							<select id='aprod' class="form-control">
							<option value="">Choose Product</option>
							<option value="PMS">PMS</option>
							<option value="AGO">AGO</option>
							<option value="DPK">DPK</option>
                        	</select>
								
							</div>
						<div class="form-group col-md-4 col-sm-4 col-xs-12">
							<!-- <label for="cpnum">Phone Number</label> -->
							<input id="apman" type="text" placeholder="Pump Manufacturer" class="form-control" name="apman">

							
						</div>
						<div class="form-group col-md-4 col-sm-4 col-xs-12">
							<!-- <label for="cpnum">Phone Number</label> -->
							<input id="apmod" type="text" placeholder="Pump Model" class="form-control" name="apmod">

							
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


<?php    $this->load->view('company/foot') ; ?>
<?php    $this->load->view('company/scriptPumpmgt') ; ?>
