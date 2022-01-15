<?php
session_start();
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
include "/xampp/htdocs/project2/dynamics/general/navigation.php";
?>

<?php
if(isset($_POST["submit"])){
//post
    $userName= $_POST["user_name"];
    $password= $_POST["password"];
    $db=new mysqli("127.0.0.1","root","","project2");
    //check if login values are correct
    $result=$db->query("select * from professors where user_name='$userName' and password='$password'");


    if($result->num_rows==0){
        echo "<script type='text/javascript'>window.alert('Username or Password is wrong. Please try again')</script>";

    }
    else{
        $_SESSION["user_name"]=$userName;


        header("Location:profIndex.php");

    }

}

?>

<div class="wrapper">
    <div class="title">Login</div>
    <form action="loginProfessor.php" method="post">
        <div class="field">
            <input type="text" required name="user_name">
            <label>User name</label>
        </div>
        <div class="field">
            <input type="password" required name="password">
            <label>Password</label>
        </div>
        <div class="field">
            <input type="submit"  name="submit" value="Login">
        </div>
    </form>

</div>

</body>

</html>