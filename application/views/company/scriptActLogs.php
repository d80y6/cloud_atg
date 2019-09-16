<script>

 
 $(document).ready(function(){
    // var name = $( "#name" ).val();
    // loadCoytable(name);
    // loadAlogtable();
	lower = '<?php echo $lowerID?>';

	if(lower){

    loadAlogtable(lower);

	}
	else{
		loadAlogtable();

	}
});






function loadAlogtable(name = null)
    {
//datatables
// var id = document.getElementsByClassName("selectpicker");
// var datetime;
// if (id.length > 0) {
//      datetime = id[0].value;
// }

// // console.log(datetime);
cols = $("#tblactLog").find("thead").find("tr")[0].cells.length;
expArr = [];
// cols = cols - 1;

// if(type == "regCoyUser"){
// 	 cols = cols + 1;
// }


var i;
for (i = 0; i < cols; i++) { 
  expArr.push(i);
}

console.log("datetime");

    table = $('#tblactLog').DataTable({ 
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
            "url": "<?php echo base_url() ; ?>index.php/actLogs_loadtable/"+name,
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
                title: "<?php echo "alog_".time() ; ?>",
                message: '',
                exportOptions: {
                    columns: expArr
                }
            },
            {
                extend: 'copyHtml5',
                text:      '<i class="fa fa-files-o"></i>',
				titleAttr: 'Copy',
                title: "<?php echo "alog_".time() ; ?>",
                exportOptions: {
                    columns: expArr
                }
            },
            {
                extend: 'excelHtml5',
                text:      '<i class="fa fa-file-excel-o "></i>',
				titleAttr: 'Excel',
                title: "<?php echo "alog_".time() ; ?>",
                exportOptions: {
                    columns: expArr
                }
            },
            {
                extend: 'pdfHtml5',
                 text:      '<i class="fa fa-file-pdf-o"></i>',
				titleAttr: 'PDF',
                title: "<?php echo "alog_".time() ; ?>",
                exportOptions: {
                    columns: expArr
                }
            },
            
            'colvis'
        ]


       
    });

    }









</script>
