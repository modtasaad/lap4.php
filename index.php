<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--BOOTSTRAP-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <title>CRUD OPRATION</title>

    <!--FONT CDN-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!--BOXICON-->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
<nav class="navbar navbar-light justify-content-center fs-3 mb-5" style="background-color: #00ff5573" >
    <p>User Information</p>
</nav>

<div class="container">
<a href="creat.php" class="btn btn-dark pull-right mb-3 "><i class="fa fa-plus"></i> Add New User</a>


<?php
require_once "config.php";

$sql = "SELECT * FROM employee";
if($result = mysqli_query($link, $sql)){
if(mysqli_num_rows($result) > 0)
{
    echo '<table class="table table-hover text-center">';
    echo '<thead  class="table-dark" >';
    echo "<tr>";
    echo "<th>ID</th>";
    echo "<th>Name</th>";
    echo "<th>Email</th>";
    echo "<th>Gender</th>";
    echo "<th>Mail Status</th>";
    echo "<th>Action</th>";
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";
    while($row = mysqli_fetch_array($result)){
    echo "<tr>";
    echo "<td>" . $row['id'] . "</td>";
    echo "<td>" . $row['name'] . "</td>";        
    echo "<td>" . $row['email'] . "</td>";
    echo "<td>" . $row['gender'] . "</td>";
    echo "<td>" . $row['agree'] . "</td>";
    echo "<td>";
    echo '<a href="read.php?id='. $row['id'] .'" class="mr-4 link-dark " title="View Record" data-toggle="tooltip"><span class="fa fa-eye"></span></a>';
    echo '<a href="update.php?id='. $row['id'] .'" class="mr-4 link-dark" title="Update Record" data-toggle="tooltip"><span class="fa fa-pencil"></span></a>';
    echo '<a href="delete.php?id='. $row['id'] .'" title="Delete Record" data-toggle="tooltip" class="mr-4 link-dark" ><span class="fa fa-trash"></span></a>';
    echo "</td>";
    echo "</tr>";
}
echo "</tbody>";                            
echo "</table>";

mysqli_free_result($result);
} else{
echo '<div class="alert alert-danger"><em>No records were found.</em></div>';
}
} else{
echo "Oops! Something went wrong. Please try again later.";
}


mysqli_close($link);
?>

</div>
</body>
</html>