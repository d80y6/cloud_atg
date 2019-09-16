<script>

 
 $(document).ready(function(){
    // var name = $( "#name" ).val();
    // loadCoytable(name);
    // loadCoytable();

	lower = '<?php echo $lowerID?>';

	if(lower){

    loadCoytable(lower);

	}
	else{
		loadCoytable();

	}

});






function loadCoytable(name = null)
    {
//datatables
// var id = document.getElementsByClassName("selectpicker");
// var datetime;
// if (id.length > 0) {
//      datetime = id[0].value;
// }

// // console.log(datetime);
cols = $("#tblcompanies").find("thead").find("tr")[0].cells.length;
expArr = [];
cols = cols - 1;

// if(type == "regUser"){
// 	 cols = cols + 1;
// }

var i;
for (i = 0; i < cols; i++) { 
  expArr.push(i);
}


console.log("datetime");

    table = $('#tblcompanies').DataTable({ 
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
            "url": "<?php echo base_url() ; ?>index.php/companies_loadtable/"+name,
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
                title: "<?php echo "coy_".time() ; ?>",
                message: '',
                exportOptions: {
                    columns: expArr
                }
            },
            {
                extend: 'copyHtml5',
                text:      '<i class="fa fa-files-o"></i>',
				titleAttr: 'Copy',
                title: "<?php echo "coy_".time() ; ?>",
                exportOptions: {
                    columns: expArr
                }
            },
            {
                extend: 'excelHtml5',
                text:      '<i class="fa fa-file-excel-o "></i>',
				titleAttr: 'Excel',
                title: "<?php echo "coy_".time() ; ?>",
                exportOptions: {
                    columns: expArr
                }
            },
            {
                extend: 'pdfHtml5',
                 text:      '<i class="fa fa-file-pdf-o"></i>',
				titleAttr: 'PDF',
                title: "<?php echo "coy_".time() ; ?>",
                exportOptions: {
                    columns: expArr
                }
            },
            
            'colvis'
        ]


       
    });

    }





// [{"id":"preAlarm","value":"abdurraheem.abdul-majeed@sahara-group.com"},
// {"id":"alarmStart","value":"abdurraheem.abdul-majeed@sahara-group.com"},
// {"id":"alarmEnd","value":"abdurraheem.abdul-majeed@sahara-group.com"},
// {"id":"unloading","value":"abdurraheem.abdul-majeed@sahara-group.com"},
// {"id":"newUser","value":"abdurraheem.abdul-majeed@sahara-group.com"},
// {"id":"threshold","value":"abdurraheem.abdul-majeed@sahara-group.com"},
// {"id":"reorder","value":"abdurraheem.abdul-majeed@sahara-group.com"}]

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

	if( $('#acname').val() == ""){
		alert("Please Enter Valid Company Name");
		return;
	}
	if( $('#acpnum').val() == "" || $('#acpnum').val().length < 11 || $('#acpnum').val().length > 11){
	// if( $('#acpnum').val() == ""){
		alert("Please Enter Valid Phone Number");
		return;
	}

	if(IsEmail($('#apemail').val()) == false){
		alert("Please enter valid Pre-Alarm Email");
		return;
	}
	if(IsEmail($('#aasemail').val()) == false){
		alert("Please enter valid Alarm Start Email");
		return;
	}
	if(IsEmail($('#aaeemail').val()) == false){
		alert("Please enter valid Alarm End Email");
		return;
	}
	if(IsEmail($('#auemail').val()) == false){
		alert("Please enter valid Unloading Email");
		return;
	}
	if(IsEmail($('#anuemail').val()) == false){
		alert("Please enter valid New User Email");
		return;
	}
	if(IsEmail($('#atemail').val()) == false){
		alert("Please enter valid Threshold Email");
		return;
	}
	if(IsEmail($('#aremail').val()) == false){
		alert("Please enter valid Re-Order Email");
		return;
	}


emails = `[{"id":"preAlarm","value":"`+$('#apemail').val()+`"},
{"id":"alarmStart","value":"`+$('#aasemail').val()+`"},
{"id":"alarmEnd","value":"`+$('#aaeemail').val()+`"},
{"id":"unloading","value":"`+$('#auemail').val()+`"},
{"id":"newUser","value":"`+$('#anuemail').val()+`"},
{"id":"threshold","value":"`+$('#atemail').val()+`"},
{"id":"reorder","value":"`+$('#aremail').val()+`"}]`;

