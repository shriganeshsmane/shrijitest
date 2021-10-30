<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>



<?php
// Include config file
require_once "config.php";

if(isset($_SESSION["result"]))  echo  $_SESSION["result"];


// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate number1
    if(empty(trim($_POST["Number1"])))
    {
        $n1_error = "Please enter a Number1.";
     	echo $n1_error;
    } 
    else{
               
        $n1= trim($_POST["Number1"]);
         //  echo $n1;  
          $_SESSION["num"]=$n1;

           header("location: ptest2.php");                
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>NUM1</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body{ font: 14px sans-serif; }
        .wrapper{ width: 360px; padding: 20px; }
    </style>
</head>
<body>
    <div class="wrapper">
        <h2>Program</h2>
        
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

            <div class="form-group">
               
                <label>Enter Number</label>
                <input type="text" name="Number1" class="form-control" >
                
                 <span class="invalid-feedback"><?php echo $n1_error; ?></span>

            </div>    
            
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Next">
                <input type="reset" class="btn btn-secondary ml-2" value="Reset">
            </div>
        </form>
    </div>    
</body>
</html>