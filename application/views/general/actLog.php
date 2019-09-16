<?php    $this->load->view('general/header') ; ?>




<div class="right_col" role="main">
<!-- dummy test page yo -->


  <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Activity Logs <small>View Logs Here</small></h2>
                    <ul class="nav navbar-right  pull-right">
						<li class="pull-right "><a style="padding:5px;" class="text-warning" href="#" onclick="loadAlogtable()"><i class="fa fa-refresh"></i> Refresh</a></li>
										 <!-- <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li> -->
                      <!-- <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a> -->
                      <!-- <li><i class="fa fa-chevron-up"></i> -->
                      <!-- </li> -->
                      <!-- <li class="dropdown pull-right">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                        <ul class="dropdown-menu"  role="menu">
                          
                          <li><a href="#" onclick="loadAlogtable()"><i class="fa fa-refresh"></i> Refresh</a>
                          </li>
                        </ul>
                      </li> -->
                     
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <table id="tblactLog" class="table table-hover">
						<thead> 
								<tr>
								<th>User</th>
								<th> Activity</th>
								<th>Company</th>
								<th>Station</th>
								<th>Timestamp</th>

								<!-- <th class="text-center"></th> -->
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




<!-- ===========================Edit Modal============================ -->
<div class="modal" id="myModal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
	  <b style="font-size:150%"  class="modal-title">Edit Company</b>
        <button type="button" class="close" data-dismiss="modal" onclick="$('#myModal').modal('hide')">&times;</button>
      </div>

      <!--  Edit Modal body -->		
			<div class="modal-body">
				
				<div class="card-body">
                <form method="POST">
							
					<div class="row">
										<div class="form-group col-md-6 col-sm-6 col-xs-12">
											<!-- <label for="cname">Company Name</label> -->
											<input id="cname" type="text" placeholder="Company Name" class="form-control" name="cname">
										
											
										</div>

					

						<div class="form-group col-md-6 col-sm-6 col-xs-12">
							<!-- <label for="cpnum">Phone Number</label> -->
							<input id="cpnum" type="number" placeholder="Phone Number" class="form-control" name="cpnum">

							
						</div>
					</div>

					<div class="clearfix"></div>


				
					<div class="row">
										<div class="form-group col-md-12 col-sm-12 col-xs-12">
											<!-- <label for="ccomm">Comments</label> -->
											<textarea id="ccomm" placeholder="Comments"  class="form-control" name="ccomm"></textarea>
										
											
										</div>
										<!-- <div class="form-group col-6">
											<label for="cemail">Customer Email</label>
											<input id="acemail" type="email" class="form-control" name="acemail">
										
											
										</div> -->
					</div>


              <div class="clearfix"></div>


                  <div class="row">
										
									
										<div class="form-group col-md-6 col-sm-6 col-xs-12">
											<!-- <label for="pemail">Pre-Alarm Email</label> -->
											<input id="pemail" placeholder="Pre-Alarm Email" type="email" class="form-control" name="pemail">
										
											
										</div>
										<div class="form-group col-md-6 col-sm-6 col-xs-12">
											<!-- <label for="asemail">Alarm Start Email</label> -->
											<input id="asemail" placeholder="Alarm Start Email" type="email" class="form-control" name="asemail">
										
											
										</div>
									
									</div>


              <div class="clearfix"></div>


								  <div class="row">
										
									
										<div class="form-group col-md-6 col-sm-6 col-xs-12">
											<!-- <label for="aeemail">Alarm End Email</label> -->
											<input id="aeemail" placeholder="Alarm End Email" type="email" class="form-control" name="aeemail">
										
											
										</div>
										<div class="form-group col-md-6 col-sm-6 col-xs-12">
											<!-- <label for="uemail">Unloading Email</label> -->
											<input id="uemail" placeholder="Unloading Email" type="email" class="form-control" name="uemail">
										
											
										</div>
									
									</div>


              <div class="clearfix"></div>


								  <div class="row">
										
									
										<div class="form-group col-md-6 col-sm-6 col-xs-12">
											<!-- <label for="remail">Reorder Email</label> -->
											<input id="remail" placeholder="Reorder Email" type="email" class="form-control" name="remail">
										
											
										</div>
										<div class="form-group col-md-6 col-sm-6 col-xs-12">
											<!-- <label for="temail">Threshold Email</label> -->
											<input id="temail" placeholder="Threshold Email" type="email" class="form-control" name="temail">
										
											
										</div>
									
									</div>

              <div class="clearfix"></div>


									<div class="row">
										
									
										<div class="form-group col-md-12 col-sm-12 col-xs-12">
											<!-- <label for="nuemail">New User Email</label> -->
											<input id="nuemail" placeholder="New User Email" type="email" class="form-control" name="nuemail">
										
											
										</div>
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
	  <b style="font-size:150%"  class="modal-title">Add A Company</b>
        <button type="button" class="close" data-dismiss="modal" onclick="$('#myAddModal').modal('hide')">&times;</button>
      </div>

      <!--  Add Modal body -->		
			<div class="modal-body">
				
				<div class="card-body">
                <form method="POST">
							
					<div class="row">
										<div class="form-group col-md-6 col-sm-6 col-xs-12">
											<!-- <label for="cname">Company Name</label> -->
											<input id="acname" type="text" placeholder="Company Name" class="form-control" name="acname">
										
											
										</div>

					

						<div class="form-group col-md-6 col-sm-6 col-xs-12">
							<!-- <label for="cpnum">Phone Number</label> -->
							<input id="acpnum" type="number" placeholder="Phone Number" class="form-control" name="acpnum">

							
						</div>
					</div>

					<div class="clearfix"></div>


				
					<div class="row">
										<div class="form-group col-md-12 col-sm-12 col-xs-12">
											<!-- <label for="ccomm">Comments</label> -->
											<textarea id="accomm" placeholder="Comments"  class="form-control" name="accomm"></textarea>
										
											
										</div>
										<!-- <div class="form-group col-6">
											<label for="cemail">Customer Email</label>
											<input id="acemail" type="email" class="form-control" name="acemail">
										
											
										</div> -->
					</div>


              <div class="clearfix"></div>


                  <div class="row">
										
									
										<div class="form-group col-md-6 col-sm-6 col-xs-12">
											<!-- <label for="pemail">Pre-Alarm Email</label> -->
											<input id="apemail" placeholder="Pre-Alarm Email" type="email" class="form-control" name="apemail">
										
											
										</div>
										<div class="form-group col-md-6 col-sm-6 col-xs-12">
											<!-- <label for="asemail">Alarm Start Email</label> -->
											<input id="aasemail" placeholder="Alarm Start Email" type="email" class="form-control" name="aasemail">
										
											
										</div>
									
									</div>


              <div class="clearfix"></div>


								  <div class="row">
										
									
										<div class="form-group col-md-6 col-sm-6 col-xs-12">
											<!-- <label for="aeemail">Alarm End Email</label> -->
											<input id="aaeemail" placeholder="Alarm End Email" type="email" class="form-control" name="aaeemail">
										
											
										</div>
										<div class="form-group col-md-6 col-sm-6 col-xs-12">
											<!-- <label for="uemail">Unloading Email</label> -->
											<input id="auemail" placeholder="Unloading Email" type="email" class="form-control" name="auemail">
										
											
										</div>
									
									</div>


              <div class="clearfix"></div>


								  <div class="row">
										
									
										<div class="form-group col-md-6 col-sm-6 col-xs-12">
											<!-- <label for="remail">Reorder Email</label> -->
											<input id="aremail" placeholder="Reorder Email" type="email" class="form-control" name="aremail">
										
											
										</div>
										<div class="form-group col-md-6 col-sm-6 col-xs-12">
											<!-- <label for="temail">Threshold Email</label> -->
											<input id="atemail" placeholder="Threshold Email" type="email" class="form-control" name="atemail">
										
											
										</div>
									
									</div>

              <div class="clearfix"></div>


									<div class="row">
										
									
										<div class="form-group col-md-12 col-sm-12 col-xs-12">
											<!-- <label for="nuemail">New User Email</label> -->
											<input id="anuemail" placeholder="New User Email" type="email" class="form-control" name="anuemail">
										
											
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


<?php    $this->load->view('general/footer') ; ?>
<?php    $this->load->view('general/scriptActLogs') ; ?>
