
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Form</title>
</head>
<style>
    body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f4f4f4;
}

h2 {
    text-align: center;
}

form {
    max-width: 500px;
    margin: 20px auto;
    background: #fff;
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1);
}

label {
    font-weight: bold;
}

input[type="text"],
input[type="tel"],
input[type="email"],
textarea {
    width: 100%;
    padding: 10px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-sizing: border-box;
}

input[type="submit"] {
    width: 100%;
    padding: 10px;
    border: none;
    border-radius: 5px;
    background-color: #007bff;
    color: #fff;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

input[type="submit"]:hover {
    background-color: #0056b3;
}
.success{
    color: green;
}
.error{
    color: red;
}
</style>
<body>
    <?php  if(isset($_GET['success'])) : ?>
        <p style="text-align: center;" class="success"><?php echo $_GET['success']; ?></p>
        <?php endif; ?>
    <h2>Contact Form</h2>
    <form action="contact_script.php" method="post" >
   <label for="full_name">Full Name<span style="color: red;">*</span> :  </label><br>
   <input type="text" id="full_name" name="full_name" value="<?php echo isset($_POST['full_name']) ? $_POST['full_name'] : '';?>"> <br>
   <?php if(isset($errors['name'])): ?>
    <p class="error"><?php echo $errors['name']; ?></p>
    <?php endif; ?>
   <label for="phone">Phone Number<span style="color: red;">*</span> :  </label><br>
   <input type="text" id="phone_number" maxlength="10" name="phone_number" value="<?php echo isset($_POST['phone_number']) ? $_POST['phone_number'] : '';?>" > <br>
   <?php if(isset($errors['phone'])): ?>
    <p class="error"><?php echo $errors['phone']; ?></p>
    <?php endif; ?>
   <label for="email">Email <span style="color: red;">*</span> : </label><br>
   <input type="email" id="email" name="email" value="<?php echo isset($_POST['email']) ? $_POST['email'] : '';?>"> <br>
   <?php if(isset($errors['email'])): ?>
    <p class="error"><?php echo $errors['email']; ?></p>
    <?php endif; ?>
   <label for="subject">Subject<span style="color: red;">*</span> :  </label><br>
   <input type="text" id="subject" name="subject" value="<?php echo isset($_POST['subject']) ? $_POST['subject'] : '';?>" > <br>
   <?php if(isset($errors['subject'])): ?>
    <p class="error"><?php echo $errors['subject']; ?></p>
    <?php endif; ?>
   <label for="message">Message :  </label><br>
   <textarea type="text" id="message" name="message" value="<?php echo isset($_POST['message']) ? $_POST['message'] : '';?>"></textarea> <br>
   <?php if(isset($errors['message'])): ?>
    <p class="error"><?php echo $errors['message']; ?></p>
   <?php endif; ?>
   <input type="submit" value="submit">
    </form>
    <?php
function generateToken() {
    return md5(uniqid(rand(), true));
}
?>
</body>
</html>