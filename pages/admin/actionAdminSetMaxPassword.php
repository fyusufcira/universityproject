<?php
session_start();
if (!isset($_SESSION["user_name"])) {
    header("Location:index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Project2</title>
    <link rel="stylesheet" type="text/css" href="../../css/style.css">
</head>
<body>
<?php
include "/xampp/htdocs/project2/dynamics/admin/navigationAdmin.php";
?>
<?php
$conn=mysqli_connect("127.0.0.1","root","","project2");






if (isset($_POST['submit'])) {
    $maxPassword=$_POST["maxPassword"];

    //setting max password length
    $sql_2 = "UPDATE rules
        	          SET max_password=$maxPassword ";
    mysqli_query($conn, $sql_2);
    echo"<script type='text/javascript'>window.alert('Successful')</script>";

}
?>
<div class="wrapper" style="width: 500px; margin-top:20px;!important;">
    <div class="title" style="font-size: 35px;!important;">
        Change Maximum Password Length
    </div>
    <form action="actionAdminSetMaxPassword.php" method="post">






        <p style="font-family: 'Candara', sans-serif;font-weight: 900;color: #4158d0;border-radius: %80;border: #4158d0 solid;
padding: 10px">
            Enter the length of password that is maximum to register a user into system
        </p>


        <p style="text-align: center;position: relative;" >



        <div class="field">
            <input type="text" required name="maxPassword">
            <label>Maximum Password Length</label>
        </div>


        <div class="field">
            <input type="submit" value="Set Maximum Password Length" name="submit">
        </div>
    </form>
</div>
</body>
</html>