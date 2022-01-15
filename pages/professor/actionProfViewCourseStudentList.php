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

//selecting professor_id
$userName=$_SESSION["user_name"];
$sql3="SELECT professor_id FROM professors WHERE user_name='$userName'";
$result3=mysqli_query($conn,$sql3);
$rowx=$result3->fetch_row();
$profId=$rowx[0];

if (isset($_POST['courseName'])) {

    //post
    $courseName=$_POST["courseName"];




    //selecting course id
    $sql4="SELECT course_id FROM courses WHERE course_name='$courseName'";
    $result4=mysqli_query($conn,$sql4);
    $rowy=$result4->fetch_row();
    $courseId=$rowy[0];



}
?>
<div class="wrapper" style="width: 500px; margin-top:20px;!important; padding-bottom: 300px ">

    <div class="title" style="font-size: 35px;!important;">
        Course List:
    </div>
    <form action="actionsStdRemoveCourse.php" method="post">
        <div class="field">
            <p id="courses">
            <p style="font-family: 'Candara', sans-serif;font-weight: 900;color: #4158d0;border-radius: %80;border: #4158d0 solid;
padding: 10px">

                These are the courses that you give and, to whom you give.

            </p>

            <p style="text-align: center;color: #4158d0;font-weight: 700">Course | Username</p>


            <p style="text-align: center;position: relative" >
                <?php

                //showing course and student list by using sql, inner join.
                $conn=mysqli_connect("127.0.0.1","root","","project2");
                $sql = "	SELECT courses.course_name,students.user_name FROM course_students
    INNER JOIN courses
		ON courses.course_giver_id='$profId' AND courses.course_id=course_students.course_id 
        INNER JOIN students ON students.student_id=course_students.student_id";
                $result = mysqli_query($conn, $sql);
                while($row=mysqli_fetch_array($result)){
                    echo $row["course_name"];
                    echo "-";
                    echo  $row["user_name"];
                    echo "<br>";
                }


                ?>
            </p>
        </div>
    </form>
</div>
</body>
</html>