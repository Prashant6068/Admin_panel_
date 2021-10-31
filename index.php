<?php
error_reporting(0);
session_start();

// session login logic
if (!empty($_SESSION["email"])) {
    header("location: dashboard.php");
}

include("includes/captcha.php");


// input fields 
$email = input_field($_POST["email"]);
$password = input_field($_POST["password"]);

// error variables 
$emailErr = $passwordErr  = "";

// query string 
$uid = $_GET["uid"];

// validation
if (isset($_POST["sub"])) {

    // email validation 
    if (empty($email)) {
        $emailErr = "Please Enter Email Address.";
    } else if (!preg_match("/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/", $email)) {
        $emailErr = "Invalid Email Address.";
    }

    // password validation 
    if (empty($password)) {
        $passwordErr = "Please Enter Password.";
    } else if (!preg_match("/^[a-zA-Z0-9]{3,16}+$/", $password)) {
        $passwordErr = "Length of password should be between 4, 16 characters.";
    }

    // login logic 
    if ($emailErr === "" && $passwordErr  === "") {
        if (is_dir("user/" . $email)) {
            $fo = fopen("user/$email/details.txt", "r");
            fgets($fo);
            $pass = substr(sha1($password), 0, 10);
            if ($pass === trim(fgets($fo))) {
                $_SESSION["email"] = $email;
                if (!empty($_POST["remember"])) {
                    setcookie("email", $email, time() + 3600 * 24);
                    setcookie("pass", $password, time() + 3600 * 24);
                }
                header("Location: dashboard.php");
                exit();
            } else {
                $passwordErr = "Wrong Password.";
            }
        } else {
            $emailErr = "Please check your Email id.";
        }
    }
}

// redirecting to registeration page 
if (isset($_POST["reg"])) {
    header("Location: register.php");
    exit();
}

// trim function 
function input_field($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>
<!doctype html>
<html lang="en">
<style>
     form{
        
  
        background: #FFEFBA;  
background: -webkit-linear-gradient(to right, #FFFFFF, #FFEFBA);  
background: linear-gradient(to right, #FFFFFF, #FFEFBA); 

        
    }h4{
        border-bottom: 2px solid black;
    }
  
    

      

        
        /* text-align: center; */
    
        h1{
        text-transform: uppercase;
        text-shadow: silver;
        text-decoration: underline;
        font-weight: bolder;
        letter-spacing: 2px;
        font-family: Georgia, 'Times New Roman', Times, serif;
    }
    
</style>
<!-- head tag -->
<?php include("includes/head.php"); ?>

<body>

  
</div>

          
      
        <div class="jumbotron bg-dark text-white">
  <h1 class="text-center">Login Panel</h1>
  
</div>

    
        <div class="container">
            <form class="form p-4  border rounded" method="POST" enctype="multipart/form-data">
                <div>
        <section class="container">
          
      
          <div class="container">
          
        <form class="form container" method="POST">
        
  
  <div >
        
  
  

            
            <div class="col-md">
                <form class="form-si p-4 bg-white border rounded shadow" method="POST">
                   
                <h4 class="py-3 text-dark ">Login</h4>
                    <div class="form-group">
                        <label for="email">Email address</label>
                        
                        
 

                        

                        <input type="text" class="form-control"  id="email" name="email" onchange="cook();" placeholder="Enter email" value="<?php echo $_GET["uid"]; ?>">
                        <small id="err" class="form-text text-danger"><?php echo $emailErr; ?></small>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Enter password">
                        <small id="err" class="form-text text-danger"><?php echo $passwordErr; ?></small>
                    </div>
                    <div class="checkbox mb-3">
                        <label>
                            <input type="checkbox" id="check" name="remember" value="checked"> Remember me
                        </label>
                    </div>
                    <!-- <div class="row"> -->
                        <div >
                            <button type="submit" class="btn btn-dark " name="sub">Login</button>
                       
                            <button type="submit" class="btn btn-danger " name="reg"><a href="./register.php" class="text-decoration-none text-white">New user</a></button>
                        </div>
                    
                </form>
            </div>
        </div>
    </div>
</section>

    <!-- Bootstrap js jquery -->
    <?php include("includes/script.php"); ?>

    <script>
        $(() => {
            window.setTimeout(() => {
                $("#alert").fadeOut(1000);
            }, 2000);
        });

        const cook = () => {
            if (document.getElementById("email").value == "<?php echo $_COOKIE["email"]; ?>") {
                document.getElementById("password").value = "<?php echo $_COOKIE["pass"]; ?>";
            } else {
                document.getElementById("password").value = "";
            }
        }
    </script>

</body>

</html>
