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
//selecting professor id
$conn=mysqli_connect("127.0.0.1","root","","project2");
$userName=$_SESSION["user_name"];
$sql3="SELECT professor_id FROM professors WHERE user_name='$userName'";
$result3=mysqli_query($conn,$sql3);
$rowx=$result3->fetch_row();
$professorId=$rowx[0];

if (isset($_POST['id'])) {
    //post id
    $id=$_POST["id"];






    $sql2 = "UPDATE course_consents SET is_consented=1 WHERE course_consents.id='$id'";
    mysqli_query($conn, $sql2);
}
?>
<div class="wrapper" style="width: 500px; margin-top:20px;!important">

    <div class="title" style="font-size: 35px;!important;">
        View / Process
    </div>
    <form action="actionProfViewProcessConsentReq.php" method="post">
        <div class="field">
            <p id="courses">
            <p style="font-family: 'Candara', sans-serif;font-weight: 900;color: #4158d0;border-radius: %80;border: #4158d0 solid;
padding: 10px">
                Type in the ID that you want to give consent(Below students are the ones sended consent request)
            </p>

            <p style="text-align: center;color: #4158d0;font-weight: 700">Id | Username | Course</p>

            <p style="text-align: center;position: relative" >
                <?php


                //again, using sql, inner join to show data
                $conn=mysqli_connect("127.0.0.1","root","","project2");
                $sql = "SELECT DISTINCT courses.course_name,course_consents.id,students.user_name FROM course_consents INNER JOIN courses
                        ON courses.course_giver_id='$professorId' AND courses.course_id=course_consents.course_id
                        INNER JOIN students ON students.student_id=course_consents.student_id
                        where course_consents.is_consented=0";
                $result = mysqli_query($conn, $sql);
                while($row=mysqli_fetch_array($result)){
                    echo $row["id"];
                    echo ") ";
                    echo $row["user_name"];
                    echo " | ";
                    echo $row["course_name"];
                  echo  "<br>";
                }


                ?>
            </p>
        </div>

        <div class="field" style="margin-top:290px">
            <input type="text" required name="id">
            <label>ID</label>
        </div>


        <div class="field">
            <input type="submit" value="Submit" name="changepass">
        </div>

    </form>
</div>
</body>
</html>