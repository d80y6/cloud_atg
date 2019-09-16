<script>

 
 $(document).ready(function(){
    // var name = $( "#name" ).val();
    // loadConttable();
    getStations();
	
	lower = '<?php echo $lowerID?>';

	if(lower){

    loadConttable(lower);

	}
	else{
		loadConttable();

	}

});






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


				_u.forEach(stats, function(val, key) {
					nick = (val.nickname != "") ?  "("+val.nickname+")" : "";
					stat = `
					<option value="`+val.station_id+`">`+capitalizeFirstLetter(val.name)+` </option>
					`;

					$("#astations").append(stat);
					$("#stations").append(stat);
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





function loadConttable(name = null)
    {
//datatables
// var id = document.getElementsByClassName("selectpicker");
// var datetime;
// if (id.length > 0) {
//      datetime = id[0].value;
// }

// // console.log(datetime);
// console.log("datetime");
cols = $("#tblcontrollers").find("thead").find("tr")[0].cells.length;
expArr = [];
cols = cols - 1;

// if(type == "regUser"){
// 	 cols = cols + 1;
// }

var i;
for (i = 0; i < cols; i++) { 
  expArr.push(i);
}

    table = $('#tblcontrollers').DataTable({ 
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
            "url": "<?php echo base_url() ; ?>index.php/controllers_loadtable/"+name,
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
                title: "<?php echo "cont_".time() ; ?>",
                message: '',
                exportOptions: {
                    columns: expArr
                }
            },
            {
                extend: 'copyHtml5',
                text:      '<i class="fa fa-files-o"></i>',
				titleAttr: 'Copy',
                title: "<?php echo "cont_".time() ; ?>",
                exportOptions: {
                    columns: expArr
                }
            },
            {
                extend: 'excelHtml5',
                text:      '<i class="fa fa-file-excel-o "></i>',
				titleAttr: 'Excel',
                title: "<?php echo "cont_".time() ; ?>",
                exportOptions: {
                    columns: expArr
                }
            },
            {
                extend: 'pdfHtml5',
                 text:      '<i class="fa fa-file-pdf-o"></i>',
				titleAttr: 'PDF',
                title: "<?php echo "cont_".time() ; ?>",
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

	if( $('#astations').val() == ""){
		alert("Please Select a Station");
		return;
	}
	if( $('#acname').val() == ""){
		alert("Please Enter Valid Controller Name");
		return;
	}
	if( $('#acnum').val() == ""){
		alert("Please Enter Valid Controller Number");
		return;
	}
	
	
	// return;
	// $('#myAddModal').modal('show');


	var jqxhr = $.ajax({

url: '<?php echo base_url() ; ?>index.php/addController',

type: 'POST',
data: {
	
	contId: $('#acnum').val(),
	contName: $('#acname').val(),

	statName: $( "#astations option:selected" ).text(),

	statId: $('#astations').val(),
	source_extra_details: $('#acdet').val(),

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
	// alert("Controller Successfully Added");
	new PNotify({
                                  title: 'Success',
                                  text: 'Controller Successfully Added!',
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

	if( $('#stations').val() == ""){
		alert("Please Select a Station");
		return;
	}
	if( $('#cname').val() == ""){
		alert("Please Enter Valid Controller Name");
		return;
	}
	if( $('#cnum').val() == ""){
		alert("Please Enter Valid Controller Number");
		return;
	}




	// return;
	// $('#myAddModal').modal('show');


	var jqxhr = $.ajax({

url: '<?php echo base_url() ; ?>index.php/editController',

type: 'POST',
data: {
	
	id: $('#keyhidden').val(),
	contId: $('#cnum').val(),
	contName: $('#cname').val(),

	statName: $( "#stations option:selected" ).text(),

	statId: $('#stations').val(),
	source_extra_details: $('#cdet').val(),
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
	// alert("Controller Successfully Edited");
	new PNotify({
                                  title: 'Success',
                                  text: 'Controller Successfully Edited!',
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
	getController(num);
	// $('#myModal').modal('show');

}



function getController(num){

			var jqxhr = $.ajax({

url: '<?php echo base_url() ; ?>index.php/getController/',

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

$('#cnum').val(curr.contId);
$('#cname').val(curr.contName);

$('#stations').val(curr.statId);
$('#cdet').val(curr.source_extra_details);





// console.log(JSON.parse(curr.email));
	// return;


$('#keyhidden').val(curr.Source_id);







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

url: '<?php echo base_url() ; ?>index.php/deleteController/'+id,

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
	// alert("Controller Successfully Deleted");
	new PNotify({
                                  title: 'Success',
                                  text: 'Controller Successfully Deleted!',
                                  type: 'success',
                                  styling: 'bootstrap3'
                              });
	// location.reload();
//   alert("done");
var name = $( "#name" ).val();
loadConttable(name);
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

url: '<?php echo base_url() ; ?>index.php/disableController/'+id,

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
                                  text: 'Controller Successfully Disabled!',
                                  type: 'success',
                                  styling: 'bootstrap3'
                              });
	// location.reload();
//   alert("done");
var name = $( "#name" ).val();
loadConttable(name);
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

url: '<?php echo base_url() ; ?>index.php/enableController/'+id,

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
                                  text: 'Controller Successfully Enabled!',
                                  type: 'success',
                                  styling: 'bootstrap3'
                              });
	// location.reload();
//   alert("done");
var name = $( "#name" ).val();
loadConttable(name);
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
