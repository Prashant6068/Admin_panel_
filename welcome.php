<?php
// session login logic
session_start();
if (!empty($_SESSION["email"])) {
    header("location: dashboard.php");
}

?>
<!DOCTYPE html>
<html lang="en">
    <style>
        .t1{
            background: #f12711;  /* fallback for old browsers */
background: -webkit-linear-gradient(to right, #f5af19, #f12711);  /* Chrome 10-25, Safari 5.1-6 */
background: linear-gradient(to right, #f5af19, #f12711); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */

        }
       
        
    </style>
<?php include("includes/head.php"); ?>

<body class="bg-dark">
    <div class="container content ">
        <div class="row ">
            <div class="col-md m-auto">
                <div class="container text-center ">
                    <p class="display-4 t1">Welcome!</p>
                    
                    
                </div>
            </div>
            <div class="col-md m-auto border rounded shadow">
                <div class="container text-left  m-3 t1">
                    <h4>You are registered successfully with id: <?php echo $_GET["uid"]; ?></h4>
                    <h6>For login Click on: <a class="btn btn-dark" href="index.php?uid=<?php echo $_GET["uid"]; ?>">Login</a></h6>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap js jquery -->
    <?php include("includes/script.php"); ?>
    
</body>

</html>