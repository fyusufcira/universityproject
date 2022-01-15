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
if (isset($_POST["register"])){
    //post values
    $userName=$_POST["user_name"];
    $firstName=$_POST["first_name"];
    $lastName=$_POST["last_name"];
    $age=$_POST["age"];
    $email=$_POST["email"];
    $password=$_POST["password"];
    $passwordRepeat=$_POST["password_repeat"];
    $telNumber=$_POST["tel_number"];



    $conn=new mysqli("127.0.0.1","root","","project2");

    //taking rule values
    $sqlrule1 = "	SELECT min_password from rules";
    $resultrule1 = mysqli_query($conn, $sqlrule1);
    $rowrule1=mysqli_fetch_array($resultrule1);
    $resultruleminpass=$rowrule1[0];



//max password
    $sqlrule2 = "	SELECT max_password from rules";
    $resultrule2 = mysqli_query($conn, $sqlrule2);
    $rowrule2=mysqli_fetch_array($resultrule2);
    $resultrulemaxpass=$rowrule2[0];



    //took user name values from tables to check if username exists
    $sqlusername="SELECT user_name from students where user_name='$userName'";
    $resultusername=mysqli_query($conn,$sqlusername);

    $sqlusernamead="SELECT user_name from admins where user_name='$userName'";
    $resultusernameadmin=mysqli_query($conn,$sqlusernamead);

    $sqlusernamepr="SELECT user_name from professors where user_name='$userName'";
    $resultusernameprof=mysqli_query($conn,$sqlusernamepr);



    //checking if values, rules are correct
    if(strlen($password)>=$resultruleminpass && strlen($password)<=$resultrulemaxpass && $password==$passwordRepeat
    && mysqli_num_rows($resultusername)==0 && mysqli_num_rows($resultusernameadmin)==0 && mysqli_num_rows($resultusernameprof)==0
    ){

        //defining professor
        $db=new mysqli("127.0.0.1","root","","project2");
        $result=$db->query("INSERT INTO professors (user_name,first_name,last_name,age,email,password,tel_number,is_active)
 VALUES ('$userName','$firstName','$lastName',$age,'$email','$password',$telNumber,1)");

            echo "<script type='text/javascript'>window.alert('Professor Succesfully created')</script>";
    }
    else if(mysqli_num_rows($resultusername)>0||mysqli_num_rows($resultusernameadmin)>0||mysqli_num_rows($resultusernameprof)>0){
        echo"<script type='text/javascript'>window.alert('Username exist')</script>";

    }
    else if ($password!=$passwordRepeat){
        echo "<script type='text/javascript'>window.alert('Passwords doesnt match')</script>";
    }

    else{

        echo"<script type='text/javascript'>
            var message='Passwords must be between $resultruleminpass-$resultrulemaxpass';
window.alert(message)</script>";
    }


}

?>

<div class="wrapper" style="width: 500px; margin-top:20px;!important;">

    <div class="title" style="font-size: 35px;!important;">
        Define Professor
    </div>
    <form action="actionAdminDefineProfessor.php" method="post">
        <div class="field">
            <input type="text" required name="user_name">
            <label>User name</label>
        </div>

        <div class="field">
            <input type="text" required name="first_name">
            <label>Name</label>
        </div>

        <div class="field">
            <input type="text" required name="last_name">
            <label>Surname</label>
        </div>

        <div class="field">
            <input type="text" required name="age">
            <label>Age</label>
        </div>

        <div class="field">
            <input type="text" required name="email">
            <label>Email</label>
        </div>

        <div class="field">
            <input type="password" required name="password">
            <label>Password</label>
        </div>

        <div class="field">
            <input type="password" required name="password_repeat">
            <label>Password(repeat)</label>
        </div>

        <div class="field">
            <input type="text" required name="tel_number">
            <label>Telephone number</label>
        </div>

        <div class="field">
            <input type="submit" value="Register" name="register">
        </div>


    </form>
</div>




</body>


</html>


