<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "my_database";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("การเชื่อมต่อล้มเหลว: " . $conn->connect_error);
}

$search_query = "";
if (isset($_GET['search'])) {
    $search_query = $conn->real_escape_string($_GET['search']);
    $sql = "SELECT std_id, std_fname, std_lname, std_nname, std_prov, std_color, std_paid FROM member WHERE std_fname LIKE '%$search_query%'";
} else {
    $sql = "SELECT std_id, std_fname, std_lname, std_nname, std_prov, std_color, std_paid FROM member";
}

$result = $conn->query($sql);

$data = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เพิ่มข้อมูลกลุ่มนักศึกษาปคพ.65/2</title>
    <link href="pics/logo/logo.jfif" rel="shortcut icon" type="image/x-icon" />
    <link rel="stylesheet" href="styles/styles_insert_form_data.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">
            <img src="logo/logo.jfif" width="30" height="30" class="d-inline-block align-top" alt="my Logo">
            My Gallery
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="show_all_data.php">หน้าหลัก</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Contact</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="background"></div>
    <br>
        <h1><b>เพิ่มข้อมูลกลุ่มนักศึกษาปคพ.65/2</b></h1>
        
        <form action="insert_sql_data.php" method="POST">
            <label for="std_fname">ชื่อ :</label>
            <input type="text" id="std_fname" name="std_fname" required>
            <br>
            <label for="std_lname">นามสกุล :</label>
            <input type="text" id="std_lname" name="std_lname" required>
            <br>
            <label for="std_nname">ชื่อเล่น :</label>
            <input type="text" id="std_nname" name="std_nname" required>
            <br>
            <label for="std_prov">จังหวัด :</label>
            <input type="text" id="std_prov" name="std_prov" required>
            <br>
            <label for="std_color">สีที่ชอบ :</label>
            <input type="text" id="std_color" name="std_color" required>
            <br>
            <label for="std_paid">ค่าใช้จ่ายรายเดือน :</label>
            <input type="number" id="std_paid" name="std_paid" required>
            <br><br><br>
            <button type="submit">บันทึก</button>
            <button type="button" onclick="window.location.href='show_all_data.php';">หน้าหลัก</button>
            <button type="reset">ล้างข้อความ</button>
        </form>

        <script>
document.querySelector('form').addEventListener('submit', function (e) {
    let valid = true;

    const inputs = document.querySelectorAll('input[type="text"], input[type="number"]');
    inputs.forEach(input => {
        if (input.value.trim() === '') {
            valid = false;
            input.style.border = '1px solid red';
        } else {
            input.style.border = '';
        }
    });

    if (!valid) {
        e.preventDefault();
        alert('กรุณากรอกข้อมูลให้ครบทุกช่อง');
    }
});
</script>

</body>
</html>
