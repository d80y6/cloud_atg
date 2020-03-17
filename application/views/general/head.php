<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>ATG</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="<?php echo base_url() ; ?>asset/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="<?php echo base_url() ; ?>asset/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="<?php echo base_url() ; ?>asset/css/style.css">
    <!-- End layout styles -->
	<link rel="shortcut icon" href="<?php echo base_url() ; ?>asset/images/favicon.png" />

	<!-- NProgress -->
	<link href="<?php echo base_url() ; ?>assets/vendors/nprogress/nprogress.css" rel="stylesheet">

	<!-- Bootstrap -->
	<!-- <link href="<?php echo base_url() ; ?>assets/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet"> -->

	<!-- Font Awesome -->
	<link href="<?php echo base_url() ; ?>assets/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.10.0/css/all.css">

			 <!-- PNotify -->
			 <link href="<?php echo base_url() ; ?>assets/vendors/pnotify/dist/pnotify.css" rel="stylesheet">
    <link href="<?php echo base_url() ; ?>assets/vendors/pnotify/dist/pnotify.buttons.css" rel="stylesheet">
    <link href="<?php echo base_url() ; ?>assets/vendors/pnotify/dist/pnotify.nonblock.css" rel="stylesheet">


	<!-- <script src="<?php echo base_url() ; ?>dist/modules/jquery.min.js"></script>
	<script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script> -->



	<link rel="stylesheet" href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
	<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css">

		<!-- datatables -->
		<link href="<?php echo base_url() ; ?>assets/vendors/datatables.net-bs/css/dataTables.bootstrap.css" rel="stylesheet" />
    
    <link href="<?php echo base_url() ; ?>assets/vendors/datatables.net-bs/css/buttons.dataTables.min.css" rel="stylesheet" />
    <link href="<?php echo base_url() ; ?>assets/dist/css/bootstrap-select.css" rel="stylesheet" />

		<link rel="stylesheet" href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
		<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css">
	<!-- <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css"> -->


<!-- bootstrap-daterangepicker -->
<link href="<?php echo base_url() ; ?>assets/vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

		<!-- lodash -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/lodash.js/4.17.5/lodash.min.js"></script>
    <script>
    _u = _.noConflict(); // lets call ourselves _u
    </script>


<script src="http://d3js.org/d3.v3.min.js" language="JavaScript"></script>
    <script src="<?php echo base_url() ; ?>assets/build/js/liquidFillGauge.js" language="JavaScript"></script>
    <style>
        .liquidFillGaugeText { font-family: Helvetica; font-weight: bold; }
    </style>


<style>

