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
if (isset($_POST["register"])){

    $conn=mysqli_connect("127.0.0.1","root","","project2");



    $userName=$_POST["user_name"];
    $firstName=$_POST["first_name"];
    $lastName=$_POST["last_name"];
    $age=$_POST["age"];
    $email=$_POST["email"];
    $password=$_POST["password"];
    $passwordRepeat=$_POST["password_repeat"];
    $telNumber=$_POST["tel_number"];



    $sqlrule1 = "	SELECT min_password from rules";
    $resultrule1 = mysqli_query($conn, $sqlrule1);
    $rowrule1=mysqli_fetch_array($resultrule1);
    $resultruleminpass=$rowrule1[0];




    $sqlrule2 = "	SELECT max_password from rules";
    $resultrule2 = mysqli_query($conn, $sqlrule2);
    $rowrule2=mysqli_fetch_array($resultrule2);
    $resultrulemaxpass=$rowrule2[0];




    if ( (strlen($password) < $resultruleminpass || strlen($password) > $resultrulemaxpass)){
            echo " 
                    <script type='text/javascript'>
                    var message='Password length must be between   $resultruleminpass-$resultrulemaxpass';
                    window.alert(message); 
</script>
            ";




    }

    else if($password!=$passwordRepeat){
        echo"
                <script type='text/javascript'>
                
                var message='Passwords doesnt match'
                window.alert(message);
                
</script>
        
        ";
    }

    else{
        $db=new mysqli("127.0.0.1","root","","project2");
        $sql2 = "INSERT INTO students (user_name,first_name,last_name,age,email,password,tel_number,is_active)
 VALUES ('$userName','$firstName','$lastName',$age,'$email','$password',$telNumber,1)";
        mysqli_query($db, $sql2);
    }




}

?>

<div class="wrapper" style="width: 500px; margin-top:20px;!important;">

    <div class="title" style="font-size: 35px;!important;">
        Register
    </div>
    <form action="register.php" method="post">
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


