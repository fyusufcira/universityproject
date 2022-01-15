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
    <form action="actionAdminGetUserStatistics.php" method="post">
        <div class="field">
            <p id="courses">
            <p style="font-family: 'Candara', sans-serif;font-weight: 900;color: #4158d0;border-radius: %80;border: #4158d0 solid;text-align: center;
padding: 10px;">

                Statistics:

            </p>



            <p style="text-align: center;position: relative" >
                <?php

                //checking active prof num
                $conn=mysqli_connect("127.0.0.1","root","","project2");
                $sql2 = "	SELECT COUNT(professor_id) FROM professors where is_active=1";
                $result2 = mysqli_query($conn, $sql2);
                while($row=mysqli_fetch_array($result2)){
                    echo "Active Professor: ";
                    echo $row[0];
                    echo "<br><br>";
                }

                //not active prof num
                $conn=mysqli_connect("127.0.0.1","root","","project2");
                $sql2 = "	SELECT COUNT(professor_id) FROM professors where is_active=0";
                $result2 = mysqli_query($conn, $sql2);
                while($row=mysqli_fetch_array($result2)){
                    echo "Deactivated Professor: ";
                    echo $row[0];
                    echo "<br><br>";
                }



                //active std
                $conn=mysqli_connect("127.0.0.1","root","","project2");
                $sql = "	SELECT COUNT(student_id) FROM students where is_active=1";
                $result = mysqli_query($conn, $sql);
                while($row=mysqli_fetch_array($result)){
                    echo "Active Student: ";
                    echo $row[0];
                    echo "<br><br>";
                }

                //not active std num
                $conn=mysqli_connect("127.0.0.1","root","","project2");
                $sql = "	SELECT COUNT(student_id) FROM students where is_active=0";
                $result = mysqli_query($conn, $sql);
                while($row=mysqli_fetch_array($result)){
                    echo "Deactivated Student: ";
                    echo $row[0];
                    echo "<br><br>";
                }



                ?>
            </p>
        </div>
    </form>
</div>
</body>
</html>