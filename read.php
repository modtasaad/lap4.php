<?php

if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){

require_once "config.php";

$sql = "SELECT * FROM employee WHERE id = ?";

if($stmt = mysqli_prepare($link, $sql)){

mysqli_stmt_bind_param($stmt, "i", $param_id);


$param_id = trim($_GET["id"]);

if(mysqli_stmt_execute($stmt)){
$result = mysqli_stmt_get_result($stmt);

if(mysqli_num_rows($result) == 1){
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
$name = $row["name"];
$email = $row["email"];
$gender = $row["gender"];
$agree = $row["agree"];
} else{
header("location: error.php");
exit();
}

} else{
echo "Oops! Something went wrong. Please try again later.";
}
}


mysqli_stmt_close($stmt);

mysqli_close($link);
} else{
header("location: error.php");
exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>View Record</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<style>
.wrapper{
width: 600px;
margin: 0 auto;
}
</style>
</head>
<body>
<div class="wrapper">
<div class="container-fluid">
<div class="row">
<div class="col-md-12">
<h1 class="mt-5 mb-3">View Record</h1>
<div class="form-group">
<label>Name</label>
<p><b><?php echo $row["name"]; ?></b></p>
</div>
<div class="form-group">
<label>Email</label>
<p><b><?php echo $row["email"]; ?></b></p>
</div>
<div class="form-group">
<label>Gender</label>
<p><b><?php echo $row["gender"]; ?></b></p>
</div>
<div class="form-group">
<label>Mail Status</label>
<p><b><?php echo $row["agree"]; ?></b></p>
</div>
<p><a href="index.php" class="btn btn-primary">Back</a></p>
</div>
</div>        
</div>
</div>
</body>
</html>