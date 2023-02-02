<?php
require_once "config.php";

$name = $email = $gender =$agree= "";
$name_err = $email_err= "";

if(isset($_POST["id"]) && !empty($_POST["id"])){

    $id = $_POST["id"];
    

$input_name = trim($_POST["name"]);
if(empty($input_name)){
$name_err = "Please enter a name.";
} elseif(!filter_var($input_name, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
$name_err = "Please enter a valid name.";
} else{
$name = $input_name;
}


$input_email = trim($_POST["email"]);
if(empty($input_email)){
$salary_err = "Please enter the salary amount.";     
} else{
$email = $input_email;
}


if(isset($_POST["gender"])){   
$gender = $_POST["gender"];
}

if(isset($_POST["agree"])){
    $agree ="Yes";
}else{
    $agree="No";
}

if(empty($name_err) && empty($email_err)){

    $sql = "UPDATE employee SET `name`=?, `email`=?, `gender`=?, `agree`=?  WHERE id=?";
     
    if($stmt = mysqli_prepare($link, $sql)){
        mysqli_stmt_bind_param($stmt, "ssssi", $param_name, $param_email, $param_gender,
        $param_agree, $param_id);

        $param_name = $name;
        $param_email = $email;
        $param_gender = $gender;
        $param_agree = $agree;
        $param_id = $id;
        
        if(mysqli_stmt_execute($stmt)){
            header("location: index.php");
            exit();
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }
    }

mysqli_stmt_close($stmt);
}
mysqli_close($link);
}else{
    if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
        $id =  trim($_GET["id"]);
        $sql = "SELECT * FROM employee WHERE id = ?";
        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "i", $param_id);
            $param_id = $id;
            
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
    }  else{
        header("location: error.php");
        exit();
    }
}
?>
 

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
</head>
<body>
<nav class="navbar navbar-light justify-content-center fs-3 mb-5" style="background-color: #00ff5573" >
    <p>User Update Data</p>
</nav>
<div class="contanier">
    <div class="text-center  mb-4 ">
        <h3>Add New User</h3>
        <p class="text-muted">Complete The Form blow To Add A New User </p>
    </div>
</div>

<div class="contanier d-flex justify-content-center">
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" style="width:50vw;min-width:300px;" >
<div class="row  mb-3">
    <div class="col">
        <label class="form-label">Name&nbsp;:</label>
        <input type="text" class="form-control   <?php echo (!empty($name_err)) ? 'is-invalid' : ''; ?> " name="name" placeholder="Enter Your Name" value="<?php echo $name; ?> ">
        <span class="invalid-feedback"><?php echo $name_err;?></span>
    </div>
</div>
<div class="mb-3">
        <label class="form-label">Email&nbsp;:</label>
        <input type="text" class="form-control  <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?> " name="email" placeholder="Enter Your Email" value="<?php echo $email; ?>">
        <span class="invalid-feedback"><?php echo $email_err;?></span>
    </div>

    <div class="form-grop mb-3 ">
        <label>Gender&nbsp;:</label>&nbsp;
        <input type="radio" class="form-check-input" name="gender" id="M" value="M"  value="<?php echo $gender; ?>">
        <label for="M" class="form-lable">Male</label>
        &nbsp;
        <input type="radio" class="form-check-input" name="gender" id="F" value="F"  value="<?php echo $gender; ?>">
        <label for="F" class="form-lable">Famale</label>
    </div>

    <div class="mb-3">
        <input type="checkbox" class="form-check-input" name="agree"  value="<?php echo $agree; ?>" >
        <label class="form-label"> &nbsp; Resive Email Form Us</label>
    </div>

    <div>
        <button type="submit" class="btn btn-success" name="submit" >Save</button>
        <a href="index.html" class="btn btn-danger" >Cancel</a>
    </div>

</form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>