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

//checking if student list is not null. If not null, student wont be deactivated
    $sqlchecknull="select course_students.id from course_students where course_students.student_id=$id";
    $result=mysqli_query($conn,$sqlchecknull);


    //deactivate
    if(mysqli_num_rows($result)==0) {
        $sql_2 = "UPDATE students
        	          SET is_active=0
        	          WHERE student_id=$id";
        mysqli_query($conn, $sql_2);
        echo "<script type='text/javascript'>window.alert('Student Deactivated')</script>";
    }
    else{
        echo"<script type='text/javascript'>window.alert('This student can not be deactivated due to having courses currently')</script>";
    }
}
?>
<div class="wrapper" style="width: 500px; margin-top:20px;!important;">
    <div class="title" style="font-size: 35px;!important;">
        Deactivate Student
    </div>
    <form action="actionAdminDeactivateStudent.php" method="post">


                    <p style="font-family: 'Candara', sans-serif;font-weight: 900;color: #4158d0;border-radius: %80;border: #4158d0 solid;
padding: 10px">

                These are the students that you can deactivate.(Type in the ID of Student you want to deactivate)

            </p>

        <p style="text-align: center;font-weight: 600;color: #4158d0" >ID | USERNAME | NAME</p>

            <p style="text-align: center;position: relative" >
                <?php




                //showing active students
                $conn=mysqli_connect("127.0.0.1","root","","project2");
                $sql = "select students.student_id,students.user_name,.students.first_name,.students.last_name 
                        from students 
                        where students.is_active=1";
                $result = mysqli_query($conn, $sql);
                while($row=mysqli_fetch_array($result)){
                    echo $row["student_id"];
                    echo ") ";
                    echo $row["user_name"];
                    echo " - ";
                    echo $row["first_name"];
                    echo " ";
                    echo $row["last_name"];
                    echo "<br>";
                }
                ?>
            </p>









        <div class="field">

            <input type="text" required name="id">
            <label>Student Id</label>
        </div>
        <div class="field">
            <input type="submit" value="Deactivate Student" name="submit">
        </div>
    </form>
</div>
</body>
</html>