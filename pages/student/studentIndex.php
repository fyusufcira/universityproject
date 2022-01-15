<?php
session_start();
if (!isset($_SESSION["user_name"])){
    header("Location:studentIndex.php");

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
include "/xampp/htdocs/project2/dynamics/general/welcome.php";
?>


</body>


</html>


