<?php include('../../../config.php');
$query = $mysqli->query("select * from boards where status = 'Active'");

?>
<style>
    .dataTables_filter {
        display: none;
    }
</style>
<input type="text" id="board_search" class="form-control"
       placeholder="Search Board">

<!--begin: Datatable-->
<table class="table table-separate table-head-custom table-checkable" id="boardtable">
    <thead>
    <tr>
        <th>Board Name</th>
        <th>Maximum Number</th>
        <th>Board Type</th>
        <th>Date Created</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>
    <?php
    while ($result = $query->fetch_assoc()) {
        ?>
        <tr>
            <td><?php echo $result['boardname'] ?></td>
            <td><?php echo $result['boardnumber'] ?></td>
            <td><?php echo $result['type'] ?></td>
            <td>
                <?php echo $result['entrydate'].'<br/>('.time_elapsed_string($result['entrydate']).')' ?>
            </td>
            <td>
                <button type="button"
                        data-type="confirm"
                        class="btn btn-primary js-sweetalert edit_board btn-sm"
                        i_index="<?php echo $result['boardid']; ?>"
                        title="Edit">
                    <i class="flaticon2-edit ml-2" style="color:#fff !important;"></i>
                </button>

                <button type="button"
                        data-type="confirm"
                        class="btn btn-danger btn-sm delete_board"
                        i_index="<?php echo $result['boardid']; ?>"
                        title="Delete">
                    <i class="flaticon2-trash ml-2" style="color:#fff !important;"></i>
                </button>
            </td>
        </tr>
        <?php
    }
    ?>
    </tbody>
</table>
<!--end: Datatable-->


<script>
    oTable = $('#boardtable').DataTable({
        "bLengthChange": false
    });

    $('#board_search').keyup(function () {
        oTable.search($(this).val()).draw();
    });

    $(document).off('click', '.edit_board').on('click', '.edit_board', function () {
        var theindex = $(this).attr('i_index');
        //alert(theindex)
        $.ajax({
            type: "POST",
            url: "ajax/forms/editboard_form.php",
            beforeSend: function () {
                KTApp.blockPage({
                    overlayColor: "#000000",
                    type: "v2",
                    state: "success",
                    message: "Please wait..."
                })
            },
            data: {
                theindex: theindex
            },
            success: function (text) {
                $('#boardform_div').html(text);
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(xhr.status + " " + thrownError);
            },
            complete: function () {
                KTApp.unblockPage();
            },
        });
    });

    $(document).off('click', '.delete_board').on('click', '.delete_board', function () {
        var theindex = $(this).attr('i_index');
        //alert(theindex)
        $.confirm({
            title: 'Delete Board!',
            content: 'Are you sure to continue?',
            buttons: {
                no: {
                    text: 'No',
                    keys: ['enter', 'shift'],
                    backdrop: 'static',
                    keyboard: false,
                    action: function () {
                        $.alert('Data is safe');
                    }
                },
                yes: {
                    text: 'Yes, Delete it!',
                    btnClass: 'btn-blue',
                    action: function () {
                        $.ajax({
                            type: "POST",
                            url: "ajax/queries/delete_board.php",
                            data: {
                                i_index: theindex
                            },
                            dataType: "html",
                            success: function (text) {
                                $.ajax({
                                    url: "ajax/tables/board_table.php",
                                    beforeSend: function () {
                                        KTApp.blockPage({
                                            overlayColor: "#000000",
                                            type: "v2",
                                            state: "success",
                                            message: "Please wait..."
                                        })
                                    },
                                    success: function (text) {
                                        $('#boardtable_div').html(text);
                                    },
                                    error: function (xhr, ajaxOptions, thrownError) {
                                        alert(xhr.status + " " + thrownError);
                                    },
                                    complete: function () {
                                        KTApp.unblockPage();
                                    },

                                });
                            },
                            complete: function () {
                            },
                            error: function (xhr, ajaxOptions, thrownError) {
                                alert(xhr.status + " " + thrownError);
                            }
                        });
                    }
                }
            }
        });
    });



</script>

