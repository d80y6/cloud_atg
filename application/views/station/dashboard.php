<?php    $this->load->view('station/header') ; ?>




<div class="right_col" role="main">
<!-- dummy test page yo -->


 <!-- top filters -->
 <div class="row tile_count">
 						
						 <div class="col-md-2 col-sm-4 col-xs-6 ">
						
            </div>
						 <div class="col-md-2 col-sm-4 col-xs-6 ">
						
            </div>
						 <div class="col-md-2 col-sm-4 col-xs-6 ">
						
            </div>
						 <div class="col-md-2 col-sm-4 col-xs-6 ">
						
            </div>
            
						 <div class="col-md-2 col-sm-4 col-xs-6 ">
						 <select id="userTypes" class="" style="width: 100%;">
										<option>Choose User Type</option>
										
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
			
 			<div class="col-md-3 col-sm-4 col-xs-6 tile_stats_count">
				<span class="count_top"><i class="fa fa-user"></i> Users</span>
				<div class="count " id="userCount">00</div>
				<span class="count_bottom"><i class="red" id="iUserCount">00 Inactive </i> | <a href="<?php echo base_url() ; ?>index.php/usermgt" class="">Manage </a></span>
			</div>
			<div class="col-md-3 col-sm-4 col-xs-6 tile_stats_count">
				<span class="count_top"><i class="fa fa-database"></i> Tanks</span>
				<div class="count" id="tankCount">00</div>
				<span class="count_bottom"><i class="red" id="iTankCount">00 Inactive </i> | <a href="<?php echo base_url() ; ?>index.php/tankmgt" class="">Manage </a></span>
			</div>
			<div class="col-md-3 col-sm-4 col-xs-6 tile_stats_count">
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
									<canvas id="myDashLineChart" ></canvas>

                </div>
                <!-- <div class="col-md-1 col-sm-1 col-xs-12 bg-white">
								</div> -->
                <div class="col-md-3 col-sm-3 col-xs-12 bg-white">
                  <div class="x_title">
                    <h2>Asset Status <small>(Active/Inactive)</small> </h2>
                    <div class="clearfix"></div>
                  </div>

                  <!-- <div class="col-md-12 col-sm-12 col-xs-6"> -->
                    <!-- <div>
                      <p>Companies</p>
                      <div class="">
                        <div class="progress progress_sm" style="width: 76%;">
                          <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="80"></div>
                        </div>
                      </div>
                    </div> -->
                    <!-- <div>
                      <p>Stations</p>
                      <div class="">
                        <div class="progress progress_sm" style="width: 76%;">
                          <div class="progress-bar bg-green" role="progressbar" id="statBar"></div>
                        </div>
                      </div>
                    </div> -->
                  <!-- </div> -->
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
			<h2>Recent Station Reorders </h2>
			<ul class="nav navbar-right panel_toolbox">
			
			</ul>
			<div class="clearfix"></div>
		</div>
		<div class="x_content">
			<ul class="list-unstyled msg_list" id="rreords">
				<!-- <li  style="max-height:55px">
					<a class="row" style="width:100%">
						<span class="col-md-3 col-sm-3 col-xs-3">
						<i class="fa fa-tint fa-3x"></i>
						</span>
						<span class="col-md-9 col-sm-9 col-xs-9">
							<b>Product</b>: <i class="pull-right">Station</i>
							<br> 
							<b>Tank(Vol)</b>: <i class="pull-right">Location</i>
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
		
			<div class="clearfix"></div>
		</div>
		<div class="x_content">
			<!-- <canvas id="myDashOnlineDonut"  style="margin: 15px 10px 10px 0"></canvas> -->
			<canvas id="myDashOnlineDonut" height="180" ></canvas>

		
		</div>
	</div>
</div>


<div class="col-md-4 col-sm-4 col-xs-12">
	<div class="x_panel tile fixed_height_320">
		<div class="x_title">
			<h2>  Inactive/Decommissioned Tanks </h2>
		
			<div class="clearfix"></div>
		</div>
		<div class="x_content">

		<ul class="list-unstyled msg_list" id="iTanks">
				<!-- <li  style="max-height:55px">
					<a class="row" style="width:100%">
						<span class="col-md-4 col-sm-4 col-xs-4">
						<i class="fa fa-database fa-3x"></i>
						<span class="badge bg-red" style="
						font-size: 10px;
						font-weight: 400;
						line-height: 13px;
						padding: 2px 6px;
						position: absolute;
						right: 30px;
						top: -1px;">F</span>

						</span>
						<span class="col-md-8 col-sm-8 col-xs-8">
							<b>Tank</b>: <i class="pull-right">Tank</i>
							<br>
							<b>Product</b>: <i class="pull-right">Product</i>
						
						
						</span>
					
					
					</a>
				</li> -->
			</ul>

	
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
<div>
		<h2 class="pull-right">Average Reorder Days</h2>
