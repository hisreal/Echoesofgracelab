	  <?php 
    error_reporting(0);
    require_once '../includes/dbh.php';
      if (isset($_GET['pid'])) {  
        $pid = mysqli_real_escape_string($conn, $_GET['pid']);
        $PatientStmt = "SELECT * FROM user_info WHERE pid='".$pid."' ";
        $PatientResult = mysqli_query($conn, $PatientStmt);
        $FetchPatient = mysqli_fetch_assoc($PatientResult);
      }

        ?>    
    <!DOCTYPE html>
<html>
<head>
	<!-- Basic Page Info -->
	<meta charset="utf-8">
	<title>Print Result</title>

	<!-- Site favicon -->
	<link rel="apple-touch-icon" sizes="180x180" href="../vendors/images/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="../vendors/images/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="../vendors/images/favicon-16x16.png">

	<!-- Mobile Specific Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<!-- Google Font -->
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="../vendors/styles/core.css">
	<link rel="stylesheet" type="text/css" href="../vendors/styles/icon-font.min.css">
	<link rel="stylesheet" type="text/css" href="../vendors/styles/style.css">

	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-119386393-1"></script>
	<script>
		window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date());

		gtag('config', 'UA-119386393-1');
	</script>
	
</head>

	<div class="invoice-wrap">
					<div class="invoice-box">
                    <!-- Bordered Table start -->
                        <div class="card">
                            <div class="card-body">
                            <h2 style="font-weight: 900; font-style: italic; font-size: 40px; text-align: center; font-family: sans-serif; ">ECHOES OF GRACE VENTURES</h2>
                                    <div class="table-responsive col-lg-12 col-md-12 col-sm-12">
                                         <address style="float: left; font-weight: bold; font-family: sans-serif;">
                                        5, Divine Grace St. Off<br>
                                         Housing Opopogboro Rd<br>
                                        Ado Ekiti<br>
                                       TEL: 08028290870.
                                    </address>



                                     <address style="float: right; font-weight: bold; font-family: sans-serif;">
                                        C/o Fasanmade Hospital <br>
                                       93, Iworoko Rd, Beside<br>
                                        First Bank, Ado-Ekiti.<br>
                                        08060365404, 08074348675
                                    </address>
                                       <br>
                                       <br>
                                      <br>
                                      <br>
                                <center><h2 style="font-weight: bold; width: 400px; padding: 10px; font-size: 40px; color: black; text-align: center; font-family: sans-serif, arial; border-radius: 15px; ">CASH RECEIPT</h2></center>






                                       <?php  
                                   
                                       $date = strtotime($FetchPatient['date_receive']);


                                       echo '<table style="font-size: 20px"  class="table">
                                           
                                                <tr>
                                                    <td sty widtd="50%"><b>Department:</b> &nbsp; Home Lab.</td>
                                                    <td widtd="1%" ></td>
                                                    <td widtd="10%"></td>
                                                    <td widtd="40%"><b>Date:</b> &nbsp;'.date("jS F, Y", $date).'</td>
                                                </tr>
                                                
                                                <tr>
                                                   <td colspan="4"><b>Received From:</b> &nbsp;'.$FetchPatient['patient_name'].'</td> 
                                                </tr>

                                                  <tr>
                                                   <td colspan="4" style="text-transform: capitalize"><b>The Total Sum of: </b> &nbsp;'.convert_number_to_words($FetchPatient['amount']).' Naira Only</td> 
                                                </tr>

                                                  <tr>
                                                   <td colspan="4"><b>Being Paid For: </b> &nbsp;'.$FetchPatient['investigation'].'</td> 
                                                </tr>

                                                 <tr>
                                                    <td colspan="2" widtd="50%"><b>Deposit:</b> <span style="border: 2px solid black; padding: 10px; ">&nbsp;&nbsp;';
                                                    if ($FetchPatient['status']== 'Deposit') {
                                                        echo '₦"'.$FetchPatient['amount'].'" ';
                                                      } else{
                                                        echo " ========";
                                                      }
                                                     echo '</span></td>';
                                                    echo '<td colspan="2" widtd="50%"><b>Balance :</b> <span style="border: 2px solid black; padding: 10px;"><b>&nbsp;&nbsp;&nbsp;&nbsp;₦'.$FetchPatient['amount'].'</b></span></td>
                                                  
                                                </tr>
                                              
                                        </table>';
                                        ?>
                                  

                                             <div style="float: left; margin-top: 50px;text-align: center">______________________________<br>
                                            <b>Customer's Signature</b>
                                        </div>
                                        
                             
                                        <div style="float: right; margin-top: 50px;text-align: center">______________________________<br>
                                            <b>Cashier's Signature</b><br><br>
                                         </div>



                                 
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

      <hr style="border: 1px solid black; margin-top: 160px; margin-bottom: 80px">

                                
                  




			<?php require_once 'footer.php'; ?>