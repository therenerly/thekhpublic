<?php
include 'partials/header.php';

// get back form data if there was an error
$firstname = $_SESSION['add-user-data']['firstname'] ?? null;
$lastname = $_SESSION['add-user-data']['lastname'] ?? null;
$username = $_SESSION['add-user-data']['username'] ?? null;
$email = $_SESSION['add-user-data']['email'] ?? null;
$createpassword = $_SESSION['add-user-data']['createpassword'] ?? null;
$confirmpassword = $_SESSION['add-user-data']['confirmpassword'] ?? null;

// delete session data
unset($_SESSION['add-user-data']);
?>



<section class="form__section">
<div class="container form__section-container">
<h2>បន្ថែមអ្នកប្រើប្រាស់</h2>
<?php if (isset($_SESSION['add-user'])) : ?>
<div class="alert__message error">
<p>
<?= $_SESSION['add-user'];
unset($_SESSION['add-user']);
?>
</p>
</div>

<?php endif ?>
<form action="<?= ROOT_URL ?>admin/add-user-logic.php" enctype="multipart/form-data" method="POST">
<input type="text" name="firstname" value="<?= $firstname ?>" placeholder="ឈ្មោះដំបូង">
<input type="text" name="lastname" value="<?= $lastname ?>" placeholder="នាមត្រកូល">
<input type="text" name="username" value="<?= $username ?>" placeholder="ឈ្មោះ​អ្នកប្រើប្រាស់">
<input type="email" name="email" value="<?= $email ?>" placeholder="អ៊ីមែល">
<input type="password" name="createpassword" value="<?= $createpassword ?>" placeholder="បង្កើត​ពាក្យ​សម្ងាត់">
<input type="password" name="confirmpassword" value="<?= $confirmpassword ?>" placeholder="បញ្ជាក់ពាក្យសម្ងាត់">
<select name="userrole">
<option value="0">អ្នកនិពន្ធ</option>
<option value="1">អ្នកគ្រប់គ្រង</option>
</select>
<div class="form__control">
<label for="avatar">រូបតំណាងអ្នកប្រើប្រាស់</label>
<input type="file" name="avatar" id="avatar">
</div>
<button type="submit" name="submit" class="btn">បន្ថែមអ្នកប្រើប្រាស់</button>
</form>
</div>
</section>



<?php
include '../partials/footer.php';
?>