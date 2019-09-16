<script>


$(document).ready( function () {
	$( "#loadspin" ).hide();

loadDash();


});




 $("#userTypes").change(function () {
	//    alert($('#userTypes').val());
	val = $('#userTypes').val();
	if (val != ""){
		usertypeVal = val;
		loadDash(startPicker, endPicker, usertypeVal, companyVal, stationVal, locationVal);
	}
    });

	$("#stations").change(function () {
	//    alert($('#userTypes').val());
	val = $('#stations').val();
	if (val != ""){
		stationVal = val;
		loadDash(startPicker, endPicker, usertypeVal, companyVal, stationVal, locationVal);
	}
    });
	
	$("#locations").change(function () {
	//    alert($('#userTypes').val());
	val = $('#locations').val();
	if (val != ""){
		locationVal = val;
		loadDash(startPicker, endPicker, usertypeVal, companyVal, stationVal, locationVal);
	}
    });
	
	$("#companies").change(function () {
	//    alert($('#userTypes').val());
	val = $('#companies').val();
	if (val != ""){
		companyVal = val;
		loadDash(startPicker, endPicker, usertypeVal, companyVal, stationVal, locationVal);
	}
    });



$('#dashRange').daterangepicker({
	timePicker: true,
    startDate: moment().subtract(6, 'month').startOf('month').startOf('hour'),
	endDate: moment().startOf('hour'),
    ranges: {
           'Today': [moment(), moment()],
           'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
           'Last 7 Days': [moment().subtract(6, 'days'), moment()],
           'Last 30 Days': [moment().subtract(29, 'days'), moment()],
           'This Month': [moment().startOf('month'), moment().endOf('month')],
           'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
    }
    // locale: {
    //   format: 'YYYY-MM-DD H:mm'
    // }
}, function(start, end, label) {
	console.log("A new date selection was made: " + start.format('YYYY-MM-DD H:mm:ss') + ' to ' + end.format('YYYY-MM-DD H:mm:ss'));
	startPicker =  start.format('YYYY-MM-DD H:mm:ss');
	endPicker =  end.format('YYYY-MM-DD H:mm:ss');
	loadDash(startPicker, endPicker, usertypeVal, companyVal, stationVal, locationVal);

  });


startPicker = null;
endPicker = null;

usertypeVal = null
companyVal = null
stationVal = null
locationVal = null

lineAGO = null;
lineDPK = null;
linePMS = null;
onlineUsers = null;
offlineUsers = null;

respo = null;

function getCoyById(id){
	coy = _u.find(respo.companies, function(o) { return o.company_id == id; });

	// console.log(_u.find(respo.companies, function(o) { return o.company_id == id; }));
	// console.log(id);
	
	rez = null;
	if(id == 0){
		rez  ="Admin";
	}
	else if(id == ""){
		rez = "Not Found";
	}
	else if(coy.length == 0){
		rez = "Not Found";
	}
	else if(coy.length == 1){
		rez = coy[0].name;
		
	}

	return rez;

}

