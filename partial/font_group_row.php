<?php 
    include 'connection.php';
    $font_groups_sql = "SELECT * FROM font_groups";
    $font_groups = mysqli_query($conn, $font_groups_sql);
    mysqli_close($conn);
    
    $font_group_row = '<option value="">Select Font</option>';
    foreach($font_groups as $font_group){
        $font_group_id = $font_group["id"];
        $font_group_title = $font_group["font_group_title"];
        $font_name = $font_group["font_name"];
        $font_count = explode(",", $font_name);
        $font_group_row .= 
        '<tr>
            <td>'.$font_group_title.'</td>
            <td>'.$font_name.'</td>
            <td>'.count($font_count).'</td>
            <td class="text-right">
                <a href="javascript:void(1);" class="text-primary text-decoration-none mr-2" onclick="editFontGroup('.$font_group_id.')"><strong>Edit</strong></a>
                <a href="javascript:void(1);" class="text-danger text-decoration-none" onclick="removeFontGroup('.$font_group_id.', this)"><strong>Delete</strong></a>
            </td>
        </tr>';
    }
    return print_r($font_group_row);
?>