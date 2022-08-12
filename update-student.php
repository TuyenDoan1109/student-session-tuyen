<?php
    session_start();
    $id = $_GET['id'];
    $studentUpdate = ['id' => $id, 'fullname' => '', 'brithday' => '', 'email' => ''];
    foreach($_SESSION['students'] as $key => $student) {
        if($_SESSION['students'][$key]['id'] == $studentUpdate['id']) {
            $studentUpdate['fullname'] = $_SESSION['students'][$key]['fullname'];
            $studentUpdate['brithday'] = $_SESSION['students'][$key]['brithday'];
            $studentUpdate['email'] = $_SESSION['students'][$key]['email'];
        }
    }
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
    <form action="" method="post">
        <table border="1" cellpadding="10" cellspacing="0">
            <tr>
                <td>Fullname:</td>
                <td>
                    <input type="text" name="fullname" value="<?php echo $studentUpdate['fullname']; ?>">
                </td>
            </tr>
            <tr>
                <td>Brithday:</td>
                <td>
                    <input type="text" name="brithday" value="<?php echo $studentUpdate['brithday']; ?>">
                </td>
            </tr>
            <tr>
                <td>Email:</td>
                <td>
                    <input type="text" name="email" value="<?php echo $studentUpdate['email']; ?>">
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <input type="hidden" name="id" value="<?php echo $studentUpdate['id']; ?>">
                    <input type="submit" value="Update Student" name="submit">
                </td>
            </tr>
        </table>
    </form>
</body>
</html>

<?php
    if(isset($_POST['submit'])) {
        $id = $_POST['id'];
        $fullname = $_POST['fullname'];
        $brithday = $_POST['brithday'];
        $email = $_POST['email'];

        foreach($_SESSION['students'] as $key => $student) {
            if($_SESSION['students'][$key]['id'] == $id) {
                $_SESSION['students'][$key]['fullname'] = $fullname;
                $_SESSION['students'][$key]['brithday'] = $brithday;
                $_SESSION['students'][$key]['email'] = $email;

                header('Location:index.php');
            }
        }
    }
?>