function loadDash(from, to, userType, company, station, location){
	$( "#loadspin" ).show();
	// alert("loaded");
			var jqxhr = $.ajax({

		url: '<?php echo base_url() ; ?>index.php/generalDashLoad/',

		type: 'POST',
		data: {
			
			from:from,
			to:to,
			userType:userType,
			company:company,
			station:station,
			location:location,

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
	
			console.log(JSON.parse(response));
			res = JSON.parse(response);

			respo = res;

			// console.log(res.currVal);

			 $('#coyCount').html((Number.isInteger(res.companyCount)) ? numberWithCommas(res.companyCount) : 0 );
			 $('#iCoyCount').html((Number.isInteger(res.inactiveCompanyCount)) ? numberWithCommas(res.inactiveCompanyCount) + " Inactive" : 0 + " Inactive" );
			 $('#statCount').html((Number.isInteger(res.stationCount)) ? numberWithCommas(res.stationCount) : 0 );
			 $('#iStatCount').html((Number.isInteger(res.inactiveStationCount)) ? numberWithCommas(res.inactiveStationCount) + " Inactive" : 0 + " Inactive" );
			 $('#userCount').html((Number.isInteger(res.userCount)) ? numberWithCommas(res.userCount) : 0 );
			 $('#iUserCount').html((Number.isInteger(res.inactiveUserCount)) ? numberWithCommas(res.inactiveUserCount) + " Inactive" : 0 + " Inactive" );
			 $('#tankCount').html((Number.isInteger(res.tankCount)) ? numberWithCommas(res.tankCount) : 0 );
			 $('#iTankCount').html((Number.isInteger(res.inactiveTankCount)) ? numberWithCommas(res.inactiveTankCount) + " Inactive" : 0 + " Inactive" );
			 $('#devCount').html((Number.isInteger(res.deviceCount)) ? numberWithCommas(res.deviceCount) : 0 );
			 $('#iDevCount').html((Number.isInteger(res.inactiveDeviceCount)) ? numberWithCommas(res.inactiveDeviceCount) + " Inactive" : 0 + " Inactive" );
			 
			 $('#agoVol').html((Number.isInteger(res.AGOvol) || !isNaN(res.AGOvol)) ? numberWithCommas(res.AGOvol.toFixed(2)) : 0 );
			 $('#pmsVol').html((Number.isInteger(res.PMSvol) || !isNaN(res.PMSvol)) ? numberWithCommas(res.PMSvol.toFixed(2)) : 0 );
			 $('#dpkVol').html((Number.isInteger(res.DPKvol) || !isNaN(res.DPKvol)) ? numberWithCommas(res.DPKvol.toFixed(2)) : 0 );


			if(Array.isArray(res.stationsSel)){
				stats = res.stationsSel;
				$('#stations').empty();
				$("#stations").append(`<option value="">Choose Station</option>`);


				_u.forEach(stats, function(val, key) {
					nick = (val.nickname != "") ?  "("+val.nickname+")" : "";
					stat = `
					<option value="`+val.station_id+`">`+capitalizeFirstLetter(val.name)+` `+capitalizeFirstLetter(nick)+`</option>
					`;

					$("#stations").append(stat);
				});

			}
			
			
			if(Array.isArray(res.companiesSel)){
				coys = res.companiesSel;
				$('#companies').empty();
				$("#companies").append(`<option value="">Choose Company</option>`);
				_u.forEach(coys, function(val, key) {
					// nick = (val.nickname != "") ?  "("+val.nickname+")" : "";
					coy = `
					<option value="`+val.company_id+`">`+capitalizeFirstLetter(val.name)+` </option>
					`;

					$("#companies").append(coy);
				});

			}
			
			
			if(Array.isArray(res.userTypesSel)){
				users = res.userTypesSel;
				$('#userTypes').empty();
				$("#userTypes").append(`<option value="">Choose User Type</option>`);
				_u.forEach(users, function(val, key) {
					// nick = (val.nickname != "") ?  "("+val.nickname+")" : "";
					type = val.acctType;
					str = null;
						switch (type) {
							case "admin":
								str = "Admin";
								break;
							case "companyAdmin":
								str = "Company Admin";
								break;
							case "stationAdmin":
								str = "Station Admin";
								break;
							case "regUser":
								str = "Regular Super User";
								break;
							case "regCoyUser":
								str = "Regular Company User";
								break;
							case "regStatUser":
								str = "Regular Station User";
								break;
							default:
								str = "Not Found";
						}

					user = `
					<option value="`+val.acctType+`">`+capitalizeFirstLetter(str)+` </option>
					`;

					$("#userTypes").append(user);
				});

			}
		
		
			if(Array.isArray(res.locationsSel)){
				locs = res.locationsSel;
				$('#locations').empty();
				$("#locations").append(`<option value="">Choose Location</option>`);
				_u.forEach(locs, function(val, key) {
					// nick = (val.nickname != "") ?  "("+val.nickname+")" : "";
					loc = `
					<option value="`+val.location+`">`+capitalizeFirstLetter(val.location)+` </option>
					`;

					$("#locations").append(loc);
				});

			}


		tot = (Number.isInteger(res.companyCount)) ? numberWithCommas(res.companyCount) : 0;
		inact = (Number.isInteger(res.inactiveCompanyCount)) ? numberWithCommas(res.inactiveCompanyCount) :0;

		num = ((tot - inact)/tot)*100;

		num = num.toFixed(2);


		$("#coyBar").css("width", num+"%");
		$('#coyBar').prop('title', num+"% Active");
		$("#coyBar").text(tot-inact +" Active");


		tot = (Number.isInteger(res.stationCount)) ? numberWithCommas(res.stationCount) : 0;
		inact = (Number.isInteger(res.inactiveStationCount)) ? numberWithCommas(res.inactiveStationCount) :0;

		num = ((tot - inact)/tot)*100;
		num = num.toFixed(2);


		$("#statBar").css("width", num+"%");
		$("#statBar").prop('title', num+"%");
		$("#statBar").text(tot-inact +" Active");
	
		tot = (Number.isInteger(res.userCount)) ? numberWithCommas(res.userCount) : 0;
		inact = (Number.isInteger(res.inactiveUserCount)) ? numberWithCommas(res.inactiveUserCount) :0;

		num = ((tot - inact)/tot)*100;
		num = num.toFixed(2);


		$("#userBar").css("width", num+"%");
		$("#userBar").prop('title', num+"%");
		$("#userBar").text(tot-inact +" Active");
		
		tot = (Number.isInteger(res.deviceCount)) ? numberWithCommas(res.deviceCount) : 0;
		inact = (Number.isInteger(res.inactiveDeviceCount)) ? numberWithCommas(res.inactiveDeviceCount) :0;

		num = ((tot - inact)/tot)*100;
		num = num.toFixed(2);


		$("#devBar").css("width", num+"%");
		$("#devBar").prop('title', num+"%");
		$("#devBar").text(tot-inact+" Active");
	
		tot = (Number.isInteger(res.tankCount)) ? numberWithCommas(res.tankCount) : 0;
		inact = (Number.isInteger(res.inactiveTankCount)) ? numberWithCommas(res.inactiveTankCount) :0;

		num = ((tot - inact)/tot)*100;
		num = num.toFixed(2);


		$("#tankBar").css("width", num+"%");
		$("#tankBar").prop('title', num+"%");
		$("#tankBar").text(tot-inact +" Active");


			
			if(Array.isArray(res.pendingApprovals)){
				
				pApps = res.pendingApprovals;

				$('#pendApp').empty();

				_u.forEach(pApps, function(val, key) {

				
				pApp = `	<li  style="max-height:55px">
					<a class="row" style="width:100%">
						<span class="col-md-2 col-sm-2 col-xs-2">
						<i class="fa fa-building-o fa-3x"></i>
						</span>
						<span class="col-md-9 col-sm-9 col-xs-9">
							<b>Company</b>: <i class="pull-right">`+capitalizeFirstLetter(val.name)+`</i>
							<br> 
							<b>Created</b>: <i class="pull-right">`+val.created.slice(0, -3)+`</i>
						
						</span>
						<span class="col-md-1 col-sm-1 col-xs-1">
						<i title="Approve" onclick="toggleApprove('`+val.company_id+`',1)" class="fa fa-check fa-1x text-success"></i>
						<br>
						<i title="Disapprove" onclick="toggleApprove('`+val.company_id+`',0)" class="fa fa-close fa-1x text-danger"></i>

						</span>
					
					</a>
				</li>`;



				$("#pendApp").append(pApp);


				});

				if (pApps.length == 0){
				$("#pendApp").append("<center><i>All Good Here</i></center>");

				}

				

			}





				if(Array.isArray(res.mostActiveUsers)){
				
				maus = res.mostActiveUsers;

				$('#mAUs').empty();

				_u.forEach(maus, function(val, key) {

				
				mau = `		<li  style="max-height:55px">
					<a class="row" style="width:100%">
						<span class="col-md-3 col-sm-3 col-xs-3">
						<i class="fa fa-user fa-3x"></i>
						</span>
						<span class="col-md-9 col-sm-9 col-xs-9">
							<b>User</b>: <i class="pull-right">`+capitalizeFirstLetter(val.user)+`</i>
							<br>
							<b>Company</b>: <i class="pull-right">`+capitalizeFirstLetter(getCoyById(val.company))+`</i>
						
						</span>
					
					</a>
				</li>`;



				$("#mAUs").append(mau);


				});

				if (maus.length == 0){
				$("#mAUs").append("<center><i>All Good Here</i></center>");

				}

				

			}
		






			if(Array.isArray(res.reorders)){

				reorders = res.reorders;

				reorders = _u.sortBy(reorders, [2]);

				console.log(reorders);

				$('#srf').empty();

					_u.forEach(reorders, function(val, key) {
coy = res.companies.filter(comp => comp.company_id == val[3]);
console.log(coy);
coyName = null;
if (typeof coy[0] === 'undefined'){
coyName = "Company";
}
else{
coyName = coy[0].name;

}

// console.log(coy);

					idev = `	<li  style="max-height:55px">
							<a class="row" style="width:100%">
								<span class="col-md-3 col-sm-3 col-xs-3">
								<i class="fa fa-tint fa-3x"></i>
								</span>
								<span class="col-md-9 col-sm-9 col-xs-9">
								<b>Company</b>: <i class="pull-right">`+capitalizeFirstLetter(coyName)+`</i>
								<br> 
								<b>Station</b>: <i class="pull-right">`+capitalizeFirstLetter(val[0])+`</i>
								</span>
							
							</a>
						</li>`;



					$("#srf").append(idev);


					});

					if (reorders.length == 0){
					$("#srf").append("<center><i>All Good Here</i></center>");

					}

				}





		
		
		
			if(Array.isArray(res.recentLogs)){
				
				rlogs = res.recentLogs;

				$('#rLogs').empty();

				_u.forEach(rlogs, function(val, key) {

				
				rlog = `		<li>
					<a>
						<span class="image">
						<i class="fa fa-list"></i>
						</span>
						<span>
							<span>`+val.user+`</span>
							<span class="time">`+val.timestamp+`</span>
						</span>
						<span class="message">
							`+val.activity+`
						</span>
					</a>
				</li>`;



				$("#rLogs").append(rlog);


				});

				if (rlogs.length == 0){
				$("#rLogs").append("<center><i>All Good Here</i></center>");

				}

				

			}



		
			if(Array.isArray(res.inactiveDevices)){
				
				idevs = res.inactiveDevices;

				$('#iDevs').empty();

				_u.forEach(idevs, function(val, key) {

				
				idev = `	<li  style="max-height:55px">
					<a class="row" style="width:100%">
						<span class="col-md-3 col-sm-3 col-xs-3 info-number">
						<i class="fa fa-keyboard-o fa-3x"></i>
						<span class="badge bg-red" >I</span>

						</span>
						<span class="col-md-9 col-sm-9 col-xs-9">
							<b>Device</b>: <i class="pull-right">`+val.contId+`</i>
							<br>
							<b>Station</b>: <i class="pull-right">`+val.statName+`</i>
						
						</span>
						<!--<span class="col-md-1 col-sm-1 col-xs-1">
						<i style="font-size:24px">D1</i>
						</span>-->
					
					</a>
				</li>`;



				$("#iDevs").append(idev);


				});

				if (idevs.length == 0){
				$("#iDevs").append("<center><i>All Good Here</i></center>");

				}

				

			}




			linePMS = Array.isArray(res.pmsSevenLogs) ? res.pmsSevenLogs.reverse() : [];
			// linePMS[2] = 40;
			lineAGO = Array.isArray(res.agoSevenLogs) ? res.agoSevenLogs.reverse() : [];
			// lineAGO[3] = 30;
			lineDPK = Array.isArray(res.dpkSevenLogs) ? res.dpkSevenLogs.reverse() : [];
			// lineDPK[5] = 40;

			loadLineGraph();

			onlineUsers = Number.isInteger(res.userOnline) ? res.userOnline : 0;
			offlineUsers = Number.isInteger(res.userOffline) ? res.userOffline : 0;

			loadPieChart();


			if(locationVal){
			$('#locations').val(locationVal);
			}

			if(usertypeVal){
			$('#userTypes').val(usertypeVal);
			}

			if(stationVal){
			$('#stations').val(stationVal);
			}

			if(companyVal){
			$('#companies').val(companyVal);
			}

// alert(startPicker);
			$( "#lsd" ).html( "");

			if(startPicker){

			$('#dashRange').data('daterangepicker').setStartDate(moment(startPicker).format('MM/DD/YYYY'));
			
			$( "#lsd" ).html( " From "+ moment(startPicker).format('MM/DD/YYYY'));
			
			}
			if(endPicker){
			$('#dashRange').data('daterangepicker').setEndDate(moment(endPicker).format('MM/DD/YYYY'));
			}

	$( "#loadspin" ).hide();
				
		})



		.fail(function () {

		})


		.always(function () {

		});

}





function toggleApprove(id, method){
	
	conf = null;
	
	if(method == 1){
		
		conf = confirm("Are You Sure You Want to Approve This Entry?");

		// url = '<?php echo base_url() ; ?>index.php/approve/'+id;
		
	}
	else if(method == 0){
		conf = confirm("Are You Sure You Want to Disapprove This Entry?");
		
	}

	if (conf == false){return false;}

	// console.log('deleteDevice/'+id+);


	var jqxhr = $.ajax({

	url: '<?php echo base_url() ; ?>index.php/toggleApprove/'+id,

	type: 'POST',
	
	data:{
		method: method
	},


	// contentType:false,

	// processData:false,

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

			if(method){

				// alert("Company Approved Successfully");
				new PNotify({
                                  title: 'Success',
                                  text: 'Company Successfully Approved!',
                                  type: 'success',
                                  styling: 'bootstrap3'
                              });
			}	
			else{
				// alert("Company Disapproved Successfully");
				new PNotify({
                                  title: 'Success',
                                  text: 'Company Successfully Disapproved!',
                                  type: 'success',
                                  styling: 'bootstrap3'
                              });
				
			}
				// location.reload();
				loadDash();
			  	

		}

		console.log(response);


		
	})

	.fail(function () {

	alert("failed");

	})


	.always(function () {

	//Do nothing
	//   alert("unmeteredenergy_consumed_import working sorta");

	});


	

}




