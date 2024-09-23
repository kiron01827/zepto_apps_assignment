<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Title -->
    <title>Full Stack Developer Assignment</title>
    <!-- Favicon -->
    <link rel="icon" href="assets/img/icon.webp">
    <link rel="apple-touch-icon" href="assets/img/icon.webp">
    <!-- CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/dropzone.min.css" type="text/css" />
    <link rel="stylesheet" href="assets/css/core.css">

  </head>
  <body>
    <div class="position-relative">
        <?php 
            include 'partial/connection.php';
            $fonts_sql = "SELECT * FROM fonts";
            $fonts = mysqli_query($conn, $fonts_sql);
            mysqli_close($conn);
        ?>
        <div class="container">
            <!-- Assignment Title -->
            <h1 class="text-center mb-5">Full Stack Developer Assignment</h1>

            <!-- Font Upload -->
            <div class="mb-5">
                <form action="upload_font.php" class="dropzone" id="drop_file_uolpad">
                    <div class="dz-default dz-message">
                        <img class="upload-logo" src="assets/img/upload-logo.png" alt="upload">
                        <h5 class="mb-1">Click to upload or drag and drop</h5>
                        <span class="note needsclick">Only TTf file allowed</span>
                    </div>
                </form>
            </div>

            <!-- Uploaded Font List -->
            <div id="font_family">
                <?php include "partial/font_family.php"; ?>
            </div>
            <div class="mb-5">
                <div class="card">
                    <div class="card-header bg-white border-0">
                        <h4>Our Fonts</h4>
                        <p>Browse a list of zepto fonts to build your font group.</p>
                    </div>
                    <div class="card-body py-0">
                        <div class="table-responsive">
                            <table class="table" id="all_fonts_table">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">Font Name</th>
                                        <th scope="col">Preview</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php include "partial/get_fonts.php"; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Create Font Group -->
            <div class="mb-5">
                <div class="card">
                    <div class="card-header bg-white border-0">
                        <h4>Create Font Group</h4>
                        <p>You Have to select at least two fonts.</p>
                    </div>
                    <div class="card-body py-0">
                        <form action="#" id="font-group-form">
                            <div class="form-group">
                                <input type="text" class="form-control" name="font_group_title" placeholder="Group Title" required>
                            </div>
                            <div class="font-group-create-rows mb-3" id="font-group-create-rows">
                                
                            </div>
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <a class="btn btn-info" href="javascript:void(1);" onclick="addFontGroupRow()">Add Row +</a>
                                <a class="btn btn-success px-5" href="javascript:void(1);" onclick="createFontGroup()">Create</a>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Hidden -->
                <div class="d-none" id="font-group-create-row">
                    <div class="font-group-create-row p-2 mb-2">
                        <div class="row">
                            <div class="col-6">
                                <input type="text" class="form-control" name="font_name[]" placeholder="Font Name" required>
                            </div>
                            <div class="col-5">
                                <select class="form-control" name="font_select[]" required>
                                    <?php include "partial/font_group_create_row.php"; ?>
                                </select>
                            </div>
                            <div class="col-1 d-flex align-items-center justify-content-center">
                                <a href="javascript:void(1);" onclick="removeFontGroupRow(this)" class="text-danger text-decoration-none"><strong>X</strong></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Font Groups -->
            <div class="mb-5">
                <div class="card">
                    <div class="card-header bg-white border-0">
                        <h4>Our Fonts Groups</h4>
                        <p>List of all available font groups.</p>
                    </div>
                    <div class="card-body py-0">
                        <div class="table-responsive">
                            <table class="table">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">Name</th>
                                        <th scope="col">Fonts</th>
                                        <th scope="col">Count</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody id="font-group-row">
                                    <?php include "partial/font_group_row.php"; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Edit Modal -->
        <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Edit Fonts Group</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Loader -->
        <div class="loader d-none">
            <div class="loading-bar"><div></div><div></div><div></div></div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="assets/js/jquery.min.js" crossorigin="anonymous"></script>
    <script src="assets/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="assets/js/dropzone.min.js"></script>
    <script>
        Dropzone.autoDiscover = false;
        const myDropzone = new Dropzone('#drop_file_uolpad', {
            parallelUploads: 1,
            maxFilesize: 50,
            acceptedFiles: '.ttf',
            init: function () {
                this.on("success", function (file) {
                    addFontRow();
                    changeFontGroupRow();
                });
            }
        });
    </script>
    <script>
        $(document).ready(function(){
            addFontGroupRow();
        });

        function addFontRow() {
            $(".loader").removeClass('d-none');
            $.post('partial/font_family.php', {}, function(data){
                $('#font_family').html(data);
            });
            $.post('partial/get_fonts.php', {}, function(data){
                $('#all_fonts_table tbody').html(data);
            });
            $(".loader").addClass('d-none');
        }

        function removeFont(id, el) {
            $(".loader").removeClass('d-none');
            if (confirm("Are you sure want to Delete?") == true) {
                $.post('remove_font.php', {id:id}, function(data){
                    if (data == '1') {
                        el.closest("tr").remove();
                        $(".loader").addClass('d-none');
                    }
                });
            } else {
                $(".loader").addClass('d-none');
                return false;
            }
        }

        function addFontGroupRow() {
            let html = $('#font-group-create-row').html();
            $('#font-group-create-rows').append(html);
        }

        function removeFontGroupRow(el) {
            el.closest(".font-group-create-row").remove();
        }

        function changeFontGroupRow() {
            $(".loader").removeClass('d-none');
            $.post('partial/font_group_create_row.php', {}, function(data){
                $('#font-group-create-row select').html(data);
                $('.font-group-create-row').each(function() {
                    $(this).find('select').html(data);
                    $(".loader").addClass('d-none');
                });
            });
        }

        function createFontGroup() {
            var font_group_title = '';
            var font_name = [];
            var font_select = [];

            if ($('#font-group-form input[name="font_group_title"]').val() == ''){
                $('#font-group-form input[name="font_group_title"]').focus();
                return false;
            }
            font_group_title = $('#font-group-form input[name="font_group_title"]').val();

            if($('#font-group-form input[name="font_name[]"]').length < 2){
                alert('Please select at least two fonts.');
                return false;
            }

            $('#font-group-form input[name="font_name[]"]').each(function(){
                if ($(this).val() == '') {
                    $(this).focus();
                    event.preventDefault();
                    return false;
                }
                font_name.push($(this).val());
            });
            $('#font-group-form select[name="font_select[]"]').each(function(){
                if ($(this).val() == '') {
                    $(this).focus();
                    event.preventDefault();
                    return false;
                }
                font_select.push($(this).val());
            });
            $.post('create_font_group.php', {
                font_group_title:font_group_title,
                font_name:font_name,
                font_select:font_select,
            }, function(data){
                if (data == '1') {
                    $(".loader").removeClass('d-none');
                    $.post('partial/font_group_row.php', {}, function(data){
                        $('#font-group-row').html(data);
                        $('#font-group-form input[name="font_group_title"]').val('');
                        $('#font-group-create-rows').html('');
                        addFontGroupRow();
                        $(".loader").addClass('d-none');
                    });
                }
            });
        }

        function editFontGroup(id) {
            $.post('edit_font_group.php', {id:id}, function(data){
                $('#editModal .modal-body').html(data);
                $('#editModal').modal('show');
            });
        }

        function addFontGroupRowEdit() {
            let html = $('#font-group-create-row').html();
            $('#font-group-edit-rows').append(html);
        }
        
        function updateFontGroup(id) {
            var font_group_title = '';
            var font_name = [];
            var font_select = [];

            if ($('#font-group-form-edit input[name="font_group_title"]').val() == ''){
                $('#font-group-form-edit input[name="font_group_title"]').focus();
                return false;
            }
            font_group_title = $('#font-group-form-edit input[name="font_group_title"]').val();

            if($('#font-group-form-edit input[name="font_name[]"]').length < 2){
                alert('Please select at least two fonts.');
                return false;
            }

            $('#font-group-form-edit input[name="font_name[]"]').each(function(){
                if ($(this).val() == '') {
                    $(this).focus();
                    return false;
                }
                font_name.push($(this).val());
            });
            $('#font-group-form-edit select[name="font_select[]"]').each(function(){
                if ($(this).val() == '') {
                    $(this).focus();
                    return false;
                }
                font_select.push($(this).val());
            });

            $.post('update_font_group.php', {
                font_group_title:font_group_title,
                font_name:font_name,
                font_select:font_select,
                id:id
            }, function(data){
                if (data == '1') {
                    $(".loader").removeClass('d-none');
                    $.post('partial/font_group_row.php', {}, function(data){
                        $('#font-group-row').html(data);
                        $('#editModal').modal('hide');
                        $(".loader").addClass('d-none');
                    });
                }
                
            });
        }

        function removeFontGroup(id, el) {
            $(".loader").removeClass('d-none');
            if (confirm("Are you sure want to Delete?") == true) {
                $.post('remove_font_group.php', {id:id}, function(data){
                    if (data == '1') {
                        el.closest("tr").remove();
                        $(".loader").addClass('d-none');
                    }
                });
            } else {
                $(".loader").addClass('d-none');
                return false;
            }
        }
    </script>
  </body>
</html>