.sasas{
		/* width: 250px; */
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
  /* text-align: center; */
	}

	</style>



  </head>
  <body>
    <div class="container-scroller">
      <!-- partial:partials/_navbar.html -->
      <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
        <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
          <a class="navbar-brand brand-logo" href="<?php echo base_url() ; ?>index.php/general"><i class="mdi mdi-bulldozer text-primary"></i> <font class="text-primary">ATG</font> </a>
          <a class="navbar-brand brand-logo-mini" href="<?php echo base_url() ; ?>index.php/general"><i style="margin-left:10px" class="mdi mdi-bulldozer text-primary"></i> <font class="text-primary">ATG</font> </a>
        </div>
        <div class="navbar-menu-wrapper d-flex align-items-stretch">
          <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="mdi mdi-menu"></span>
          </button>
          <!-- <div class="search-field d-none d-md-block" >
            <form class="d-flex align-items-center h-100" action="#">
              <div class="input-group">
                <div class="input-group-prepend bg-transparent">
                  <i class="input-group-text border-0 mdi mdi-refresh mdi-spin" id="loadspin" ></i>
								</div>
								
              </div>
            </form>
					</div> -->
					<i class="input-group-text border-0 mdi mdi-chart-donut mdi-spin mdi-48px" id="loadspin" ></i>
					
          <ul class="navbar-nav navbar-nav-right">
            <li class="nav-item nav-profile dropdown">
              <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
                <div class="nav-profile-img">
                  <img src="<?php echo base_url() ; ?>asset/images/faces/face1.png" alt="image">
                  <span class="availability-status online"></span>
                </div>
                <div class="nav-profile-text">
                  <p class="mb-1 text-black"><?php echo ucfirst($this->session->userdata('fname')) ." ". ucfirst($this->session->userdata('lname'))?></p>
                </div>
              </a>
              <div class="dropdown-menu navbar-dropdown" aria-labelledby="profileDropdown">
                <a class="dropdown-item" href="<?php echo base_url() ; ?>index.php/actLog">
                  <i class="mdi mdi-file-document mr-2 text-success"></i> Activity Logs </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="<?php echo base_url() ; ?>index.php/profile">
                  <i class="mdi mdi-account mr-2 text-danger"></i> Profile </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="<?php echo base_url() ; ?>index.php/logout">
                  <i class="mdi mdi-logout mr-2 text-primary"></i> Signout </a>
              </div>
            </li>
            <!-- <li class="nav-item d-none d-lg-block full-screen-link">
              <a class="nav-link">
                <i class="mdi mdi-fullscreen" id="fullscreen-button"></i>
              </a>
            </li> -->
            <!-- <li class="nav-item dropdown">
              <a class="nav-link count-indicator dropdown-toggle" id="messageDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
                <i class="mdi mdi-email-outline"></i>
                <span class="count-symbol bg-warning"></span>
              </a>
              <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="messageDropdown">
                <h6 class="p-3 mb-0">Messages</h6>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <img src="<?php echo base_url() ; ?>asset/images/faces/face4.jpg" alt="image" class="profile-pic">
                  </div>
                  <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                    <h6 class="preview-subject ellipsis mb-1 font-weight-normal">Mark send you a message</h6>
                    <p class="text-gray mb-0"> 1 Minutes ago </p>
                  </div>
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <img src="<?php echo base_url() ; ?>asset/images/faces/face2.jpg" alt="image" class="profile-pic">
                  </div>
                  <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                    <h6 class="preview-subject ellipsis mb-1 font-weight-normal">Cregh send you a message</h6>
                    <p class="text-gray mb-0"> 15 Minutes ago </p>
                  </div>
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <img src="<?php echo base_url() ; ?>asset/images/faces/face3.jpg" alt="image" class="profile-pic">
                  </div>
                  <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                    <h6 class="preview-subject ellipsis mb-1 font-weight-normal">Profile picture updated</h6>
                    <p class="text-gray mb-0"> 18 Minutes ago </p>
                  </div>
                </a>
                <div class="dropdown-divider"></div>
                <h6 class="p-3 mb-0 text-center">4 new messages</h6>
              </div>
            </li> -->
            <li class="nav-item dropdown">
              <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#" data-toggle="dropdown">
                <i class="mdi mdi-bell-outline"></i>
                <span class="count-symbol bg-danger"></span>
              </a>
              <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" id="menu1" aria-labelledby="notificationDropdown">
                <!-- <h6 class="p-3 mb-0">Notifications</h6>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <div class="preview-icon bg-success">
                      <i class="mdi mdi-calendar"></i>
                    </div>
                  </div>
                  <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                    <h6 class="preview-subject font-weight-normal mb-1">Event today</h6>
                    <p class="text-gray ellipsis mb-0"> Just a reminder that you have an event today </p>
                  </div>
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <div class="preview-icon bg-warning">
                      <i class="mdi mdi-settings"></i>
                    </div>
                  </div>
                  <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                    <h6 class="preview-subject font-weight-normal mb-1">Settings</h6>
                    <p class="text-gray ellipsis mb-0"> Update dashboard </p>
                  </div>
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <div class="preview-icon bg-info">
                      <i class="mdi mdi-link-variant"></i>
                    </div>
                  </div>
                  <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                    <h6 class="preview-subject font-weight-normal mb-1">Launch Admin</h6>
                    <p class="text-gray ellipsis mb-0"> New admin wow! </p>
                  </div>
                </a>
                <div class="dropdown-divider"></div>
                <h6 class="p-3 mb-0 text-center">See all notifications</h6> -->
              </div>
            </li>
            <!-- <li class="nav-item nav-logout d-none d-lg-block">
              <a class="nav-link" href="#">
                <i class="mdi mdi-power"></i>
              </a>
            </li> -->
            <!-- <li class="nav-item nav-settings d-none d-lg-block">
              <a class="nav-link" href="#">
                <i class="mdi mdi-format-line-spacing"></i>
              </a>
            </li> -->
          </ul>
          <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
            <span class="mdi mdi-menu"></span>
          </button>
        </div>
      </nav>
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_sidebar.html -->
        <nav class="sidebar sidebar-offcanvas" id="sidebar">
          <ul class="nav">
            <li class="nav-item nav-profile">
              <a href="#" class="nav-link">
                <div class="nav-profile-image">
                  <img src="<?php echo base_url() ; ?>asset/images/faces/face1.png" alt="profile">
                  <span class="login-status online"></span>
                  <!--change to offline or busy as needed-->
                </div>
                <div class="nav-profile-text d-flex flex-column">
                  <span class="text-secondary text-small">Welcome</span>
                  <span class="font-weight-bold mb-2"><?php echo ucfirst($this->session->userdata('fname')) ." ". ucfirst($this->session->userdata('lname'))?></span>
                </div>
                <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo base_url() ; ?>index.php/general">
                <span class="menu-title">Dashboard</span>
                <i class="mdi mdi-home menu-icon"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo base_url() ; ?>index.php/companymgt">
                <span class="menu-title">My Companies</span>
                <i class="mdi mdi-city menu-icon"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo base_url() ; ?>index.php/stationmgt">
                <span class="menu-title">My Stations</span>
                <i class="mdi mdi-engine menu-icon"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo base_url() ; ?>index.php/controllermgt">
                <span class="menu-title">My Controllers</span>
                <i class="mdi mdi-desktop-mac menu-icon"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo base_url() ; ?>index.php/pumpmgt">
                <span class="menu-title">My Pumps</span>
                <i class="mdi mdi-gas-station menu-icon"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo base_url() ; ?>index.php/tankmgt">
                <span class="menu-title">My Tanks</span>
                <i class="mdi mdi-delete menu-icon"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo base_url() ; ?>index.php/usermgt">
                <span class="menu-title">My Users</span>
                <i class="mdi mdi-account menu-icon"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo base_url() ; ?>index.php/settings">
                <span class="menu-title">Settings</span>
                <i class="mdi mdi-settings menu-icon"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo base_url() ; ?>index.php/actLog">
                <span class="menu-title">Activity Logs</span>
                <i class="mdi mdi-file-document menu-icon"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo base_url() ; ?>index.php/backup">
                <span class="menu-title">Backup</span>
                <i class="mdi mdi-cloud-upload menu-icon"></i>
              </a>
            </li>
            <!-- <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                <span class="menu-title">Basic UI Elements</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-crosshairs-gps menu-icon"></i>
              </a>
              <div class="collapse" id="ui-basic">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="pages/ui-features/buttons.html">Buttons</a></li>
                  <li class="nav-item"> <a class="nav-link" href="pages/ui-features/typography.html">Typography</a></li>
                </ul>
              </div>
            </li> -->
            <!-- <li class="nav-item">
              <a class="nav-link" href="pages/icons/mdi.html">
                <span class="menu-title">Icons</span>
                <i class="mdi mdi-contacts menu-icon"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="pages/forms/basic_elements.html">
                <span class="menu-title">Forms</span>
                <i class="mdi mdi-format-list-bulleted menu-icon"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="pages/charts/chartjs.html">
                <span class="menu-title">Charts</span>
                <i class="mdi mdi-chart-bar menu-icon"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="pages/tables/basic-table.html">
                <span class="menu-title">Tables</span>
                <i class="mdi mdi-table-large menu-icon"></i>
              </a>
            </li> -->
            <!-- <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#general-pages" aria-expanded="false" aria-controls="general-pages">
                <span class="menu-title">Sample Pages</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-medical-bag menu-icon"></i>
              </a>
              <div class="collapse" id="general-pages">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="pages/samples/blank-page.html"> Blank Page </a></li>
                  <li class="nav-item"> <a class="nav-link" href="pages/samples/login.html"> Login </a></li>
                  <li class="nav-item"> <a class="nav-link" href="pages/samples/register.html"> Register </a></li>
                  <li class="nav-item"> <a class="nav-link" href="pages/samples/error-404.html"> 404 </a></li>
                  <li class="nav-item"> <a class="nav-link" href="pages/samples/error-500.html"> 500 </a></li>
                </ul>
              </div>
            </li> -->
            <!-- <li class="nav-item sidebar-actions">
              <span class="nav-link">
                <div class="border-bottom">
                  <h6 class="font-weight-normal mb-3">Projects</h6>
                </div>
                <button class="btn btn-block btn-lg btn-gradient-primary mt-4">+ Add a project</button>
                <div class="mt-4">
                  <div class="border-bottom">
                    <p class="text-secondary">Categories</p>
                  </div>
                  <ul class="gradient-bullet-list mt-4">
                    <li>Free</li>
                    <li>Pro</li>
                  </ul>
                </div>
              </span>
            </li> -->
          </ul>
        </nav>
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
            <!-- <div class="row" id="proBanner">
              <div class="col-12">
                <span class="d-flex align-items-center purchase-popup">
                  <p>Like what you see? Check out our premium version for more.</p>
                  <a href="https://github.com/BootstrapDash/PurpleAdmin-Free-Admin-Template" target="_blank" class="btn ml-auto download-button">Download Free Version</a>
                  <a href="https://www.bootstrapdash.com/product/purple-bootstrap-4-admin-template/" target="_blank" class="btn purchase-button">Upgrade To Pro</a>
                  <i class="mdi mdi-close" id="bannerClose"></i>
                </span>
              </div>
            </div> -->
            

			<script src="<?php echo base_url() ; ?>assets/vendors/jquery/dist/jquery.min.js"></script>

