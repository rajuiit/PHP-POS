<?php include("header.php"); ?>

<style type="text/css">
.table-bordered > thead > tr > th, .table-bordered > tbody > tr > th, .table-bordered > tfoot > tr > th, .table-bordered > thead > tr > td, .table-bordered > tbody > tr > td, .table-bordered > tfoot > tr > td {
  border: 1px solid #ddd;
  vertical-align: middle;
}
</style>

<?php
if(isset($_POST['date1'])){$DATE1=$_POST['date1'];}else{$DATE1="";}
if(isset($_POST['date2'])){$DATE2=$_POST['date2'];}else{$DATE2="";}

$product_id=filter_input(INPUT_GET, 'id', FILTER_SANITIZE_SPECIAL_CHARS);


if(isset($_POST['action'])&&$_POST['action']=='Search')
{
$year1	=	substr($_POST['date1'],6,4);
		$month1	=	substr($_POST['date1'],0,2);
		$day1	=	substr($_POST['date1'],3,2);

		$date1	=	month2($month1)." ".$day1.", ".$year1;

		$year2	=	substr($_POST['date2'],6,4);
		$month2	=	substr($_POST['date2'],0,2);
		$day2	=	substr($_POST['date2'],3,2);
		$date2	=	month2($month2)." ".$day2.", ".$year2;
}
?>
<script type="text/javascript">
        function PrintDiv() {
            var contents = document.getElementById("dvContents").innerHTML;
            var frame1 = document.createElement('iframe');
            frame1.name = "frame1";
            frame1.style.position = "absolute";
            frame1.style.top = "-1000000px";
            document.body.appendChild(frame1);
            var frameDoc = frame1.contentWindow ? frame1.contentWindow : frame1.contentDocument.document ? frame1.contentDocument.document : frame1.contentDocument;
            frameDoc.document.open();
            frameDoc.document.write('<html><head><title>Stock Return Report</title>');
            frameDoc.document.write('</head><body>');
            frameDoc.document.write('<h1 style=text-align:center;>Stock Return Report</h1>');
            frameDoc.document.write('<h3 style=text-align:center;>Date:  <?php echo $date1; ?> To  <?php echo $date2; ?></h3>');
            frameDoc.document.write(contents);
            frameDoc.document.write('</body></html>');
            frameDoc.document.close();
            setTimeout(function () {
                window.frames["frame1"].focus();
                window.frames["frame1"].print();
                document.body.removeChild(frame1);
            }, 500);
            return false;
        }
    </script>
	
	

        <section>
            <div class="mainwrapper">
                    
					<?php include("left_menu.php"); ?>

                <div class="mainpanel">
                    <div class="pageheader">
                        <div class="media">
                            <div class="pageicon pull-left">
                                <i class="fa fa-pencil"></i>
                            </div>
                            <div class="media-body">
                                 <ul class="breadcrumb">
                                    <li><a href="#"><i class="glyphicon glyphicon-home"></i></a></li>                                    
                                    <li>Reports</li>
                                </ul>
								
                   <h4> Stock Return Report </h4>
					
					
					
                            </div>
                        </div><!-- media -->
                    </div><!-- pageheader -->
                    
                    <div class="contentpanel">
                        
                        <div class="row">
          
		  
<?php


	
function status_color($month)
	{
	$month1			=	$month;
	
	$month_number		=	array ("Done", "In Progress", "Not Interested");
	
	$f1		=	"<div class='btn btn-success mr5 mb10'>Done</div>";
	$f2		=	"<div class='btn btn-warning mr5 mb10'>In Progress</div>";
	$f3		=	"<div class='btn btn-danger mr5 mb10'>Not Interested</div>";
	
	$replace	=	array ("$f1", "$f2", "$f3");
	
	$english_month	=	str_replace($month_number, $replace, $month1);
	$english_date=$english_month;
	return $english_date;
	}	

?>

	<form action="" method="POST" name="date_range_query">
	  
<table id="basicTable33" border="0" class="table table-striped table-bordered responsive">
  
