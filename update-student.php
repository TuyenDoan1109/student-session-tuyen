<?php
    session_start();
    $id = $_GET['id'];
    $studentUpdate = ['id' => $id, 'fullname' => '', 'brithday' => '', 'email' => ''];
    $students = $_SESSION['students'] ?? [];
    $errors = ['fullname' => '', 'brithday' => '', 'email' => ''];
    foreach($_SESSION['students'] as $key => $student) {
        if($_SESSION['students'][$key]['id'] == $studentUpdate['id']) {
            $studentUpdate['fullname'] = $_SESSION['students'][$key]['fullname'];
            $studentUpdate['brithday'] = $_SESSION['students'][$key]['brithday'];
            $studentUpdate['email'] = $_SESSION['students'][$key]['email'];
        }
    }

    // Clicked Submit
    if(isset($_POST['submit'])) {
        $id = $_POST['id'];

        // VALIDATION
        // Check Fullname
        if(empty($_POST['fullname'])) {
            $errors['fullname'] = 'Fullname is required';
        } else {
            $fullname = $_POST['fullname'];
            if(!preg_match('/^[a-zA-Z\s]{6,}/', $fullname)){
                $errors['fullname'] = 'Fullname must be letters and spaces only and have at least 6 characters!';
            }
        }

        // Check Brithday
        if(empty($_POST['brithday'])) {
            $errors['brithday'] = 'Brithday is required';
        } else {
            $brithday = $_POST['brithday'];
            $validateBrithday = explode('/', $brithday);
            if(count($validateBrithday) != 3) {
                $errors['brithday'] = 'brithday must be in right format month/day/year';
            } else {
                if (!checkdate($validateBrithday[0], $validateBrithday[1], $validateBrithday[2])) {
                    $errors['brithday'] = 'brithday must be a valid date';
                }
            }
        }

        //Check Email
        if(empty($_POST['email'])) {
            $errors['email'] = 'An email is required';
        } else {
            $email = $_POST['email'];
            if(filter_var($email, FILTER_VALIDATE_EMAIL)){
                // Valid Email
                // Check Email Unique
                if(count($students) > 0) {
                    foreach($students as $key => $student) {
                        if($student['id'] == $id) {
                            continue;
                        }
                        if($student['email'] == $email) {
                            $errors['email'] = 'Email must be unique';
                        }
                    }
                }
            } else {
                $errors['email'] = 'Email must be a valid email address';
            }
        }

        if(array_filter($errors)) {
            // echo 'Errors in form';
        } else {
            // Update Student
            foreach($_SESSION['students'] as $key => $student) {
                if($_SESSION['students'][$key]['id'] == $id) {
                    $_SESSION['students'][$key]['fullname'] = $fullname;
                    $_SESSION['students'][$key]['brithday'] = $brithday;
                    $_SESSION['students'][$key]['email'] = $email;

                    header('Location:index.php');
                }
            }
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
    <style>
        .errors{
            color: red;
        }
    </style>
</head>
<body>
    <form action="" method="post">
        <table border="1" cellpadding="10" cellspacing="0">
            <tr>
                <td>Fullname:</td>
                <td>
                    <input type="text" name="fullname" value="<?php echo $studentUpdate['fullname']; ?>">
                    <div class="errors"><?php echo $errors['fullname']; ?></div>
                </td>
            </tr>
            <tr>
                <td>Brithday:</td>
                <td>
                    <input type="text" name="brithday" value="<?php echo $studentUpdate['brithday']; ?>">
                    <div class="errors"><?php echo $errors['brithday']; ?></div>
                </td>
            </tr>
            <tr>
                <td>Email:</td>
                <td>
                    <input type="text" name="email" value="<?php echo $studentUpdate['email']; ?>">
                    <div class="errors"><?php echo $errors['email']; ?></div>
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
    
?>