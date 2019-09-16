<script>

 
 $(document).ready(function(){
    // var name = $( "#name" ).val();
    // loadTanktable();
    getControllers();


	$('#myCurrModal').on('hidden.bs.modal', function(e)
    { 
        $(this).removeData();
    });


	lower = '<?php echo $lowerID?>';

		if(lower){

		loadTanktable(lower);

		}
		else{
			loadTanktable();

		}

});





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

function addMaint(){

if($('#maint').val() == "" || $('#ndate').val() == ""){
	return;
}

now = (new Date).getTime();
maintappend = `<li id="`+now+`"> <b>Type:</b> `+$('#maint').val()+`, <b>Next Due Date:</b> `+$('#ndate').val()+`  <i class="fa fa-minus text-danger" onclick="removeMaint(`+now+`)"></i>  </li>`;
	$("#maints").append(maintappend);

	arrmaint = '{"id":'+now+',"type": "'+$('#maint').val()+'", "date":"'+$('#ndate').val()+'"}';

	arrmaint = JSON.parse(arrmaint);

	maint.push(arrmaint);
console.log(maint);

$('#maint').val("");
$('#ndate').val("");

}


function aaddMaint(){

if($('#amaint').val() == "" || $('#andate').val() == ""){
	return;
}

now = (new Date).getTime();
maintappend = `<li id="`+now+`"> <b>Type:</b> `+$('#amaint').val()+`, <b>Next Due Date:</b> `+$('#andate').val()+`  <i class="fa fa-minus text-danger" onclick="removeMaint(`+now+`)"></i>  </li>`;
	$("#amaints").append(maintappend);

	arrmaint = '{"id":'+now+',"type": "'+$('#amaint').val()+'", "date":"'+$('#andate').val()+'"}';

	arrmaint = JSON.parse(arrmaint);

	amaint.push(arrmaint);
console.log(amaint);
$('#amaint').val("");
$('#andate').val("");

}


function removeMaint(num){
	console.log(num);
	$( "#"+num+"" ).remove();
	console.log(maint);

	maint = maint.filter((value, index, arr)=>{

		return value.id != num;

	});

	console.log(maint);
	
	console.log(amaint);

	amaint = amaint.filter((value, index, arr)=>{

		return value.id != num;

	});

	console.log(amaint);

}






