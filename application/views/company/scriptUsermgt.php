<script>

 
 $(document).ready(function(){
    // var name = $( "#name" ).val();
    // loadUsertable();
    getStations();
    getCompanies();

	lower = '<?php echo $lowerID?>';

		if(lower){

		loadUsertable(lower);

		}
		else{
			loadUsertable();

		}

	$("#acoys").hide();
	$("#astations").hide(); 
	$("#coys").hide();
	$("#stations").hide(); 

});





$( "#userType" ).change(function() {
// alert($("#auserType").val());
// alert(1);
$("#coys").hide();
	$("#stations").hide(); 
val = $("#userType").val();
console.log(val);
	

	if((val != "") && (val != "admin") && (val != "regUser")){
		$("#coys").show();
		$( "#coysDiv" ).removeClass( "col-md-6 col-sm-6" ).addClass( "col-md-12 col-sm-12" );
	}


});


$( "#coys" ).change(function() {

val = $("#userType").val();
coyval = $("#coys").val();
// getStations();

	if(val == "stationAdmin" || val == "regStatUser"){
		substats = stats;
		substats = substats.filter(st => st.company_id == coyval);
		console.log(substats);
		$('#stations').empty();
		$("#stations").append(`<option value="">Choose Station</option>`);


		_u.forEach(substats, function(val, key) {
					stat = `
					<option value="`+val.station_id+`">`+capitalizeFirstLetter(val.name)+` </option>
					`;

					$("#stations").append(stat);
				});
				$("#stations").show();

		$( "#coysDiv" ).removeClass( "col-md-12 col-sm-12" ).addClass( "col-md-6 col-sm-6" );


	}


});







$( "#auserType" ).change(function() {
// alert($("#auserType").val());
// alert(1);
$("#acoys").hide();
	$("#astations").hide(); 
val = $("#auserType").val();
console.log(val);
	// if(val == "companyAdmin"){
	// 	$("#coys").show();

	// }
	// else if(val == "stationAdmin"){
	// 	$("#coys").show();
	// $("#stations").show(); 

	// }
	// else if(val == "regCoyUser"){
	// 	$("#coys").show();

	// }
	// else if(val == "regStatUser"){
	// 	$("#coys").show();
	// $("#stations").show(); 

	// }

	if((val != "") && (val != "admin") && (val != "regUser")){
		$("#acoys").show();
		$( "#acoysDiv" ).removeClass( "col-md-6 col-sm-6" ).addClass( "col-md-12 col-sm-12" );
	}


});



$( "#acoys" ).change(function() {

val = $("#auserType").val();
coyval = $("#acoys").val();
// getStations();

	if(val == "stationAdmin" || val == "regStatUser"){
		substats = stats;
		substats = substats.filter(st => st.company_id == coyval);
		console.log(substats);
		$('#astations').empty();
		$("#astations").append(`<option value="">Choose Station</option>`);


		_u.forEach(substats, function(val, key) {
					stat = `
					<option value="`+val.station_id+`">`+capitalizeFirstLetter(val.name)+` </option>
					`;

					$("#astations").append(stat);
				});
				$("#astations").show();

		$( "#acoysDiv" ).removeClass( "col-md-12 col-sm-12" ).addClass( "col-md-6 col-sm-6" );


	}


});


stats=[];



