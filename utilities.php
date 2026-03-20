<?php
function uploadImage($file_input)
{

    // Check if uploaded file is single / multiple
    if (is_string($file_input)) {
        $file = $_FILES[$file_input];
    } else {
        $file = $file_input;
    }


    $isUploaded = 0;
    $target_dir = "../Assets/uploads/";
    $thumbnail_file_ext = strtolower(pathinfo($target_dir . basename($file['name']), PATHINFO_EXTENSION));
    $new_filename = time() . "_" . uniqid() . "." . $thumbnail_file_ext;

    $img_size = getimagesize($file['tmp_name']);
    if ($img_size !== false) {
        echo "Uploaded file is an image" . $img_size['mime'];
        $isUploaded = 1;
    } else {
        echo "Uploaded file is not an image";
        $isUploaded = 0;
    }

    // Check if file already exist
    if (file_exists($target_dir . basename($file['name']))) {
        echo "Uploaded file already exist";
        $isUploaded = 0;
    } else {
        $isUploaded = 1;

    }

    // Check file size
    /*
    if ($file['size'] > 500000) {
        echo "Too large file size";
        $isUploaded = 0;
    } else {
        $isUploaded = 1;
    }
    */

    // Allow certain file format
    if ($thumbnail_file_ext != "jpg" && $thumbnail_file_ext != "jpeg" && $thumbnail_file_ext != "png") {
        echo "Invalid file format";
        $isUploaded = 0;
    } else {
        $isUploaded = 1;
    }

    //Store file name in timestamp format.
    $target_file = "../Assets/uploads/" . basename($new_filename);

    if ($isUploaded == 1) {
        if (move_uploaded_file($file['tmp_name'], $target_file)) {
            echo "File Uploaded Successfully";
        }
    } else {
        echo "File Not Uploaded Successfully";
    }

    return $new_filename;
}
?>