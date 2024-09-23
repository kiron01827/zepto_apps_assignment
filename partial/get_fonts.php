<?php 
    include 'connection.php';
    $fonts_sql = "SELECT * FROM fonts";
    $fonts = mysqli_query($conn, $fonts_sql);
    mysqli_close($conn);
    
    $font_option = '';
    foreach($fonts as $font){
        $id = $font["id"];
        $font_name = $font["font_name"];
        $font_option .= '<tr>
                            <td>'.$font_name.'</td>
                            <td style="font-family:font'.$id.' !important;">Example Style</td>
                            <td class="text-right">
                                <a href="javascript:void(1);" onclick="removeFont('.$id.', this)">Delete</a>
                            </td>
                        </tr>';
    }
    return print_r($font_option);
?>