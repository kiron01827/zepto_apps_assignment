<?php
    include 'partial/connection.php';
    $id  = $_POST['id'];
    $sql = "DELETE FROM font_groups WHERE id='$id'";
    mysqli_query($conn, $sql);
    mysqli_close($conn);
    return print_r('1');
?>