<tr>
	<td valign="middle"><div align="center">Starting Date</div></td>
 
	<td> 
		<div class="input-group">
			<input type="text" class="form-control" name="date1" placeholder="mm/dd/yyyy" id="datepicker" value="<?php echo $DATE1; ?>">
			<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
		</div><!-- input-group -->
	</td>

	<td><div align="center">Ending Date</div></td>

	<td>
		<div class="input-group">
			<input type="text" class="form-control" name="date2" placeholder="mm/dd/yyyy" value="<?php echo $DATE2; ?>" id="datepicker-multiple">
			<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
		</div><!-- input-group -->
	</td>

	<td>	
		<button name="action" value="Search" class="btn btn-primary mr5">Submit</button>
<?php
if(isset($_POST['action'])&&$_POST['action']=='Search')
{
?>
	<input type="button" onclick="PrintDiv();" value="Print" class="btn btn-primary mr5" />	
<?php
}
?>
	</td>
	
</tr>

</table>


</form>


<?php
if(isset($_POST['action'])&&$_POST['action']=='Search')
{

?>
		 
 <div id="dvContents">

<link href="css/style.datatables.css" rel="stylesheet">
<link href="css/dataTables.responsive.css" rel="stylesheet">

<style text="text/css">
table {
  border-collapse: collapse;
  border-spacing: 0;
}
</style>
				<table id="basicTable" width="1100" border="1" cellpadding="5" cellspacing="0" class="table table-striped table-bordered responsive">
					
					<thead class="">
						<tr>
							<th>SL</th>
							<th>Item Name</th>
							<th>Item Code</th>
							<th><div align="center">Date</div></th>
							<th><div align="center">Stock Return</div></th>
						</tr>
					</thead>

		<tbody>
					
		<?php 
					
		$year1	=	substr($_POST['date1'],6,4);
		$month1	=	substr($_POST['date1'],0,2);
		$day1	=	substr($_POST['date1'],3,2);

		$date1	=	$year1."-".$month1."-".$day1;

		$year2	=	substr($_POST['date2'],6,4);
		$month2	=	substr($_POST['date2'],0,2);
		$day2	=	substr($_POST['date2'],3,2);
		$date2	=	$year2."-".$month2."-".$day2;


		
		$sl				=	1;
		$total_due		=	0;
		$total_payment	=	0;
		$total_balance	=	0;
		
		
		
$product_id=filter_input(INPUT_GET, 'id', FILTER_SANITIZE_SPECIAL_CHARS);
	
					
					
					$db = new mysqli(SERVER, USERNAME, PASSWORD, DATABASE);
					//$client_id		=	filter_input(INPUT_GET, 'id', FILTER_SANITIZE_SPECIAL_CHARS);
					
		$q	=	mysqli_query($db,"SELECT * FROM `shop_stock` WHERE status=1 AND (add_date BETWEEN '$date1' AND '$date2') ORDER BY add_date ASC");
					while($r	=	mysqli_fetch_array($q))
					{
					?>
					
	<tr>
		<td><?php echo $sl; $sl+=1; ?></td>
		<td><?php echo get_product_info("product_name",$r['product_id']); ?></td>
		<td><?php echo get_product_info("product_code",$r['product_id']); ?></td>
		<td><div align="center"><?php echo $r['add_date']; ?></div></td>
		<td><div align="center"><?php echo $r['stock_out']; ?></div></td>
	
	</tr>
						
					<?php
					}
					?>								
						
						
						</tbody>
				</table>

</div>

<?php

}

?>

						 
                        </div><!-- row -->
                        
                       
                    
                    </div><!-- contentpanel -->
                </div>
            </div><!-- mainwrapper -->
        </section>


        <script src="js/jquery-1.11.1.min.js"></script>
        <script src="js/jquery-migrate-1.2.1.min.js"></script>
        <script src="js/jquery-ui-1.10.3.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/modernizr.min.js"></script>
        <script src="js/pace.min.js"></script>
        <script src="js/retina.min.js"></script>
        <script src="js/jquery.cookies.js"></script>
        
        <script src="js/jquery.autogrow-textarea.js"></script>
        <script src="js/jquery.mousewheel.js"></script>
        <script src="js/jquery.tagsinput.min.js"></script>
        <script src="js/toggles.min.js"></script>
        <script src="js/bootstrap-timepicker.min.js"></script>
        <script src="js/jquery.maskedinput.min.js"></script>
        <script src="js/select2.min.js"></script>
        <script src="js/colorpicker.js"></script>
        <script src="js/dropzone.min.js"></script>

        <script src="js/custom.js"></script>
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










