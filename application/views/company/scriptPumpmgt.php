<script>

 
 $(document).ready(function(){
    // var name = $( "#name" ).val();
    
    getStations();


	$('#myCurrModal').on('hidden.bs.modal', function(e)
    { 
        $(this).removeData();
    });

	currVolData(moment().startOf('month').startOf('day').format('YYYY-MM-DD H:mm:ss'), moment().startOf('hour').format('YYYY-MM-DD H:mm:ss'));

	loadPumptable();
	

});

startPickerl = moment().startOf('month').startOf('day').format('YYYY-MM-DD H:mm:ss');
  endPickerl = moment().startOf('hour').format('YYYY-MM-DD H:mm:ss');


$('.pumpRangeLand').daterangepicker({
	timePicker: true,
    startDate: moment().startOf('month').startOf('day'),
	endDate: moment().startOf('hour'),
    ranges: {
	       'Today': [moment().startOf('day'), moment()],
           'Yesterday': [moment().subtract(1, 'days').startOf('day'), moment().subtract(1, 'days').endOf('day')],
           'This Week': [moment().startOf('isoWeek'), moment()],
           'This Month': [moment().startOf('month'), moment()],
           'This Quarter': [moment().startOf('quarter'), moment()],
           'This Year': [moment().startOf('year'), moment()],
           'Last Week': [ moment().startOf('isoweek').subtract(1, 'days').startOf('isoWeek'),  moment().startOf('isoweek').subtract(1, 'days').endOf('isoWeek')],
           'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
           'Last Quarter': [moment().subtract(1, 'quarter').startOf('quarter'), moment().subtract(1, 'quarter').endOf('quarter')],
           'Last Year': [moment().subtract(1, 'year').startOf('year'), moment().subtract(1, 'year').endOf('year')]
    },
    locale: {
      format: 'DD/MM/YYYY'
    }
}, function(start, end, label) {
	console.log("A new date selection was made: " + start.format('YYYY-MM-DD H:mm:ss') + ' to ' + end.format('YYYY-MM-DD H:mm:ss'));
	startPickerl =  start.format('YYYY-MM-DD H:mm:ss');
	endPickerl =  end.format('YYYY-MM-DD H:mm:ss');
	// getPumpLogs(filternum,startPicker,endPicker);
	currVolData(startPickerl,endPickerl);

  });

 


$('.pumpRange').daterangepicker({
	timePicker: true,
    startDate: moment().subtract(1, 'month').startOf('month').startOf('hour'),
	endDate: moment().startOf('hour'),
    ranges: {
	       'Today': [moment().startOf('day'), moment()],
           'Yesterday': [moment().subtract(1, 'days').startOf('day'), moment().subtract(1, 'days').endOf('day')],
           'This Week': [moment().startOf('isoWeek'), moment()],
           'This Month': [moment().startOf('month'), moment()],
           'This Quarter': [moment().startOf('quarter'), moment()],
           'This Year': [moment().startOf('year'), moment()],
           'Last Week': [ moment().startOf('isoweek').subtract(1, 'days').startOf('isoWeek'),  moment().startOf('isoweek').subtract(1, 'days').endOf('isoWeek')],
           'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
           'Last Quarter': [moment().subtract(1, 'quarter').startOf('quarter'), moment().subtract(1, 'quarter').endOf('quarter')],
           'Last Year': [moment().subtract(1, 'year').startOf('year'), moment().subtract(1, 'year').endOf('year')]
    },
    locale: {
      format: 'DD/MM/YYYY'
    }
}, function(start, end, label) {
	console.log("A new date selection was made: " + start.format('YYYY-MM-DD H:mm:ss') + ' to ' + end.format('YYYY-MM-DD H:mm:ss'));
	startPicker =  start.format('YYYY-MM-DD H:mm:ss');
	endPicker =  end.format('YYYY-MM-DD H:mm:ss');
	// getPumpLogs(filternum,startPicker,endPicker);
	currData(filternum, null,startPicker,endPicker);

  });




