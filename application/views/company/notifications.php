<?php    $this->load->view('company/header') ; ?>




<div class="right_col" role="main">
<!-- dummy test page yo -->


  <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Notifications <small>View Notifications Here</small></h2>
                    <ul class="nav navbar-right  pull-right">
											<li class="pull-right "><a style="padding:5px;" class="text-warning" href="#" onclick="loadNotable()"><i class="fa fa-refresh"></i> Refresh</a></li>

										 <!-- <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li> -->
                      <!-- <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a> -->
                      <!-- <li><i class="fa fa-chevron-up"></i> -->
                      <!-- </li> -->
                      <!-- <li class="dropdown pull-right">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                        <ul class="dropdown-menu"  role="menu">
                          
                          <li><a href="#" onclick="loadNotable()"><i class="fa fa-refresh"></i> Refresh</a>
                          </li>
                        </ul>
                      </li> -->
                     
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <table id="tblnotLog" class="table table-hover">
						<thead> 
								<tr>
								<th>Company</th>
								<th> Message</th>
								<th>Severity</th>
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

              <div class="clearfix"></div>


</div>




<!-- ======================================================= -->

<!-- ======================================================= -->


<?php    $this->load->view('company/footer') ; ?>
<?php    $this->load->view('company/scriptNotLogs') ; ?>
