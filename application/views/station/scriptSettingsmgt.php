<script>

 
 $(document).ready(function(){
    // var name = $( "#name" ).val();
    // loadConttable();
    getKAT();
    getPCD();
});






function getPCD(){

var jqxhr = $.ajax({

url: '<?php echo base_url() ; ?>index.php/getPCD/',

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
if (response == "0"){
// alert("Something went wrong");
$('#pcdcount').text("00");


// curr = JSON.parse(response);

}
else if(response == null){
	// alert("Something went wrong");
$('#pcdcount').text("00");
	

}
else if(JSON.parse(response)){

	// new PNotify({
    //                               title: 'Success',
    //                               text: ' Successfully Got!',
    //                               type: 'success',
    //                               styling: 'bootstrap3'
    //                           });


curr = JSON.parse(response);
console.log(curr);

	$('#pcdcount').text(curr[0].value);


}
else{
// alert("Something went wrong");
$('#pcdcount').text("00");

}
console.log(response);

})



.fail(function () {

})


.always(function () {

});


}


function getKAT(){

var jqxhr = $.ajax({

url: '<?php echo base_url() ; ?>index.php/getKAT/',

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
if (response == "0"){
// alert("Something went wrong");
$('#count').text("00");


// curr = JSON.parse(response);

}
else if(response == null){
	// alert("Something went wrong");
$('#count').text("00");
	

}
else if(JSON.parse(response)){

curr = JSON.parse(response);
console.log(curr);

	$('#count').text(curr[0].value);


}
else{
// alert("Something went wrong");
$('#count').text("00");

}
console.log(response);

})



.fail(function () {

})


.always(function () {

});


}






// function IsEmail(email) {
//   var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
//   if(!regex.test(email)) {
//     return false;
//   }else{
//     return true;
//   }
// }



function savePcd(){
	// alert("save add");

	if( ($('#pcd').val() == "") || ($('#pcd').val() < 1 )){
		alert("Please Enter A Valid Password Change Duration");
		return;
	}
	
	num = $('#pcd').val();
	
	// return;
	// $('#myAddModal').modal('show');


	var jqxhr = $.ajax({

url: '<?php echo base_url() ; ?>index.php/editPCD',

type: 'POST',
data: {
	
	property: "PasswordDuration",
	value: num,
	company: <?php echo $this->session->userdata('company');?>,
	station: <?php echo $this->session->userdata('station');?>

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
	// alert("Update Successful");
	new PNotify({
                                  title: 'Success',
                                  text: 'Update Successful!',
                                  type: 'success',
                                  styling: 'bootstrap3'
                              });
	// location.reload();
	getPCD();
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




function saveKat(){
	// alert("save add");

	if( ($('#kat').val() == "") || ($('#kat').val() < 1 )){
		alert("Please Enter A Valid Keep Alive Time");
		return;
	}
	
	num = $('#kat').val();
	
	// return;
	// $('#myAddModal').modal('show');


	var jqxhr = $.ajax({

url: '<?php echo base_url() ; ?>index.php/editKAT',

type: 'POST',
data: {
	
	property: "KeepAliveTime",
	value: num,
	company: <?php echo $this->session->userdata('company');?>,
	station: <?php echo $this->session->userdata('station');?>

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
	// alert("Update Successful");
	new PNotify({
                                  title: 'Success',
                                  text: 'Update Successful!',
                                  type: 'success',
                                  styling: 'bootstrap3'
                              });
	// location.reload();
	getKAT();
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






</script>
