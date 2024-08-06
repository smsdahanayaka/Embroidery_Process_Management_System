<?php

if (isset($_POST['submit'])) {
    $file = $_FILES['Artwork_side01'];
    print_r($file);
    $fileName = $_FILES['Artwork_side01']['name'];
    $fileTmpName = $_FILES['Artwork_side01']['tmp_name'];
    $fileSize = $_FILES['Artwork_side01']['size'];
    $fileError = $_FILES['Artwork_side01']['error'];
    $fileType = $_FILES['Artwork_side01']['type'];

    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));

    $allowed = array('jpg', 'jpeg', 'png', 'pdf', 'eps', 'svg');

    if (in_array($fileActualExt, $allowed)) {
        if ($fileError === 0) {
            if ($fileSize < 1000000) {
                $fileNameNew = uniqid('', true).".".$fileActualExt;
                $fileDestination ;
            } else {
                echo "Your file is Too big!";
            }
        } else {
            echo "There was an error uploading your file!";
        }
    } else {
        echo "You cannot upload files of this type!";
    }
}
?>