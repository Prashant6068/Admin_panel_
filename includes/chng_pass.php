<style>
    body{
        background: #F7F8F8;  /* fallback for old browsers */
background: -webkit-linear-gradient(to right, #ACBB78, #F7F8F8);  /* Chrome 10-25, Safari 5.1-6 */
background: linear-gradient(to right, #ACBB78, #F7F8F8); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */

    }
    form{
        background: #F7F8F8;  /* fallback for old browsers */
background: -webkit-linear-gradient(to right, #ACBB78, #F7F8F8);  /* Chrome 10-25, Safari 5.1-6 */
background: linear-gradient(to right, #ACBB78, #F7F8F8); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */  
background: #FFEFBA;  
background: -webkit-linear-gradient(to right, #FFFFFF, #FFEFBA);  
background: linear-gradient(to right, #FFFFFF, #FFEFBA); 
 
}
    h4{
        text-transform: uppercase;
        font-weight: bolder;
        font-family: 'Times New Roman', Times, serif; 
    }
    label{
        font-weight: 600;
    }
</style>

<?php 
$old_password = input_field($_POST["old_password"]);
$new_password = input_field($_POST["new_password"]);
$confirm_password = input_field($_POST["confirm_password"]);
$old_passwordErr = $new_passwordErr = $confirm_passwordErr = "";

if (isset($_POST["sub"])) {

    // old password validation 
    if (empty($old_password)) {
        $old_passwordErr = "Please Enter old password";
    } else if (!preg_match("/^[a-zA-Z0-9]{3,16}+$/", $old_password)) {
        $old_passwordErr = "Only characters and number are allowed. Length should be between 4 to 16.";
    }

    // new password validation 
    if (empty($new_password)) {
        $new_passwordErr = "Please Enter new password";
    } else if (!preg_match("/^[a-zA-Z0-9]{3,16}+$/", $new_password)) {
        $new_passwordErr = "Only characters and number are allowed. Length should be between 4 to 16.";
    }

    // confirm password validation 
    if (empty($confirm_password)) {
        $confrim_passwordErr = "Please Enter new password again";
    } else if (!preg_match("/^[a-zA-Z0-9]{3,16}+$/", $confrim_password)) {
        $confrim_passwordErr = "Only characters and number are allowed. Length should be between 4 to 16.";
    }

    // change password logic 
    if ($old_passwordErr === "" && $new_passwordErr === "" && $confirm_passwordErr === "") {
        if (trim($password) !== substr(sha1($old_password), 0, 10)) {
            $old_passwordErr = "Enter Correct Password";
        } else {
            if ($confirm_password != $new_password) {
                $confirm_passwordErr = "Password doesn't Match";
            } else {
                file_put_contents("user/$email/" . "details.txt", $username . "\n" . substr(sha1($confirm_password), 0, 10) . "\n" . $name . "\n" . $age . "\n" . $gender . "\n" . $image_path);
                $success_msg = "<div id='alert' class='alert alert-success position-absolute translate-middle bottom-0 end-0 w-25 text-center pt-3'>Password Changed Successfully</div>";
            }
        }
    }
}

?>
<form class="form-si p-4 bg-white border rounded shadow" method="POST">
    <div class="text-center">
        <h4 class="text-dark">Change Password</h4>
        <hr>
    </div>
    <div class="form-group">
        <label for="email">Old Password</label>
        <input type="password" class="form-control" id="email" name="old_password" placeholder="Enter Password" value="<?php echo $_GET["uid"]; ?>">
        <small id="err" class="form-text text-danger"><?php echo $old_passwordErr; ?></small>
    </div>
    <div class="form-group">
        <label for="password">New Password</label>
        <input type="password" class="form-control" id="password" name="new_password" placeholder="Enter password">
        <small id="err" class="form-text text-danger"><?php echo $new_passwordErr; ?></small>
    </div>
    <div class="form-group">
        <label for="password">Confirm Password</label>
        <input type="password" class="form-control" id="password" name="confirm_password" placeholder="Enter password">
        <small id="err" class="form-text text-danger"><?php echo $confirm_passwordErr; ?></small>
    </div>
    <button type="submit" class="btn btn-dark btn-block" name="sub">Change Password</button>
    <?php echo $success_msg; ?>
</form>