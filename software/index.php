<?php include("header.php");
 
if($sess_admin_user_id>1){
	echo ("<META HTTP-EQUIV=Refresh CONTENT=\"0; URL=sales.php\">");
//header("location:sales.php");	
}

?>

		
        <section>
            <div class="mainwrapper">
                <?php include("left_menu.php"); ?>
				<!-- leftpanel -->
                
                <div class="mainpanel">
                    <div class="pageheader">
                        <div class="media">
                            <div class="pageicon pull-left">
                                <i class="fa fa-home"></i>
                            </div>
                            <div class="media-body">
                                <ul class="breadcrumb">
                                    <li><a href="#"><i class="glyphicon glyphicon-home"></i></a></li>
                                    <li>Dashboard</li>
                                </ul>
                                <h4>Dashboard</h4>
                            </div>
                        </div><!-- media -->
                    </div><!-- pageheader -->
                    
			
					
					
                    <div class="contentpanel">
                        
                        <div class="row row-stat">



				
                        </div><!-- row -->
                      
							
                       
                        
                    </div><!-- contentpanel -->
                    
                </div><!-- mainpanel -->
				
				
				
				
				
				
            </div><!-- mainwrapper -->
        </section>

<?php include("footer.php"); ?>