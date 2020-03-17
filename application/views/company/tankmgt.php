<?php    $this->load->view('company/head') ; ?>



<div class="page-header">
              <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white mr-2">
                  <i class="mdi mdi-delete"></i>
                </span> Tank Management </h3>
              <nav aria-label="breadcrumb">
                <ul class="breadcrumb">
                  <li class="breadcrumb-item active" aria-current="page">
                    <span></span><i id="nodeName" class="text-default"></i> &nbsp;  <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
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
					<h4 class="card-title float-left">Tanks <hr> </h4>
					
					<h4 class="card-title float-right" id="addnew"><p class="float-right"><a style="padding:5px; " class="text-primary" href="#" onclick="addNew()"><i class="fa fa-plus-circle"></i> Add New Tank</a></p>
					<p class="float-right"><a style="padding:5px;" class="text-warning" href="#" onclick="loadTanktable()"><i class="fa fa-refresh"></i> Refresh</a></p></h4>
					<div id="visit-sale-chart-legend" class="rounded-legend legend-horizontal legend-top-right float-right"></div>
				</div>
			
<div style="overflow-x:auto;">

	<table id="tbltanks" class="table table-hover responsive">
		<thead> 
				<tr>
				<th>Name <small>(Links to Logs)</small></th>
				<th>Tank Number</th>
				<th>Controller</th>
				<th>Capacity(Litres)</th>
				<th>Height(CM)</th>
				<th>Product</th>
				
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






<!-- ===========================cal Modal============================ -->
<div class="modal" id="myCalModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <b style="font-size:150%" class="modal-title" id="caltankTitle">Upload Tank Calibration</b>
        <a type="button" class="close" data-dismiss="modal" onclick="$('#myCalModal').modal('hide')">&times;</a>
      </div>

      <!--  Edit Modal body -->		
			<div class="modal-body">
				
				<div class="card-body">
								
					<div class="row">
							<div class="form-group col-md-12 col-sm-12 col-xs-12">

								Download Sample Template<a href="<?php echo base_url() ; ?>upload/sample_CalChart.xlsx" download="sample_CalChart.xlsx"> <u>Here</u> </a>			
												
							</div>

					</div>
					
					<div class="row">
						<form  id="importCalibrationForm" method="post">
							

							<div class="form-group col-md-12 col-sm-12 col-xs-12">

								<input type="hidden" id="tankId" name="tankId" >
								<input type="file" id="upload" required class="form-control name fc" name="upload" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" style="opacity:1">


												
							</div>
							
						</form>
							

					</div>
					<div class="ln_solid"></div>


					<div class="row">
										
						<div class="form-group col-md-4 col-sm-4 col-xs-12">
						</div>
					
						<div class="form-group col-md-4 col-sm-4 col-xs-12">
							<a id="btnCalAdd" onclick="calBtnClick()" class="btn btn-primary btn-block">
							<!-- <a id="btn" type="submit" class="btn btn-primary btn-block"> -->
							Upload Chart												
							</a>
						</div>

						<div class="form-group col-md-4 col-sm-4 col-xs-12">
						</div>

                  	</div>
					
					


              	</div>




			</div>
      <!--  Edit Modal body -->

    

    </div>
  </div>
