<?php    $this->load->view('station/header') ; ?>




<div class="right_col" role="main">
<!-- dummy test page yo -->


  <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Tanks <small>Manage Tanks Here</small></h2>
                    <ul class="nav navbar-right  pull-right">
						<li class="pull-right" id="addnew"><a style="padding:5px; " class="text-primary" href="#" onclick="addNew()"><i class="fa fa-plus-circle"></i> Add New Tank</a></li>
						<li class="pull-right "><a style="padding:5px;" class="text-warning" href="#" onclick="loadTanktable()"><i class="fa fa-refresh"></i> Refresh</a></li>
										 <!-- <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li> -->
                      <!-- <li class="pull-right"><a class="collapse-link"><i class="fa fa-chevron-up"></i></a> -->
                      <!-- <li><i class="fa fa-chevron-up"></i>
					</li> -->
                      <!-- <li class="dropdown pull-right">
						  <li id="addnew"><a href="#" onclick="addNew()"><i class="fa fa-plus-circle"></i> Add New Tank</a>
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                        <ul class="dropdown-menu" role="menu">
                          </li>
                          <li><a href="#" onclick="loadTanktable()"><i class="fa fa-refresh"></i> Refresh</a>
                          </li>
                        </ul>
                      </li> -->
                     
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
<div>
				  <!-- <canvas id="canvasTest"></canvas> -->
				  <script>
		// 		  var MONTHS = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
		// var config = {
		// 	type: 'line',
		// 	data: {
		// 		labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
		// 		datasets: [{
		// 			label: 'My First dataset',
		// 			backgroundColor: "rgb(255, 99, 132)",
		// 			borderColor: "rgb(255, 99, 132)",
		// 			data: [
		// 				4,
		// 				5,
		// 				32,
		// 				43,
		// 				12,
		// 				3,
		// 				8
		// 			],
		// 			fill: false,
		// 		}, {
		// 			label: 'My Second dataset',
		// 			fill: false,
		// 			backgroundColor: "rgb(25, 199, 12)",
		// 			borderColor: "rgb(25, 199, 12)",
		// 			data: [
		// 				5,
		// 				15,
		// 				20,
		// 				40,
		// 				2,
		// 				5,
		// 				80
		// 			],
		// 		}]
		// 	},
		// 	options: {
		// 		legend:{
		// 			display:true,
		// 			// labels: {
		// 			// 	fontColor: 'rgb(255, 99, 132)'
		// 			// }
		// 		},
		// 		responsive: true,
		// 		title: {
		// 			display: true,
		// 			text: 'Chart.js Line Chart'
		// 		},
		// 		tooltips: {
		// 			mode: 'index',
		// 			intersect: false,
		// 		},
		// 		hover: {
		// 			mode: 'nearest',
		// 			intersect: true
		// 		},
		// 		scales: {
		// 			xAxes: [{
		// 				display: true,
		// 				scaleLabel: {
		// 					display: true,
		// 					labelString: 'Month'
		// 				}
		// 			}],
		// 			yAxes: [{
		// 				display: true,
		// 				scaleLabel: {
		// 					display: true,
		// 					labelString: 'Value'
		// 				}
		// 			}]
		// 		}
		// 	}
		// };

		// window.onload = function() {
		// 	var ctx = document.getElementById('canvasTest').getContext('2d');
		// 	window.myLine = new Chart(ctx, config);
		// };


		</script>
</div>

                    <table id="tbltanks" class="table table-hover">
						<thead> 
								<tr>
								<th>Name <small>(Links to Logs)</small></th>
								<!-- <th>Email</th> -->
								<th>Tank Number</th>
								<!-- <th>Controller Number</th> -->
								<th>Controller</th>
								<th>Capacity(Litres)</th>
								<th>Height(CM)</th>
								<th>Product</th>
								<!-- <th>Threshold</th>
								<th>Reorder Level</th> -->

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
									<ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
										<li role="presentation" id="t1" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Current Tank Data</a>
										</li>
										<li role="presentation" id="t2" class=""><a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Historic Trends</a>
										</li>
										<li role="presentation" id="t3" class=""><a href="#tab_content3" role="tab" id="profile-tab2" data-toggle="tab" aria-expanded="false">Notification/Alerts</a>
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




									<table class="table table-striped">
									
									<tbody>
										<tr>
										<td><b>Timestamp:</b> <i id="ts"></i></td>
										<td><b>Water Level:</b> <i id="wlevel"></i></td>
										</tr>
										<tr>
										<td><b>Temperature:</b> <i id="temp"></i></td>
										<td><b>Fuel Volume:</b> <i id="fvol"></i></td>
										</tr>
										<tr>
										<td><b>Fuel Level:</b> <i id="flevel"></i></td>
										<td><b>Controller:</b> <i id="contr"></i></td>
										</tr>
										<tr>
										<td><b>Tank Height:</b> <i id="theight"></i></td>
										<td><b>Product:</b> <i id="pduct"></i></td>
										</tr>
									</tbody>
									</table>

										<!-- ================================================================ -->
										</div>

										<div role="tabpanel" class="tab-pane fade row" id="tab_content2" aria-labelledby="profile-tab">
											<div class="col-md-9 col-sm-9 col-xs-12">
												<canvas id="canvas"></canvas>
											</div>
											<div class="col-md-3 col-sm-3 col-xs-12">

											<div class="animated flipInY col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-bottom:10px">
													<input placeholder="Choose Date" class="" id="tankRange"  >
												</div>
												
												<div class="animated flipInY col-lg-12 col-md-12 col-sm-12 col-xs-12">
													<div class="tile-stats">
													<div class="icon"><i class="fa fa-comments-o"></i>
													</div>
													<div class="count" id="dailyUsage">00</div>

													<h3>Daily Usage </h3>
													<p>*1000 Litres</p>
													</div>
												</div>
												
												<div class="animated flipInY col-lg-12 col-md-12 col-sm-12 col-xs-12">
													<div class="tile-stats">
													<div class="icon"><i class="fa fa-comments-o"></i>
													</div>
													<div class="count" id="nxtReord">00/00</div>

													<h3>Next Reorder</h3>
													<p>(DD/MM)</p>
													</div>
												</div>

											</div>
										</div>

										<div role="tabpanel" class="tab-pane fade" id="tab_content3" aria-labelledby="profile-tab">
											<div  >
											<ul class="list-unstyled msg_list" id="tankNotify">
											</ul>
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


<?php    $this->load->view('station/footer') ; ?>
<?php    $this->load->view('station/scriptTankmgt') ; ?>
