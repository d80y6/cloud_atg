<script>

// alert("fish stew");
$(document).ready( function () {
	$( "#loadspin" ).hide();

loadDash();


});

 $("#userTypes").change(function () {
	//    alert($('#userTypes').val());
	val = $('#userTypes').val();
	if (val != ""){
		usertypeVal = val;
		loadDash(startPicker, endPicker, usertypeVal);
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
	loadDash(startPicker, endPicker, usertypeVal);

	});






	function loadDash(from, to, userType){
	
	$( "#loadspin" ).show();
		
// alert("loaded");
		var jqxhr = $.ajax({

	url: '<?php echo base_url() ; ?>index.php/generalStation/',

	type: 'POST',
	data: {
		
		from:from,
		to:to,
		userType:userType,
		// company:company,
		// station:station,
		// location:location,

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

		// console.log(response);
		console.log(JSON.parse(response));
		res = JSON.parse(response);

			console.log(res.currVal);


		//  $('#coyCount').html((Number.isInteger(res.companyCount)) ? numberWithCommas(res.companyCount) : 0 );
		//  $('#iCoyCount').html((Number.isInteger(res.inactiveCompanyCount)) ? numberWithCommas(res.inactiveCompanyCount) + " Inactive" : 0 + " Inactive" );
		 $('#statCount').html((Number.isInteger(res.stationCount)) ? numberWithCommas(res.stationCount) : 0 );
		 $('#iStatCount').html((Number.isInteger(res.inactiveStationCount)) ? numberWithCommas(res.inactiveStationCount) + " Inactive" : 0 + " Inactive" );
		 $('#userCount').html((Number.isInteger(res.userCount)) ? numberWithCommas(res.userCount) : 0 );
		 $('#iUserCount').html((Number.isInteger(res.inactiveUserCount)) ? numberWithCommas(res.inactiveUserCount) + " Inactive" : 0 + " Inactive" );
		 $('#tankCount').html((Number.isInteger(res.tankCount)) ? numberWithCommas(res.tankCount) : 0 );
		 $('#iTankCount').html((Number.isInteger(res.inactiveTankCount)) ? numberWithCommas(res.inactiveTankCount) + " Inactive" : 0 + " Inactive" );
		 $('#devCount').html((Number.isInteger(res.deviceCount)) ? numberWithCommas(res.deviceCount) : 0 );
		 $('#iDevCount').html((Number.isInteger(res.inactiveDeviceCount)) ? numberWithCommas(res.inactiveDeviceCount) + " Inactive" : 0 + " Inactive" );
		 
		// $('#agoVol').html((Number.isInteger(res.AGOvol)) ? numberWithCommas(res.AGOvol) : 0 );
		// $('#pmsVol').html((Number.isInteger(res.PMSvol)) ? numberWithCommas(res.PMSvol) : 0 );
		// $('#dpkVol').html((Number.isInteger(res.DPKvol)) ? numberWithCommas(res.DPKvol) : 0 );

		$('#agoVol').html((Number.isInteger(res.AGOvol) || !isNaN(res.AGOvol)) ? numberWithCommas(res.AGOvol.toFixed(2)) : 0 );
		$('#pmsVol').html((Number.isInteger(res.PMSvol) || !isNaN(res.PMSvol)) ? numberWithCommas(res.PMSvol.toFixed(2)) : 0 );
		$('#dpkVol').html((Number.isInteger(res.DPKvol) || !isNaN(res.DPKvol)) ? numberWithCommas(res.DPKvol.toFixed(2)) : 0 );



		if(Array.isArray(res.stations)){
			stats = res.stations;
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
		
		
		// if(Array.isArray(res.companies)){
		// 	coys = res.companies;
		// 	$('#companies').empty();
		// 	$("#companies").append(`<option value="">Choose Company</option>`);
		// 	_u.forEach(coys, function(val, key) {
		// 		// nick = (val.nickname != "") ?  "("+val.nickname+")" : "";
		// 		coy = `
		// 		<option value="`+val.company_id+`">`+capitalizeFirstLetter(val.name)+` </option>
		// 		`;

		// 		$("#companies").append(coy);
		// 	});

		// }
		
		
		if(Array.isArray(res.userTypes)){
			users = res.userTypes;
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
	
	
		if(Array.isArray(res.locations)){
			locs = res.locations;
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


		// tot = (Number.isInteger(res.companyCount)) ? numberWithCommas(res.companyCount) : 0;
		// inact = (Number.isInteger(res.inactiveCompanyCount)) ? numberWithCommas(res.inactiveCompanyCount) :0;

		// num = ((tot - inact)/tot)*100;


		// $("#coyBar").css("width", num+"%");

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
						<b>Company</b>: <i class="pull-right">`+capitalizeFirstLetter(val.company)+`</i>
						<br>
						<b>User</b>: <i class="pull-right">`+capitalizeFirstLetter(val.user)+`</i>
					
					</span>
				
				</a>
			</li>`;



			$("#mAUs").append(mau);


			});

			if (maus.length == 0){
			$("#mAUs").append("<center><i>All Good Here</i></center>");

			}

			

		}
	
	
	
	
		if(Array.isArray(res.recentLogs)){
			
			rlogs = res.recentLogs;

			$('#rLogs').empty();

			_u.forEach(rlogs, function(val, key) {

			
			rlog = `		<li style="background-color:#fafafa;margin-bottom:5px">
				<a>
					<span class="image">
					<i class="fa fa-list text-info"></i>
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

				// <span class="col-md-3 col-sm-3 col-xs-3 info-number">
				// 	<i class="fa fa-keyboard-o fa-3x"></i>
				// 	<span class="badge bg-red" >I</span>

				// 	</span>

			
			idev = `	<li  style="max-height:55px">
				<a class="row" style="width:100%">
					
					<span class="col-md-12 col-sm-12 col-xs-12">
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



		
		if(Array.isArray(res.inactiveTanks)){
			
			idevs = res.inactiveTanks;

			$('#iTanks').empty();

			_u.forEach(idevs, function(val, key) {
				tankstat = (val.status =='inactive') ? 'I' : 'F' ;

						// <span class="col-md-4 col-sm-4 col-xs-4">
						// <i class="fa fa-database fa-3x text-primary"></i>
						// <span class="badge bg-red" style="
						// font-size: 10px;
						// font-weight: 400;
						// line-height: 13px;
						// padding: 2px 6px;
						// position: absolute;
						// right: 30px;
						// top: -1px;"></span>

						// </span>
			
			idev = `	<li  style="max-height:55px; background-color:#fafafa; margin-bottom:5px">
					<a class="row" style="width:100%">
						<span class="col-md-8 col-sm-8 col-xs-8">
							<b>Tank</b>: <i class="pull-right">`+val.tank_name+`</i>
							<br>
							<b>Product</b>: <i class="pull-right">`+val.product+`</i>
						
						
						</span>
					
					
					</a>
				</li>`;



			$("#iTanks").append(idev);


			});

			if (idevs.length == 0){
			$("#iTanks").append("<center><i>All Good Here</i></center>");

			}

			

		}
		
		




		if(Array.isArray(res.sales)){

			// vsbp
			vsppms = res.sales.filter(sale => JSON.parse(sale.log_decoded).fuelType == 'PET');
			vspago = res.sales.filter(sale => JSON.parse(sale.log_decoded).fuelType == 'DIE');
			vspdpk = res.sales.filter(sale => JSON.parse(sale.log_decoded).fuelType == 'DPK');

			// console.log(vsppms);
			// console.log(vspago);
			// console.log(vspdpk);


			pmsvols = vsppms.map(x => JSON.parse(x.log_decoded).fuelVol);
			agovols = vspago.map(x => JSON.parse(x.log_decoded).fuelVol);
			dpkvols = vspdpk.map(x => JSON.parse(x.log_decoded).fuelVol);

			// console.log(agovols);


			pmssum = _u.sum(pmsvols);
			agosum = _u.sum(agovols);
			dpksum = _u.sum(dpkvols);

			$("#vsppms").text(pmssum ? numberWithCommas(pmssum) : 0);
			$("#vspago").text(agosum ? numberWithCommas(agosum) : 0);
			$("#vspdpk").text(dpksum ? numberWithCommas(dpksum) : 0);

		
		}





		
		
		
		if(Array.isArray(res.sales)){
			adspms = res.sales.filter(sale => JSON.parse(sale.log_decoded).fuelType == 'PET');
			adsago = res.sales.filter(sale => JSON.parse(sale.log_decoded).fuelType == 'DIE');
			adsdpk = res.sales.filter(sale => JSON.parse(sale.log_decoded).fuelType == 'DPK');

			_u.forEach(adsago,(val, key)=>{
				val.subDate = val.timestamp.substring(0,10);
			});
			_u.forEach(adspms,(val, key)=>{
				val.subDate = val.timestamp.substring(0,10);
			});
			_u.forEach(adsdpk,(val, key)=>{
				val.subDate = val.timestamp.substring(0,10);
			});


adspmsgrp = _u.groupBy(adspms,'subDate');
adsagogrp = _u.groupBy(adsago,'subDate');
adsdpkgrp = _u.groupBy(adsdpk,'subDate');
agoavgarr = [];
for (var key in adsagogrp) {
	vol = 0;
_u.forEach(adsagogrp[key], (val, key)=>{
 	vol += JSON.parse(val.log_decoded).fuelVol;


}); 

// console.log(vol);
// console.log(adsagogrp[key].length);

vol = vol ? vol : 1;
adsagogrp[key].length = adsagogrp[key].length ? adsagogrp[key].length : 1;

curavg = (vol)/(adsagogrp[key].length);

agoavgarr.push(curavg);

}

agoavg = _u.sum(agoavgarr)/agoavgarr.length;


pmsavgarr = [];
for (var key in adspmsgrp) {
	vol = 0;
_u.forEach(adspmsgrp[key], (val, key)=>{
 	vol += JSON.parse(val.log_decoded).fuelVol;


}); 

// console.log(vol);
// console.log(adspmsgrp[key].length);

vol = vol ? vol : 1;
adspmsgrp[key].length = adspmsgrp[key].length ? adspmsgrp[key].length : 1;

curavg = (vol)/(adspmsgrp[key].length);

pmsavgarr.push(curavg);

}

pmsavg = _u.sum(pmsavgarr)/pmsavgarr.length;


dpkavgarr = [];
for (var key in adsdpkgrp) {
	vol = 0;
_u.forEach(adsdpkgrp[key], (val, key)=>{
 	vol += JSON.parse(val.log_decoded).fuelVol;


}); 

// console.log(vol);
// console.log(adsdpkgrp[key].length);

vol = vol ? vol : 1;
adsdpkgrp[key].length = adsdpkgrp[key].length ? adsdpkgrp[key].length : 1;

curavg = (vol)/(adsdpkgrp[key].length);

dpkavgarr.push(curavg);

}

dpkavg = _u.sum(dpkavgarr)/dpkavgarr.length;
// console.log(adsagogrp);
// console.log(adsdpkgrp);
// console.log(agoavgarr);
// console.log(agoavg);
// console.log(pmsavgarr);
// console.log(pmsavg);
// console.log(dpkavgarr);
// console.log(dpkavg);


$("#adsago").text(agoavg ? numberWithCommas(agoavg) : 0);
$("#adspms").text(pmsavg ? numberWithCommas(pmsavg) : 0);
$("#adsdpk").text(dpkavg ? numberWithCommas(dpkavg) : 0);



	}

 





		if(Array.isArray(res.reorders)){
			
			idevs = res.reorders.slice(-4).reverse();

			$('#rreords').empty();

			_u.forEach(idevs, function(val, key) {

				log = JSON.parse(val.log_decoded) ? JSON.parse(val.log_decoded) : null;

				prod = product(log.fuelType);
				tank = log.tankNum;
				vol = Number.isInteger(log.fuelVol) ? numberWithCommas(log.fuelVol) : log.fuelVol;
			
			idev = `	<li  style="max-height:55px">
					<a class="row" style="width:100%">
						<span class="col-md-3 col-sm-3 col-xs-3">
						<i class="fa fa-tint fa-3x"></i>
						</span>
						<span class="col-md-9 col-sm-9 col-xs-9">
							<b>Product</b>: <i class="pull-right">`+prod+`</i>
							<br> 
							<b>Tank(Vol)</b>: <i class="pull-right">`+tank+`(`+vol+`)</i>
						</span>
					
					</a>
				</li>`;



			$("#rreords").append(idev);


			});

			if (idevs.length == 0){
			$("#rreords").append("<center><i>All Good Here</i></center>");

			}
// ===================================================================


ardpms = res.reorders.filter(reorder => JSON.parse(reorder.log_decoded).fuelType == 'PET');
ardago = res.reorders.filter(reorder => JSON.parse(reorder.log_decoded).fuelType == 'DIE');
arddpk = res.reorders.filter(reorder => JSON.parse(reorder.log_decoded).fuelType == 'DPK');



pmsavgarr = [];
agoavgarr = [];
dpkavgarr = [];
_u.forEach(ardpms,(val, key)=>{
	if(key != 0){
		date1 = new Date(val.timestamp);
		date2 = new Date(ardpms[key-1].timestamp);
		diff = dateDiffInDays(date1,date2);
		pmsavgarr.push(diff);
	}
});

pmsavg = _u.sum(pmsavgarr);
$("#ardpms").text(pmsavg ? numberWithCommas(pmsavg) : 0 );


_u.forEach(ardago,(val, key)=>{
	if(key != 0){
		date1 = new Date(val.timestamp);
		date2 = new Date(ardago[key-1].timestamp);
		diff = dateDiffInDays(date1,date2);
		agoavgarr.push(diff);
	}
});
agoavg = _u.sum(agoavgarr);
$("#ardago").text(agoavg ? numberWithCommas(agoavg) : 0);


			

_u.forEach(arddpk,(val, key)=>{
	if(key != 0){
		date1 = new Date(val.timestamp);
		date2 = new Date(arddpk[key-1].timestamp);
		diff = dateDiffInDays(date1,date2);
		dpkavgarr.push(diff);
	}
});
dpkavg = _u.sum(dpkavgarr);
$("#arddpk").text(dpkavg ? numberWithCommas(dpkavg) : 0);

			

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




		if(usertypeVal){
		$('#userTypes').val(usertypeVal);
		}
		
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



const _MS_PER_DAY = 1000 * 60 * 60 * 24;

// a and b are javascript Date objects
function dateDiffInDays(a, b) {
  // Discard the time and time-zone information.
  const utc1 = Date.UTC(a.getFullYear(), a.getMonth(), a.getDate());
  const utc2 = Date.UTC(b.getFullYear(), b.getMonth(), b.getDate());

  return Math.abs(Math.floor((utc2 - utc1) / _MS_PER_DAY));
}

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



function numberWithCommas(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") ? x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") : x;
} 


function product(y){
	str = null;
						switch (y) {
							case "DIE":
								str = "AGO";
								break;
							case "PET":
								str = "PMS";
								break;
							case "KER":
								str = "DPK";
								break;
						
							default:
								str = "";
						}

						return str;
}




function loadLineGraph(){
if ($('#myDashLineChart').length ){	
			
			var ctx = document.getElementById("myDashLineChart");
			var lineChart = new Chart(ctx, {
			type: 'line',
			data: {
				labels: ["7 Days Ago", "6 Days Ago", "5 Days Ago", "4 Days Ago", "3 Days Ago", "2 Days Ago", "1 Day Ago"],
				datasets: [{
				label: "PMS",
				backgroundColor: "rgba(25, 138, 227, 0.31)",
				borderColor: "rgba(25, 138, 227, 0.7)",
				pointBorderColor: "rgba(25, 138, 227, 0.7)",
				pointBackgroundColor: "rgba(25, 138, 227, 0.7)",
				pointHoverBackgroundColor: "#fff",
				pointHoverBorderColor: "rgba(220,220,220,1)",
				pointBorderWidth: 1,
				// data: [31, 74, 6, 39, 20, 85, 7]
				data: linePMS
				}, {
				label: "DPK",
				backgroundColor: "rgba(254, 124, 150, 0.3)",
				borderColor: "rgba(254, 124, 150, 0.70)",
				pointBorderColor: "rgba(254, 124, 150, 0.70)",
				pointBackgroundColor: "rgba(254, 124, 150, 0.70)",
				pointHoverBackgroundColor: "#fff",
				pointHoverBorderColor: "rgba(151,187,205,1)",
				pointBorderWidth: 1,
				// data: [82, 23, 66, 9, 99, 4, 2]
				data: lineDPK

				}, {
				label: "AGO",
				backgroundColor: "rgba(254, 215, 19, 0.3)",
				borderColor: "rgba(254, 215, 19, 0.70)",
				pointBorderColor: "rgba(254, 215, 19, 0.70)",
				pointBackgroundColor: "rgba(254, 215, 19, 0.70)",
				pointHoverBackgroundColor: "#fff",
				pointHoverBorderColor: "rgba(151,187,205,1)",
				pointBorderWidth: 1,
				// data: [18, 30, 16, 91, 9, 34, 42]
				data: lineAGO

				}
			]
			},
			options: { 
					// legend: true, 
					legend:{
					display:true,
					
					},
					// responsive: false 
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