<script>
	
type = null;
table = null;

Chart.defaults.global.responsive = true;


$(document).ready( function () {
	// $('#menu_toggle').remove();
$( "#loadspin" ).hide();
console.log("consolespined");

getNotifications();
type = "<?php echo $this->session->userdata('acctType')?>";

if(type == "regUser"){

	$("#userType option[value='admin']").remove();
	$("#userType option[value='companyAdmin']").remove();
	$("#userType option[value='stationAdmin']").remove();


	// alert(type);
	$( "#addnew" ).remove();
	$( "#setpcd" ).remove();
	$( "#setkat" ).remove();
	
	$( "#btnAdd" ).remove();

	// alert(21);
	// $( ".rem" ).remove();
	// $( ".fa" ).remove();

	// $("#tblcompanies th:last-child, #tblcompanies td:last-child").remove();
	// $("#tblstations th:last-child, #tblstations td:last-child").remove();
	// $("#tblcontrollers th:last-child, #tblcontrollers td:last-child").remove();
	// $("#tbltanks th:last-child, #tbltanks td:last-child").remove();
	// $("#tblusers th:last-child, #tblusers td:last-child").remove();

}


var href = location.href;
lastthing = href.match(/([^\/]*)\/*$/)[1];
// alert(lastthing); 

switch (lastthing) {
case 'general':

	$("#smenu li:nth-child(1)").addClass("active");

		break;
case 'companymgt':

	$("#smenu li:nth-child(2)").addClass("active");

		break;
	
case "stationmgt":

	$("#smenu li:nth-child(3)").addClass("active");
	
		break;

case "controllermgt":

	$("#smenu li:nth-child(4)").addClass("active");

		break;

case "pumpmgt":

	$("#smenu li:nth-child(5)").addClass("active");
	
		break;
	
	
case "tankmgt":

	$("#smenu li:nth-child(6)").addClass("active");
	
		break;
case "usermgt":

	$("#smenu li:nth-child(7)").addClass("active");
	
		break;

case "settings":

	$("#smenu li:nth-child(8)").addClass("active");

		break;

case "actLog":

	$("#smenu li:nth-child(9)").addClass("active");
 
		break;


}

});

function getNotifications(){
	// ==================================================================

			
			var jqxhr = $.ajax({

						url: '<?php echo base_url() ; ?>index.php/getNotifications/',

						type: 'POST',
						data: {
							
							// num: num
							},


						cache:false,
						error: function(XMLHttpRequest, textStatus, errorThrown) {
								alert(errorThrown);
						},
						

						beforeSend: function () {  

						}            

				})



				.done(function () {

						var response = jqxhr.responseText;
						if (response){
							// alert("Successful");
							// location.reload();
							curr = JSON.parse(response);
							// curr = curr[0];
							// console.log(curr);

							


		 $('#notifCount').html((Number.isInteger(curr.notificationsCount)) ? curr.notificationsCount : 0 );
	
							if(Array.isArray(curr.notifications)){
									nots = curr.notifications;
								
								$('#menu1').empty();

		
								notif = `<h6 class="p-3 mb-0">Notifications</h6>
                <div class="dropdown-divider"></div>`;

								$("#menu1").append(notif);

									_u.forEach(nots, function(value, key) {


										color = 'secondary';
										sev = value.severity;
										if (sev == "High"){
										color = "danger";
										}
										else if (sev == "Medium"){
										color = "warning";
										}
										else if (sev == "Low"){
										color = "secondary";
										}
										

										notif = `<a onclick="deleteNotification('`+value.notification_id+`')" class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <div class="preview-icon bg-`+color+`">
                      <i class="mdi mdi-bell"></i>
                    </div>
                  </div>
                  <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                    <h6 class="preview-subject font-weight-normal mb-1">`+capitalizeFirstLetter(value.company)+`</h6>
                    <p class="text-gray ellipsis mb-0"> `+value.message+` </p>
                  </div>
                </a>
								<div class="dropdown-divider"></div>`;
								
										
										$("#menu1").append(notif);
										
									});
									
								
									notif =`<h6 class="p-3 mb-0 text-center">
									<a href="<?php echo base_url() ; ?>index.php/notifications"> See all notifications </a>
									</h6>`;
									
									$("#menu1").append(notif);

							}

						}
						else{
							alert("Something went wrong")
						}
						// console.log(response);
								
				})



				.fail(function () {

				})


				.always(function () {

				});
	// ==================================================================
}



function capitalizeFirstLetter(string) {
// console.log(string);
if(string){

	return string.charAt(0).toUpperCase() + string.slice(1);
}
else{
	return '';
}
}




function deleteNotification(id){
conf = confirm("Are You Sure You Want to Close This Entry? This Action Cannot Be Undone");
if (conf == false){return false;}

// console.log('deleteDevice/'+id+);


var jqxhr = $.ajax({

url: '<?php echo base_url() ; ?>index.php/deleteNotification/'+id,

data:{},

type: 'POST',

contentType:false,

processData:false,

cache:false,
error: function(XMLHttpRequest, textStatus, errorThrown) {
	alert(errorThrown);
},

beforeSend: function () {  

}            

})


.done(function () {

	var response = jqxhr.responseText;
	if (response)
	{
		// alert("Notification Closed Successfully");
		new PNotify({
																title: 'Success',
																text: 'Notification Closed Successfully!',
																type: 'success',
																styling: 'bootstrap3'
														});
		// location.reload();
		getNotifications();

		loadNotable();
				

	}


	
})

.fail(function () {

alert("failed");

})


.always(function () {

//Do nothing
//   alert("unmeteredenergy_consumed_import working sorta");

});


}

</script>
	
