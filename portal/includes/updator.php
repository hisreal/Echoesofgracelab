   <?php
session_start();
//all select query is done here

error_reporting(10);
require_once ('../../includes/dbh.php');
//require_once (dminsession.php');
//Profile Setting inserting query
$date_created = date('Y-m-d h:i:s');
$day_month = date('m-d');
$month_year = date('m-y');
$set='123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
$pid=substr(str_shuffle($set), 0,10);

if (isset($_POST['patient_reg2'])) {
$patient_name = mysqli_real_escape_string($conn, $_POST['patient_name']);
$sex = mysqli_real_escape_string($conn, $_POST['sex']);
$age = mysqli_real_escape_string($conn, $_POST['age']);
$nature = mysqli_real_escape_string($conn, $_POST['nature']);
$investigation = mysqli_real_escape_string($conn, $_POST['investigation']);
$hospital = mysqli_real_escape_string($conn, $_POST['hospital']);
$ticketid = mysqli_real_escape_string($conn, $_POST['ticketid']);
//$consultant = mysqli_real_escape_string($conn, $_POST['consultant']);
//$lab_no = mysqli_real_escape_string($conn, $_POST['lab_no']);

//insert query
$PatientStmt ="INSERT INTO user_info (`pid`, `patient_name`, `age`, `sex`, `hospital`, `nature`, `date_receive`, `investigation`, `status`, `mth`) VALUES( '".$pid."','".$patient_name."','".$age."', '".$sex."', '".$hospital."', '".$nature."', '".$date_created."', '".$investigation."', 'Not Yet Paid', '".$month_year."' )";
$PatientResult = mysqli_query($conn, $PatientStmt);

if ($PatientResult = TRUE) {
     echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.location.href='../index.php?msg=updated';
   </SCRIPT>"); 
$PaStmt = "DELETE FROM ticket WHERE id='".$ticketid."' ";
$PaResult = mysqli_query($conn, $PaStmt);
}else{
    echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.location.href='../index.php?msg=registered';
   </SCRIPT>"); 
      }
}

if (isset($_POST['patient_reg'])) {
$patient_name = mysqli_real_escape_string($conn, $_POST['patient_name']);
$date_receive = mysqli_real_escape_string($conn, $_POST['date_receive']);
$patient_name = mysqli_real_escape_string($conn, $_POST['patient_name']);
$sex = mysqli_real_escape_string($conn, $_POST['sex']);
$age = mysqli_real_escape_string($conn, $_POST['age']);
//$bill = mysqli_real_escape_string($conn, $_POST['bill']);
$consultant = mysqli_real_escape_string($conn, $_POST['consultant']);
$clinical_diagnosis = mysqli_real_escape_string($conn, $_POST['clinical_diagnosis']);
$hospital = mysqli_real_escape_string($conn, $_POST['hospital']);
$nature = mysqli_real_escape_string($conn, $_POST['nature']);
$clinical_address = mysqli_real_escape_string($conn, $_POST['clinical_address']);
$investigation = mysqli_real_escape_string($conn, $_POST['investigation']);
//$amount = mysqli_real_escape_string($conn, $_POST['amount']);
//$status = mysqli_real_escape_string($conn, $_POST['status']);
$phone_number = mysqli_real_escape_string($conn, $_POST['phone_number']);
$lab_no = mysqli_real_escape_string($conn, $_POST['lab_no']);
$branch = mysqli_real_escape_string($conn, $_POST['branch']);
//$mode = mysqli_real_escape_string($conn, $_POST['mode']);

//insert query
$PatientStmt ="INSERT INTO user_info (`pid`,`labno`, `branch`, `patient_name`, `age`, `sex`, `consultant`, `clinical_diagnosis`, `hospital`, `nature`, `date_receive`, `clinic_address`, `investigation`, `phone_number`, `day_month`, `mth`) VALUES('".$pid."', '".$lab_no."', '".$branch."', '".$patient_name."','".$age."', '".$sex."', '".$consultant."', '".$clinical_diagnosis."', '".$hospital."', '".$nature."', '".$date_receive."', '".$clinical_address."', '".$investigation."',  '".$phone_number."', '".$day_month."', '".$month_year."')";
$PatientResult = mysqli_query($conn, $PatientStmt);

if ($PatientResult = TRUE) {
	  echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.location.href='../index.php?msg=registered';
   </SCRIPT>"); 
}else{
	 echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.location.href='../registration.php?msg=error';
   </SCRIPT>"); 
      }
}



