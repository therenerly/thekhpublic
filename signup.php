<?php
require 'config/constants.php';

// get back form data if there was a registration error
$firstname = $_SESSION['signup-data']['firstname'] ?? null;
$lastname = $_SESSION['signup-data']['lastname'] ?? null;
$username = $_SESSION['signup-data']['username'] ?? null;
$email = $_SESSION['signup-data']['email'] ?? null;
$createpassword = $_SESSION['signup-data']['createpassword'] ?? null;
$confirmpassword = $_SESSION['signup-data']['confirmpassword'] ?? null;
// delete signup data session
unset($_SESSION['signup-data']);
?>


<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>គេហទំព័រសាកល្បង</title>
<!-- CUSTOM STYLESHEET -->
<link rel="stylesheet" href="<?= ROOT_URL ?>css/style.css">
<!-- ICONSCOUT CDN -->
<link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
<!-- GOOGLE FONT (MONTSERRAT) -->
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

</head>

<body>


<section class="form__section">
<div class="container form__section-container">
<h2>ចុះ​ឈ្មោះ</h2>
<?php if (isset($_SESSION['signup'])) : ?>
<div class="alert__message error">
<p>
<?= $_SESSION['signup'];
unset($_SESSION['signup']);
?>
</p>
</div>
<?php endif ?>
<form action="<?= ROOT_URL ?>signup-logic.php" enctype="multipart/form-data" method="POST">
<input type="text" name="firstname" value="<?= $firstname ?>" placeholder="ឈ្មោះដំបូង">
<input type="text" name="lastname" value="<?= $lastname ?>" placeholder="នាមត្រកូល">
<input type="text" name="username" value="<?= $username ?>" placeholder="ឈ្មោះ​អ្នកប្រើប្រាស់">
<input type="email" name="email" value="<?= $email ?>" placeholder="អ៊ីមែល">
<input type="password" name="createpassword" value="<?= $createpassword ?>" placeholder="បង្កើត​ពាក្យ​សម្ងាត់">
<input type="password" name="confirmpassword" value="<?= $confirmpassword ?>" placeholder="បញ្ជាក់ពាក្យសម្ងាត់">
<div class="form__control">
<label for="avatar">រូបតំណាងអ្នកប្រើប្រាស់</label>
<input type="file" name="avatar" id="avatar">
</div>
<button type="submit" name="submit" class="btn">ចុះ​ឈ្មោះ</button>
<small>មានគណនីរួចហើយ? <a href="signin.php">ចូល</a></small>
</form>
</div>
</section>


</body>

</html>