<?php include('../../../config.php');
$query = $mysqli->query("select * from announcements ORDER BY id DESC");

?>
<style>
    .dataTables_filter {
        display: none;
    }
</style>
<input type="text" id="message_search" class="form-control"
       placeholder="Search...">

<!--begin: Datatable-->
<table class="table table-separate table-head-custom table-checkable" id="boardtable">
    <thead>
    <tr>
        <th>Title</th>
        <th>Announcements Number</th>
        <th>Date Created</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>
    <?php
    while ($result = $query->fetch_assoc()) {
        ?>
        <tr>
            <td><?php echo $result['title'] ?></td>
            <td><?php echo $result['announcement'] ?></td>
            <td>
                <?php echo $result['periodsent'].'<br/>('.time_elapsed_string($result['periodsent']).')' ?>
            </td>
            <td>
                <button type="button"
                        data-type="confirm"
                        class="btn btn-danger btn-sm delete_announcement"
                        i_index="<?php echo $result['id']; ?>"
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

    $('#message_search').keyup(function () {
        oTable.search($(this).val()).draw();
    });

    $(document).off('click', '.delete_announcement').on('click', '.delete_announcement', function () {
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
                                    url: "ajax/tables/message_table.php",
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

