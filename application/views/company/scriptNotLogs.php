<script>

 
 $(document).ready(function(){
    // var name = $( "#name" ).val();
    loadNotable();
	lower = '<?php echo $lowerID?>';

	// if(lower){

    // loadAlogtable(lower);

	// }
	// else{
	// 	loadAlogtable();

	// }


});






function loadNotable(name = null)
    {
//datatables
// var id = document.getElementsByClassName("selectpicker");
// var datetime;
// if (id.length > 0) {
//      datetime = id[0].value;
// }

// // console.log(datetime);

cols = $("#tblnotLog").find("thead").find("tr")[0].cells.length;
expArr = [];
// cols = cols - 1;

// if(type == "regCoyUser"){
// 	 cols = cols + 1;
// }

var i;
for (i = 0; i < cols; i++) { 
  expArr.push(i);
}
// console.log(i);
// console.log(expArr);

// cols = $("#tblactLog > thead > tr:first > td").length;

// alert(cols);

// alert(name);
console.log("datetime");

    table = $('#tblnotLog').DataTable({ 
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
            "url": "<?php echo base_url() ; ?>index.php/notLogs_loadtable/"+name,
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
                title: "<?php echo "notif_".time() ; ?>",
                message: '',
                exportOptions: {
                    // columns: ':visible'
                    columns: expArr
                }
            },
            {
                extend: 'copyHtml5',
                text:      '<i class="fa fa-files-o"></i>',
				titleAttr: 'Copy',
                title: "<?php echo "notif_".time() ; ?>",
                exportOptions: {
                    columns: expArr
                }
            },
            {
                extend: 'excelHtml5',
                text:      '<i class="fa fa-file-excel-o "></i>',
				titleAttr: 'Excel',
                title: "<?php echo "notif_".time() ; ?>",
                exportOptions: {
                    columns: expArr
                }
            },
            {
                extend: 'pdfHtml5',
                 text:      '<i class="fa fa-file-pdf-o"></i>',
				titleAttr: 'PDF',
                title: "<?php echo "notif_".time() ; ?>",
                exportOptions: {
                    columns: expArr
                }
            },
            
            'colvis'
        ]


       
    });

    }









</script>
