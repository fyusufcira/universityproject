<style>
    .list-user{
        background: linear-gradient(90deg, rgba(34,34,34,1) 0%, rgba(85,214,170,1) 100%);
        display: inline-block;
        position: relative;
        padding:30px;
        margin-top: 100px;
        margin-left: 50px;
        border-radius: 50%;
    }
    .list-item{
        font-family: 'Work Sans', sans-serif;
        font-weight: 800;
        text-decoration: none;
        font-size: 15px;
        color: #ffffff;
    }
</style>



<?php
session_start();
if (!isset($_SESSION["user_name"])){
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







<div class="wrapper" style="width: 500px; margin-top:20px;!important;">

    <div class="title" style="font-size: 35px;!important;margin-top: 160px">
        Select Parameter
    </div>

    </form>
</div>

<li class="list-user" style=";padding: 50px">
    <a href="../../pages/admin/actionAdminSetMinPassword.php" class="list-item">Min Password Length</a>
</li>

<li class="list-user" style="padding: 50px">
    <a href="../../pages/admin/actionAdminSetMaxPassword.php" class="list-item">Max Password Length</a>
</li>

<li class="list-user" style="padding: 50px">
    <a href="../../pages/admin/actionAdminSetMaxCourseSystem.php" class="list-item">Max Course Number In the System </a>
</li>

<li class="list-user" style="padding: 50px">
    <a href="../../pages/admin/actionAdminSetMaxCourseStudent.php" class="list-item">Max Course Num for Students </a>
</li>


<li class="list-user" style="padding: 50px;margin-left: 38%">
    <a href="../../pages/admin/actionAdminSetMaxCourseProfessor.php" class="list-item" style="">Max Course Number for Professors </a>
</li>





</body>


</html>