function numberWithCommas(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") ? x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") : x;
}


// alert("fish stew");
 
// if ($('#myDashLineChart').length ){	
	function loadLineGraph(){
if ($('#myDashLineChart').length ){	
			
			var ctx = document.getElementById("myDashLineChart");
			var lineChart = new Chart(ctx, {
			type: 'line',
			data: {
				labels: ["7 Days Ago", "6 Days Ago", "5 Days Ago", "4 Days Ago", "3 Days Ago", "2 Days Ago", "1 Day Ago"],
				datasets: [{
				label: "PMS",
				backgroundColor: "rgba(38, 185, 154, 0.31)",
				borderColor: "rgba(38, 185, 154, 0.7)",
				pointBorderColor: "rgba(38, 185, 154, 0.7)",
				pointBackgroundColor: "rgba(38, 185, 154, 0.7)",
				pointHoverBackgroundColor: "#fff",
				pointHoverBorderColor: "rgba(220,220,220,1)",
				pointBorderWidth: 1,
				// data: [31, 74, 6, 39, 20, 85, 7]
				data: linePMS
				}, {
				label: "DPK",
				backgroundColor: "rgba(3, 88, 106, 0.3)",
				borderColor: "rgba(3, 88, 106, 0.70)",
				pointBorderColor: "rgba(3, 88, 106, 0.70)",
				pointBackgroundColor: "rgba(3, 88, 106, 0.70)",
				pointHoverBackgroundColor: "#fff",
				pointHoverBorderColor: "rgba(151,187,205,1)",
				pointBorderWidth: 1,
				// data: [82, 23, 66, 9, 99, 4, 2]
				data: lineDPK

				}, {
				label: "AGO",
				backgroundColor: "rgba(23, 8, 106, 0.3)",
				borderColor: "rgba(23, 8, 106, 0.70)",
				pointBorderColor: "rgba(23, 8, 106, 0.70)",
				pointBackgroundColor: "rgba(23, 8, 106, 0.70)",
				pointHoverBackgroundColor: "#fff",
				pointHoverBorderColor: "rgba(151,187,205,1)",
				pointBorderWidth: 1,
				// data: [18, 30, 16, 91, 9, 34, 42]
				data: lineAGO

				}
			]
			},
			options: { 
				legend:{
					display:true,
					
					},
// // ======================================
// 				legend: {
// 					display: true,
// 					labels: {
// 						fontColor: 'rgb(255, 99, 132)'
// 					}
// 				}
// // ======================================

					
			}
			});
		
		}
		
		}


function loadPieChart(){

					if ($('#myDashOnlineDonut').length ){ 
			  
			  var ctx = document.getElementById("myDashOnlineDonut");
			  var data = {
				labels: [
				  "Online",
				  "Offline"
				],
				datasets: [{
				//   data: [120, 50],
				  data: [onlineUsers, offlineUsers],
				  backgroundColor: [
					"#455C73",
					"#9B59B6"
				  ],
				  hoverBackgroundColor: [
					"#34495E",
					"#B370CF"
				  ]

				}]
			  };

			  var canvasDoughnut = new Chart(ctx, {
				type: 'doughnut',
				tooltipFillColor: "rgba(51, 51, 51, 0.55)",
				data: data
			  });
			 
			} 

} 

</script>
