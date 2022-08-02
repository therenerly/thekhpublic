<?php
require 'config/database.php';

if (isset($_POST['submit'])) {
// get updated form data
$id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
$firstname = filter_var($_POST['firstname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$lastname = filter_var($_POST['lastname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$is_admin = filter_var($_POST['userrole'], FILTER_SANITIZE_NUMBER_INT);

// check for valid input
if (!$firstname || !$lastname) {
$_SESSION['edit-user'] = "ការបញ្ចូលទម្រង់មិនត្រឹមត្រូវនៅលើទំព័រកែសម្រួល។";
} else {
// update user
$query = "UPDATE users SET firstname='$firstname', lastname='$lastname', is_admin=$is_admin WHERE id=$id LIMIT 1";
$result = mysqli_query($connection, $query);

if (mysqli_errno($connection)) {
$_SESSION['edit-user'] = "បរាជ័យក្នុងការធ្វើបច្ចុប្បន្នភាពអ្នកប្រើប្រាស់។";
} else {
$_SESSION['edit-user-success'] = "អ្នក​ប្រើ $firstname $lastname បានធ្វើបច្ចុប្បន្នភាពដោយជោគជ័យ";
}
}
}

header('location: ' . ROOT_URL . 'admin/manage-users.php');
die();
