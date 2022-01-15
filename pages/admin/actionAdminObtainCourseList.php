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
?>
<div class="wrapper" style="width: 500px; margin-top:20px;!important; padding-bottom: 300px ">

    <div class="title" style="font-size: 35px;!important;">
        Course List:
    </div>
    <form action="actionAdminObtainCourseList.php" method="post">
        <div class="field">
            <p id="courses">
            <p style="font-family: 'Candara', sans-serif;font-weight: 900;color: #4158d0;border-radius: %80;border: #4158d0 solid;
padding: 10px">

                These are all the courses that is registered into database

            </p>

            <p style="text-align: center;color: #4158d0;font-weight: 700">Id | Course Name | Description</p>


            <p style="text-align: center;position: relative" >
                <?php


                //taking course list with sql
                $conn=mysqli_connect("127.0.0.1","root","","project2");
                $sql = "	SELECT courses.course_name,courses.course_id,courses.course_description FROM courses";
                $result = mysqli_query($conn, $sql);
                while($row=mysqli_fetch_array($result)){
                    echo $row["course_id"];
                    echo " ) ";
                    echo  $row["course_name"];
                    echo " | ";
                    echo $row["course_description"];
                    echo "<br>";
                }


                ?>
            </p>
        </div>
    </form>
</div>
</body>
</html>