//UPDATE PATIENT INFO

if (isset($_POST['update_patient'])) {
$patient_name = mysqli_real_escape_string($conn, $_POST['patient_name']);
$age = mysqli_real_escape_string($conn, $_POST['age']);
$bill = mysqli_real_escape_string($conn, $_POST['bill']);
$sex = mysqli_real_escape_string($conn, $_POST['sex']);
$consultant = mysqli_real_escape_string($conn, $_POST['consultant']);
$clinical_diagnosis = mysqli_real_escape_string($conn, $_POST['clinical_diagnosis']);
$hospital = mysqli_real_escape_string($conn, $_POST['hospital']);
$nature = mysqli_real_escape_string($conn, $_POST['nature']);
$clinical_address = mysqli_real_escape_string($conn, $_POST['clinical_address']);
$investigation = mysqli_real_escape_string($conn, $_POST['investigation']);
$amount = mysqli_real_escape_string($conn, $_POST['amount']);
$status = mysqli_real_escape_string($conn, $_POST['status']);
$phone_number = mysqli_real_escape_string($conn, $_POST['phone_number']);
$pid = mysqli_real_escape_string($conn, $_POST['pid']);
//$patientid = mysqli_real_escape_string($conn, $_POST['patientid']);
$date_receive =mysqli_real_escape_string($conn, $_POST['date_receive']);
$lab_no =mysqli_real_escape_string($conn, $_POST['lab_no']);
$mode =mysqli_real_escape_string($conn, $_POST['mode']);
//insert query
$PatientStmt ="UPDATE user_info SET pid='".$pid."', labno='".$lab_no."', patient_name='".$patient_name."', age='".$age."', sex='".$sex."', consultant='".$consultant."', clinical_diagnosis='".$clinical_diagnosis."', hospital='".$hospital."', nature='".$nature."', date_receive='".$date_receive."', clinic_address='".$clinical_address."', investigation='".$investigation."', amount='".$amount."', bill='".$bill."', status='".$status."', phone_number='".$phone_number."', mode='".$mode."' WHERE pid='".$pid."' ";
$PatientResult = mysqli_query($conn, $PatientStmt);

if ($PatientResult = TRUE) {
    echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.location.href='../index.php?msg=updated';
   </SCRIPT>"); 
}else{
   echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.location.href='../index.php?msg?error';
   </SCRIPT>"); 
      }

}

//Expenses query goes here




if (isset($_POST['expenses'])) {
$collector = mysqli_real_escape_string($conn, $_POST['collector']);
$amount = mysqli_real_escape_string($conn, $_POST['amount']);
$description = mysqli_real_escape_string($conn, $_POST['description']);
$branch = mysqli_real_escape_string($conn, $_POST['branch']);

//insert query
$ExpenseStmt ="INSERT INTO expenses (`collector`, `amount`, `description`, `date_created`, `day_month`, `branch`, `mth`) VALUES ('".$collector."', '".$amount."', '".$description."', '".$date_created."', '".$day_month."', '".$branch."', '".$month_year."')";
$ExpenseResult = mysqli_query($conn, $ExpenseStmt);

if ($ExpenseResult = TRUE) {
    echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.location.href='../expenses.php';
   </SCRIPT>"); 
}else{
   echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('An error occur when trying to update the information')
    window.location.href='../expenses.php';
   </SCRIPT>"); 
      }
}




