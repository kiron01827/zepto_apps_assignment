<?php
    include 'partial/connection.php';

    $ds          = DIRECTORY_SEPARATOR;
    $storeFolder = 'assets\fonts';
    $id          = $_POST['id'];

    $sql = "SELECT * FROM fonts WHERE id='$id'";
    $result  = mysqli_query($conn, $sql);
    if (!empty($result )) {
        $font = $result->fetch_array(MYSQLI_ASSOC);
        $file = $font['font_name'];     
        $targetPath = dirname( __FILE__ ) . $ds. $storeFolder . $ds;
        $path =  $targetPath. $file;
        unlink($path);

        $sql2 = "DELETE FROM fonts WHERE id='$id'";
        mysqli_query($conn, $sql2);
    }
    mysqli_close($conn);
    return print_r('1');
?>