// ===========================


$( "#stations" ).change(function() {
// alert(startPickerl);
// alert(endPickerl);

	currVolData(startPickerl,endPickerl,$( "#stations" ).val());

	loadPumptable($( "#stations" ).val());

});
// ===========================



  function getStations(){

var jqxhr = $.ajax({

url: '<?php echo base_url() ; ?>index.php/getStations/',

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




			if(Array.isArray(curr)){
				stats = curr;
				$('#stations').empty();
				// $('#astations').empty();

				$("#stations").append(`<option value="">All Stations</option>`);
				// $("#astations").append(`<option value="">Choose Station</option>`);


				_u.forEach(stats, function(val, key) {
					nick = (val.nickname != "") ?  "("+val.nickname+")" : "";
					stat = `
					<option value="`+val.station_id+`">`+capitalizeFirstLetter(val.name)+` </option>
					`;

					// $("#astations").append(stat);
					$("#stations").append(stat);
				});

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


}






function getControllers(){

var jqxhr = $.ajax({

url: '<?php echo base_url() ; ?>index.php/getControllers/',

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




			if(Array.isArray(curr)){
				conts = curr;
				$('#conts').empty();
				$('#aconts').empty();

				$("#conts").append(`<option value="">Choose Controller*</option>`);
				$("#aconts").append(`<option value="">Choose Controller*</option>`);


				_u.forEach(conts, function(val, key) {
					cont = `
					<option value="`+val.Source_id+`">`+capitalizeFirstLetter(val.contName)+` </option>
					`;

					$("#conts").append(cont);
					$("#aconts").append(cont);
				});

			}



}
else{
alert("Something went wrong")
}
console.log(response);

})



.fail(function () {

})


.always(function () {

});


}



maint = [];
amaint = [];



function loadPumptable(stat = null)
    {
//datatables
// var id = document.getElementsByClassName("selectpicker");
// var datetime;
// if (id.length > 0) {
//      datetime = id[0].value;
// }
cols = $("#tblpumps").find("thead").find("tr")[0].cells.length;
expArr = [];
cols = cols - 1;

// if(type == "regUser"){
// 	 cols = cols + 1;
// }

var i;
for (i = 0; i < cols; i++) { 
  expArr.push(i);
}


    table = $('#tblpumps').DataTable({ 
		"drawCallback": function( settings ) {
			if(type == "regUser"){
				$( ".rem" ).remove();
			}
		},
		"initComplete": function(settings, json) {
			// alert( 'DataTables has finished its initialisation.' );
			if(type == "regUser"){

				$( ".rem" ).remove();
			}

		},
        "destroy": true,
           "dom": '<"pull-left"B><"pull-left bb"l><"bb "f>rt<"pull-left"i><"pull-right"<"#bb"p>>',
       "pageLength": 25,
         lengthMenu: [[1, 10, 25, 50, 100, 500, 1000], [1, 10, 25, 50, 100, 500, 1000]],
   
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [ ], //Initial no order.
        // Load data for the table's content from an Ajax source
        
        "ajax": {
            "url": "<?php echo base_url() ; ?>index.php/pumps_loadtable/"+stat,
            "type": "POST"
        },
        //Set column definition initialisation properties.
        "columnDefs": [
        { 
            "targets": [ ], //first column / numbering column
            "orderable": true, //set not orderable
        },
        ],
        buttons: [
           {
                extend: 'print',
                text:      '<i class="fa fa-print"></i>',
				titleAttr: 'Print',
                title: "<?php echo "pump_".time() ; ?>",
                message: '',
                exportOptions: {
                    columns: expArr
                }
            },
            {
                extend: 'copyHtml5',
                text:      '<i class="fa fa-files-o"></i>',
				titleAttr: 'Copy',
                title: "<?php echo "pump_".time() ; ?>",
                exportOptions: {
                    columns: expArr
                }
            },
            {
                extend: 'excelHtml5',
                text:      '<i class="fa fa-file-excel-o "></i>',
				titleAttr: 'Excel',
                title: "<?php echo "pump_".time() ; ?>",
                exportOptions: {
                    columns: expArr
                }
            },
            {
                extend: 'pdfHtml5',
                 text:      '<i class="fa fa-file-pdf-o"></i>',
				titleAttr: 'PDF',
                title: "<?php echo "pump_".time() ; ?>",
                exportOptions: {
                    columns: expArr
                }
            },
            
            'colvis'
        ]


       
    });

    }





function IsEmail(email) {
  var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  if(!regex.test(email)) {
    return false;
  }else{
    return true;
  }
}



function addBtnClick(){
	
	if( $('#apman').val() == ""){
		alert("Please Enter Valid Pump Manufacturer");
		return;
	}
	if( $('#apmod').val() == ""){
		alert("Please Enter Valid Pump Model");
		return;
	}
	if( $('#apalias').val() == ""){
		alert("Please Enter Valid Pump Alias (Can be the same as name)");
		return;
	}
	if( $('#apname').val() == ""){
		alert("Please Enter Valid Pump Name");
		return;
	}

	
	if( $('#aprod').val() == ""){
		alert("Please Enter Valid Product");
		return;	
	}
	
	if( $('#astations').val() == ""){
		alert("Please Select A Station");
		return;	
	}


	// return;
	// $('#myAddModal').modal('show');


	var jqxhr = $.ajax({

url: '<?php echo base_url() ; ?>index.php/addPump',

type: 'POST',
data: {
	
	pump_name: $('#apname').val(),
	pname: $('#apalias').val(),
	model: $('#apmod').val(),
	manufacturer: $('#apman').val(),
	station: $('#astations').val(),
	product: $('#aprod').val(),
	// product: $('#prod').val(),
	

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
console.log(response);

if (response == 1){
	
	new PNotify({
                                  title: 'Success',
                                  text: 'Pump Successfully Added!',
                                  type: 'success',
                                  styling: 'bootstrap3'
                              });
							  setTimeout(function(){
									location.reload();
								}, 3000); 

}
else if(response == 2){
	alert("Something went wrong")
}
console.log(response);
		
})



.fail(function () {

})


.always(function () {

});
// ==================================================


}



function editBtnClick(){
	// alert("save add");

	if( $('#pman').val() == ""){
		alert("Please Enter Valid Pump Manufacturer");
		return;
	}
	if( $('#pmod').val() == ""){
		alert("Please Enter Valid Pump Model");
		return;
	}
	if( $('#palias').val() == ""){
		alert("Please Enter Valid Pump Alias (Can be the same as name)");
		return;
	}
	if( $('#pname').val() == ""){
		alert("Please Enter Valid Pump Name");
		return;
	}

	
	if( $('#prod').val() == ""){
		alert("Please Enter Valid Product");
		return;	
	}
	
	if( $('#stations').val() == ""){
		alert("Please Select A Station");
		return;	
	}
	


	var jqxhr = $.ajax({

url: '<?php echo base_url() ; ?>index.php/editPump',

type: 'POST',
data: {
	
	id: $('#keyhidden').val(),
	pump_name: $('#pname').val(),
	pname: $('#palias').val(),
	model: $('#pmod').val(),
	manufacturer: $('#pman').val(),
	station: $('#stations').val(),
	product: $('#prod').val(),
	// product: $('#prod').val(),
	

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
console.log(response);

if (response == 1){
	
	new PNotify({
                                  title: 'Success',
                                  text: 'Pump Successfully Edited!',
                                  type: 'success',
                                  styling: 'bootstrap3'
                              });
							  setTimeout(function(){
									location.reload();
								}, 3000); 

}
else if(response == 2){
	alert("Something went wrong")
}
console.log(response);
		
})



.fail(function () {

})


.always(function () {

});
// ==================================================


}



function numberWithCommas(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") ? x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") : x;
}





function calChart(num){
	$('#myCalModal').modal('show');
	$('#tankId').val(num);
	console.log(num);

}








$('.pumpDates').daterangepicker({
	timePicker: false,
	singleDatePicker: true,
    startDate: moment().startOf('month'),
	// endDate: moment().startOf('hour'),
    // ranges: {
    //        'Today': [moment(), moment()],
    //        'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
    //        'Last 7 Days': [moment().subtract(6, 'days'), moment()],
    //        'Last 30 Days': [moment().subtract(29, 'days'), moment()],
    //        'This Month': [moment().startOf('month'), moment().endOf('month')],
    //        'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
    // }
    // locale: {
    //   format: 'YYYY-MM-DD H:mm'
    // }
}, function(start, end, label) {
	console.log("A new date selection was made: " + start.format('YYYY-MM-DD H:mm:ss') + ' to ' + end.format('YYYY-MM-DD H:mm:ss'));
	startPicker =  start.format('YYYY-MM-DD H:mm:ss');
	endPicker =  end.format('YYYY-MM-DD H:mm:ss');
	// loadDash(startPicker, endPicker, usertypeVal, companyVal, stationVal, locationVal);

  });








function edit(num){
	getPump(num,null);
	// $('#myModal').modal('show');

}



// ===========================================================
function deletePumpNotification(id){
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
			console.log(response);
			// alert("Notification Closed Successfully");
			new PNotify({
                                  title: 'Success',
                                  text: 'Notification Closed Successfully!',
                                  type: 'success',
                                  styling: 'bootstrap3'
                              });
			// location.reload();
			getpumpNotifications(gnum,gcont);
			getNotifications();

			  	

		}


		
	})

	.fail(function () {

	alert("failed");

	})


	.always(function () {

	

	});


	}
