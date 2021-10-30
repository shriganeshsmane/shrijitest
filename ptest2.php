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
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST")
{
     // Validate number1
    if(empty(trim($_POST["Number2"])))
    {
        $n1_error = "Please enter a Number2.";
     	echo $n1_error;
    } 
    else{
               
        $n2= trim($_POST["Number2"]);
           //echo $n2;
          $_SESSION["num2"] = $n2;  

          $n1= $_SESSION["num"];

                    
            
    // Check input errors before updating the database
    if(!empty($n1) && !empty($n2) )
    {
        // Prepare an update statement
        $result = (int)$n1 + (int)$n2 ;
        echo "$result";
        
        $sql = "INSERT into input_data_for_add (num1,num2,result) values ( ".$n1.",".$n2.",".$result." )";
        
        if($stmt = mysqli_prepare($link, $sql)){
            
            if(mysqli_stmt_execute($stmt)){
                // Password updated successfully. Destroy the session, and redirect to login page
                //session_destroy();
            	
            	//echo " <script > alert('You Done ".$result." Succesfully') </script>";
 				
 				 unset($_SESSION["num"]);
 				 unset($_SESSION["num1"]);

 				$result=0;
                

                header("location: ptest1.php");
                exit();
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }


        }
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
               
                <label>Enter Number2</label>
                <input type="text" name="Number2" class="form-control" >
                
                 <span class="invalid-feedback"><?php echo $n2_error; ?></span>

            </div>    
            
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="EXECUTE">

                <input type="reset" class="btn btn-secondary ml-2" value="Reset">
                <a href="ptest1.php" class="btn btn-primary" > back </a>
              </div>
        </form>
    </div>    
</body>
</html>