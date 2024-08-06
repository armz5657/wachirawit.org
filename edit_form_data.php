<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "my_database";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("การเชื่อมต่อล้มเหลว: " . $conn->connect_error);
}

$id = intval($_GET['id']);
$sql = "SELECT std_id, std_fname, std_lname, std_nname, std_prov, std_color, std_paid FROM member WHERE std_id = $id";
$result = $conn->query($sql);

$data = $result->fetch_assoc();
$conn->close();
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แก้ไขข้อมูลนักศึกษา</title>
    <link href="pics/logo/logo.jfif" rel="shortcut icon" type="image/x-icon" />
    <link rel="stylesheet" href="styles/styles.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand">
        <img src="pics/logo/logo.jfif" width="30" height="30" class="d-inline-block align-top" alt="my Logo">
        MY DATABASE
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
<div class="content">
    <h1><b>แก้ไขข้อมูลนักศึกษา</b></h1>

    <?php if ($data): ?>
        <form action="edit_sql_data.php" method="POST">
            <input type="hidden" name="std_id" value="<?php echo $data['std_id']; ?>">
            <div class="form-group">
                <label for="std_fname">ชื่อ:</label>
                <input type="text" class="form-control" id="std_fname" name="std_fname" value="<?php echo $data['std_fname']; ?>" required>
            </div>
            <div class="form-group">
                <label for="std_lname">นามสกุล:</label>
                <input type="text" class="form-control" id="std_lname" name="std_lname" value="<?php echo $data['std_lname']; ?>" required>
            </div>
            <div class="form-group">
                <label for="std_nname">ชื่อเล่น:</label>
                <input type="text" class="form-control" id="std_nname" name="std_nname" value="<?php echo $data['std_nname']; ?>" required>
            </div>
            <div class="form-group">
                <label for="std_prov">จังหวัด:</label>
                <input type="text" class="form-control" id="std_prov" name="std_prov" value="<?php echo $data['std_prov']; ?>" required>
            </div>
            <div class="form-group">
                <label for="std_color">สีที่ชอบ:</label>
                <input type="text" class="form-control" id="std_color" name="std_color" value="<?php echo $data['std_color']; ?>" required>
            </div>
            <div class="form-group">
                <label for="std_paid">ค่าใช้จ่ายรายเดือน:</label>
                <input type="number" class="form-control" id="std_paid" name="std_paid" value="<?php echo $data['std_paid']; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">บันทึกการแก้ไข</button>
            <a href="show_all_data.php" class="btn btn-secondary">ยกเลิก</a>
        </form>
    <?php else: ?>
        <p>ไม่พบข้อมูล</p>
    <?php endif; ?>
</div>
</body>
</html>