if (isset($_POST['bank'])) {
$amount = mysqli_real_escape_string($conn, $_POST['amount']);
$dateofpay = mysqli_real_escape_string($conn, $_POST['dateofpay']);
$branch = mysqli_real_escape_string($conn, $_POST['branch']);

//insert query
$dateofpay ="INSERT INTO bank (`amount`, `dateofpay`, `branch`, `mth`) VALUES ('".$amount."', '".$dateofpay."', '".$branch."', '".$month_year."')";
$dateofpay = mysqli_query($conn, $dateofpay);

if ($dateofpay = TRUE) {
    echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.location.href='../bank.php';
   </SCRIPT>"); 
}else{
   echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('An error occur when trying to update the information')
    window.location.href='../bank.php';
   </SCRIPT>"); 
      }
}

   

   if (isset($_POST['sum-btn'])) {
$pieces = mysqli_real_escape_string($conn, $_POST['pieces']);
$itemId = mysqli_real_escape_string($conn, $_POST['itemId']);

//insert query
$InvStmt ="SELECT * FROM inventory WHERE id='".$itemId."' ";
$InvResult = mysqli_query($conn, $InvStmt);
$FetchInv = mysqli_fetch_assoc($InvResult);

$Invpiece = $FetchInv['pieces'];
$Invused = $FetchInv['used'];
$Invname = $FetchInv['name_item'];

$Totalused = $Invused + $pieces;
$Remain = $Invpiece - $Totalused;

$InvStmt2 ="UPDATE inventory SET used='".$Totalused."', remain='".$Remain."', date_created='".$date_created."' WHERE id='".$itemId."'";
$InvResult2 = mysqli_query($conn, $InvStmt2);

//insert into summary table
$SumStmt = "INSERT INTO summary (`name_item`, `date`, `pieces`) VALUES ('".$Invname."', '".$date_created."', '".$pieces."' ) ";
$SumResult = mysqli_query($conn, $SumStmt);

if ($InvResult = TRUE) {
    echo ("<SCRIPT LANGUAGE='JavaScript'>
       window.alert('Inventory Is Updated successfully')
    window.location.href='../inventory.php';
   </SCRIPT>"); 
}else{
   echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('An error occur when trying to update the information')
    window.location.href='../inventory.php';
   </SCRIPT>"); 
      }
}



 if (isset($_POST['update-invent'])) {
$pieces = mysqli_real_escape_string($conn, $_POST['pieces']);
$itemId = mysqli_real_escape_string($conn, $_POST['itemId']);
$quantity = mysqli_real_escape_string($conn, $_POST['quantity']);
$remain = mysqli_real_escape_string($conn, $_POST['remain']);
$used = mysqli_real_escape_string($conn, $_POST['used']);
$item_name = mysqli_real_escape_string($conn, $_POST['item_name']);




$InvStmt ="UPDATE inventory SET quantity='".$quantity."',  pieces='".$pieces."', used='".$used."', remain='".$remain."', date_created='".$date_created."' WHERE id='".$itemId."'";
$InvResult = mysqli_query($conn, $InvStmt);

if ($InvResult = TRUE) {
    echo ("<SCRIPT LANGUAGE='JavaScript'>
       window.alert('".$item_name." has been successfully updated')
    window.location.href='../inventory.php';
   </SCRIPT>"); 
}else{
   echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('An error occur when trying to update the information')
    window.location.href='../inventory.php';
   </SCRIPT>"); 
      }
}






if (isset($_POST['up-exp'])) {
$collector = mysqli_real_escape_string($conn, $_POST['collector']);
$amount = mysqli_real_escape_string($conn, $_POST['amount']);
$ExpId = mysqli_real_escape_string($conn, $_POST['ExpId']);
$date_created = mysqli_real_escape_string($conn, $_POST['date_created']);
$mth = mysqli_real_escape_string($conn, $_POST['mth']);

//insert query
$ExpenseStmt ="UPDATE expenses SET  collector='".$collector."', amount='".$amount."', description='".$date_created."', mth='".$mth."' WHERE id='".$ExpId."' ";
$ExpenseResult = mysqli_query($conn, $ExpenseStmt);
if ($ExpenseResult = TRUE) {
    echo ("<SCRIPT LANGUAGE='JavaScript'>
         window.alert('Records successfully updated')
    window.location.href='../expenses.php';
   </SCRIPT>"); 
}else{
   echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('An error occur when trying to update the information')
    window.location.href='../expenses.php';
   </SCRIPT>"); 
      }
}


if (isset($_POST['up-bank'])) {
$amount = mysqli_real_escape_string($conn, $_POST['amount']);
$dateofpay = mysqli_real_escape_string($conn, $_POST['dateofpay']);
$BankId = mysqli_real_escape_string($conn, $_POST['BankId']);

//insert query
$BankStmt ="UPDATE bank SET amount='".$amount."', dateofpay='".$dateofpay."' WHERE id='".$BankId."' ";
$BankResult = mysqli_query($conn, $BankStmt);
if ($BankResult = TRUE) {
    echo ("<SCRIPT LANGUAGE='JavaScript'>
         window.alert('Records successfully updated')
    window.location.href='../bank.php';
   </SCRIPT>"); 
}else{
   echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('An error occur when trying to update the information')
    window.location.href='../bank.php';
   </SCRIPT>"); 
      }
}



?>