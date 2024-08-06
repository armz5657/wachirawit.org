<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "my_database";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("การเชื่อมต่อล้มเหลว: " . $conn->connect_error);
}

$std_id = intval($_POST['std_id']);
$std_fname = $conn->real_escape_string($_POST['std_fname']);
$std_lname = $conn->real_escape_string($_POST['std_lname']);
$std_nname = $conn->real_escape_string($_POST['std_nname']);
$std_prov = $conn->real_escape_string($_POST['std_prov']);
$std_color = $conn->real_escape_string($_POST['std_color']);
$std_paid = intval($_POST['std_paid']);

$sql = "UPDATE member SET std_fname='$std_fname', std_lname='$std_lname', std_nname='$std_nname', std_prov='$std_prov', std_color='$std_color', std_paid='$std_paid' WHERE std_id=$std_id";

if ($conn->query($sql) === TRUE) {
    echo "บันทึกการแก้ไขสำเร็จ";
    header("Location: show_all_data.php");
} else {
    echo "เกิดข้อผิดพลาด: " . $conn->error;
}

$conn->close();
?>
