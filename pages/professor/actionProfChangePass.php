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
include "/xampp/htdocs/project2/dynamics/professor/navigationProf.php";
?>
<?php
$conn=mysqli_connect("127.0.0.1","root","","project2");
if (isset($_POST['currentPassword']) && isset($_POST['newPassword'])
    && isset($_POST['newPasswordRepeat'])) {
    $curPassword=$_POST["currentPassword"];
    $newPassword=$_POST["newPassword"];
    $newPasswordRepeat=$_POST["newPasswordRepeat"];
    $userName=$_SESSION["user_name"];


    //taking rule values
    //MIN PASS
    $sqlrule1 = "	SELECT min_password from rules";
    $resultrule1 = mysqli_query($conn, $sqlrule1);
    $rowrule1=mysqli_fetch_array($resultrule1);
    $resultruleminpass=$rowrule1[0];



//MAX PASS
    $sqlrule2 = "	SELECT max_password from rules";
    $resultrule2 = mysqli_query($conn, $sqlrule2);
    $rowrule2=mysqli_fetch_array($resultrule2);
    $resultrulemaxpass=$rowrule2[0];


    //if pass is correct
    $sqlpassword="SELECT password from professors where user_name='$userName'";
    $resultpassword=mysqli_query($conn,$sqlpassword);
    $rowpassword=$resultpassword->fetch_row();
    $passwordCheck=$rowpassword[0];





    $sql = "SELECT password
                FROM professors WHERE 
                user_name='$userName'";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) === 1) {


        //checking rules and values
        if (strlen($newPassword) >= $resultruleminpass && strlen($newPassword) <= $resultrulemaxpass && $newPassword==$newPasswordRepeat && $curPassword==$passwordCheck) {

            $sql_2 = "UPDATE professors
        	          SET password=$newPassword
        	          WHERE user_name='$userName'";
            mysqli_query($conn, $sql_2);

            echo"<script type='text/javascript'>window.alert('Successful')</script>";
        }
        //IF PASSWORDS DOESNT MATCH
else if(strlen($newPassword) >= $resultruleminpass && strlen($newPassword) <= $resultrulemaxpass && $newPassword!=$newPasswordRepeat){

            echo "<script type='text/javascript'>window.alert('Passwords doesnt match');</script>";
        }
//IF CURRENT PASSWORD IS WRONG
else if($curPassword!=$passwordCheck){
    echo "<script type='text/javascript'>window.alert('Wrong Password');</script>";

}
//IF PASSWORD LENGTH RULES ARE NOT PROVIDED
else{
    echo "<script type='text/javascript'>
                    var message='Passwords must be between $resultruleminpass-$resultrulemaxpass'
                    window.alert(message);</script>";

}

    }
}
?>
<div class="wrapper" style="width: 500px; margin-top:20px;!important;">
    <div class="title" style="font-size: 35px;!important;">
        Change Password
    </div>
    <form action="actionProfChangePass.php" method="post">
        <div class="field">
            <input type="password" required name="currentPassword">
            <label>Current Password</label>
        </div>
        <div class="field">
            <input type="password" required name="newPassword">
            <label>New Password</label>
        </div>
        <div class="field">
            <input type="password" required name="newPasswordRepeat">
            <label>New Password(repeat)</label>
        </div>
        <div class="field">
            <input type="submit" value="Change Password" name="submit">
        </div>
    </form>
</div>
</body>
</html>