function loadTanktable(name = null)
    {
//datatables
// var id = document.getElementsByClassName("selectpicker");
// var datetime;
// if (id.length > 0) {
//      datetime = id[0].value;
// }
cols = $("#tbltanks").find("thead").find("tr")[0].cells.length;
expArr = [];
cols = cols - 1;

// if(type == "regStatUser"){
// 	 cols = cols + 1;
// }

var i;
for (i = 0; i < cols; i++) { 
  expArr.push(i);
}


    table = $('#tbltanks').DataTable({ 
		"drawCallback": function( settings ) {
			if(type == "regStatUser"){
				$( ".rem" ).remove();
			}
		},
		"initComplete": function(settings, json) {
			// alert( 'DataTables has finished its initialisation.' );
			if(type == "regStatUser"){

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
            "url": "<?php echo base_url() ; ?>index.php/tanks_loadtable/"+name,
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
                title: "<?php echo "tank_".time() ; ?>",
                message: '',
                exportOptions: {
                    columns: expArr
                }
            },
            {
                extend: 'copyHtml5',
                text:      '<i class="fa fa-files-o"></i>',
				titleAttr: 'Copy',
                title: "<?php echo "tank_".time() ; ?>",
                exportOptions: {
                    columns: expArr
                }
            },
            {
                extend: 'excelHtml5',
                text:      '<i class="fa fa-file-excel-o "></i>',
				titleAttr: 'Excel',
                title: "<?php echo "tank_".time() ; ?>",
                exportOptions: {
                    columns: expArr
                }
            },
            {
                extend: 'pdfHtml5',
                 text:      '<i class="fa fa-file-pdf-o"></i>',
				titleAttr: 'PDF',
                title: "<?php echo "tank_".time() ; ?>",
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
	// alert("save add");

	if( $('#aconts').val() == ""){
		alert("Please Select a Controller");
		return;
	}
	if( $('#atname').val() == ""){
		alert("Please Enter Valid Tank Name");
		return;
	}

	if( $('#atnum').val() == ""){
		alert("Please Enter Valid Tank Number");
		return;	
	}
	if( $('#aprod').val() == ""){
		alert("Please Enter Valid Product");
		return;	
	}
	if( $('#avol').val() == ""){
		alert("Please Enter Valid Capacity/Volume");
		return;	
	}
	if( $('#aheight').val() == ""){
		alert("Please Enter Valid Height");
		return;	
	}
	if( $('#athresh').val() == ""){
		alert("Please Enter Valid Tank Threshold");
		return;	
	}
	if( $('#arlevel').val() == ""){
		alert("Please Enter Valid Reorder Level");
		return;	
	}
	

console.log(JSON.stringify(amaint));

// return;


	// return;
	// $('#myAddModal').modal('show');


	var jqxhr = $.ajax({

url: '<?php echo base_url() ; ?>index.php/addTank',

type: 'POST',
data: {
	
	tank_name: $('#atname').val(),
	tank_num: $('#atnum').val(),
	device_id: $('#aconts').val(),
	device_name: $( "#aconts option:selected" ).text(),
	volume: $('#avol').val(),
	height: $('#aheight').val(),
	product: $('#aprod').val(),
	threshold: $('#athresh').val(),
	rlevel: $('#arlevel').val(),
	maint: JSON.stringify(amaint),

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
	// alert("Tank Successfully Added");
	new PNotify({
                                  title: 'Success',
                                  text: 'Tank Successfully Added!',
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

	if( $('#conts').val() == ""){
		alert("Please Select a Controller");
		return;
	}
	if( $('#tname').val() == ""){
		alert("Please Enter Valid Tank Name");
		return;
	}

	if( $('#tnum').val() == ""){
		alert("Please Enter Valid Tank Number");
		return;	
	}
	if( $('#prod').val() == ""){
		alert("Please Enter Valid Product");
		return;	
	}
	if( $('#vol').val() == ""){
		alert("Please Enter Valid Capacity/Volume");
		return;	
	}
	if( $('#height').val() == ""){
		alert("Please Enter Valid Height");
		return;	
	}
	if( $('#thresh').val() == ""){
		alert("Please Enter Valid Tank Threshold");
		return;	
	}
	if( $('#rlevel').val() == ""){
		alert("Please Enter Valid Reorder Level");
		return;	
	}
	

console.log(JSON.stringify(maint));


	var jqxhr = $.ajax({

url: '<?php echo base_url() ; ?>index.php/editTank',

type: 'POST',
data: {
	
	id: $('#keyhidden').val(),
	tank_name: $('#tname').val(),
	tank_num: $('#tnum').val(),
	device_id: $('#conts').val(),
	device_name: $( "#conts option:selected" ).text(),
	volume: $('#vol').val(),
	height: $('#height').val(),
	product: $('#prod').val(),
	threshold: $('#thresh').val(),
	rlevel: $('#rlevel').val(),
	maint: JSON.stringify(maint),
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
	// alert("Tank Successfully Edited");
	new PNotify({
                                  title: 'Success',
                                  text: 'Tank Successfully Edited!',
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




function currData(num,cont){

	if(cont==null){

	getTank(num,"ed");
	}
	else{


			var jqxhr = $.ajax({

			url: '<?php echo base_url() ; ?>index.php/getCurrentTankData/',

			type: 'POST',
			data: {

			id: num,
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

			console.log(response);
			curr = JSON.parse(response);
			


			if (curr == "2" || curr == "3"){
				alert("Data Not Available");
				return;
			}

			else{
				log = JSON.parse(curr.log_decoded);

			console.log(log);
			
			// getTankName = getTank(cid,"getTank");
			console.log(tankName);

				$('#myCurrModal').modal('show');

		// $('#t1').addClass("active");
		// $('#t2').removeClass("active");
		// $('#t3').removeClass("active");
		$('.nav-tabs a:first').tab('show') 


				$('#tankTitle').text("Tank: "+tankName+" ("+num+")");
				$('#ts').text(log.timestamp);
				$('#contr').text(log.stationCode);
				$('#pduct').text(log.fuelType);
				$('#flevel').text(numberWithCommas(parseFloat(log.fuelLevel).toFixed(2))+"(CM)");
				$('#fvol').text(numberWithCommas(parseFloat(log.fuelVol).toFixed(2))+"(Litres)");
				$('#ltype').text(log.funcCode);
				$('#theight').text(numberWithCommas(parseFloat(log.tankHeight).toFixed(2))+"(CM)");
				$('#temp').html(parseFloat(log.temp).toFixed(2)+" <sup>o</sup>C");
				$('#wlevel').text(numberWithCommas(parseFloat(log.waterLevel).toFixed(2))+"(CM)");

				volNow = log.fuelVol;

				// lvl = log.fuelLevel.toString().substring(0,2);
				lvl = log.fuelLevel;
				console.log(lvl)
				lvl = parseInt(lvl);
				console.log(lvl)
				
				// th = log.tankHeight.toString().substring(0,3);
				th = log.tankHeight;
				console.log(th)
				th = parseInt(th);
				console.log(th)

				percent = lvl/th;
				console.log(percent)
				percent = (percent*100).toFixed(2);
				console.log(percent)

				if(percent < 10){
				$('#statBadge').text("L");
				$('#statBadge').css('background-color', 'red');
				$('#statBadge').prop('title', 'Tank Level Low');

				}
				else{
				$('#statBadge').text("H");
				$('#statBadge').css('background-color', 'green');
				$('#statBadge').prop('title', 'Tank Level OK');

				}


					// =============================================================================

				gauge = `<center>
							<svg id="fillgauge5" width="50%" height="200" ></svg>
						</center>`;

				$('#fillg').empty();
				$('#fillg').append( gauge );



					var config4 = liquidFillGaugeDefaultSettings();
    config4.circleThickness = 0.15;
    config4.circleColor = "#808015";
    config4.textColor = "#555500";
    config4.waveTextColor = "#FFFFAA";
    config4.waveColor = "#AAAA39";
    config4.textVertPosition = 0.8;
    config4.waveAnimateTime = 1000;
    config4.waveHeight = 0.05;
    config4.waveAnimate = true;
    config4.waveRise = false;
    config4.waveHeightScaling = false;
    config4.waveOffset = 0.25;
    config4.textSize = 0.75;
    config4.waveCount = 3;
    // var gauge5 = loadLiquidFillGauge("fillgauge5", 60.44, config4);
    var gauge5 = loadLiquidFillGauge("fillgauge5", percent, config4);
	gauge5.update(percent);
				// =============================================================================
				// function NewValue(){
				// 	return percent;
				// }

				// =============================================================================


				getTankLogs(num,cont);
				gettankNotifications(num,cont);
				dailyAvgs(num,cont);

			}

			})



			.fail(function () {

			})


			.always(function () {

			});



	}



}

// percent = null;

// function NewValue(){
// 	return percent;
// }


// $('#myCurrModal').on('hidden.bs.modal', function(e)
//     { 
//         $(this).removeData();
//     }) ;




function calChart(num){
	$('#myCalModal').modal('show');
	$('#tankId').val(num);
	console.log(num);

}


function calBtnClick(){

	 if ($('#upload').get(0).files.length === 0) {
    // console.log("No files selected.");
    return;
    }
    
    r=confirm('Confirm This Operation. If the chart for this tank exists, the old data will be replaced');
    if(r==false){return false ;}; 
    
    var importdata = document.getElementById("importCalibrationForm");

    id = $('#tankId').val();

	var jqxhr = $.ajax({

	url: '<?php echo base_url() ; ?>index.php/calibrationImport/'+id,

	data:new FormData(importdata),

	type: 'POST',

	contentType:false,

	processData:false,

	cache:false,
	error: function(XMLHttpRequest, textStatus, errorThrown) {
		alert(errorThrown);
	},


	beforeSend: function () {  
		// $('.ajaxmsg-body').html('<div style="text-align:center" ><i class="fa fa-spinner fa-spin" style="font-size:30px;"></i><br><strong>Processing...</strong></div>');

		// $('#ajaxmsg').modal('show');
	}            

	})


	.done(function () {

	var response = jqxhr.responseText;
	// alert("Sy");

	console.log(response);

	if (response == 1){
		new PNotify({
                                  title: 'Success',
                                  text: 'Tank Calibration Uploaded Successfully',
                                  type: 'success',
                                  styling: 'bootstrap3'
                              });
	$('#myCalModal').modal('hide');

	} 
	else{
		alert("Something went wrong, Please try again")

	}

		
	})

	.fail(function () {
	//    $('.ajaxmsg-body').html("<h5><i class='fa fa-info-circle'></i> Connection timeout. Check network connection and try again!</h5>");     
	})

	.always(function () {

	//Do nothing
	//   alert("unmeteredenergy_consumed_import working sorta");

	});

}







$('.tankDates').daterangepicker({
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
	getTank(num,null);
	// $('#myModal').modal('show');

}



// ===========================================================
function deleteTankNotification(id){
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
			gettankNotifications(gnum,gcont);
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
function gettankNotifications(num,cont){
		// ==================================================================
		// alert(num);
		// alert(cont);
		gnum = num;
		gcont = cont;
				
				var jqxhr = $.ajax({

							url: '<?php echo base_url() ; ?>index.php/gettankNotifications/',

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
									
									$('#tankNotify').empty();

			
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
														<i style="padding-left:10px" onclick="deleteTankNotification('`+value.notification_id+`')" class="fa fa-close" title="Mark As Closed"></i> 
														</span>
														</span>
														<span class="message">
																`+value.message+`
														</span>
													</a>
												</li>`;
											
											$("#tankNotify").append(notif);
											
										});


										if(nots.length == 0){
											$("#tankNotify").append(`<center>All Good Here</center>`);

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


function getTank(num, edit){

			var jqxhr = $.ajax({

url: '<?php echo base_url() ; ?>index.php/getTank/',

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

$('#tname').val(curr.tank_name);
$('#tnum').val(curr.tank_num);
$('#conts').val(curr.device_id);
$('#vol').val(curr.volume);
$('#height').val(curr.height);
$('#prod').val(curr.product);
$('#thresh').val(curr.threshold);
$('#rlevel').val(curr.rlevel);

maint = [];
$('#maints').empty();


maint = JSON.parse(curr.maint);

console.log(maint);

_u.forEach(maint, function(val, key) {
					// nick = (val.nickname != "") ?  "("+val.nickname+")" : "";
					mt = `
					<li id="`+val.id+`"> <b>Type:</b> `+val.type+`, <b>Next Due Date:</b> `+val.date+`  <i class="fa fa-minus text-danger" onclick="removeMaint(`+val.id+`)"></i>  </li>
					`;

					$("#maints").append(mt);
				});




// console.log(JSON.parse(curr.email));
	// return;


$('#keyhidden').val(curr.tank_id);







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

currData(curr.tank_num,curr.device_id);

}

// console.log(response);
		
})



.fail(function () {

})


.always(function () { 

});


}






function getTankLogs(num,devid){

			var jqxhr = $.ajax({

url: '<?php echo base_url() ; ?>index.php/getTankLogs/',
type: 'POST',
data: {
	num: num,
	devid: devid
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
	// console.log("curr");
	// console.log(curr);

	tsArray = curr.map(x => x.timestamp);
	// console.log(tsArray);
	volArray = curr.map(x => JSON.parse(x.log_decoded).fuelVol);
	// volArray = curr.map(x => JSON.parse(x.log_decoded).fuelLevel);
	// console.log(volArray);


	// ================================================

	var config = {
			type: 'line',
			data: {
				// labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
				labels: tsArray,
				datasets: [{
					label: 'Recent '+tankName +' Logs',
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
					text: 'Tank Historic Trends'
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
							labelString: 'Volume'
						}
					}]
				}
			}
		};

		var ctx = document.getElementById('canvas').getContext('2d');
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

$('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
  var target = $(e.target).attr("href") // activated tab
//   alert(target);

	if(target == "#tab_content1" || target == "#tab_content3"){
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

url: '<?php echo base_url() ; ?>index.php/deleteTank/'+id,

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
	// alert("Tank Successfully Deleted");
	new PNotify({
                                  title: 'Success',
                                  text: 'Tank Successfully Deleted!',
                                  type: 'success',
                                  styling: 'bootstrap3'
                              });
	// location.reload();
//   alert("done");
var name = $( "#name" ).val();
loadTanktable(name);
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

url: '<?php echo base_url() ; ?>index.php/disableTank/'+id,

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
                                  text: 'Tank Successfully Disabled!',
                                  type: 'success',
                                  styling: 'bootstrap3'
                              });
	// location.reload();
//   alert("done");
var name = $( "#name" ).val();
loadTanktable(name);
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

url: '<?php echo base_url() ; ?>index.php/enableTank/'+id,

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
                                  text: 'Tank Successfully Enabled!',
                                  type: 'success',
                                  styling: 'bootstrap3'
                              });
	// location.reload();
//   alert("done");
var name = $( "#name" ).val();
loadTanktable(name);
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
