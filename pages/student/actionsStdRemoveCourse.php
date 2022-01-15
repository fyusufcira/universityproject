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
include "/xampp/htdocs/project2/dynamics/student/navigationStudent.php";
?>


<?php

//selecting std it
$conn=mysqli_connect("127.0.0.1","root","","project2");
$userName=$_SESSION["user_name"];
$sql3="SELECT student_id FROM students WHERE user_name='$userName'";
$result3=mysqli_query($conn,$sql3);
$rowx=$result3->fetch_row();
$studentId=$rowx[0];

if (isset($_POST['courseName'])) {

    $courseName=$_POST["courseName"];


//taking values and the deleting sql query.

    $sql4="SELECT course_id FROM courses WHERE course_name='$courseName'";
    $result4=mysqli_query($conn,$sql4);
    $rowy=$result4->fetch_row();
    $courseId=$rowy[0];



    //deleting course
    $sql2 = "DELETE FROM course_students where course_id='$courseId' AND student_id=$studentId";
    mysqli_query($conn, $sql2);
}
?>
<div class="wrapper" style="width: 500px; margin-top:20px;!important;">

    <div class="title" style="font-size: 35px;!important;">
        Remove Course
    </div>
    <form action="actionsStdRemoveCourse.php" method="post">
        <div class="field" style="padding-bottom: 100px">
            <p id="courses">
            <p style="font-family: 'Candara', sans-serif;font-weight: 900;color: #4158d0;border-radius: %80;border: #4158d0 solid;
padding: 10px">
                Type in the name of the course you want to remove(Below courses are the ones in your course list, which means you ADDED them BEFORE)
            </p>

            <p style="text-align: center;position: relative; " >
                <?php


                $conn=mysqli_connect("127.0.0.1","root","","project2");
                //showing std courses that is taken by him.
                $sql = "
                            SELECT courses.course_name 
                            FROM courses 
                            INNER JOIN course_students 
                            ON  course_students.course_id=courses.course_id
                            AND course_students.student_id='$studentId' ";
                $result = mysqli_query($conn, $sql);
                while($row=mysqli_fetch_array($result)){
                    echo $row["course_name"];
                    echo "<br> ";
                }


                ?>
            </p>
        </div>

        <div class="field" style="padding-top: 100px">
            <input type="text" required name="courseName">
            <label>Course Name</label>
        </div>


        <div class="field">
            <input type="submit" value="Submit" name="changepass">
        </div>

    </form>
</div>
</body>
</html>