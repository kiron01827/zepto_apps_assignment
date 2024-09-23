<?php 
    include 'partial/connection.php';

    $font_group_title = $_POST["font_group_title"];
    $font_name = implode(",", $_POST["font_name"]);
    $font_select = implode(",", $_POST["font_select"]);

    $font_group_sql = "INSERT INTO font_groups (font_group_title,font_name,font_select) VALUES ('$font_group_title','$font_name','$font_select')";
    $fonts = mysqli_query($conn, $font_group_sql);
    mysqli_close($conn);
    return print_r('1');
?>