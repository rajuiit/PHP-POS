<?php include("header.php"); ?>

        <section>
            <div class="mainwrapper">
               
			   <?php include("left_menu.php"); ?>
			   
                <div class="mainpanel">
                    <div class="pageheader">
                        <div class="media">
                            <div class="pageicon pull-left">
                                <i class="fa fa-th-list"></i>
                            </div>
                            <div class="media-body">
                                <ul class="breadcrumb">
                                    <li><a href="#"><i class="glyphicon glyphicon-home"></i></a></li>
                                    <li>Admin</li>
                                </ul>
                                <h4>Edit Expense Category</h4>
								
				   <a href="add_expense_category.php" class="btn btn-success" style="float: right;
margin-top: -31px;">Add Expense Category</a>
									
									
								
								
                            </div>
                        </div><!-- media -->
                    </div><!-- pageheader -->
                    
					
					
					
 <div class="contentpanel">
					
					
	
<?php
if(isset($_GET['action'])&&$_GET['action']=='DELETE')
{
$id	=	filter_input(INPUT_GET, 'id', FILTER_SANITIZE_SPECIAL_CHARS);

?>

<h1>Are you sure you want to delete?</h1>

<a href="expense_category_list.php?id=<?php echo $id; ?>&action=Yes" class="btn btn-success">Yes</a>
<a href="expense_category_list.php?" class="btn btn-warning">No</a>

<br><br>
<br><br>

<?php
}
if(isset($_GET['action'])&&$_GET['action']=='Yes')
{

$category_id	=	filter_input(INPUT_GET, 'id', FILTER_SANITIZE_SPECIAL_CHARS);

$db = 	new mysqli(SERVER, USERNAME, PASSWORD, DATABASE);

$qq	=	mysqli_query($db,"DELETE FROM `shop_expense_category` WHERE `category_id` = $category_id");



if($qq)
{
?>
<div class="alert alert-success">
	<a class="close" data-dismiss="alert" href="#" aria-hidden="true">&times;</a>
	<strong>Well done!</strong> Record delete successfully!
</div> <!-- /.alert -->	
<?php
}
else{
?>
<div class="alert alert-denger">
									<a class="close" data-dismiss="alert">×</a>
									Sorry, Failed to delete record! <br>								
								</div>	

<?php
}
}
?>     
     				
	
					
					
                          
                        <div class="panel panel-primary-head">
                            <div class="panel-heading">
                                <h4 class="panel-title">View/Search Category</h4>
                            </div><!-- panel-heading -->
  	
							
                            <table id="basicTable" class="table table-striped table-bordered responsive">
                                <thead class="">
                                    <tr>
                                        <th>ID</th>
                                        <th>Category Name</th>               
                                        <th>Parent Category</th>            
                                        <th>Status</th>                                      
										<th width="120"><div align="center">Action</div></th>
                                    </tr>
                                </thead>
                         
                                <tbody>
								<?php 
								$db = new mysqli(SERVER, USERNAME, PASSWORD, DATABASE);
								$q	=	mysqli_query($db,"SELECT * FROM `shop_expense_category` ORDER BY category_id DESC");
								while($r	=	mysqli_fetch_array($q))
								{
								?>
								
                                    <tr>
                                        <td><?php echo $r['category_id']; ?></td>
                                      
                                        <td><?php echo $r['category_name']; ?></td>
                                        <td><?php echo get_category_info("category_name",$r['parent_id']); ?></td>
                                        
										
										<td><?php if($r['status']==1){ ?>
										<a id="growl-success" class="btn btn-success mr5 mb10" href="#">Active</a>
										<?php }
										else{ ?>
										<a id="growl-warning" class="btn btn-warning mr5 mb10" href="#">Inactive</a>
										<?php
										}
										?>
										</td>
                                      
									  
									  
                                        <td width="200">
		<div align="center">					
		<a href="edit_expense_category.php?id=<?php echo $r['category_id']; ?>" title="Edit" class="btn btn-success"><span class='glyphicon glyphicon-pencil'></span></a>
		
		
		<a href="expense_category_list.php?id=<?php echo $r['category_id']; ?>&action=DELETE" title="Category Delete" class='btn btn-danger'><span class='glyphicon glyphicon-trash'></span></a>
		
		<a href="category_wise_sales_report.php?id=<?php echo $r['category_id']; ?>&action=DELETE" title="Expense Category Report" class='btn btn-success'><span class='glyphicon glyphicon-list'></span></a>
		
		
		</div>
		
		
		
										</td>
                                    </tr>
								<?php
								}
								?>								
									
									
									</tbody>
                            </table>
                        </div><!-- panel -->
                        
                        <br />
                        
                       
                        
                    </div><!-- contentpanel -->
                </div><!-- mainpanel -->
            </div><!-- mainwrapper -->
        </section>

        <script src="js/jquery-1.11.1.min.js"></script>
        <script src="js/jquery-migrate-1.2.1.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/modernizr.min.js"></script>
        <script src="js/pace.min.js"></script>
        <script src="js/retina.min.js"></script>
        <script src="js/jquery.cookies.js"></script>
        
        <script src="js/jquery.dataTables.min.js"></script>
        <script src=".js/dataTables.bootstrap.js"></script>
        <script src="js/dataTables.responsive.js"></script>
        <script src="js/select2.min.js"></script>

        <script src="js/custom.js"></script>
		
		
        <script src="js/jquery-ui-1.10.3.min.js"></script>
        
        <script src="js/jquery.autogrow-textarea.js"></script>
        <script src="js/jquery.mousewheel.js"></script>
        <script src="js/jquery.tagsinput.min.js"></script>
        <script src="js/toggles.min.js"></script>
        <script src="js/bootstrap-timepicker.min.js"></script>
        <script src="js/jquery.maskedinput.min.js"></script>

        <script src="js/colorpicker.js"></script>
        <script src="js/dropzone.min.js"></script>

    
		
		
		
        <script>
            jQuery(document).ready(function(){
                
                jQuery('#basicTable').DataTable({
                    responsive: true
                });
                
                var shTable = jQuery('#shTable').DataTable({
                    "fnDrawCallback": function(oSettings) {
                        jQuery('#shTable_paginate ul').addClass('pagination-active-dark');
                    },
                    responsive: true
                });
                
                // Show/Hide Columns Dropdown
                jQuery('#shCol').click(function(event){
                    event.stopPropagation();
                });
                
                jQuery('#shCol input').on('click', function() {

                    // Get the column API object
                    var column = shTable.column($(this).val());
 
                    // Toggle the visibility
                    if ($(this).is(':checked'))
                        column.visible(true);
                    else
                        column.visible(false);
                });
                
                var exRowTable = jQuery('#exRowTable').DataTable({
                    responsive: true,
                    "fnDrawCallback": function(oSettings) {
                        jQuery('#exRowTable_paginate ul').addClass('pagination-active-success');
                    },
                    "ajax": "ajax/objects.txt",
                    "columns": [
                        {
                            "class":          'details-control',
                            "orderable":      false,
                            "data":           null,
                            "defaultContent": ''
                        },
                        { "data": "name" },
                        { "data": "position" },
                        { "data": "office" },
                        { "data": "salary" }
                    ],
                    "order": [[1, 'asc']] 
                });
                
                // Add event listener for opening and closing details
                jQuery('#exRowTable tbody').on('click', 'td.details-control', function () {
                    var tr = $(this).closest('tr');
                    var row = exRowTable.row( tr );
             
                    if ( row.child.isShown() ) {
                        // This row is already open - close it
                        row.child.hide();
                        tr.removeClass('shown');
                    }
                    else {
                        // Open this row
                        row.child( format(row.data()) ).show();
                        tr.addClass('shown');
                    }
                });
               
                
                // DataTables Length to Select2
                jQuery('div.dataTables_length select').removeClass('form-control input-sm');
                jQuery('div.dataTables_length select').css({width: '60px'});
                jQuery('div.dataTables_length select').select2({
                    minimumResultsForSearch: -1
                });
    
            });
            
            function format (d) {
                // `d` is the original data object for the row
                return '<table class="table table-bordered nomargin">'+
                    '<tr>'+
                        '<td>Full name:</td>'+
                        '<td>'+d.name+'</td>'+
                    '</tr>'+
                    '<tr>'+
                        '<td>Extension number:</td>'+
                        '<td>'+d.extn+'</td>'+
                    '</tr>'+
                    '<tr>'+
                        '<td>Extra info:</td>'+
                        '<td>And any further details here (images etc)...</td>'+
                    '</tr>'+
                '</table>';
            }
        </script>

		
		 <script>
            jQuery(document).ready(function() {
                
                // Tags Input
                jQuery('#tags').tagsInput({width:'auto'});
                 
                // Textarea Autogrow
                jQuery('#autoResizeTA').autogrow();
                
                // Spinner
                var spinner = jQuery('#spinner').spinner();
                spinner.spinner('value', 0);
                
                // Form Toggles
                jQuery('.toggle').toggles({on: true});
                
                // Time Picker
                jQuery('#timepicker').timepicker({defaultTIme: false});
                jQuery('#timepicker2').timepicker({showMeridian: false});
                jQuery('#timepicker3').timepicker({minuteStep: 15});
                
                // Date Picker
                jQuery('#datepicker').datepicker();
                jQuery('#datepicker-inline').datepicker();
                jQuery('#datepicker-multiple').datepicker({
                    numberOfMonths: 3,
                    showButtonPanel: true
                });
                
                // Input Masks
                jQuery("#date").mask("99/99/9999");
                jQuery("#phone").mask("(999) 999-9999");
                jQuery("#ssn").mask("999-99-9999");
                
                // Select2
                jQuery("#select-basic, #select-multi").select2();
                jQuery('#select-search-hide').select2({
                    minimumResultsForSearch: -1
                });
                
                function format(item) {
                    return '<i class="fa ' + ((item.element[0].getAttribute('rel') === undefined)?"":item.element[0].getAttribute('rel') ) + ' mr10"></i>' + item.text;
                }
                
                // This will empty first option in select to enable placeholder
                jQuery('select option:first-child').text('');
                
                jQuery("#select-templating").select2({
                    formatResult: format,
                    formatSelection: format,
                    escapeMarkup: function(m) { return m; }
                });
                
                // Color Picker
                if(jQuery('#colorpicker').length > 0) {
                    jQuery('#colorSelector').ColorPicker({
			onShow: function (colpkr) {
			    jQuery(colpkr).fadeIn(500);
                            return false;
			},
			onHide: function (colpkr) {
                            jQuery(colpkr).fadeOut(500);
                            return false;
			},
			onChange: function (hsb, hex, rgb) {
			    jQuery('#colorSelector span').css('backgroundColor', '#' + hex);
			    jQuery('#colorpicker').val('#'+hex);
			}
                    });
                }
  
                // Color Picker Flat Mode
                jQuery('#colorpickerholder').ColorPicker({
                    flat: true,
                    onChange: function (hsb, hex, rgb) {
			jQuery('#colorpicker3').val('#'+hex);
                    }
                });
                
                
            });
        </script>
		
    </body>

</html>
