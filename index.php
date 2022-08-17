<?php
    session_start();
    //session_destroy();
    // $students = isset($_SESSION['students']) ? $_SESSION['students'] : [];
    $students = $_SESSION['students'] ?? [];
    // $_SESSION['students'] = [
    //     ['id' => 1, 'fullname' => 'Nguyễn Thị Hào', 'brithday' => '1/1/2002', 'email' => 'hao@gmail.com'],
    //     ['id' => 2, 'fullname' => 'Nguyễn Thị Khải', 'brithday' => '2/1/2002', 'email' => 'khai@gmail.com'],
    //     ['id' => 3, 'fullname' => 'Nguyễn Thị Thắng', 'brithday' => '3/1/2002', 'email' => 'thang@gmail.com']
    // ];

    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <a href="add-student.php">Thêm Sinh Viên</a>
    <table border="1" cellpadding="10" cellspacing="0">
        <tr>
            <th>ID</th>
            <th>Fullname</th>
            <th>Brithday</th>
            <th>Email</th>
            <th>Action</th>
        </tr>

        <?php foreach($students as $student) { ?>
        <tr>
            <th><?php echo $student['id']; ?></th>
            <th><?php echo $student['fullname']; ?></th>
            <th><?php echo $student['brithday']; ?></th>
            <th><?php echo $student['email']; ?></th>
            <th>
                <a href="update-student.php?id=<?php echo $student['id']; ?>">Update Student</a>
                <a onclick="return confirm('Are you sure?');" href="delete-student.php?id=<?php echo $student['id']; ?>">Delete Student</a>
            </th>
        </tr>
        <?php } ?>
    </table>
</body>
</html>
