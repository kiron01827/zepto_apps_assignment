<?php 
    include 'partial/connection.php';

    $id = $_POST["id"];
    $font_group_title = $_POST["font_group_title"];
    $font_name = implode(",", $_POST["font_name"]);
    $font_select = implode(",", $_POST["font_select"]);

    $font_group_sql = "UPDATE font_groups SET font_group_title='$font_group_title', font_name='$font_name', font_select='$font_select' WHERE id='$id'";
    $fonts = mysqli_query($conn, $font_group_sql);
    mysqli_close($conn);
    return print_r('1');
?>