function getCompanies(){

var jqxhr = $.ajax({

url: '<?php echo base_url() ; ?>index.php/getCompanies/',

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
				coys = curr;
				
				$('#coys').empty();
				$('#acoys').empty();

				$("#coys").append(`<option value="">Choose Company</option>`);
				$("#acoys").append(`<option value="">Choose Company</option>`);
				
				_u.forEach(coys, function(val, key) {
					// nick = (val.nickname != "") ?  "("+val.nickname+")" : "";
					coy = `
					<option value="`+val.company_id+`">`+capitalizeFirstLetter(val.name)+` </option>
					`;

					$("#coys").append(coy);
					$("#acoys").append(coy);
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
				$('#astations').empty();

				$("#stations").append(`<option value="">Choose Station</option>`);
				$("#astations").append(`<option value="">Choose Station</option>`);


				// _u.forEach(stats, function(val, key) {
				// 	nick = (val.nickname != "") ?  "("+val.nickname+")" : "";
				// 	stat = `
				// 	<option value="`+val.station_id+`">`+capitalizeFirstLetter(val.name)+` </option>
				// 	`;

				// 	$("#astations").append(stat);
				// 	$("#stations").append(stat);
				// });

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





function loadUsertable(name = null)
    {
//datatables
// var id = document.getElementsByClassName("selectpicker");
// var datetime;
// if (id.length > 0) {
//      datetime = id[0].value;
// }

cols = $("#tblusers").find("thead").find("tr")[0].cells.length;
expArr = [];
cols = cols - 1;

// if(type == "regCoyUser"){
// 	 cols = cols + 1;
// }

var i;
for (i = 0; i < cols; i++) { 
  expArr.push(i);
}

    table = $('#tblusers').DataTable({ 
		"drawCallback": function( settings ) {
			if(type == "regCoyUser"){
				$( ".rem" ).remove();
			}
		},
		"initComplete": function(settings, json) {
			// alert( 'DataTables has finished its initialisation.' );
			if(type == "regCoyUser"){

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
            "url": "<?php echo base_url() ; ?>index.php/users_loadtable/"+name,
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
                title: "<?php echo "user_".time() ; ?>",
                message: '',
                exportOptions: {
                    columns: expArr
                }
            },
            {
                extend: 'copyHtml5',
                text:      '<i class="fa fa-files-o"></i>',
				titleAttr: 'Copy',
                title: "<?php echo "user_".time() ; ?>",
                exportOptions: {
                    columns: expArr
                }
            },
            {
                extend: 'excelHtml5',
                text:      '<i class="fa fa-file-excel-o "></i>',
				titleAttr: 'Excel',
                title: "<?php echo "user_".time() ; ?>",
                exportOptions: {
                    columns: expArr
                }
            },
            {
                extend: 'pdfHtml5',
                 text:      '<i class="fa fa-file-pdf-o"></i>',
				titleAttr: 'PDF',
                title: "<?php echo "user_".time() ; ?>",
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

	if( $('#auserType').val() == ""){
		alert("Please Select a User Account Type");
		return;
	}
	
	if( $('#afname').val() == ""){
		alert("Please Enter Valid First Name");
		return;
	}
	
	if( IsEmail($('#auemail').val()) == false ){
		alert("Please Enter Valid Email Address");
		return;
	}

	if( $('#apword').val() == ""){
		alert("Please Enter Valid Password");
		return;
	}

	if( $('#apword').val().length < 7){
			alert("Password Must Meet or Exceed 7 Characters");
			return;
		}

	if( $('#apword').val() != $('#acpword').val()){
		alert("Please Ensure Passwords Match");
		return;
	}


	if( ($('#acoys').val() == "") ){
		if( ($("#auserType").val() != "admin") && ($("#auserType").val() != "regUser")){

		alert("Please Select A Company");
		return;
		}
	}
	
	if( ($('#astations').val() == "") && ($("#auserType").val() == "stationAdmin") && ($("#auserType").val() == "regStatUser") ){
		alert("Please Select a Station");
		return;
	}



if( ($("#auserType").val() == "admin") || ($("#auserType").val() == "regUser")){
	$('#acoys').val("");
	$('#astations').val("");

}
if( ($("#auserType").val() == "companyAdmin") || ($("#auserType").val() == "regCoyUser")){
	$('#astations').val("");

}

	// ==============================


	
	
	
	// return;
	// $('#myAddModal').modal('show');


	var jqxhr = $.ajax({

		url: '<?php echo base_url() ; ?>index.php/addUser',

		type: 'POST',
		data: {
			
			fname: $('#afname').val(),
			lname: $('#alname').val(),
			user_password: $('#apword').val(),
			email: $('#auemail').val(),
			company: $('#acoys').val(),
			station: $('#astations').val(),
			acctType: $('#auserType').val(),

			

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
			// alert("User Successfully Added");
			new PNotify({
                                  title: 'Success',
                                  text: 'User Successfully Added!',
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

	if( $('#userType').val() == ""){
		alert("Please Select a User Account Type");
		return;
	}
	
	if( $('#fname').val() == ""){
		alert("Please Enter Valid First Name");
		return;
	}
	
	if( IsEmail($('#uemail').val()) == false ){
		alert("Please Enter Valid Email Address");
		return;
	}

	// if( $('#apword').val() == ""){
	// 	alert("Please Enter Valid Password");
	// 	return;
	// }
	if( $('#pword').val() != "" ){

		if( $('#pword').val().length < 7){
			alert("Password Must Meet or Exceed 7 Characters");
			return;
		}

		if( $('#pword').val() != $('#cpword').val()){
			alert("Please Ensure Passwords Match");
			return;
		}
	}


	if( ($('#coys').val() == "") ){
		if( ($("#userType").val() != "admin") && ($("#userType").val() != "regUser")){

		alert("Please Select A Company");
		return;
		}
	}
	
	if( ($('#stations').val() == "") && ($("#userType").val() == "stationAdmin") && ($("#userType").val() == "regStatUser") ){
		alert("Please Select a Station");
		return;
	}


if( ($("#userType").val() == "admin") || ($("#userType").val() == "regUser")){
	$('#coys').val("");
	$('#stations').val("");

}

if( ($("#userType").val() == "companyAdmin") || ($("#userType").val() == "regCoyUser")){
	$('#stations').val("");

}


	// return;
	// $('#myAddModal').modal('show');


	var jqxhr = $.ajax({

url: '<?php echo base_url() ; ?>index.php/editUser',

type: 'POST',
data: {
	
	id: $('#keyhidden').val(),
	fname: $('#fname').val(),
	lname: $('#lname').val(),
	user_password: $('#pword').val(),
	email: $('#uemail').val(),
	company: $('#coys').val(),
	station: $('#stations').val(),
	acctType: $('#userType').val(),

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
	// alert("User Successfully Edited");
	new PNotify({
                                  title: 'Success',
                                  text: 'User Successfully Edited!',
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





function edit(num){
	getUser(num);
	// $('#myModal').modal('show');

}



function getUser(num){

$("#coys").hide();
$("#stations").hide();



			var jqxhr = $.ajax({

url: '<?php echo base_url() ; ?>index.php/getUser/',

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
if (response){
	// alert("Successful");
	// location.reload();
	curr = JSON.parse(response);
	curr = curr[0];
	console.log(curr);


$('#myModal').modal('show');

// return;

$('#userType').val(curr.acctType);

if(curr.company != 0 ){
$('#coys').val(curr.company);
$("#coys").show();

	$( "#coysDiv" ).removeClass( "col-md-6 col-sm-6" ).addClass( "col-md-12 col-sm-12" );

}

if(curr.station != 0 ){

coyval = curr.company;

substats = stats;
		substats = substats.filter(st => st.company_id == coyval);
		console.log(substats);
		$('#stations').empty();
		$("#stations").append(`<option value="">Choose Station</option>`);


		_u.forEach(substats, function(val, key) {
					stat = `
					<option value="`+val.station_id+`">`+capitalizeFirstLetter(val.name)+` </option>
					`;

					$("#stations").append(stat);
				});

		$( "#coysDiv" ).removeClass( "col-md-12 col-sm-12" ).addClass( "col-md-6 col-sm-6" );
		
// =================================================================



$('#stations').val(curr.station);
$("#stations").show();

}


$('#fname').val(curr.fname);
$('#lname').val(curr.lname);
// $('#pword').val(curr.user_password);
$('#uemail').val(curr.email);







// console.log(JSON.parse(curr.email));
	// return;


$('#keyhidden').val(curr.id);







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



function addNew(){
	// alert("add");
	$('#myAddModal').modal('show');

}


	

		function confirmDelete(id){
conf = confirm("Are you sure you want to delete this? This action cannot be undone");
if (conf == false){return false;}

// console.log('deleteDevice/'+id+);


var jqxhr = $.ajax({

url: '<?php echo base_url() ; ?>index.php/deleteUser/'+id,

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
	// alert("User Successfully Deleted");
	new PNotify({
                                  title: 'Success',
                                  text: 'User Successfully Deleted!',
                                  type: 'success',
                                  styling: 'bootstrap3'
                              });
	// location.reload();
//   alert("done");
var name = $( "#name" ).val();
loadUsertable(name);
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

url: '<?php echo base_url() ; ?>index.php/disableUser/'+id,

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
                                  text: 'User Successfully Disabled!',
                                  type: 'success',
                                  styling: 'bootstrap3'
                              });
	// location.reload();
//   alert("done");
var name = $( "#name" ).val();
loadUsertable(name);
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

url: '<?php echo base_url() ; ?>index.php/enableUser/'+id,

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
                                  text: 'User Successfully Enabled!',
                                  type: 'success',
                                  styling: 'bootstrap3'
                              });
	// location.reload();
//   alert("done");
var name = $( "#name" ).val();
loadUsertable(name);
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