</div>
<!-- ======================================================= -->
<!-- ===========================curr Modal============================ -->
<div class="modal" id="myCurrModal">
  <div class="modal-dialog " id="modDial">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <b style="font-size:150%" class="modal-title" id="tankTitle"></b>
        <a type="button" class="close" data-dismiss="modal" onclick="$('#myCurrModal').modal('hide')">&times;</a>
      </div>

      <!--  Edit Modal body -->		
			<div class="modal-body">
				
				<div class="card-body">
								

								<div class="" role="tabpanel" data-example-id="togglable-tabs">
									<ul id="myTab" class="nav nav-tabs bar_tabs row" role="tablist">
										<li role="presentation" id="t1" class="active col-md-4"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Current Tank Data</a>
										</li>
										<li role="presentation" id="t2" class="col-md-4"><a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Historic Trends</a>
										</li>
										<li role="presentation" id="t3" class="col-md-4"><a href="#tab_content3" role="tab" id="profile-tab2" data-toggle="tab" aria-expanded="false">Notification/Alerts</a>
										</li>
									</ul>
									<div id="myTabContent" class="tab-content">
										<div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
										<!-- ================================================================ -->

										<div class="row">
									<div class="col-md-12 col-sm-12 col-xs-12" id="fillg">
										<center>
										<!-- <svg id="fillgauge5" width="50%" height="200" onclick="gauge5.update(NewValue());"></svg> -->
										<svg id="fillgauge5" width="50%" height="200" ></svg>
										</center>
									</div>
			
								</div>
								
								<div class="row">
									<div class="form-group col-md-12 col-sm-12 col-xs-12" style="border-bottom:1px solid #CCCCCC">
										<strong style="font-size:130%">
										Data
										<span class="badge pull-right" id="statBadge"> </span>
										
										</strong>
									</div>
								</div>
								<!-- <div class="row">
										<div class="form-group col-md-6 col-sm-6 col-xs-12">
			
											<b>Timestamp:</b> <i id="ts"></i>			
															
										</div>
										
										<div class="form-group col-md-6 col-sm-6 col-xs-12">
			
											<b>Waler Level:</b> <i id="wlevel"></i>			
															
										</div>
										
			
								</div>
								
								<div class="row">
										
										<div class="form-group col-md-6 col-sm-6 col-xs-12">
			
											<b>Temperature:</b> <i id="temp"></i>
															
										</div>
			
										<div class="form-group col-md-6 col-sm-6 col-xs-12">
			
											<b>Fuel Volume:</b> <i id="fvol"></i>			
															
										</div>
								</div>
								<div class="row">
			
			
			
										<div class="form-group col-md-6 col-sm-6 col-xs-12">
			
											<b>Fuel Level:</b> <i id="flevel"></i>			
															
										</div>
										
										<div class="form-group col-md-4 col-sm-4 col-xs-12">
			
											<b>Controller:</b> <i id="contr"></i>			
															
										</div>
										
										
			
								</div>
								
								<div class="row">
										
										<div class="form-group col-md-6 col-sm-6 col-xs-12">
			
											<b>Tank Height:</b> <i id="theight"></i>			
															
										</div>
										
										<div class="form-group col-md-6 col-sm-6 col-xs-12">
			
											<b>Product:</b> <i id="pduct"></i>			
			
															
										</div>
			
										
										
			
								</div> -->
									



									<table class="table table-striped table-responsive">
									
									<tbody>
										<tr>
										<td><b>Timestamp:</b> <i id="ts"></i></td>
										<!-- <td><b>Water Level:</b> <i id="wlevel"></i></td> -->
										<td><b>Temperature:</b> <i id="temp"></i></td>
										</tr>
										<tr>
										<td><b>Fuel Volume:</b> <i id="fvol"></i></td>
										<td><b>Fuel Level:</b> <i id="flevel"></i></td>
										</tr>
										<tr>
										<td><b>Controller:</b> <i id="contr"></i></td>
										<!-- <td><b>Tank Height:</b> <i id="theight"></i></td> -->
										<td><b>Product:</b> <i id="pduct"></i></td>
										</tr>
										<tr>
										</tr>
									</tbody>
									</table>

										<!-- ================================================================ -->
										</div>

							
										<div role="tabpanel" class="tab-pane fade " id="tab_content2" aria-labelledby="profile-tab">
											<div class="row">
												<div class="col-md-8 col-sm-8 col-xs-12">
													<canvas id="canvas"></canvas>
												</div>
												<div style="border-left:2px solid #fafafa; padding-top:30px" class="col-md-4  col-sm-4 col-xs-12">

													<div class="animated flipInY col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-bottom:10px">
														<input placeholder="Choose Date" class="" id="tankRange"  >
													</div>
													
													<div style="border-bottom:2px solid #fafafa" class="animated flipInY col-lg-12 col-md-12 col-sm-12 col-xs-12">
														<div class="tile-stats">
														<div class="icon"><i class="far fa-comments fa-3x"></i>
														</div>
														<div class="count" >Daily Usage</div>
														<h3 id="dailyUsage">00 </h3>

														<p>*1000 Litres</p>
														</div>
													</div>
													
													<div style="margin-top:10px" class="animated flipInY col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
														<div class="tile-stats">
														<div class="icon"><i class="far fa-comments fa-3x"></i>
														</div>
														<div class="count" >Next Reorder</div>
														<h3 id="nxtReord">00/00</h3>

														<p>(DD/MM)</p>
														</div>
													</div>

												</div>
											</div>
										</div>

										<div role="tabpanel" class="tab-pane fade" id="tab_content3" aria-labelledby="profile-tab">
											<div  >
											<div  id="tankNotify">
											</div>
											</div>
										</div>
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
        <b style="font-size:150%"  class="modal-title">View/Edit Tank</b>
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
						<select id='conts' class="form-control">
                        </select>
											
										</div>

					

						<div class="form-group col-md-4 col-sm-4 col-xs-12">
							<!-- <label for="cpnum">Phone Number</label> -->
							<input id="tname" type="text" placeholder="Tank Name" class="form-control" name="tname">

							
						</div>

						<div class="form-group col-md-4 col-sm-4 col-xs-12">
								<!-- <label for="cpnum">Phone Number</label> -->
								<input id="tnum" type="number" placeholder="Tank Number" class="form-control" name="tnum">

								
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
								<input id="vol" type="number" placeholder="Capacity/Volume(Litres)" class="form-control" name="vol">

								
							</div>
						<div class="form-group col-md-4 col-sm-4 col-xs-12">
								<!-- <label for="cpnum">Phone Number</label> -->
								<input id="height" type="number" placeholder="Height(CM)" class="form-control" name="height">

								
							</div>
										
					</div>


              <div class="clearfix"></div>


								  <div class="row">
										
									
										<div class="form-group col-md-6 col-sm-6 col-xs-12">
											<!-- <label for="aeemail">Alarm End Email</label> -->
											<input id="thresh" type="number" placeholder="Threshold(CM)" class="form-control" name="thresh">
										
											
										</div>
										<div class="form-group col-md-6 col-sm-6 col-xs-12">
											<!-- <label for="uemail">Unloading Email</label> -->
											<input id="rlevel" placeholder="Reorder Level(CM)" type="number" class="form-control" name="rlevel">
										
											
										</div>
									
									</div>


              <div class="clearfix"></div>


									 <div class="ln_solid"></div>


								  <div class="row">
								  <div class="form-group col-md-12 col-sm-12 col-xs-12">
								  <h2>Maintenence</h2>
								  </div>
								  </div>



								  <div class="row">
										
									
										<div class="form-group col-md-5 col-sm-5 col-xs-5">
											<!-- <label for="remail">Reorder Email</label> -->
											<input id="maint" placeholder="Maintenance Type" type="text" class="form-control" name="maint">
										
											
										</div>
										<div class="form-group col-md-5 col-sm-5 col-xs-5">
											<!-- <label for="temail">Threshold Email</label> -->
											<input id="ndate" placeholder="Next Due Date" type="text" class="tankDates form-control" name="ndate">
										
											
										</div>
										<div class="form-group col-md-2 col-sm-2 col-xs-2">
											<!-- <label for="temail">Threshold Email</label> -->
											<!-- <input id="atemail" placeholder="Threshold Email" type="email" class="form-control" name="atemail"> -->
										<a onclick="addMaint()" class="btn btn-secondary "> <i style="font-size:200%" class="fa fa-plus-square"></i></a>
											
										</div>
									
									</div>

            
								  <div class="row">
									<div class="form-group col-md-12 col-sm-12 col-xs-12" >
										<!-- <h2>Maintenence</h2> -->

										<ul id='maints'>
										
										</ul>
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
			<b style="font-size:150%"  class="modal-title">Add A Tank</b>
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
						<select id='aconts' class="form-control">
                        </select>
											
										</div>

					

						<div class="form-group col-md-4 col-sm-4 col-xs-12">
							<!-- <label for="cpnum">Phone Number</label> -->
							<input id="atname" type="text" placeholder="Tank Name*" class="form-control" name="atname">

							
						</div>

						<div class="form-group col-md-4 col-sm-4 col-xs-12">
								<!-- <label for="cpnum">Phone Number</label> -->
								<input id="atnum" type="number" placeholder="Tank Number*" class="form-control" name="atnum">

								
							</div>

					</div>


              <div class="clearfix"></div>


                 <div class="row">
						<div class="form-group col-md-4 col-sm-4 col-xs-12">
								<!-- <label for="cpnum">Phone Number</label> -->
							<select id='aprod' class="form-control">
							<option value="">Choose Product*</option>
							<option value="PMS">PMS</option>
							<option value="AGO">AGO</option>
							<option value="DPK">DPK</option>
                        	</select>
								
							</div>
						<div class="form-group col-md-4 col-sm-4 col-xs-12">
								<!-- <label for="cpnum">Phone Number</label> -->
								<input id="avol" type="number" placeholder="Capacity/Volume(Litres)*" class="form-control" name="avol">

								
							</div>
						<div class="form-group col-md-4 col-sm-4 col-xs-12">
								<!-- <label for="cpnum">Phone Number</label> -->
								<input id="aheight" type="number" placeholder="Height(CM)*" class="form-control" name="aheight">

								
							</div>
										
					</div>


              <div class="clearfix"></div>


								  <div class="row">
										
									
										<div class="form-group col-md-6 col-sm-6 col-xs-12">
											<!-- <label for="aeemail">Alarm End Email</label> -->
											<input id="athresh" type="number" placeholder="Threshold(CM)*" class="form-control" name="athresh">
										
											
										</div>
										<div class="form-group col-md-6 col-sm-6 col-xs-12">
											<!-- <label for="uemail">Unloading Email</label> -->
											<input id="arlevel" placeholder="Reorder Level(CM)*" type="number" class="form-control" name="arlevel">
										
											
										</div>
									
									</div>


              <div class="clearfix"></div>


									 <div class="ln_solid"></div>


								  <div class="row">
								  <div class="form-group col-md-12 col-sm-12 col-xs-12">
								  <h2>Maintenence</h2>
								  </div>
								  </div>



								  <div class="row">
										
									
										<div class="form-group col-md-5 col-sm-5 col-xs-5">
											<!-- <label for="remail">Reorder Email</label> -->
											<input id="amaint" placeholder="Maintenance Type" type="text" class="form-control" name="amaint">
										
											
										</div>
										<div class="form-group col-md-5 col-sm-5 col-xs-5">
											<!-- <label for="temail">Threshold Email</label> -->
											<input id="andate" placeholder="Next Due Date" type="text" class="tankDates form-control" name="andate">
										
											
										</div>
										<div class="form-group col-md-2 col-sm-2 col-xs-2">
											<!-- <label for="temail">Threshold Email</label> -->
											<!-- <input id="atemail" placeholder="Threshold Email" type="email" class="form-control" name="atemail"> -->
										<a onclick="aaddMaint()" class="btn btn-secondary "> <i style="font-size:200%" class="fa fa-plus-square"></i></a>
											
										</div>
									
									</div>

            
								  <div class="row">
									<div class="form-group col-md-12 col-sm-12 col-xs-12" >
										<!-- <h2>Maintenence</h2> -->

										<ul id='amaints'>
										
										</ul>
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
<?php    $this->load->view('company/scriptTankmgt') ; ?>
