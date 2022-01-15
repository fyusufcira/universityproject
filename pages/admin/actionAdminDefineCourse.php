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
if (isset($_POST["register"])){

    $conn=mysqli_connect("127.0.0.1","root","","project2");

    $courseName=$_POST["courseName"];
    $courseDescription=$_POST["courseDescription"];
    $courseQuota=$_POST["courseQuota"];
    $courseGiverId=$_POST["courseGiverId"];
    $finalDate=$_POST["finalDate"];
    $isConsentNeeded=$_POST["isConsentNeeded"];



    //taking rule values
    $sqlrule2 = "	SELECT max_course_system from rules";
    $resultrule2 = mysqli_query($conn, $sqlrule2);
    $rowrule2=mysqli_fetch_array($resultrule2);
    $resultrulelast=$rowrule2[0];


    $sqlrulecourse = "	SELECT COUNT(course_id) FROM courses";
    $resultcourse = mysqli_query($conn, $sqlrulecourse);
    $row=mysqli_fetch_array($resultcourse);
        $currentcoursenum=$row[0];


        //how much is max course system defined
    $sqlrule2 = "	SELECT max_course_system from rules";
    $resultrule2 = mysqli_query($conn, $sqlrule2);
    $rowrule2=mysqli_fetch_array($resultrule2);
    $resultrulelast=$rowrule2[0];

    //How many courses are there right now
    $sqlrulecourse = "	SELECT COUNT(course_id) FROM courses";
    $resultcourse = mysqli_query($conn, $sqlrulecourse);
    $row=mysqli_fetch_array($resultcourse);
    $currentcoursenum=$row[0];





        $db=new mysqli("127.0.0.1","root","","project2");

        //if course number limit in system fulled, course will not be allowed to defined
        if($currentcoursenum>=$resultrulelast){
            echo "
            <script type='text/javascript'>window.alert('Course limit is fulled. You cannot define a new course')</script>
            ";
        }

        else {
            //Defining course after checking values
            $result = $db->query("INSERT INTO courses (course_name,course_description,course_quota,course_giver_id,final_date,is_consent_needed)
 VALUES ('$courseName','$courseDescription',$courseQuota,$courseGiverId,$finalDate,$isConsentNeeded)");


            echo "<script type='text/javascript'>window.alert('Successful')</script>";

        }

}
?>

<div class="wrapper" style="width: 500px; margin-top:20px;!important;">

    <div class="title" style="font-size: 35px;!important;">
        Define Course
    </div>
    <form action="actionAdminDefineCourse.php" method="post">
        <div class="field">
            <input type="text" required name="courseName">
            <label>Course Name</label>
        </div>

        <div class="field">
            <input type="text" required name="courseDescription">
            <label>Course Description</label>
        </div>

        <div class="field">
            <input type="text" required name="courseQuota">
            <label>Course Quota</label>
        </div>

        <div class="field">
            <input type="text" required name="courseGiverId">
            <label>Course Giver Id</label>
        </div>

        <div class="field">
            <input type="date" required name="finalDate">
            <label style="padding-bottom: 10px">Final Date</label>
        </div>


        <br>


        <div style="text-align: center;margin-top: 20px">
            <label style="color: #4158d0;font-weight: 600;font-size: 20px">Is Consent Needed For Students To Take This Course?</label>
            <br>
            <br>
            <label style="color: #55d6aa;font-weight: 600">Yes</label><input type="radio" name="isConsentNeeded" value="1">
            <label style="color: orangered;font-weight: 600">No</label><input type="radio" name="isConsentNeeded" value="0">
        </div>

        <div class="field">
            <input type="submit" value="Register" name="register">
        </div>




    </form>
</div>




</body>


</html>


