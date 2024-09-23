<?php 
    include 'connection.php';
    $fonts_sql = "SELECT * FROM fonts";
    $fonts = mysqli_query($conn, $fonts_sql);
    mysqli_close($conn);
    
    $font_option = '<option value="">Select Font</option>';
    foreach($fonts as $font){
        $id = $font["id"];
        $font_name = $font["font_name"];
        $font_option .= '<option value="'.$id.'">'.$font_name.'</option>';
    }
    return print_r($font_option);
?>