<div class="clearfix"></div>

		<i class="fa fa-calendar fa-3x  pull-left"></i>

	<i class=" pull-right" style="font-size:24px" id="ardpms">00</i>
</div>
<br>
<div class="clearfix"></div>

<div style="border-top:1px solid #E6E9ED;margin-top:20px">
		<h2 class="pull-right">Average Daily Sales (* 1000Ltrs)</h2>
<div class="clearfix"></div>

		<i class="fa fa-tint fa-3x  pull-left"></i>
<!-- <div class="clearfix"></div> -->


	<i class=" pull-right" style="font-size:24px" id="adspms">00</i>
</div>

			
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
	
		<div>
		<h2 class="pull-right">Average Reorder Days</h2>
<div class="clearfix"></div>

		<i class="fa fa-calendar fa-3x  pull-left"></i>

	<i class=" pull-right" style="font-size:24px" id="ardago">00</i>
</div>
<br>
<div class="clearfix"></div>

<div style="border-top:1px solid #E6E9ED;margin-top:20px">
		<h2 class="pull-right">Average Daily Sales (* 1000Ltrs)</h2>
<div class="clearfix"></div>

		<i class="fa fa-tint fa-3x  pull-left"></i>
<!-- <div class="clearfix"></div> -->


	<i class=" pull-right" style="font-size:24px" id="adsago">00</i>
</div>

	
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


<div>
		<h2 class="pull-right">Average Reorder Days</h2>
<div class="clearfix"></div>

		<i class="fa fa-calendar fa-3x  pull-left"></i>

	<i class=" pull-right" style="font-size:24px" id="arddpk">00</i>
</div>
<br>
<div class="clearfix"></div>

<div style="border-top:1px solid #E6E9ED;margin-top:20px">
		<h2 class="pull-right">Average Daily Sales (* 1000Ltrs)</h2>
<div class="clearfix"></div>

		<i class="fa fa-tint fa-3x  pull-left"></i>
<!-- <div class="clearfix"></div> -->


	<i class=" pull-right" style="font-size:24px" id="adsdpk">00</i>
</div>


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

<!-- ========================== -->
	
<div class="col-md-4 col-sm-4 col-xs-4" style="border-right:1px solid #E6E9ED;margin-top:20px">
		<h2 class="pull-right">PMS (* 1000Ltrs)</h2>
<div class="clearfix"></div>
<br><br>
		<i class="fa fa-tint fa-3x  pull-left"></i>
<!-- <div class="clearfix"></div> -->


	<i class=" pull-right" style="font-size:28px" id="vsppms">00</i>
</div>

<div class="col-md-4 col-sm-4 col-xs-4" style="border-right:1px solid #E6E9ED;margin-top:20px">
		<h2 class="pull-right">AGO (* 1000Ltrs)</h2>
<div class="clearfix"></div>
<br><br>

		<i class="fa fa-tint fa-3x  pull-left"></i>
<!-- <div class="clearfix"></div> -->


	<i class=" pull-right" style="font-size:28px" id="vspago">00</i>
</div>


<div class="col-md-4 col-sm-4 col-xs-4" style="margin-top:20px">
		<h2 class="pull-right">DPK (* 1000Ltrs)</h2>
<div class="clearfix"></div>
<br><br>

		<i class="fa fa-tint fa-3x  pull-left"></i>
<!-- <div class="clearfix"></div> -->


	<i class=" pull-right" style="font-size:28px" id="vspdpk">00</i>
</div>
<!-- ========================== -->

		</div>
	</div>
</div>

<!-- <div class="col-md-4 col-sm-4 col-xs-12">
	<div class="x_panel tile fixed_height_320">
		<div class="x_title">
			<h2>Recent Logs</h2>
			
			<div class="clearfix"></div>
		</div>
		<div class="x_content">
			<ul class="list-unstyled msg_list">
				<li>
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
				</li>
			</ul>
			
		</div>
	</div>
</div> -->


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


<?php    $this->load->view('station/footer') ; ?>
<?php    $this->load->view('station/scriptDashboard') ; ?>
