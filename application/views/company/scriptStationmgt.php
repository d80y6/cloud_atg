<script>

 
 $(document).ready(function(){
    // var name = $( "#name" ).val();
    // loadCoytable(name);
    // loadStattable();
    getCompanies();
	lower = '<?php echo $lowerID?>';

	if(lower){

    loadStattable(lower);

	}
	else{
		loadStattable();

	}
});




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
					<option selected value="`+val.company_id+`">`+capitalizeFirstLetter(val.name)+` </option>
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





function loadStattable(name = null)
    {

	cols = $("#tblstations").find("thead").find("tr")[0].cells.length;
expArr = [];
cols = cols - 1;

// if(type == "regCoyUser"){
// 	 cols = cols + 1;
// }

var i;
for (i = 0; i < cols; i++) { 
  expArr.push(i);
}

    table = $('#tblstations').DataTable({ 
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
            "url": "<?php echo base_url() ; ?>index.php/stations_loadtable/"+name,
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
                title: "<?php echo "stat_".time() ; ?>",
                message: '',
                exportOptions: {
                    columns: expArr
                }
            },
            {
                extend: 'copyHtml5',
                text:      '<i class="fa fa-files-o"></i>',
				titleAttr: 'Copy',
                title: "<?php echo "stat_".time() ; ?>",
                exportOptions: {
                    columns: expArr
                }
            },
            {
                extend: 'excelHtml5',
                text:      '<i class="fa fa-file-excel-o "></i>',
				titleAttr: 'Excel',
                title: "<?php echo "stat_".time() ; ?>",
                exportOptions: {
                    columns: expArr
                }
            },
            {
                extend: 'pdfHtml5',
                 text:      '<i class="fa fa-file-pdf-o"></i>',
				titleAttr: 'PDF',
                title: "<?php echo "stat_".time() ; ?>",
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
	// return;

	if( $('#acoys').val() == ""){
		alert("Please Select a Company");
		return;
	}
	
	if( $('#aname').val() == ""){
		alert("Please Enter Valid Station Name");
		return;
	}
	if( $('#aadd').val() == ""){
		alert("Please Enter Valid Station Address");
		return;
	}
	if( $('#astate').val() == ""){
		alert("Please Enter Valid Station State");
		return;
	}
	if( $('#apms').val() == ""){
		alert("Please Enter Station PMS Threshold");
		return;
	}
	if( $('#aago').val() == ""){
		alert("Please Enter Station AGO Threshold");
		return;
	}
	if( $('#adpk').val() == ""){
		alert("Please Enter Station DPK Threshold");
		return;
	}
	
	



// console.log(emails);

	// return;
	// $('#myAddModal').modal('show');


	var jqxhr = $.ajax({

url: '<?php echo base_url() ; ?>index.php/addStation',

type: 'POST',
data: {
	
	company: $( "#acoys option:selected" ).text(),
	company_id: $('#acoys').val(),
	name: $('#aname').val(),
	location: $('#aloc').val(),
	longitude: $('#along').val(),
	latitude: $('#alat').val(),
	address: $('#aadd').val(),
	state: $('#astate').val(),
	nickname: $('#anick').val(),
	pms_threshold: $('#apms').val(),
	dpk_threshold: $('#adpk').val(),
	ago_threshold: $('#aago').val(),
	// email: emails
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
	// alert("Station Successfully Added");
	new PNotify({
                                  title: 'Success',
                                  text: 'Station Successfully Added!',
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
// console.log(response);
		
})



.fail(function () {

})


.always(function () {

});
// ==================================================


}



function editBtnClick(){
	// alert("save edit");
	// return;

	if( $('#coys').val() == ""){
		alert("Please Select a Company");
		return;
	}
	
	if( $('#name').val() == ""){
		alert("Please Enter Valid Station Name");
		return;
	}
	if( $('#add').val() == ""){
		alert("Please Enter Valid Station Address");
		return;
	}
	if( $('#state').val() == ""){
		alert("Please Enter Valid Station State");
		return;
	}
	if( $('#pms').val() == ""){
		alert("Please Enter Station PMS Threshold");
		return;
	}
	if( $('#ago').val() == ""){
		alert("Please Enter Station AGO Threshold");
		return;
	}
	if( $('#dpk').val() == ""){
		alert("Please Enter Station DPK Threshold");
		return;
	}




	// return;
	// $('#myAddModal').modal('show');


	var jqxhr = $.ajax({

url: '<?php echo base_url() ; ?>index.php/editStation',

type: 'POST',
data: {
	
	id: $('#keyhidden').val(),
	company: $( "#coys option:selected" ).text(),
	company_id: $('#coys').val(),
	name: $('#name').val(),
	location: $('#loc').val(),
	longitude: $('#long').val(),
	latitude: $('#lat').val(),
	address: $('#add').val(),
	state: $('#state').val(),
	nickname: $('#nick').val(),
	pms_threshold: $('#pms').val(),
	dpk_threshold: $('#dpk').val(),
	ago_threshold: $('#ago').val(),
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
	// alert("Station Successfully Edited");
	new PNotify({
                                  title: 'Success',
                                  text: 'Station Successfully Edited!',
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
	
	getStation(num);
	// $('#myModal').modal('show');

}



function getStation(num){

			var jqxhr = $.ajax({

url: '<?php echo base_url() ; ?>index.php/getStation/',

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
// return;

$('#myModal').modal('show');

$('#coys').val(curr.company_id);
$('#name').val(curr.name);
$('#loc').val(curr.location);
$('#long').val(curr.longitude);
$('#lat').val(curr.latitude);
$('#add').val(curr.address);
$('#state').val(curr.state);
$('#nick').val(curr.nickname);
$('#pms').val(curr.pms_threshold);
$('#dpk').val(curr.dpk_threshold);
$('#ago').val(curr.ago_threshold);





// console.log(JSON.parse(curr.email));
	// return;


$('#keyhidden').val(curr.station_id);







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

url: '<?php echo base_url() ; ?>index.php/deleteStation/'+id,

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
	// alert("Station Successfully Deleted");
	new PNotify({
                                  title: 'Success',
                                  text: 'Station Successfully Deleted!',
                                  type: 'success',
                                  styling: 'bootstrap3'
                              });
	// location.reload();
//   alert("done");
var name = $( "#name" ).val();
loadStattable(name);
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

url: '<?php echo base_url() ; ?>index.php/disableStation/'+id,

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
                                  text: 'Station Successfully Disabled!',
                                  type: 'success',
                                  styling: 'bootstrap3'
                              });
	// location.reload();
//   alert("done");
var name = $( "#name" ).val();
loadStattable(name);
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

url: '<?php echo base_url() ; ?>index.php/enableStation/'+id,

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
                                  text: 'Station Successfully Enabled!',
                                  type: 'success',
                                  styling: 'bootstrap3'
                              });
	// location.reload();
//   alert("done");
var name = $( "#name" ).val();
loadStattable(name);
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
