<?php
    include 'partial/connection.php';
    $sql = "SELECT * FROM font_groups WHERE id=".$_POST['id'];
    $result  = mysqli_query($conn, $sql);
    $font_group = $result->fetch_array(MYSQLI_ASSOC);

    $fonts_sql = "SELECT * FROM fonts";
    $fonts = mysqli_query($conn, $fonts_sql);

    mysqli_close($conn);

    $font_group_id = $font_group['id'];
    $font_group_title = $font_group['font_group_title'];
    $font_names = explode(',', $font_group['font_name']);
    $font_selects = explode(',', $font_group['font_select']);

    $row_data = '';
    foreach ($font_names as $key => $group_font_name) {
        $font_option = '<option value="">Select Font</option>';
        foreach($fonts as $font){
            $id = $font["id"];
            $selected = $font_selects[$key] == $id ? 'selected' : '';
            $font_name = $font["font_name"];
            $font_option .= '<option value="'.$id.'" '.$selected.'>'.$font_name.'</option>';
        }
        $row_data .= '<div class="font-group-create-row p-2 mb-2">
                <div class="row">
                    <div class="col-6">
                        <input type="text" class="form-control" name="font_name[]" placeholder="Font Name" value="'.$group_font_name.'" required>
                    </div>
                    <div class="col-5">
                        <select class="form-control" name="font_select[]" required>
                        '.$font_option.'
                        </select>
                    </div>
                    <div class="col-1 d-flex align-items-center justify-content-center">
                        <a href="javascript:void(1);" onclick="removeFontGroupRow(this)" class="text-danger text-decoration-none"><strong>X</strong></a>
                    </div>
                </div>
            </div>';
    }

    $html = '<form action="#" id="font-group-form-edit">
                            <div class="form-group">
                                <input type="text" class="form-control" name="font_group_title" placeholder="Group Title" value="'.$font_group_title.'" required>
                            </div>
                            <div class="font-group-edit-rows mb-3" id="font-group-edit-rows">
                                '.$row_data.'
                            </div>
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <a class="btn btn-info" href="javascript:void(1);" onclick="addFontGroupRowEdit()">Add Row +</a>
                                <a class="btn btn-success px-5" href="javascript:void(1);" onclick="updateFontGroup('.$font_group_id.')">Update</a>
                            </div>
                        </form>';

    return print_r($html);
?>