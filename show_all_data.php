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
    while ($row = $result->fetch_assoc()) {
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
    <title>ข้อมูลกลุ่มนักศึกษาปคพ.65/2</title>
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
                <a class="nav-link" href="#">ข้อมูล</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">เกี่ยวกับ</a>
            </li>
        </ul>
    </div>
</nav>

<div class="background"></div>
<div class="content">
    <h1><b>ข้อมูลกลุ่มนักศึกษาปคพ.65/2</b></h1>

    <div class="form-container">
        <form action="insert_form_data.php">
            <button type="submit">เพิ่มข้อมูล</button>
        </form>
        <form method="GET" action="">
            <input type="text" name="search" value="<?php echo htmlspecialchars($search_query); ?>" placeholder="ค้นหาชื่อนักศึกษา">
            <button type="submit">ค้นหา</button>
        </form>
    </div>

    <?php if (count($data) > 0): ?>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>รหัสนักศึกษา</th>
                    <th>ชื่อ</th>
                    <th>นามสกุล</th>
                    <th>ชื่อเล่น</th>
                    <th>จังหวัด</th>
                    <th>สีที่ชอบ</th>
                    <th>ค่าใช้จ่ายรายเดือน</th>
                    <th>จัดการข้อมูล</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data as $row): ?>
                <tr>
                    <td><?php echo $row["std_id"]; ?></td>
                    <td><?php echo $row["std_fname"]; ?></td>
                    <td><?php echo $row["std_lname"]; ?></td>
                    <td><?php echo $row["std_nname"]; ?></td>
                    <td><?php echo $row["std_prov"]; ?></td>
                    <td><?php echo $row["std_color"]; ?></td>
                    <td><?php echo $row["std_paid"]; ?></td>
                    <td>
                        <a class="btn btn-warning btn-sm" href="edit_form_data.php?id=<?php echo $row['std_id']; ?>">แก้ไข</a>
                        <a class="btn btn-danger btn-sm" href="delete_data.php?id=<?php echo $row['std_id']; ?>" onclick="return confirm('คุณแน่ใจหรือไม่ที่จะลบข้อมูลนี้?');">ลบ</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>ไม่มีข้อมูล</p>
    <?php endif; ?>
</div>
</body>
</html>
