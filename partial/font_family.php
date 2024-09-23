<?php 
    include 'connection.php';
    $fonts_sql = "SELECT * FROM fonts";
    $fonts = mysqli_query($conn, $fonts_sql);
    mysqli_close($conn);
    
    $font_family = '<style>';
    foreach($fonts as $font){
        $id = $font["id"];
        $font_name = $font["font_name"];
        $font_family .= '@font-face {
                            font-family: font'.$id.';
                            src: url(assets/fonts/'.$font_name.');
                        }';
    }
    $font_family .= '</style>';
    return print_r($font_family);
?>