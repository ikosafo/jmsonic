<?php include('../../../config.php');
$query = $mysqli->query("select DISTINCT(boardid) as boardids from colourconfig");

?>
<style>
    .dataTables_filter {
        display: none;
    }
</style>

<input type="text" id="colour_search" class="form-control"
       placeholder="Search Board or Colour">

<!--begin: Datatable-->
<table class="table table-separate table-head-custom table-checkable" id="colourtable">
    <thead>
    <tr>
    <tr>
        <th>Board Name</th>
        <th>Colour Details</th>
    </tr>
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
                <table>
                    <thead>
                    <tr>
                        <th>Colour Name</th>
                        <th>Colour Code</th>
                        <th>Priority</th>
                        <th>Number Assigned</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $getcolourdetails = $mysqli->query("select * from colourconfig where boardid = '$boardid' and `status` = 'Active'");
                    while ($rescolourdetails = $getcolourdetails->fetch_assoc()) { ?>

                        <tr>
                            <td><?php echo $rescolourdetails['colourname'] ?></td>
                            <td><?php echo $rescolourdetails['colourcode'] ?></td>
                            <td><?php echo $rescolourdetails['colourpriority'] ?></td>
                            <td><?php echo $rescolourdetails['numberassign'] ?></td>
                            <td>
                                <button type="button"
                                        data-type="confirm"
                                        class="btn btn-primary js-sweetalert edit_colour btn-sm"
                                        i_index="<?php echo $rescolourdetails['colourid']; ?>"
                                        title="Edit">
                                    <i class="flaticon2-edit ml-2" style="color:#fff !important;"></i>
                                </button>
                                <button type="button"
                                        data-type="confirm"
                                        class="btn btn-danger btn-sm delete_colour"
                                        i_index="<?php echo $rescolourdetails['colourid']; ?>"
                                        title="Delete">
                                    <i class="flaticon2-trash ml-2" style="color:#fff !important;"></i>
                                </button>
                            </td>
                        </tr>
                    <?php }
                    ?>
                    <tr style="font-weight: 500">
                        <td colspan="3">TOTAL</td>
                        <td>
                            <?php $gettotal = $mysqli->query("select sum(numberassign) as colortotal from colourconfig where boardid = '$boardid'
                                            and status = 'Active'");
                            $restotal = $gettotal->fetch_assoc();
                            echo $restotal['colortotal'];
                            ?>
                        </td>
                    </tr>
                    </tbody>

                </table>
            </td>
        </tr>
        <?php
    }
    ?>
    </tbody>
</table>
<!--end: Datatable-->


<script>

    oTable = $('#colourtable').DataTable({
        "bLengthChange": false
    });

    $('#colour_search').keyup(function () {
        oTable.search($(this).val()).draw();
    });

    $(document).off('click', '.edit_colour').on('click', '.edit_colour', function () {
        var theindex = $(this).attr('i_index');
        //alert(theindex)
        $.ajax({
            type: "POST",
            url: "ajax/forms/editcolour_form.php",
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
                $('#colourform_div').html(text);
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(xhr.status + " " + thrownError);
            },
            complete: function () {
                KTApp.unblockPage();
            },
        });
    });

    $(document).off('click', '.delete_colour').on('click', '.delete_colour', function () {
        var theindex = $(this).attr('i_index');
        //alert(theindex)
        $.confirm({
            title: 'Delete Colour!',
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
                            url: "ajax/queries/delete_colour.php",
                            data: {
                                i_index: theindex
                            },
                            dataType: "html",
                            success: function (text) {
                                //alert(text);
                                $.ajax({
                                    url: "ajax/tables/colour_table.php",
                                    beforeSend: function () {
                                        KTApp.blockPage({
                                            overlayColor: "#000000",
                                            type: "v2",
                                            state: "success",
                                            message: "Please wait..."
                                        })
                                    },
                                    success: function (text) {
                                        $('#colourtable_div').html(text);
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