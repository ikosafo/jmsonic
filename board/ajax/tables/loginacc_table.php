<?php include('../../../config.php');
$query = $mysqli->query("select * from users ORDER BY id DESC");
$selectstatus = $_POST['selectstatus'];

?>
<style>
    .dataTables_filter {
        display: none;
    }
</style>
<input type="text" id="acc_search" class="form-control"
       placeholder="Search...">



<!--begin: Datatable-->
<table class="table table-separate table-head-custom table-checkable" id="accounttable">
    <thead>
        <tr>
            <th>More Details</th>
            <th>Full Name</th>
            <th>Telephone</th>
            <th>Email Address</th>
            <th>Location</th>
            <th>Country</th>
            <th>Status</th>
            <th>Next of Kin</th>
            <th>Next of Kin Phone</th>
            <th>Introducer</th>
            <th>Role</th>
            <th>Existing</th>
            <th>Action</th>
        </tr>
    </thead>

</table>
<!--end: Datatable-->


<script>

    $('#acc_search').keyup(function () {
        oTable.search($(this).val()).draw();
    });

    oTable = $('#accounttable').DataTable({
        stateSave: true,
        responsive: true,
        "bLengthChange": false,
        'processing': true,
        'serverSide': true,
        'serverMethod': 'post',
        'ajax': {
            'url': 'ajax/paginations/useraccounts.php?status=<?php echo $selectstatus ?>'
        },
        'columns': [
            {data: 'view'},
            {data: 'fullname'},
            {data: 'telephone'},
            {data: 'emailaddress'},
            {data: 'location'},
            {data: 'country'},
            {data: 'userstatus'},
            {data: 'nextofkin'},
            {data: 'nextofkintelephone'},
            {data: 'introducer'},
            {data: 'userrole'},
            {data: 'existing'},
            {data: 'userid'}
        ]
    });
    $('#account_search').keyup(function () {
        oTable.search($(this).val()).draw();
    })

   /* $(document).off('click', '.edit_board').on('click', '.edit_board', function () {
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
                                        $('#accounttable_div').html(text);
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
    });*/



</script>

