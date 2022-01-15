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
//selecting std id
$conn=mysqli_connect("127.0.0.1","root","","project2");
$userName=$_SESSION["user_name"];
$sql3="SELECT student_id FROM students WHERE user_name='$userName'";
$result3=mysqli_query($conn,$sql3);
$rowx=$result3->fetch_row();
$studentId=$rowx[0];

if (isset($_POST['courseName'])) {

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

                These are the courses that you asked for consent(if needed), approved, and added to your list, and  grade of the course.

            </p>

            <p style="text-align: center;position: relative" >
                <?php


                $conn=mysqli_connect("127.0.0.1","root","","project2");
                //query for showing course list of related student.
                $sql = "
SELECT courses.course_name,course_students.grade
FROM courses 
INNER JOIN course_students 
ON  course_students.course_id=courses.course_id
AND course_students.student_id='$studentId'
";
                //showing grades
                $sqlcheck="SELECT grade from grades where grade_student_id=$studentId";
                $resultgrade=$conn->query($sqlcheck);

                $result = mysqli_query($conn, $sql);

                while($row=mysqli_fetch_array($result)){
                    echo $row["course_name"];
                    echo " - ";
                    echo $row["grade"];

                    echo "<br> ";
                }


                ?>
            </p>
        </div>
    </form>
</div>
</body>
</html>