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

//preparing
$sql3="SELECT student_id FROM students WHERE user_name='$userName'";
$result3=mysqli_query($conn,$sql3);
$rowx=$result3->fetch_row();
$studentId=$rowx[0];
if (isset($_POST['courseName'])) {

    $courseName=$_POST["courseName"];



//course id
    $sql4="SELECT course_id FROM courses WHERE course_name='$courseName'";
    $result4=mysqli_query($conn,$sql4);
    $rowy=$result4->fetch_row();
    $courseId=$rowy[0];

    //adding consent request to database.
    $sql2 = "INSERT INTO course_consents (course_id,student_id,is_consented)
 VALUES ('$courseId','$studentId',0)";
        mysqli_query($conn, $sql2);
}
?>
<div class="wrapper" style="width: 500px; margin-top:20px;!important;">

    <div class="title" style="font-size: 35px;!important;">
        Ask For Consent
    </div>
    <form action="actionStdAskForConsent.php" method="post">
        <div class="field">
            <p id="courses">
               <p style="font-family: 'Candara', sans-serif;font-weight: 900;color: #4158d0;border-radius: %80;border: #4158d0 solid;
padding: 10px">
                Type in the name of the course you want to ask for consent
            </p>

            <p style="text-align: center;position: relative" >
                <?php
                $conn=mysqli_connect("127.0.0.1","root","","project2");

                //i dont know how to explain this query. but i will try
                //taking course names which needs a consent, but both not taken by student already, and not asked for consent already.
                //if a course consent is sended for approval to related professor, it wont be showed in ask for consent page in student

                $sql = "select courses.course_name from courses where
 NOT EXISTS (
					SELECT course_students.course_id from course_students where course_students.course_id=courses.course_id 
                                        AND course_students.student_id=$studentId) 
and
                                              
NOT EXISTS (

SELECT course_consents.id from course_consents where course_consents.course_id=courses.course_id and course_consents.student_id=$studentId

)
and

courses.is_consent_needed=1
";
                $result = mysqli_query($conn, $sql);
                while($row=mysqli_fetch_array($result)){
                    echo $row["course_name"];
                    echo " ";
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