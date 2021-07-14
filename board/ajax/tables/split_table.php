<?php include('../../../config.php');
$query = $mysqli->query("select DISTINCT(boardid) as boardids from previewboard");

?>
<style>
    .dataTables_filter {
        display: none;
    }
</style>

<input type="text" id="member_search" class="form-control"
       placeholder="Search...">

<!--begin: Datatable-->
<table class="table table-separate table-head-custom table-checkable" id="membertable">
    <thead>
    <tr>
        <th>Board Name</th>
        <th>Number of Members</th>
        <th>Number Paid</th>
        <th>Board Status</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>
    <?php
    while ($result = $query->fetch_assoc()) {
        ?>
        <tr>
            <td>
                <?php $boardid = $result['boardids'];
                $getname = $mysqli->query("select * from boards where boardid = '$boardid' ORDER BY boardname");
                $resname = $getname->fetch_assoc();
                echo $resname['boardname'];
                ?>
            </td>
            <td>
                <b><?php echo $countdb = mysqli_num_rows($mysqli->query("select * from previewboard where boardid = '$boardid'"));
                ?></b>
                Out of <?php echo $countmax = getmaxboardnumber($boardid); ?>
            </td>
            <td>
                <b><?php echo $countpaid = mysqli_num_rows($mysqli->query("select * from previewboard where boardid = '$boardid' and payment = '1'"));
                ?></b>
                Out of <?php echo $countmaxpaid = getmaxpaidnumber($boardid); ?>
            </td>
            <td>
                <?php
                if (($countdb == $countmax) && ($countpaid == $countmaxpaid)) {
                    echo "<span class='label label-lg label-light-success label-inline'>Complete</span>";
                }
                else {
                    echo "<span class='label label-lg label-light-danger label-inline'>Incomplete</span>";
                }
                ?>
            </td>
            <td>
                <?php
                    if (($countdb == $countmax) && ($countpaid == $countmaxpaid)) { ?>
                        <button type="button"
                        data-type="confirm"
                        class="btn btn-primary js-sweetalert edit_colour btn-sm"
                        i_index="<?php echo $boardid; ?>"
                        title="Edit">
                        Split Board
                    </button>
                   <?php  }
                    else {
                        echo "<span class='label label-lg label-light-danger label-inline'>Incomplete</span>";
                    }
                ?>
            </td>
                  
           
        </tr>
        <?php
    }
    ?>
    </tbody>
</table>
<!--end: Datatable-->


<script>

    oTable = $('#membertable').DataTable({
        "bLengthChange": false
    });

    $('#member_search').keyup(function () {
        oTable.search($(this).val()).draw();
    });


    $(document).off('click', '.deletemember').on('click', '.deletemember', function () {
        var theindex = $(this).attr('i_index');
        //alert(theindex)
        $.confirm({
            title: 'Remove Member!',
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
                            url: "ajax/queries/delete_member.php",
                            data: {
                                i_index: theindex
                            },
                            dataType: "html",
                            success: function (text) {
                                //alert(text);
                                $.ajax({
                                    url: "ajax/tables/member_table.php",
                                    beforeSend: function () {
                                        KTApp.blockPage({
                                            overlayColor: "#000000",
                                            type: "v2",
                                            state: "success",
                                            message: "Please wait..."
                                        })
                                    },
                                    success: function (text) {
                                        $('#membertable_div').html(text);
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

    $(document).off('click', '.suspendmember').on('click', '.suspendmember', function () {
        var theindex = $(this).attr('i_index');
        //alert(theindex)
        $.confirm({
            title: 'Suspend Member!',
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
                            url: "ajax/queries/suspend_member.php",
                            data: {
                                i_index: theindex
                            },
                            dataType: "html",
                            success: function (text) {
                                //alert(text);
                                $.ajax({
                                    url: "ajax/tables/member_table.php",
                                    beforeSend: function () {
                                        KTApp.blockPage({
                                            overlayColor: "#000000",
                                            type: "v2",
                                            state: "success",
                                            message: "Please wait..."
                                        })
                                    },
                                    success: function (text) {
                                        $('#membertable_div').html(text);
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

    $(document).off('click', '.viewmemberdetails').on('click', '.viewmemberdetails', function () {
        var theindex = $(this).attr('i_index');
        //alert(theindex);

        $.ajax({
                type: "POST",
                url: "ajax/forms/viewmemberdetails.php",
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
                    $('#viewmemberdiv').html(text);
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + " " + thrownError);
                },
                complete: function () {
                    KTApp.unblockPage();
                },
            });

    });
</script>