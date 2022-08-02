<?php
require 'config/database.php';

if (isset($_POST['submit'])) {
$author_id = $_SESSION['user-id'];
$title = filter_var($_POST['title'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$body = filter_var($_POST['body'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$category_id = filter_var($_POST['category'], FILTER_SANITIZE_NUMBER_INT);
$is_featured = filter_var($_POST['is_featured'], FILTER_SANITIZE_NUMBER_INT);
$thumbnail = $_FILES['thumbnail'];

// set is_featured to 0 if unchecked
$is_featured = $is_featured == 1 ?: 0;

// validate form data
if (!$title) {
$_SESSION['add-post'] = "បញ្ចូលចំណងជើងប្រកាស";
} elseif (!$category_id) {
$_SESSION['add-post'] = "ជ្រើសរើសប្រភេទប្រកាស";
} elseif (!$body) {
$_SESSION['add-post'] = "បញ្ចូលតួអត្ថបទ";
} elseif (!$thumbnail['name']) {
$_SESSION['add-post'] = "ជ្រើសរើសរូបភាពតូចនៃប្រកាស";
} else {
// WORK ON THUMBNAIL
// rename the image
$time = time(); // make each image name unique
$thumbnail_name = $time . $thumbnail['name'];
$thumbnail_tmp_name = $thumbnail['tmp_name'];
$thumbnail_destination_path = '../images/' . $thumbnail_name;

// make sure file is an image
$allowed_files = ['png', 'jpg', 'jpeg'];
$extension = explode('.', $thumbnail_name);
$extension = end($extension);
if (in_array($extension, $allowed_files)) {
// make sure image is not too big. (2mb+)
if ($thumbnail['size'] < 2000000) {
// upload thumbnail
move_uploaded_file($thumbnail_tmp_name, $thumbnail_destination_path);
} else {
$_SESSION['add-post'] = "ទំហំឯកសារធំពេក។ គួរតែតិចជាង 2mb";
}
} else {
$_SESSION['add-post'] = "ឯកសារគួរតែជា png, jpg, ឬ jpeg";
}
}

// redirect back (with form data) to add-post page if there is any problem
if (isset($_SESSION['add-post'])) {
$_SESSION['add-post-data'] = $_POST;
header('location: ' . ROOT_URL . 'admin/add-post.php');
die();
} else {
// set is_featured of all psots to 0 if is_featured for this post is 1
if ($is_featured == 1) {
$zero_all_is_featured_query = "UPDATE posts SET is_featured=0";
$zero_all_is_featured_result = mysqli_query($connection, $zero_all_is_featured_query);
}

// insert post into database
$query = "INSERT INTO posts (title, body, thumbnail, category_id, author_id, is_featured) VALUES ('$title', '$body', '$thumbnail_name', $category_id, $author_id, $is_featured)";
$result = mysqli_query($connection, $query);

if (!mysqli_errno($connection)) {
$_SESSION['add-post-success'] = "ប្រកាសថ្មីត្រូវបានបន្ថែមដោយជោគជ័យ";
header('location: ' . ROOT_URL . 'admin/');
die();
}
}
}

header('location: ' . ROOT_URL . 'admin/add-post.php');
die();
