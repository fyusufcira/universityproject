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
if (isset($_POST['submit'])){
    $id=$_POST["id"];

    //deleting
    $sql_2 = "DELETE FROM courses WHERE course_id=$id;
";

    $resultcheck=    mysqli_query($conn, $sql_2);


}
?>
<div class="wrapper" style="width: 500px; margin-top:20px;!important;">
    <div class="title" style="font-size: 35px;!important;">
        Remove Course
    </div>
    <form action="actionAdminRemoveCourse.php" method="post">


        <p style="font-family: 'Candara', sans-serif;font-weight: 900;color: #4158d0;border-radius: %80;border: #4158d0 solid;
padding: 10px">

            These are the courses that you can remove.(Type in the ID of the Course you want to deactivate NOTE: You cannot
            Delete Courses that currently have consent requests)

        </p>

        <p style="text-align: center;font-weight: 600;color: #4158d0" >ID | COURSE NAME </p>

        <p style="text-align: center;position: relative" >
            <?php



//showing courses to user
            $conn=mysqli_connect("127.0.0.1","root","","project2");
            $sql = "select courses.course_id,courses.course_name 
                        from courses";
            $result = mysqli_query($conn, $sql);
            while($row=mysqli_fetch_array($result)){
                echo $row["course_id"];
                echo ") ";
                echo $row["course_name"];
                echo "<br>";
            }
            ?>
        </p>









        <div class="field">

            <input type="text" required name="id">
            <label>Course Id</label>
        </div>
        <div class="field">
            <input type="submit" value="Remove Course" name="submit">
        </div>
    </form>
</div>
</body>
</html>