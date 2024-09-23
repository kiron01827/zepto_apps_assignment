<?php
    include 'partial/connection.php';

    $ds          = DIRECTORY_SEPARATOR;
    $storeFolder = 'assets/fonts';
    
    if (!empty($_FILES)) {
        $file = $_FILES['file']['name'];           
        $tempFile = $_FILES['file']['tmp_name'];            
        $targetPath = dirname( __FILE__ ) . $ds. $storeFolder . $ds;
        $targetFile =  $targetPath. $file;
        move_uploaded_file($tempFile,$targetFile);

        $sql = "INSERT INTO fonts (font_name) VALUES ('$file')";
        mysqli_query($conn, $sql);
        mysqli_close($conn);
    }
?>