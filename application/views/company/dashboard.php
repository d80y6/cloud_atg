<?php    $this->load->view('company/header') ; ?>




<div class="right_col" role="main">
<!-- dummy test page yo -->


 <!-- top filters -->
 <div class="row tile_count">
 						
						 <div class="col-md-2 col-sm-4 col-xs-6 ">
						
            </div>
						 <div class="col-md-2 col-sm-4 col-xs-6 ">
						
            </div>
            
						 <div class="col-md-2 col-sm-4 col-xs-6 ">
						 <select id="userTypes" class="" style="width: 100%;">
										<option>Choose User Type</option>
									
									</select>
            </div>
						 <div class="col-md-2 col-sm-4 col-xs-6 ">
						 <select id="stations" class="" style="width: 100%;">
										<option>Choose Station</option>
										
									</select>
            </div>
						 <div class="col-md-2 col-sm-4 col-xs-6 ">
						 <select id="locations" class="" style="width: 100%;">
										<option>Choose Location</option>
								
									</select>
            </div>
						 <!-- <div class="col-md-2 col-sm-4 col-xs-6 ">
						 <select class="">
										<option>Choose Company</option>
										<option>Option one</option>
										<option>Option two</option>
										<option>Option three</option>
										<option>Option four</option>
									</select>
            </div> -->
						 <div class="col-md-2 col-sm-4 col-xs-6 ">
						 <input placeholder="Choose Date" class="" id="dashRange"  style="width: 100%;height:19px">
						 
            </div>
            
					
           
          </div>
          <!-- /top filters -->


 <!-- top pans -->
 <div class="row tile_count">
			
			<div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
				<span class="count_top"><i class="fa fa-tint"></i> Stations</span>
				<div class="count" id="statCount">00</div>
				<span class="count_bottom"><i class="red"  id="iStatCount">00 Inactive </i> | <a href="<?php echo base_url() ; ?>index.php/stationmgt" class="">Manage </a></span>
			</div>
			<div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
				<span class="count_top"><i class="fa fa-user"></i> Users</span>
				<div class="count " id="userCount">00</div>
				<span class="count_bottom"><i class="red" id="iUserCount">00 Inactive </i> | <a href="<?php echo base_url() ; ?>index.php/usermgt" class="">Manage </a></span>
			</div>
			<div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
				<span class="count_top"><i class="fa fa-database"></i> Tanks</span>
				<div class="count" id="tankCount">00</div>
				<span class="count_bottom"><i class="red" id="iTankCount">00 Inactive </i> | <a href="<?php echo base_url() ; ?>index.php/tankmgt" class="">Manage </a></span>
			</div>
			<div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
				<span class="count_top"><i class="fa fa-keyboard-o"></i> Devices</span>
				<div class="count" id="devCount">00</div>
				<span class="count_bottom"><i class="red" id="iDevCount">00 Inactive </i> | <a href="<?php echo base_url() ; ?>index.php/controllermgt" class="">Manage </a></span>
			</div>
			<div class="col-md-3 col-sm-4 col-xs-6 tile_stats_count">
				<span class="count_top"><i class="fa fa-tint"></i> Volume (*1000Ltrs)</span>
				
				<div style="border-bottom: 1px solid #D9DEE4;margin-bottom: 2px"><b>PMS:</b> <i id="pmsVol">00</i></div>
				
				<div style="border-bottom: 1px solid #D9DEE4;margin-bottom: 2px"><b>AGO:</b> <i id="agoVol">00</i></div>
				
				<div style="margin-bottom: 3px"><b>DPK:</b> <i id="dpkVol">00</i></div>
				<!-- <span class="count_bottom"><i class="red">73 Inactive </i> | <a href="#" class="">Manage </a></span> -->
			</div>
	</div>
	<!-- /top pans -->

	  <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="dashboard_graph">

                <div class="row x_title">
                  <div class="col-md-6">
                    <h3>Product Volumes <small >Last 7 Days <i id="lsd"></i></small></h3>
                  </div>
                  <!-- <div class="col-md-6">
                    <div id="reportrange" class="pull-right" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc">
                      <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
                      <span>December 30, 2014 - January 28, 2015</span> <b class="caret"></b>
                    </div>
                  </div> -->
                </div>

                <div class="col-md-9 col-sm-9 col-xs-12">
                  <!-- <div id="chart_plot_01" class="demo-placeholder"></div> -->
									<canvas id="myDashLineChart"  ></canvas>

                </div>
                <!-- <div class="col-md-1 col-sm-1 col-xs-12 bg-white">
								</div> -->
                <div class="col-md-3 col-sm-3 col-xs-12 bg-white">
                  <div class="x_title">
                    <h2>Asset Status <small>(Active/Inactive)</small> </h2>
                    <div class="clearfix"></div>
                  </div>

                  <div class="col-md-12 col-sm-12 col-xs-6">
                    <!-- <div>
                      <p>Companies</p>
                      <div class="">
                        <div class="progress progress_sm" style="width: 76%;">
                          <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="80"></div>
                        </div>
                      </div>
                    </div> -->
                    <div>
                      <p>Stations</p>
                      <div class="">
                        <div class="progress " style="width: 76%;">
                          <div class="progress-bar bg-green" role="progressbar" id="statBar"></div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-12 col-sm-12 col-xs-6">
                    <div>
                      <p>Devices</p>
                      <div class="">
                        <div class="progress " style="width: 76%;">
                          <div class="progress-bar bg-green" role="progressbar" id="devBar"></div>
                        </div>
                      </div>
                    </div>
                    <div>
                      <p>Tanks</p>
                      <div class="">
                        <div class="progress " style="width: 76%;">
                          <div class="progress-bar bg-green" role="progressbar" id="tankBar"></div>
                        </div>
                      </div>
                    </div>
                  </div>
               
							    <div class="col-md-12 col-sm-12 col-xs-6">
                    <div>
                      <p>Users</p>
                      <div class="">
                        <div class="progress " style="width: 76%;">
                          <div class="progress-bar bg-green" role="progressbar" id="userBar" data-transitiongoal="0"></div>
                        </div>
                      </div>
                    </div>
                    <!-- <div>
                      <p>Tanks</p>
                      <div class="">

										

                        <div class="progress progress_sm" style="width: 76%;">
                          <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="50"></div>
                        </div>

                      </div>
                    </div> -->
                  </div>


					

                </div>

                <div class="clearfix"></div>
              </div>
            </div>

          </div>

