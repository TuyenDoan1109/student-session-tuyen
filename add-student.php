<?php
    session_start();
    $fullname = $brithday = $email = '';
    $errors = ['fullname' => '', 'brithday' => '', 'email' => ''];
    if(isset($_POST['submit'])) {
        $id = ++end($_SESSION['students'])['id'];

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
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                $errors['email'] = 'Email must be a valid email address';
            }
        }

        if(array_filter($errors)) {
            // echo 'Errors in form';
        } else {
            $newStudent = ['id' => $id, 'fullname' => $fullname, 'brithday' => $brithday, 'email' => $email];
            $_SESSION['students'][] = $newStudent;
            header('Location:index.php');
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
        <table border="1" cellspacing="0" cellpadding="10">
            <tr>
                <td>Fullname:</td>
                <td>
                    <input type="text" name="fullname" placeholder="Enter Full Name..." value="<?php echo $fullname; ?>">
                    <div class="errors"><?php echo $errors['fullname']; ?></div>
                </td>
            </tr>
            <tr>
                <td>Brithday:</td>
                <td>
                    <input type="text" name="brithday" placeholder="Enter Brithday mm/dd/yyyy ..." value="<?php echo $brithday; ?>">
                    <div class="errors"><?php echo $errors['brithday']; ?></div>
                </td>
            </tr>
            <tr>
                <td>Email:</td>
                <td>
                    <input type="text" name="email" placeholder="Enter Email..." value="<?php echo $email; ?>">
                    <div class="errors"><?php echo $errors['email']; ?></div>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <input type="submit" name="submit" value="Add Student">
                </td>
            </tr>
        </table>
    </form>
</body>
</html>