console.log(emails);

	// return;
	// $('#myAddModal').modal('show');


	var jqxhr = $.ajax({

url: '<?php echo base_url() ; ?>index.php/addCompany',

type: 'POST',
data: {
	
	name: $('#acname').val(),
	phone_no: $('#acpnum').val(),
	comments: $('#accomm').val(),
	email: emails
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
	// alert("Company Successfully Added");

	new PNotify({
                                  title: 'Success',
                                  text: 'Company Successfully Added!',
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
	

	if( $('#cname').val() == ""){
		alert("Please Enter Valid Company Name");
		return;
	}
	if( $('#cpnum').val() == "" || $('#cpnum').val().length < 11 || $('#cpnum').val().length > 11){
		alert("Please Enter Valid Phone Number");
		return;
	}

	if(IsEmail($('#pemail').val()) == false){
		alert("Please enter valid Pre-Alarm Email");
		return;
	}
	if(IsEmail($('#asemail').val()) == false){
		alert("Please enter valid Alarm Start Email");
		return;
	}
	if(IsEmail($('#aeemail').val()) == false){
		alert("Please enter valid Alarm End Email");
		return;
	}
	if(IsEmail($('#uemail').val()) == false){
		alert("Please enter valid Unloading Email");
		return;
	}
	if(IsEmail($('#nuemail').val()) == false){
		alert("Please enter valid New User Email");
		return;
	}
	if(IsEmail($('#temail').val()) == false){
		alert("Please enter valid Threshold Email");
		return;
	}
	if(IsEmail($('#remail').val()) == false){
		alert("Please enter valid Re-Order Email");
		return;
	}


emails = `[{"id":"preAlarm","value":"`+$('#pemail').val()+`"},
{"id":"alarmStart","value":"`+$('#asemail').val()+`"},
{"id":"alarmEnd","value":"`+$('#aeemail').val()+`"},
{"id":"unloading","value":"`+$('#uemail').val()+`"},
{"id":"newUser","value":"`+$('#nuemail').val()+`"},
{"id":"threshold","value":"`+$('#temail').val()+`"},
{"id":"reorder","value":"`+$('#remail').val()+`"}]`;

console.log(emails);

	// return;
	// $('#myAddModal').modal('show');


	var jqxhr = $.ajax({

url: '<?php echo base_url() ; ?>index.php/editCompany',

type: 'POST',
data: {
	
	id: $('#keyhidden').val(),
	name: $('#cname').val(),
	phone_no: $('#cpnum').val(),
	comments: $('#ccomm').val(),
	email: emails
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
	// alert("Company Successfully Edited");
	new PNotify({
                                  title: 'Success',
                                  text: 'Company Successfully Edited!',
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
	getCompany(num);
	// $('#myModal').modal('show');

}



function getCompany(num){

			var jqxhr = $.ajax({

url: '<?php echo base_url() ; ?>index.php/getCompany/',

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

$('#cname').val(curr.name);
$('#cpnum').val(curr.phone_no);
$('#ccomm').val(curr.comments);

// ################################
emails = JSON.parse(curr.email);
$('#pemail').val(emails[0].value);
$('#asemail').val(emails[1].value);
$('#aeemail').val(emails[2].value);
$('#uemail').val(emails[3].value);
$('#remail').val(emails[6].value);
$('#temail').val(emails[5].value);
$('#nuemail').val(emails[4].value);



// console.log(JSON.parse(curr.email));
	// return;


$('#keyhidden').val(curr.company_id);







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






		function approve(id){
conf = confirm("Are you sure you want to Approve this Company?");
if (conf == false){return false;}

// console.log('deleteDevice/'+id+);


var jqxhr = $.ajax({

url: '<?php echo base_url() ; ?>index.php/approveCompany/'+id,

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

//   alert("Company Approved Successfully");
  new PNotify({
                                  title: 'Success',
                                  text: 'Company Approved Successfully!',
                                  type: 'success',
                                  styling: 'bootstrap3'
                              });
var name = $( "#name" ).val();
loadCoytable(name);

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

		function confirmDelete(id){
conf = confirm("Are you sure you want to delete this? This action cannot be undone");
if (conf == false){return false;}

// console.log('deleteDevice/'+id+);


var jqxhr = $.ajax({

url: '<?php echo base_url() ; ?>index.php/deleteCompany/'+id,

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
                                  text: 'Company Successfully Deleted!',
                                  type: 'success',
                                  styling: 'bootstrap3'
                              });
	// location.reload();
//   alert("done");
var name = $( "#name" ).val();
loadCoytable(name);
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

url: '<?php echo base_url() ; ?>index.php/disableCompany/'+id,

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
                                  text: 'Company Successfully Disabled!',
                                  type: 'success',
                                  styling: 'bootstrap3'
                              });
	// location.reload();
//   alert("done");
var name = $( "#name" ).val();
loadCoytable(name);
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

url: '<?php echo base_url() ; ?>index.php/enableCompany/'+id,

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
// alert(response);
if (response == 1){
	// alert("Company Successfully Deleted");
	new PNotify({
                                  title: 'Success',
                                  text: 'Company Successfully Enabled!',
                                  type: 'success',
                                  styling: 'bootstrap3'
                              });
	// location.reload();
//   alert("done");
var name = $( "#name" ).val();
loadCoytable(name);
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
