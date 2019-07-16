<?php

session_start();

$mysqli = new mysqli('localhost','root','','directory') or die(mysqli_error($mysqli));
$update=false;
$name='';
$address='';
$phone='';
$id=0;

if(isset($_POST['save'])){

   if(isset($_POST['name']) && $_POST['name'] !='')

      {
     $name = $_POST['name'];      
      }
   else{
 	 $error[] = 'name is missing';
       }

   if(isset($_POST['address']) && $_POST['address'] !='')
    
       {
     $address = $_POST['address'];
       }
   else{
 	 $error[] = 'address is missing';
       }

 if(isset($_POST['phone']) && $_POST['phone'] !=''){

 	$phone = $_POST['phone'];
 }

   else{

 	  $error[] ='password is missing';
       }

if(!isset($error)){

	$q=  "INSERT INTO data(`name`,`address`,`phone`) VALUES('$name','$address','$phone')"; 


    if ($mysqli->query($q) === TRUE) {
    $_SESSION['message'] = "Record has been Submited!";
    $_SESSION['msg_type'] = "success";
    header("location: index.php");
                                     } 
    else {
    echo "Error: " . $q . "<br>" . $connect->error;
         }
                  }
else{
	
	foreach ($error as $value) {
		# code...

		//echo $value;
		//echo '<br>';
	}
 }
}


if(isset($_GET['delete'])){
	$id = $_GET['delete'];

	$mysqli->query("DELETE FROM data WHERE id=$id") or die($mysqli->error());
	$_SESSION['message'] = "Record has been Deleted!";
    $_SESSION['msg_type'] = "danger";

    header("location: index.php");
}
if(isset($_GET['edit'])){
	$id = $_GET['edit'];
	$update = true;

	$result = $mysqli->query("SELECT * FROM data WHERE id=$id") or die($mysqli->error());
	//$_SESSION['message'] = "Record has been Updated!";
    //$_SESSION['msg_type'] = "success";

    if ($result!=''){
    	$row = $result->fetch_array();
    	$name = $row['name'];
    	$address = $row['address'];
    	$phone = $row['phone'];
                    }


    //header("location: index.php");
}

if (isset($_POST['update'])){
	$id = $_POST['id'];
	$name = $_POST['name'];
	$address = $_POST['address'];
	$phone = $_POST['phone'];

$mysqli->query("UPDATE data SET name='$name', address='$address', phone='$phone' WHERE id=$id")
or die($mysqli->error);
$_SESSION['message'] = "Record has been updated!";
$_SESSION['msg_type'] = "warning";

header('location: index.php');

}



?>