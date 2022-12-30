<?php
include 'config.php';
session_start();
$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
};

$select = mysqli_query($conn, "SELECT * FROM `borrower` WHERE bid = '$user_id'") or die('query failed');

   if(mysqli_num_rows($select) > 0){
      header('location:loans.php');
   }
?>

<?php

if(isset($_POST['submit_loan_req'])){

   //need fix---no validations to the data entered at all
   $fname = mysqli_real_escape_string($conn, $_POST['first_name']);
   $mname = mysqli_real_escape_string($conn, $_POST['middle_name']);
   $lname = mysqli_real_escape_string($conn, $_POST['last_name']);
   $phone = mysqli_real_escape_string($conn, $_POST['phone_number']);
   $bank = mysqli_real_escape_string($conn, $_POST['bank']);
   $bank_acc = mysqli_real_escape_string($conn, $_POST['acc_number']);
   $gender = mysqli_real_escape_string($conn, $_POST['gender']);
   $nida_no = mysqli_real_escape_string($conn, $_POST['nida_no']);

   //not done---give unique names to files uploaded by user in nida noc and fd doc
   $nida_doc = $_FILES['nida_doc']['name'];
   $nida_doc_size = $_FILES['nida_doc']['size'];
   $nida_tmp_name = $_FILES['nida_doc']['tmp_name'];
   $nida_folder = 'uploaded_doc_nida/'.$nida_doc;

   $fd_doc = $_FILES['farm_deed']['name'];
   $fd_doc_size = $_FILES['farm_deed']['size'];
   $fd_tmp_name = $_FILES['farm_deed']['tmp_name'];
   $fd_folder = 'uploaded_doc_fd/'.$fd_doc;

   $insert = mysqli_query($conn, "INSERT INTO `borrower`(bid,first_name,middle_name,last_name,phone,bank,bank_acc,gender,nida_no,nida_doc,fd_doc) 
                        VALUES('$user_id','$fname','$mname','$lname','$phone','$bank','$bank_acc','$gender','$nida_no','$nida_doc','$fd_doc')") or die('query failed');

   if($insert){
      move_uploaded_file($nida_tmp_name, $nida_folder);
      move_uploaded_file($fd_tmp_name, $fd_folder);
      $message[] = 'registered successfully!';
      header('location:loans.php');
}
else{
   $message[] = 'registration failed!';
}
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Register for loan</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/style.css">

</head>
<body>
   
<div class="update-profile">

   <form action="" method ="POST" enctype="multipart/form-data"> 
   <?php
      if(isset($message)){
         foreach($message as $message){
            echo '<div class="message">'.$message.'</div>';
         }
      }
      ?>    
      <div class="flex">
         <div class="inputBox">
            <span>First name</span>
            <input type="text" name="first_name" required class="box">
            <span>Middle name</span>
            <input type="text" name="middle_name" required class="box">
            <span>Last name</span>
            <input type="text" name="last_name"  required class="box">
            <span>Your phone number</span>
            <!--limit number of character input for phone and bank account-->
            <input type="text" name="phone_number" placeholder="eg 255752.." maxlenght="12" required class="box">
            <span>Bank details</span>
            <select id ="bank"  name = "bank" class="box" required>
               <option value ="" disabled selected>Choose Bank</option>
               <option value ="NMB">NMB</option>
               <option value ="CRDB">CRDB</option>
               <option value ="NBC">NBC</option>
            </select>
            <input type="text" name="acc_number" placeholder="Account number" maxlenght="12" required class="box">
         </div>
         <div class="inputBox">
            <span>Gender</span>
            <select id ="gender"  name = "gender" class="box" required>
               <option value ="" disabled selected>Choose Gender</option>
               <option value ="M">Male</option>
               <option value ="F">Female</option>
            </select>
            <span>NIDA number</span>
            <input type="text" name="nida_no" required class="box">
            <span>Upload your NIDA ID  (scanned PDF)</span>
            <input type="file" name="nida_doc" accept="application/pdf" required class="box">
            <span>Upload Farm Deed document</span>
            <input type="file" name="farm_deed" accept="application/pdf" required class="box">
           
            
            
         </div>
      </div>
      <input type="submit" name="submit_loan_req" value="submit" class="btn">
      <a href="home.php" class="delete-btn">go back</a>
   </form>

</div>

</body>
</html>