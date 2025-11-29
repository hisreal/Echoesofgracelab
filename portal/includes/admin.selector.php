<?php 
//session_start();
//error_reporting(0);
require_once ('../includes/dbh.php');
require_once ('usersession.php');
$AdminStmt = "SELECT * FROM admin WHERE id='".$_SESSION['user_id']."' ";
$AdminResult = mysqli_query($conn, $AdminStmt);
$FetchAdmin = mysqli_fetch_assoc($AdminResult);
$branch = $FetchAdmin['branch'];


$day_month = date('m-d');
$month_year = date('m-y');
//Total User and their list based on ascending order
$PatientStmt = "SELECT * FROM user_info ORDER BY id DESC";
$PatientResult = mysqli_query($conn, $PatientStmt);
$TotalUsers = mysqli_num_rows($PatientResult);

//Total User and their list based on ascending order
$PatientUnprinted = "SELECT * FROM user_info WHERE printed=''";
$PatientUnprintedResult = mysqli_query($conn, $PatientUnprinted);
$TotalUnprinted = mysqli_num_rows($PatientUnprintedResult);

$PatientCStmt = "SELECT * FROM user_info WHERE  branch='".$branch."' ORDER BY id DESC";
$PatientCResult = mysqli_query($conn, $PatientCStmt);
$TotalCUsers = mysqli_num_rows($PatientCResult);



$PatientStmt2 = "SELECT * FROM user_info ORDER BY id DESC ";
$PatientResult2 = mysqli_query($conn, $PatientStmt2);

$InventStmt = "SELECT * FROM inventory ORDER BY id DESC ";
$InventResult = mysqli_query($conn, $InventStmt);




$SaleCStmt = "SELECT SUM(amount) FROM user_info WHERE  branch='".$branch."' ";
$SaleCResult = mysqli_query($conn, $SaleCStmt);
$TotalCPaid = mysqli_fetch_row($SaleCResult);

$CashStmt = "SELECT SUM(amount) FROM user_info WHERE  branch='".$branch."' AND mode='Cash' ";
$CashResult = mysqli_query($conn, $CashStmt);
$TotalCash = mysqli_fetch_row($CashResult);


$BankStmt = "SELECT SUM(amount) FROM user_info WHERE  branch='".$branch."' AND mode='Bank' ";
$BankResult = mysqli_query($conn, $BankStmt);
$TotalBank = mysqli_fetch_row($BankResult);

$ExpenseStmt = "SELECT * FROM expenses WHERE branch='".$branch."' ORDER BY id DESC";
$ExpenseResult = mysqli_query($conn, $ExpenseStmt);    

$ExStmt = "SELECT SUM(amount) FROM expenses WHERE branch='".$branch."' ";
$ExResult = mysqli_query($conn, $ExStmt);
$TotalEx = mysqli_fetch_row($ExResult);

$Bank2Stmt = "SELECT SUM(amount) FROM bank WHERE branch='".$branch."' ";
$Bank2Result = mysqli_query($conn, $Bank2Stmt);
$TotalBank2 = mysqli_fetch_row($Bank2Result);


$BankStmt = "SELECT * FROM bank WHERE branch='".$branch."' ORDER BY id DESC ";
$BankResult = mysqli_query($conn, $BankStmt);








    function timeAgo($dateTime){
      $dateTime = strtotime($dateTime);
      $cur_time   = time();
      $time_elapsed   = $cur_time - $dateTime;
      $seconds    = $time_elapsed ;
      $minutes    = round($time_elapsed / 60 );
      $hours      = round($time_elapsed / 3600);
      $days       = round($time_elapsed / 86400 );
      $weeks      = round($time_elapsed / 604800);
      $months     = round($time_elapsed / 2600640 );
      $years      = round($time_elapsed / 31207680 );
      // Seconds
      if($seconds <= 60){
        return '<span style="color:#096;font-style:italic;">Just now</span>';
      }
      //Minutes
      else if($minutes <= 60){
        if($minutes == 1){
          return "1 minute ago";
        }
        else{
          return "$minutes minutes ago";
        }
      }
      //Hours
      else if($hours <= 24){
        if($hours == 1){
          return "an hour ago";
        }else{
          return "$hours hrs ago";
        }
      }
      //Days
      else if($days <= 7){
        if($days == 1){
          return "Yesterday";
        }else{
          return "$days days ago";
        }
      }
      //Weeks
      else if($weeks <= 4.3){
        if($weeks == 1){
          return "a week ago";
        }else{
          return "$weeks weeks ago";
        }
      }
      //Months
      else if($months <= 12){
        if($months == 1){
          return "a month ago";
        }else{
          return "$months months ago";
        }
      }
      //Years
      else{
        if($years == 1){
          return "1 year ago";
        }else{
          return "$years years ago";
        }
      }
  }
  
    //Total Notication and their list based on ascending order
$NotifyStmt = "SELECT * FROM ticket WHERE  btn='0' ORDER BY id DESC";
$NotifyResult = mysqli_query($conn, $NotifyStmt);
$TotalNotify = mysqli_num_rows($NotifyResult);


?>