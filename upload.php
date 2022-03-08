<?php 

// create directory if not exists /uploads.
if (!file_exists('uploads')) {
    mkdir('uploads', 0777, true);
}

// create data file, if does not exists.
if (!file_exists('uploads/data.txt')) {
    $file = fopen('uploads/data.txt', 'w');
    fclose($file);
}

// read data from file.
$file = fopen('uploads/data.txt', 'r');
$content = fgets($file);
$content = explode(',', $content);
fclose($file);


if (isset($_FILES['file'])) {
    $fileName = $_FILES['file']['name'];
    // get file content.
    $fileContent = file_get_contents($_FILES['file']['tmp_name']);
    // calculate hash.
    $hash = hash('sha256', $fileContent);
    if (in_array($hash, $content)) {
        echo 'File already exists';
    } else {
        // save file.
        $file = fopen('uploads/data.txt', 'a');
        fwrite($file, $hash . ',');
        fclose($file);
        move_uploaded_file($_FILES['file']['tmp_name'], 'uploads/' . $fileName);
        echo 'File uploaded';
    }
} else {
    echo 'No file';
}
