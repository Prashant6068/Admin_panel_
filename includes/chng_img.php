<style>
    body{
        background: #F7F8F8;  
background: -webkit-linear-gradient(to right, #ACBB78, #F7F8F8);  
background: linear-gradient(to right, #ACBB78, #F7F8F8); 

    }
    form{
        background: #F7F8F8;  /* fallback for old browsers */
background: -webkit-linear-gradient(to right, #ACBB78, #F7F8F8);  /* Chrome 10-25, Safari 5.1-6 */
background: linear-gradient(to right, #ACBB78, #F7F8F8); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */

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
if (isset($_POST["sub"])) {
    $img_tmp = $_FILES["chng_img"]["tmp_name"];
    $img_name = $_FILES["chng_img"]["name"];

    $chng_imgErr = "";

    $ext = pathinfo($img_name, PATHINFO_EXTENSION);
    $image_path =  "attach-" . rand() . "-" . time() . "." . $ext;

    // image validation 
    if (empty($img_tmp)) {
        $chng_imgErr = "Please select png, jpg or jpeg file.";
    }

    if ($chng_imgErr === "") {
        move_uploaded_file($img_tmp, "user/$email/$image_path");
        file_put_contents("user/$email/" . "details.txt", $username . "\n" . substr(sha1($confirm_password), 5, 10) . "\n" . $name . "\n" . $age . "\n" . $gender . "\n" . $image_path);
        header("Refresh:3");
        $success_msg = "<div id='alert' class='alert alert-success position-absolute translate-middle bottom-0 end-0 w-25 text-center pt-3'>Image Uploaded Successfully</div>";       
    }
}
?>
<form class="form-si p-4 bg-white border rounded shadow " action="" method="POST" enctype="multipart/form-data">
    <div class="text-center">
        <h4 class="text-dark">Change Image</h4>
        <hr>
    </div>
    <div class="form-group">
        <label for="chng_img">Select Image</label>
        <input type="file" class="form-control" id="chng_img" name="chng_img">
        <small id="err" class="form-text text-danger"><?php echo $chng_imgErr; ?></small>
    </div>
    <button type="submit" class="btn btn-dark btn-block" name="sub">Confirm</button>
    <?php echo $success_msg; ?>
</form>