<br/>

					<!-- row 3 -->
					<div class="row">


<div class="col-md-4 col-sm-4 col-xs-12">
	<div class="x_panel tile fixed_height_320">
		<div class="x_title">
			<h2>Top 5 Stations by Reorder Frequency</h2>
			<ul class="nav navbar-right panel_toolbox">
			
			</ul>
			<div class="clearfix"></div>
		</div>
		<div class="x_content">
			<ul class="list-unstyled msg_list" id="srf">
				<!-- <li  style="max-height:55px">
					<a class="row" style="width:100%">
						<span class="col-md-3 col-sm-3 col-xs-3">
						<i class="fa fa-tint fa-3x"></i>
						</span>
						<span class="col-md-9 col-sm-9 col-xs-9">
							<b>Station</b>: <i class="pull-right">Station</i>
							<br> 
							<b>Location</b>: <i class="pull-right">Location</i>
						</span>
					
					</a>
				</li> -->
			</ul>
			
		</div>
	</div>
</div>

<div class="col-md-4 col-sm-4 col-xs-12">
	<div class="x_panel tile fixed_height_320 overflow_hidden">
		<div class="x_title">
			<h2> Online Users</h2>
			<!-- <ul class="nav navbar-right panel_toolbox">
				<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
				</li>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
					<ul class="dropdown-menu" role="menu">
						<li><a href="#">Settings 1</a>
						</li>
						<li><a href="#">Settings 2</a>
						</li>
					</ul>
				</li>
				<li><a class="close-link"><i class="fa fa-close"></i></a>
				</li>
			</ul> -->
			<div class="clearfix"></div>
		</div>
		<div class="x_content">
			<!-- <canvas id="myDashOnlineDonut"  style="margin: 15px 10px 10px 0"></canvas> -->
			<canvas id="myDashOnlineDonut"  height="180"></canvas>

			<!-- <table class="" style="width:100%">
				
				<tr>
					<td>
						<canvas class="canvasDoughnut" height="140" width="90%" style="margin: 15px 10px 10px 0"></canvas>
					</td>
				
				</tr>
			</table> -->
		</div>
	</div>
</div>


<div class="col-md-4 col-sm-4 col-xs-12">
	<div class="x_panel tile fixed_height_320">
		<div class="x_title">
			<h2> Station Map </h2>
			<!-- <ul class="nav navbar-right panel_toolbox">
				<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
				</li>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
					<ul class="dropdown-menu" role="menu">
						<li><a href="#">Settings 1</a>
						</li>
						<li><a href="#">Settings 2</a>
						</li>
					</ul>
				</li>
				<li><a class="close-link"><i class="fa fa-close"></i></a>
				</li>
			</ul> -->
			<div class="clearfix"></div>
		</div>
		<div class="x_content">



       <div id="statMap" style=" height: 250px"></div>
       <!-- <div id="world-map-gdp" class="col-md-12 col-sm-12 col-xs-12" style="height:230px;"></div> -->



		</div>
	</div>
