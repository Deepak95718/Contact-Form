<?php
function sanitize_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);

    return $data;
}
$errors = [];
if ($_SERVER["REQUEST_METHOD"]  == "POST") {

    if (!empty($_POST['submitted'])) {
        header("Location:contact_form.php");
        exit;
    }
    $_POST['submitted'] = true;
    $full_name = sanitize_input($_POST['full_name']);
    $phone_number = sanitize_input($_POST['phone_number']);
    $email = sanitize_input($_POST['email']);
    $subject = sanitize_input($_POST['subject']);
    $message = sanitize_input($_POST['message']);

    if (empty($full_name)) {
        $errors['name'] = "Please enter your name";
    }
    if (empty($email)) {
        $errors['email'] = "Please enter your email";
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Invalid Email";
    }
    if (empty($phone_number)) {
        $errors['phone'] = "Please enter your phone number";
    }
    if (empty($subject)) {
        $errors['subject'] = "Please enter your subject";
    }

    if (!empty($errors)) {
        include('contact_form.php');
        exit;
    } else {

        $server = "localhost";
        $user = "root";
        $password = "";
        $dbname = "contact_form";

        $conn = new mysqli($server, $user, $password, $dbname);
        if ($conn->connect_error) {
            print_r('connection fail');
            die;
        } else {
            echo "connected succesfull";
        }

        $a = $conn->prepare("INSERT INTO form (name, phone, email, subject, message, ip_address) VALUES(?,?,?,?,?,?)");
        $a->bind_param("sissss", $full_name, $phone_number, $email, $subject, $message, $_SERVER['REMOTE_ADDR']);

        if ($a->execute() == true) {
            // echo "here";
            $to = $email;
            $subject = "New Form Submission";
            $body = "Name" . $full_name .  "\n" .
                "Phone number" . $phone_number . "\n" .
                "Email"  . $email  . "\n" .
                "Subject"  . $subject . "\n" .
                "message"  . $message;

            $headers = "From : dy1883078@gmail.com" . "\n"  .
                "Reply-To"  . $email . "\n" .
                "X-mailer : PHP/" . phpversion();
            //  print_r($to);die;

            if (mail($to, $subject, $body, $headers)) {
                echo "Form Submit Succesfully";
            } else {
                echo "not send" . error_get_last()['message'];
            }
            $success = "Form submit successfully";
            header("Location: contact_form.php?success=" . urlencode(($success)));
            exit;
        }
        $a->close();
        $conn->close();
    }
}
