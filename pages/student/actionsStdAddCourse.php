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
$conn=mysqli_connect("127.0.0.1","root","","project2");

$userName=$_SESSION["user_name"];

//selecting student id
$sql3="SELECT student_id FROM students WHERE user_name='$userName'";
$result3=mysqli_query($conn,$sql3);
$rowx=$result3->fetch_row();
$studentId=$rowx[0];

//taking rules and values
$sqlrule2 = "	SELECT max_course_student from rules";
$resultrule2 = mysqli_query($conn, $sqlrule2);
$rowrule2=mysqli_fetch_array($resultrule2);
$resultrulemaxcourse=$rowrule2[0];

//selecting how many course the student takes
$sqlrule2 = "	SELECT COUNT(id) from course_students where student_id=$studentId";
$resultrule2 = mysqli_query($conn, $sqlrule2);
$rowrule2=mysqli_fetch_array($resultrule2);
$coursenumber=$rowrule2[0];






if (isset($_POST['courseName'])) {
    //post
    $courseName=$_POST["courseName"];



        //selecting course id
    $sql4="SELECT course_id FROM courses WHERE course_name='$courseName'";
    $result4=mysqli_query($conn,$sql4);
    $rowy=$result4->fetch_row();
    $courseId=$rowy[0];


    //quota and how many people is taking course currently, takin values from database
    $sqlrulecoursetaker="SELECT COUNT(course_id) from course_students where course_id=$courseId";
    $resultrulecoursetaker=mysqli_query($conn,$sqlrulecoursetaker);
    $rowrulecoursetaker=mysqli_fetch_array($resultrulecoursetaker);
    $coursetakernum=$rowrulecoursetaker[0];

    //selecting course quota
    $sqlrulequota="SELECT course_quota from COURSES WHERE course_id=$courseId";
    $resultquota=mysqli_query($conn,$sqlrulequota);
    $rowquota=mysqli_fetch_array($resultquota);
    $coursequota=$rowquota[0];







//checking rules values
    if ($coursenumber>=$resultrulemaxcourse){
        echo"<script type='text/javascript'>window.alert('Student Course Limit is Full. You cannot add any more courses to your course list.')</script>";


    }
    else if($coursetakernum>=$coursequota){
        echo"<script type='text/javascript'>window.alert('Quota for this course is full. You cannot add this course.')</script>";
    }

    else{

        //add to course_students
        $sql2 = "INSERT INTO course_students (course_id,student_id)
 VALUES ('$courseId','$studentId')";
        mysqli_query($conn, $sql2);


        //after adding the course to system, course consent will be deleted from database, to not show it on the Add Course List page again.
        $sqlremove="DELETE FROM course_consents where course_id=$courseId and student_id=$studentId";
        mysqli_query($conn,$sqlremove);

    }


}

?>
<div class="wrapper" style="width: 500px; margin-top:20px;!important;">

    <div class="title" style="font-size: 35px;!important;">
        Add Course
    </div>
    <form action="actionsStdAddCourse.php" method="post">
        <div class="field">
            <p id="courses">
            <p style="font-family: 'Candara', sans-serif;font-weight: 900;color: #4158d0;border-radius: %80;border: #4158d0 solid;
padding: 10px">
                Type in the name of the course you want to add(Below courses are the ones you got consents from professors or courses
                that doesnt want a consent)
            </p>

            <p style="text-align: center;position: relative" >
                <?php

                //showing the courses that is not taken by student, but can be taken.
                //this part is for courses that need consent
                $conn=mysqli_connect("127.0.0.1","root","","project2");
                $sql = "SELECT DISTINCT courses.course_name FROM courses INNER JOIN course_consents
                        ON course_consents.course_id=COURSES.course_id AND
                        course_consents.student_id='$studentId' WHERE course_consents.is_consented=1";
                $result = mysqli_query($conn, $sql);
                while($row=mysqli_fetch_array($result)){
                    echo $row["course_name"];
                    echo "<br>";
                }

                //this part is for courses that not needed consent
                //I spent at least 2 days tofigure out this sql query
                //using not exists, to show course names that can be added but not the ones that is already in the course list of student
                $sql = "select courses.course_name from courses where courses.is_consent_needed=0 AND NOT EXISTS(

SELECT course_students.course_id from course_students where course_students.course_id=courses.course_id and course_students.student_id=$studentId
)
";
                $result = mysqli_query($conn, $sql);
                while($row=mysqli_fetch_array($result)){
                    echo $row["course_name"];
                    echo "<br>";
                }




                ?>
            </p>
        </div>

        <div class="field" style="padding-top: 250px">
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