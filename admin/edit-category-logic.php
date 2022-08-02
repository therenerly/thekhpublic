<?php
require 'config/database.php';

if (isset($_POST['submit'])) {
$id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
$title = filter_var($_POST['title'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$description = filter_var($_POST['description'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

// validate input
if (!$title || !$description) {
$_SESSION['edit-category'] = "ការបញ្ចូលទម្រង់មិនត្រឹមត្រូវនៅលើទំព័រកែសម្រួលប្រភេទ";
} else {
$query = "UPDATE categories SET title='$title', description='$description' WHERE id=$id LIMIT 1";
$result = mysqli_query($connection, $query);

if (mysqli_errno($connection)) {
$_SESSION['edit-category'] = "មិនអាចធ្វើបច្ចុប្បន្នភាពប្រភេទបានទេ។";
} else {
$_SESSION['edit-category-success'] = "ប្រភេទ $title បានធ្វើបច្ចុប្បន្នភាពដោយជោគជ័យ";
}
}
}

header('location: ' . ROOT_URL . 'admin/manage-categories.php');
die();
