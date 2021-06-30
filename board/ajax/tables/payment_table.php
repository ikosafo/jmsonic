<?php include('../../../config.php');
$query = $mysqli->query("select DISTINCT(boardid) as boardids from paymentconfig");

?>
<style>
    .dataTables_filter {
        display: none;
    }
</style>

<input type="text" id="payment_search" class="form-control"
       placeholder="Search Payment Config Details">

<!--begin: Datatable-->
<table class="table table-separate table-head-custom table-checkable" id="paymenttable">
    <thead>
        <tr>
            <th>Board Name</th>
            <th>Payment Details</th>
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
                        <th>Colour to Receive</th>
                        <th>Amount</th>
                        <th>Colour to Pay</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $getpaymentdetails = $mysqli->query("select * from paymentconfig where boardid = '$boardid'");
                    while ($respaymentdetails = $getpaymentdetails->fetch_assoc()) { ?>

                        <tr>
                            <td><?php $reccolid = $respaymentdetails['reccolid'];
                                $getcolour = $mysqli->query("select * from colourconfig where colourid = '$reccolid'");
                                $rescolour = $getcolour->fetch_assoc();
                                echo $rescolour['colourname'];
                                ?></td>
                            <td><?php echo $respaymentdetails['amounttopay'] ?></td>
                            <td><?php $paycolid = $respaymentdetails['paycolid'];
                                $getcolour2 = $mysqli->query("select * from colourconfig where colourid = '$paycolid'");
                                $rescolour2 = $getcolour2->fetch_assoc();
                                echo $rescolour2['colourname'];
                                ?></td>
                            <td>
                                <button type="button"
                                        data-type="confirm"
                                        class="btn btn-danger btn-sm delete_payment"
                                        i_index="<?php echo $respaymentdetails['payid']; ?>"
                                        title="Delete">
                                    <i class="flaticon2-trash ml-2" style="color:#fff !important;"></i>
                                </button>
                            </td>
                        </tr>
                    <?php }
                    ?>

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

    oTable = $('#paymenttable').DataTable({
        "bLengthChange": false
    });

    $('#payment_search').keyup(function () {
        oTable.search($(this).val()).draw();
    });

   
    $(document).off('click', '.delete_payment').on('click', '.delete_payment', function () {
        var theindex = $(this).attr('i_index');
        //alert(theindex)
        $.confirm({
            title: 'Delete Payment Details!',
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
                            url: "ajax/queries/delete_payment.php",
                            data: {
                                i_index: theindex
                            },
                            dataType: "html",
                            success: function (text) {
                                $.ajax({
                                    url: "ajax/tables/payment_table.php",
                                    beforeSend: function () {
                                        KTApp.blockPage({
                                            overlayColor: "#000000",
                                            type: "v2",
                                            state: "success",
                                            message: "Please wait..."
                                        })
                                    },
                                    success: function (text) {
                                        $('#paymenttable_div').html(text);
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