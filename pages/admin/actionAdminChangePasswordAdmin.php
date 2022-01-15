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
    $id=$_POST["id"];


    $curPassword=$_POST["currentPassword"];
    $newPassword=$_POST["newPassword"];
    $newPasswordRepeat=$_POST["newPasswordRepeat"];



    //taking rules from rules table, min password and max password
    $sqlrule1 = "	SELECT min_password from rules";
    $resultrule1 = mysqli_query($conn, $sqlrule1);
    $rowrule1=mysqli_fetch_array($resultrule1);
    $resultruleminpass=$rowrule1[0];



//max password
    $sqlrule2 = "	SELECT max_password from rules";
    $resultrule2 = mysqli_query($conn, $sqlrule2);
    $rowrule2=mysqli_fetch_array($resultrule2);
    $resultrulemaxpass=$rowrule2[0];





    //checking if password is correct
$sqlpassword="SELECT admins.password from admins where admin_id=$id";
$resultpassword=mysqli_query($conn,$sqlpassword);
    $rowpassword=$resultpassword->fetch_row();
    $passwordCheck=$rowpassword[0];




    $sql = "SELECT admins.user_name,admins.admin_id from admins where admins.admin_id=$id
                            ";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) === 1 ) {

//checking if current password is correct
        if($passwordCheck!=$curPassword){
            echo "
            <script type='text/javascript'>
            window.alert('Wrong password');
</script>
            
            ";
        }
//checking if rules are correct, passwords match
        else if(strlen($newPassword)>=$resultruleminpass && strlen($newPassword)<=$resultrulemaxpass && $newPasswordRepeat==$newPassword ) {
            $sql_2 = "UPDATE admins
        	          SET password='$newPassword'
        	          WHERE admin_id=$id and password='$curPassword' and '$newPassword'='$newPasswordRepeat' ";
            mysqli_query($conn, $sql_2);

            echo "<script type='text/javascript'>window.alert('Successful')</script>";

        }
        //if rules, or passwords doesnt match
        else if(strlen($newPassword)>=$resultruleminpass && strlen($newPassword)<=$resultrulemaxpass && $newPasswordRepeat!=$newPassword){
            echo " 
                    <script type='text/javascript'>
                    window.alert('Passwords doesnt match'); 
</script>
            ";
        }
        else{

            //max min rules
            echo " 
                    <script type='text/javascript'>
                    var message='Password length must be between   $resultruleminpass-$resultrulemaxpass';
                    window.alert(message); 
</script>
            ";

        }


    }
}
?>
<div class="wrapper" style="width: 500px; margin-top:20px;!important;">
    <div class="title" style="font-size: 35px;!important;">
        Change Password
    </div>
    <form action="actionAdminChangePasswordAdmin.php" method="post">






         <p style="font-family: 'Candara', sans-serif;font-weight: 900;color: #4158d0;border-radius: %80;border: #4158d0 solid;
padding: 10px">
                Type in the id of the admin you want to change password of
            </p>

            <p style="text-align: center;color: #4158d0;font-weight: 700">Id | Username</p>

            <p style="text-align: center;position: relative;" >
                <?php

                //showing admins
                $conn=mysqli_connect("127.0.0.1","root","","project2");
                $sql = "    SELECT admins.user_name,admins.admin_id from admins
                             ";
                $result = mysqli_query($conn, $sql);
                while($row=mysqli_fetch_array($result)){

                    echo $row["admin_id"];
                    echo " ) ";
                    echo $row["user_name"];
                    echo "<br>";
                }

?>
        <div class="field">
            <input type="text" required name="id">
            <label>Id</label>
        </div>

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