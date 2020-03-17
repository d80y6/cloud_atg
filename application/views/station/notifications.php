<?php    $this->load->view('station/head') ; ?>




<div class="page-header">
              <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white mr-2">
                  <i class="mdi mdi-bell-outline"></i>
                </span> Notifications </h3>
              <nav aria-label="breadcrumb">
                <ul class="breadcrumb">
                  <li class="breadcrumb-item active" aria-current="page">
					<span></span><i id="nodeName" class="text-default"></i> &nbsp; 
					<!-- <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i> -->
                  </li>
                </ul>
              </nav>
						</div>



<div class="right_col" role="main">
<!-- dummy test page yo -->


<div class="row">
	<div class="col-md-12 grid-margin stretch-card ">
		<div class="card ">
			<div class="card-body">
				<div class="clearfix">
					<h4 class="card-title float-left">Notifications <hr> </h4>
					
					<h4 class="card-title float-right" id="addnew">
					<p class="float-right"><a style="padding:5px;" class="text-warning" href="#" onclick="loadNotable()"><i class="fa fa-refresh"></i> Refresh</a></p></h4>
					<div id="visit-sale-chart-legend" class="rounded-legend legend-horizontal legend-top-right float-right"></div>
				</div>
			
<div style="overflow-x:auto;">

<table id="tblnotLog" class="table table-hover responsive">
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
	</div>
 </div>




<!-- ======================================================= -->

<!-- ======================================================= -->


<?php    $this->load->view('station/foot') ; ?>
<?php    $this->load->view('station/scriptNotLogs') ; ?>
