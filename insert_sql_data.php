<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "my_database";

try {
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        throw new Exception("การเชื่อมต่อล้มเหลว: " . $conn->connect_error);
    }

    $std_fname = $conn->real_escape_string($_POST['std_fname']);
    $std_lname = $conn->real_escape_string($_POST['std_lname']);
    $std_nname = $conn->real_escape_string($_POST['std_nname']);
    $std_prov = $conn->real_escape_string($_POST['std_prov']);
    $std_color = $conn->real_escape_string($_POST['std_color']);
    $std_paid = $conn->real_escape_string($_POST['std_paid']);

    $sql = "INSERT INTO member (std_fname, std_lname, std_nname, std_prov, std_color, std_paid) VALUES ('$std_fname', '$std_lname', '$std_nname', '$std_prov', '$std_color', '$std_paid')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>
                alert('บันทึกข้อมูลสำเร็จ');
                window.location.href = 'show_all_data.php';
              </script>";
    } else {
        throw new Exception("Error: " . $sql . "<br>" . $conn->error);
    }

    $conn->close();
} catch (Exception $e) {
    echo "Caught exception: " . $e->getMessage();
}
?>
