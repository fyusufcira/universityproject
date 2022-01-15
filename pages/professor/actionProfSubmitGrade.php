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
//POST
$userName=$_SESSION["user_name"];
//SELECTING ID
$sql3="SELECT professor_id FROM professors WHERE user_name='$userName'";
$result3=mysqli_query($conn,$sql3);
$rowx=$result3->fetch_row();
$profId=$rowx[0];




if (isset($_POST['submit'])) {

//POST
    $studentId=$_POST["studentId"];
    $grade=$_POST["grade"];
    $courseName=$_POST["courseName"];


//SELECTING COURSE ID
    $sql4="SELECT course_id FROM courses WHERE course_name='$courseName'";
    $result4=mysqli_query($conn,$sql4);
    $rowy=$result4->fetch_row();
    $courseId=$rowy[0];

    //SETTING GRADE
    $sql2 = "UPDATE course_students SET grade='$grade' where student_id=$studentId and course_id=$courseId";
    mysqli_query($conn, $sql2);
//SETTING IS_GRADED TO 1 AFTER GIVING GRADE
    $sqllast="UPDATE course_students set is_graded=1 where student_id=$studentId AND course_id=$courseId";
    mysqli_query($conn,$sqllast);
}
?>
<div class="wrapper" style="width: 500px; margin-top:20px;!important;">

    <div class="title" style="font-size: 35px;!important;">
        Submit Grade
    </div>
    <form action="actionProfSubmitGrade.php" method="post">
        <div class="field">
            <p id="courses">
            <p style="font-family: 'Candara', sans-serif;font-weight: 900;color: #4158d0;border-radius: %80;border: #4158d0 solid;
padding: 10px">
                Type in the name of the course and id of student to submit grade(Below students are taking your course)
            </p>

            <p style="text-align: center;color: #4158d0;font-weight: 700">Course | Id | Username</p>

            <p style="text-align: center;position: relative;" >
                <?php


                //using inner join, to show professor which course_student data that he/she can give grade to.
                $conn=mysqli_connect("127.0.0.1","root","","project2");
                $sql = "    SELECT courses.course_name,course_students.student_id,students.user_name FROM courses 
                            INNER JOIN course_students
                            ON course_students.course_id=courses.course_id 
                            INNER JOIN students ON students.student_id=course_students.student_id
                            WHERE courses.course_giver_id='$profId' and is_graded=0;
                             ";
                $result = mysqli_query($conn, $sql);
                while($row=mysqli_fetch_array($result)){

                    echo $row["course_name"];
                    echo " | ";
                    echo $row["student_id"];
                    echo " | ";
                    echo $row["user_name"];
                    echo "<br>";

                }


                ?>
            </p>
        </div>


        <div class="field" style="padding-top: 150px">
            <input type="text" required name="courseName" style="">
            <label style="margin-top: 75px">Course Name</label>
        </div>

        <div class="field">
            <input type="text" required name="studentId">
            <label>Student Id</label>
        </div>

        <div style="text-align: center;margin-top: 20px">
            <label style="color: #4158d0;font-weight: 600;font-size: 20px">Grade</label>
            <br>
            <br>
            <label style="color: #55d6aa;font-weight: 600">Passed</label><input type="radio" name="grade" value="Passed">
            <label style="color: red;font-weight: 600">Failed</label><input type="radio" name="grade" value="Failed">
        </div>


        <div class="field">
            <input type="submit" value="Submit" name="submit">
        </div>

    </form>
</div>
</body>
</html>