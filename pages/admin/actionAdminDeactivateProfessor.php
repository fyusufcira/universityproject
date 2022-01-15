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


    //checking if professor giving any courses. if yes, then query wont trigger.
    $sqlchecknull="select courses.course_id from courses where course_giver_id=$id ";
    $result=mysqli_query($conn,$sqlchecknull);


    //deactivate
    if(mysqli_num_rows($result)==0) {
        $sql_2 = "UPDATE professors
        	          SET is_active=0
        	          WHERE professor_id=$id";
        mysqli_query($conn, $sql_2);
        echo "<script type='text/javascript'>window.alert('Professor Deactivated')</script>";
    }
    else{
        echo"<script type='text/javascript'>window.alert('This professor can not be deactivated due to giving courses currently')</script>";
    }


}
?>
<div class="wrapper" style="width: 500px; margin-top:20px;!important;">
    <div class="title" style="font-size: 35px;!important;">
        Deactivate Professors
    </div>
    <form action="actionAdminDeactivateProfessor.php" method="post">


        <p style="font-family: 'Candara', sans-serif;font-weight: 900;color: #4158d0;border-radius: %80;border: #4158d0 solid;
padding: 10px">

            These are the professors that you can deactivate.(Type in the ID of Professor you want to deactivate)

        </p>

        <p style="text-align: center;font-weight: 600;color: #4158d0" >ID | USERNAME | NAME</p>

        <p style="text-align: center;position: relative" >
            <?php




            //showing active professors
            $conn=mysqli_connect("127.0.0.1","root","","project2");
            $sql = "select professors.professor_id,professors.user_name,.professors.first_name,.professors.last_name 
                        from professors 
                        where professors.is_active=1";
            $result = mysqli_query($conn, $sql);
            while($row=mysqli_fetch_array($result)){
                echo $row["professor_id"];
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
            <label>Professor Id</label>
        </div>
        <div class="field">
            <input type="submit" value="Deactivate Professor" name="submit">
        </div>
    </form>
</div>
</body>
</html>