</div>

</div>


					<!-- /row 3 -->

<br/>

					<!-- row 4 -->
					<div class="row">


<div class="col-md-4 col-sm-4 col-xs-12">
	<div class="x_panel tile fixed_height_320">
		<div class="x_title">
			<h2> PMS</h2>
			
			<div class="clearfix"></div>
		</div>
		<div class="x_content">
		<table class="table table-striped">
		<col width="33%">
		<col width="33%">
		<col width="33%">
			<thead>
				<tr>
					
					<th>Stations</th>
					<th width="30%">Avg Days to Reorder</th>
					<th>Avg Daily Sales </th>
				</tr>
			</thead>
			<tbody id="vsppms">
				<tr>
					<td></td>
					<td>0</td>
					<td>0</td>
				</tr>
				
			</tbody>
		</table>
			
		</div>
	</div>
</div>

<div class="col-md-4 col-sm-4 col-xs-12">
	<div class="x_panel tile fixed_height_320 overflow_hidden">
		<div class="x_title">
			<h2> AGO</h2>
		
			<div class="clearfix"></div>
		</div>
		<div class="x_content">
		<table class="table table-striped">
		<col width="33%">
		<col width="33%">
		<col width="33%">
			<thead>
				<tr>
					
					<th>Stations</th>
					<th width="30%">Avg Days to Reorder</th>
					<th>Avg Daily Sales </th>
				</tr>
			</thead>
			<tbody id="vspago">
				<tr>
					<td></td>
					<td>0</td>
					<td>0</td>
				</tr>
				
			</tbody>
		</table>
		</div>
	</div>
</div>


<div class="col-md-4 col-sm-4 col-xs-12">
	<div class="x_panel tile fixed_height_320">
		<div class="x_title">
			<h2>  DPK </h2>
		
			<div class="clearfix"></div>
		</div>
		<div class="x_content">

		<table class="table table-striped">
		<col width="33%">
		<col width="33%">
		<col width="33%">
			<thead>
				<tr>
					
					<th>Stations</th>
					<th width="30%">Avg Days to Reorder</th>
					<th>Avg Daily Sales </th>
				</tr>
			</thead>
			<tbody id="vspdpk">
				<tr>
					<td></td>
					<td>0</td>
					<td>0</td>
				</tr>
								
			</tbody>
		</table>

		</div>
	</div>
</div>

</div>


					<!-- /row 4 -->
					<!-- row 5 -->
					<div class="row">


<div class="col-md-8 col-sm-8 col-xs-12">
	<div class="x_panel tile fixed_height_320">
		<div class="x_title">
			<h2> Volume Sales By Product <small>Specify Range Using Date Filter Above</small></h2>
			
			<div class="clearfix"></div>
		</div>
		<div class="x_content">
		<table class="table table-striped">
			<thead>
				<tr>
					
					<th>Stations</th>
					<th>PMS (* 1000Ltrs)</th>
					<th>AGO (* 1000Ltrs)</th>
					<th>DPK (* 1000Ltrs)</th>
				</tr>
			</thead>
			<tbody id="vsbp">
				<tr>
					<td></td>
					<td>0</td>
					<td>0</td>
					<td>0</td>
				</tr>
				
			</tbody>
		</table>
			
		</div>
	</div>
</div>

<div class="col-md-4 col-sm-4 col-xs-12">
	<div class="x_panel tile fixed_height_320">
		<div class="x_title">
			<h2>Recent Logs</h2>
			
			<div class="clearfix"></div>
		</div>
		<div class="x_content">
			<ul class="list-unstyled msg_list" id="rLogs">
				<!-- <li>
					<a>
						<span class="image">
						<i class="fa fa-list"></i>
						</span>
						<span>
							<span>John Smith</span>
							<span class="time">3 mins ago</span>
						</span>
						<span class="message">
							Film festivals used to be do-or-die moments for movie makers. They were where you met the producers that
						</span>
					</a>
				</li> -->
			</ul>
			
		</div>
	</div>
</div>




</div>


					<!-- /row 5 -->


</div>


<?php    $this->load->view('company/footer') ; ?>
<?php    $this->load->view('company/scriptDashboard') ; ?>
