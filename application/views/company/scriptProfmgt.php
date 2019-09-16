<script>

 
 $(document).ready(function(){
    // var name = $( "#name" ).val();
num= "<?php echo $this->session->userdata('id')?>";
console.log(num);

    getStations();
    getCompanies();
	getUser(num);


	 
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

				$("#coys").append(`<option value="">Choose Company</option>`);
				
				_u.forEach(coys, function(val, key) {
					// nick = (val.nickname != "") ?  "("+val.nickname+")" : "";
					coy = `
					<option value="`+val.company_id+`">`+capitalizeFirstLetter(val.name)+` </option>
					`;

					$("#coys").append(coy);
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

				$("#stations").append(`<option value="">Choose Station</option>`);


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





function IsEmail(email) {
  var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  if(!regex.test(email)) {
    return false;
  }else{
    return true;
  }
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


if($('#userType').val() == "admin" || $('#userType').val() == "regUser"){
	if($('#coys').val()){
		$('#coys').val() = 0;
	}
	if($('#stations').val()){
		$('#stations').val() = 0;
	}
}

if($('#userType').val() == "companyAdmin" || $('#userType').val() == "regCoyUser"){
	if(!$('#coys').val()){
		alert("Please Select a Valid Company");
		return;
	}
	if($('#stations').val()){
		$('#stations').val() = 0;
	}
}

if($('#userType').val() == "stationAdmin" || $('#userType').val() == "regStatUser"){
	if(!$('#coys').val()){
		alert("Please Select a Valid Company");
		return;

	}
	if(!$('#stations').val()){
		alert("Please Select a Valid Station");
		return;

	}
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
		text: 'Profile Successfully Edited!',
		type: 'success',
		styling: 'bootstrap3'
	});
	
	alert("Logging Out For Changes to Take Effect");
	window.location.href = '<?php echo base_url() ; ?>index.php/logout/';
	
	// location.reload();
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
	// alert(curr.company);
// $('#coys').val(curr.company);
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



// $('#stations').val(curr.station);
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






</script>