// ===========================================================
gnum = null;
gcont = null;
// ===========================================================
function getpumpNotifications(num,cont){
		// ==================================================================
		// alert(num);
		// alert(cont);
		gnum = num;
		gcont = cont;
				
				var jqxhr = $.ajax({

							url: '<?php echo base_url() ; ?>index.php/getpumpNotifications/',

							type: 'POST',
							data: {
								
								num: num,
								cont: cont
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
								curr = JSON.parse(response);
								console.log(curr);
// alert(curr)
			//  $('#notifCount').html((Number.isInteger(curr.notificationsCount)) ? curr.notificationsCount : 0 );
		
								if(Array.isArray(curr)){
										nots = curr;
									
									$('#pumpNotify').empty();

			
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
											

										notif = ` <li>
													<a>
														<span class="image">
															<i title="`+sev+` Priority" class="fa fa-bell text-`+color+`"></i>
														</span>
														<span>
														<span>`+capitalizeFirstLetter(value.company)+`</span>
														<span class="time" style="padding-right:10px">`+value.created+` 
														<i style="padding-left:10px" onclick="deletePumpNotification('`+value.notification_id+`')" class="fa fa-close" title="Mark As Closed"></i> 
														</span>
														</span>
														<span class="message">
																`+value.message+`
														</span>
													</a>
												</li>`;
											
											$("#pumpNotify").append(notif);
											
										});


										if(nots.length == 0){
											$("#pumpNotify").append(`<center>All Good Here</center>`);

										}

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
// ===========================================================



function dailyAvgs(num,cont){
		// ==================================================================
		// alert(num);
		// alert(cont);
		gnum = num;
		gcont = cont;
				
			var jqxhr = $.ajax({

						url: '<?php echo base_url() ; ?>index.php/dailyAvgs/',

						type: 'POST',
						data: {
							
							num: num,
							cont: cont
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
							console.log(response)
							$('#dailyUsage').html(parseInt(response));

							curres = parseInt(response);
							dailyUsage = (curres > 0) ? curres : 1;

							volNow = volNow ? volNow : 1;

							daysDiff = volNow/dailyUsage;

							daysDiff = Math.floor(daysDiff);

							// nxrreorder = moment().add(daysDiff, 'days').format('DD/MM');
							nxrreorder = moment().add(daysDiff, 'days');


							
						
						// reordDate = null;                                                                    
							$('#nxtReord').html(nxrreorder.format('DD/MM'));
							$('#nxtReord').prop('title', nxrreorder.format('DD/MM/YYYY'));


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

	volNow = null;
	dailyUsage = null;
// ===========================================================


function getPump(num, edit){

			var jqxhr = $.ajax({

url: '<?php echo base_url() ; ?>index.php/getPump/',

type: 'POST',
data: {
	
	num: num
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



if(edit == null){


if (response){
	// alert("Successful");
	// location.reload();
	curr = JSON.parse(response);
	curr = curr[0];
	console.log(curr);



$('#myModal').modal('show');

$('#pname').val(curr.pump_name);
$('#palias').val(curr.pname);
$('#prod').val(curr.product);
$('#pmod').val(curr.model);
$('#pman').val(curr.manufacturer);
$('#stations').val(curr.station);


$('#keyhidden').val(curr.pID);







}
else{
	alert("Something went wrong")
}

}
else{


console.log(response);
curr = JSON.parse(response);
curr = curr[0];
tankName = curr.tank_name;

// currData(curr.tank_num,curr.device_id);

}

// console.log(response);
		
})



.fail(function () {

})


.always(function () { 

});


}



filternum = null;
filterdev = null;





function currData(num,cont,st,en){

console.log("currData");

var jqxhr = $.ajax({

url: '<?php echo base_url() ; ?>index.php/getCurrentPumpData/',

type: 'POST',
data: {

id: num,
st:st,
en:en,

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
curr = JSON.parse(response);


if (curr == "2" || curr == "3"){
	alert("Data Not Available");
	return;
}

else{
	// log = JSON.parse(curr.log_decoded);

	$('#pumpTitle').text("Current Pump Data");


	v = JSON.parse(response);

// console.log(v);
st = (st == null) ? moment().subtract(1, 'month').startOf('month').startOf('hour').format('YYYY-MM-DD H:mm:ss') : st;
en = (en == null) ? moment().format('YYYY-MM-DD H:mm:ss') : en;



trow = `<tr>
		
		<td>#</td>
		<td>DateTime</td>
		<td>Opening Read</td>
		<td>Closing Read</td>
		<td>Volume Dispensed(Ltrs)</td>
		
		</tr>
		`;

	$('#plogsh').html(trow);


	trow = ``;
		


	_u.forEach(v, function(val, key) {

		console.log(val);

		trow += `<tr>
		
		<td>`+(key+1)+`</td>
		<td>`+JSON.parse(val['pump_data'])['datetime']+`</td>
		<td>`+numberWithCommas(JSON.parse(val['pump_data'])['openingRead'].toFixed(2))+`</td>
		<td>`+numberWithCommas(JSON.parse(val['pump_data'])['closingRead'].toFixed(2))+`</td>
		<td>`+numberWithCommas(JSON.parse(val['pump_data'])['volDisp'].toFixed(2))+`</td>
		
		</tr>
		`;

	});


	$('#plogs').html(trow);

	$('#plogTab').DataTable(
	// 	{
	// 	"dom": '<"pull-left"><"pull-left bb"l><"bb "f>rt<"pull-left"i><"pull-right"<"#bb"p>>',

	// }
	);


	$('#myCurrModal').modal('show');


getPumpLogs(num,st,en);



}

})



.fail(function () {

})


.always(function () {

});


}



function currVolData(st,en,stat){

console.log("currVolData");

var jqxhr = $.ajax({

url: '<?php echo base_url() ; ?>index.php/getCurrentStatPumpData/',

type: 'POST',
data: {

st:st,
en:en,

stat: stat,

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

console.log(response);
curr = JSON.parse(response);


// if (curr == "2" || curr == "3"){
// 	alert("Data Not Available");
// 	return;
// }

// else{
	// log = JSON.parse(curr.log_decoded);

	


	v = JSON.parse(response);



	ptvpst = v['pms'].toFixed(2);
	ptvps = numberWithCommas(ptvpst);

	$('#ptvps').text(ptvps);

	atvpst = v['ago'].toFixed(2);
	atvps = numberWithCommas(atvpst);

	$('#atvps').text(atvps);

	dtvpst = v['dpk'].toFixed(2);
	dtvps = numberWithCommas(dtvpst);

	$('#dtvps').text(dtvps);


	$('.vdrange').text("Between: "+ st +" to "+en );




// console.log(v);
// st = (st == null) ? moment().subtract(1, 'month').startOf('month').startOf('hour').format('YYYY-MM-DD H:mm:ss') : st;
// en = (en == null) ? moment().format('YYYY-MM-DD H:mm:ss') : en;


// }

})



.fail(function () {

})


.always(function () {

});


}





function getPumpLogs(num,from,to){

	filternum = num;
// filterdev = devid;

			var jqxhr = $.ajax({

url: '<?php echo base_url() ; ?>index.php/getPumpLogs/',
type: 'POST',
data: {
	num: num,
	// devid: devid,
	from:from,
	to:to
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
console.log(response);
if (response){

	curr = JSON.parse(response);
	// console.log("curr");
	console.log(curr);

	tvpst = _u.sum(curr.map(x => JSON.parse(x.pump_data).volDisp)).toFixed(2);
	tvps = numberWithCommas(tvpst);

	$('#tvps').text(tvps);

	tnott = curr.map(x => JSON.parse(x.pump_data).volDisp).length;
	tnot = numberWithCommas(tnott);

	$('#tnot').text(tnot);

	alptt = isNaN(parseInt(tvpst)/parseInt(tnott)) ? 0 : (parseInt(tvpst)/parseInt(tnott)).toFixed(2);
	alpt = numberWithCommas(alptt);

	$('#alpt').text(alpt);

	tsArray = curr.map(x => JSON.parse(x.pump_data).datetime);
	// console.log(tsArray);
	// volArray = curr.map(x => JSON.parse(x.log_decoded).probeFuelVol);
	volArray = curr.map(x => JSON.parse(x.pump_data).volDisp);
	// console.log(volArray);

volArray = volArray.reverse();
tsArray = tsArray.reverse();
	// ================================================

	var config = {
			type: 'line',
			data: {
				// labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
				labels: tsArray,
				datasets: [{
					label: 'Recent Logs',
					fill: false,
					backgroundColor: window.chartColors.blue,
					borderColor: window.chartColors.blue,
					data: volArray,
				}]
			},
			options: {
				responsive: true,
				title: {
					display: false,
					text: 'Pump Historic Trends'
				},
				tooltips: {
					mode: 'index',
					intersect: false,
				},
				hover: {
					mode: 'nearest',
					intersect: true
				},
				scales: {
					xAxes: [{
						display: true,
						scaleLabel: {
							display: true,
							labelString: 'Timestamps'
						}
					}],
					yAxes: [{
						display: true,
						scaleLabel: {
							display: true,
							labelString: 'Volume Dispensed'
						}
					}]
				}
			}
		};

		canvas = document.getElementById('canvas');

		var ctx = document.getElementById('canvas').getContext('2d');

		ctx.clearRect(0, 0, canvas.width, canvas.height);

		var chart = new Chart(ctx, config);

		

	// ================================================


}
else{
	alert("Something went wrong")
}
		
})

.fail(function () {
})

.always(function () {
});

}

tsArray = [];
volArray = [];


tankName = null;


// $( "#myCurrModal" ).on('shown', function(){
// 	var target = $(e.target).attr("href") // activated tab

// 	if( target == "#tab_content1"){
// 		$('#modDial').addClass("modal-lg");
// 	}

// });



$('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
  var target = $(e.target).attr("href") // activated tab
//   alert(target);

	if( target == "#tab_content3"){
		$('#modDial').removeClass("modal-lg");
	}
	else{
		$('#modDial').addClass("modal-lg");
	}


});

window.chartColors = {
	red: 'rgb(255, 99, 132)',
	orange: 'rgb(255, 159, 64)',
	yellow: 'rgb(255, 205, 86)',
	green: 'rgb(75, 192, 192)',
	blue: 'rgb(54, 162, 235)',
	purple: 'rgb(153, 102, 255)',
	grey: 'rgb(201, 203, 207)'
};


function addNew(){
	// alert("add");
	$('#myAddModal').modal('show');

}




function confirmDelete(id){

conf = confirm("Are you sure you want to delete this? This action cannot be undone");
if (conf == false){return false;}

// console.log('deleteDevice/'+id+);


var jqxhr = $.ajax({

url: '<?php echo base_url() ; ?>index.php/deletePump/'+id,

data:{},

type: 'POST',

contentType:false,

processData:false,

cache:false,
error: function(XMLHttpRequest, textStatus, errorThrown) {
    alert(errorThrown);
},


beforeSend: function () {  

    // alert("unmeteredenergy_consumed_import working sorta");


}            

})


.done(function () {
	var response = jqxhr.responseText;
console.log(response);

if (response == 1){
	
	new PNotify({
                                  title: 'Success',
                                  text: 'Pump Successfully Deleted!',
                                  type: 'success',
                                  styling: 'bootstrap3'
                              });
	// location.reload();
//   alert("done");
var name = $( "#name" ).val();
loadPumptable(name);
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









	
	function disable(id){
conf = confirm("Are you sure you want to disable this?");
if (conf == false){return false;}

// console.log('deleteDevice/'+id+);


var jqxhr = $.ajax({

url: '<?php echo base_url() ; ?>index.php/disablePump/'+id,

data:{},

type: 'POST',

contentType:false,

processData:false,

cache:false,
error: function(XMLHttpRequest, textStatus, errorThrown) {
    alert(errorThrown);
},


beforeSend: function () {  

    // alert("unmeteredenergy_consumed_import working sorta");


}            

})


.done(function () {
	var response = jqxhr.responseText;
console.log(response);

if (response == 1){
	// alert("Company Successfully Deleted");
	new PNotify({
                                  title: 'Success',
                                  text: 'Pump Successfully Disabled!',
                                  type: 'success',
                                  styling: 'bootstrap3'
                              });
	// location.reload();
//   alert("done");
var name = $( "#name" ).val();
loadPumptable(name);
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



function enable(id){
conf = confirm("Are you sure you want to enable this?");
if (conf == false){return false;}

// console.log('deleteDevice/'+id+);


var jqxhr = $.ajax({

url: '<?php echo base_url() ; ?>index.php/enablePump/'+id,

data:{},

type: 'POST',

contentType:false,

processData:false,

cache:false,
error: function(XMLHttpRequest, textStatus, errorThrown) {
    alert(errorThrown);
},


beforeSend: function () {  

    // alert("unmeteredenergy_consumed_import working sorta");


}            

})


.done(function () {
	var response = jqxhr.responseText;
console.log(response);

if (response == 1){
	// alert("Company Successfully Deleted");
	new PNotify({
                                  title: 'Success',
                                  text: 'Pump Successfully Enabled!',
                                  type: 'success',
                                  styling: 'bootstrap3'
                              });
	// location.reload();
//   alert("done");
var name = $( "#name" ).val();
loadPumptable(name);
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
