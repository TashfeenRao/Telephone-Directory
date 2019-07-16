<!DOCTYPE html>
<html>
<head>
	<title>Directry</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>

<?php require_once 'process.php';  ?>

<?php
if(isset($_SESSION['message'])): ?>

	<div class="alert-<?=$_SESSION['msg_type']?>">

		<?php
		echo $_SESSION['message'];
		unset($_SESSION['message']); ?>
		
	</div>
  <?php endif ?>
   <?php 


    
	$mysqli = new mysqli('localhost','root','','directory') or die(mysql_error($mysqli));
	$result = $mysqli->query("SELECT * FROM data") or die($mysqli->error);

    ?>
<div class="container">
    <div class="row justify-content-center">
    	<table class="table">
    		<thead>
    			<tr>
    				<th>Name</th>
    				<th>Address</th>
    				<th>phone</th>
    				<th colspan="2">Action</th>
    			</tr>
    		</thead>
    		<?php while($row = $result->fetch_assoc()):     ?>
    			<tr>
    				<td><?php echo $row['name']; ?></td>
    				<td><?php echo $row['address']; ?></td>
    				<td><?php echo $row['phone']; ?></td>
    				<td>
    					<a href="index.php?edit=<?php echo $row['id']; ?>" class="btn btn-info">Edit</a>
    					<a href="process.php?delete=<?php echo $row['id']; ?>" class="btn btn-danger">Delete</a>
    				</td>
    			<?php endwhile; ?>

    			</tr>
    	</table>
    </div>


<div class="row justify-content-center">
<form action="process.php" method="POST">
<input type="hidden" name="id" value="<?php echo $id; ?>">
	<div class="form-group">
		<label>Name</label>
   <input type="text" name="name" placeholder="Enter your name" value="<?php echo $name; ?>"></div>
   <div class="form-group">
   	<label>Address</label>
   <input type="varchar" name="address" placeholder="Enter your Address" value="<?php echo $address; ?>"></div>
   <div class="form-group">
   	<label>Phone</label>
   <input type="varchar" name="phone" placeholder="Enter your Phone" value="<?php echo $phone; ?>"></div>
   <div class="form-group">
   	<?php if ($update == true): ?>
   		<input type="submit" class="btn btn-info" name="update" value="update"></input>
   		<?php else: ?>
   	<input type="submit" class="btn btn-primary" name="save" value="Save"></input>
   <?php endif; ?>
   	
   </div>

</form>

</div>
</div>
</body>
</html>