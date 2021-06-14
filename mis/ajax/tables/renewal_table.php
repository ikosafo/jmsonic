<?php include('../../../config.php');
$fullname = $_SESSION['full_name'];
$password = $_SESSION['password'];
$username = $_SESSION['username'];
$user_type = $_SESSION['user_type'];
$year_search = $_POST['select_year'];
$renewal_status = $_POST['renewal_status'];
$admintype = $_POST['admintype'];

?>
<style>
    .dataTables_filter {
        display: none;
    }
</style>

<div class="form-group row">
    <div class="col-md-8 kt-margin-b-20-tablet-and-mobile">
        <div class="kt-form__group kt-form__group--inline">
            <div class="kt-form__label">
                <label>Select Applicant:</label>
            </div>
            <div class="kt-form__control">
                <select class="form-control kt-select2" id="selectapplicant" name="param">
                    <option>Select Applicant to Search</option>
                    <?php
                    $getapplicant = $mysqli->query("select * from provisional p
                                                   JOIN renewal r
                                                   ON p.applicant_id = r.applicant_id WHERE r.cpdyear = '$year_search'");
                    while ($resapplicant = $getapplicant->fetch_assoc()) { ?>
                    <option value="<?php echo $resapplicant['applicant_id']; ?>"><?php echo $resapplicant['surname'].' '.$resapplicant['first_name'].' '.$resapplicant['other_name'].' - '.$resapplicant['provisional_pin'].' - '.$resapplicant['email_address']  ?></option>
                    <?php } ?>

                </select>
            </div>
        </div>
    </div>

    <div class="col-md-4 kt-margin-b-20-tablet-and-mobile">
        <div class="kt-form__group kt-form__group--inline">
            <div class="kt-form__label">
                <label>Search Query:</label>
            </div>
            <button type="button" id="search_load_btn" class="btn btn-primary">
                Search
            </button>
        </div>
    </div>
</div>

<div class="kt-separator kt-separator--dashed"></div>

<div class="kt-section">
    <div class="kt-section__content responsive">

        <div class="table-responsive">
            <table id="prov-table" class="table" style="margin-top: 3% !important;">
                <thead>
                    <tr>
                        <th>Full Name</th>
                        <th>Email Address</th>
                        <th>Provisional PIN</th>
                        <th>MIS Status</th>
                        <th>Admin Status</th>
                        <th>Period Registered</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

<script>
    var KTSelect2 = {
        init: function () {
            $("#selectapplicant").select2({placeholder: "Select a year"});
        }
    };

    jQuery(document).ready(function () {
        KTSelect2.init()
    });

    dTable = $('#example').DataTable({
        "lengthChange": false
    });

    var admintype = '<?php echo $admintype ?>';
    //alert(admintype);

    if (admintype == 'Super Admin') {
        oTable = $('#prov-table').DataTable({
            stateSave: true,
            "bLengthChange": false,
            dom: "rtiplf",
            "sDom": '<"top"ip>rt<"bottom"fl><"clear">',
            'processing': true,
            'serverSide': true,
            'serverMethod': 'post',
            'ajax': {
                'url': 'ajax/paginations/renewal_super.php?year=<?php echo $year_search ?>&status=<?php echo $renewal_status ?>'
            },
            'columns': [
                {data: 'provisionalid'},
                {data: 'email_address'},
                {data: 'renewal_pin'},
                {data: 'renewal_usercheck_status'},
                {data: 'renewal_admincheck_status'},
                {data: 'renewal_period'},
                {data: 'applicant_id'}
            ]
        });

        $("#search_load_btn").click(function () {
            var id_index = $("#selectapplicant").val();
            var id_year = '<?php echo $year_search ?>';
            //alert(id_index+' '+id_year);

            $('html, body').animate({
                scrollTop: $("#approval_div").offset().top
            }, 2000);
            $.ajax({
                type: "POST",
                url: "approvalsuper_renewal.php",
                data: {
                    id_index:id_index,
                    id_year:id_year
                },
                beforeSend: function () {
                    KTApp.blockPage({
                        overlayColor: "#000000",
                        type: "v2",
                        state: "success",
                        message: "Please wait..."
                    })
                },
                success: function (text) {
                    $('#approval_div').html(text);
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + " " + thrownError);
                },
                complete: function () {
                    KTApp.unblockPage();
                },
            });
        });
    }

    else {
        oTable = $('#prov-table').DataTable({
            stateSave: true,
            "bLengthChange": false,
            dom: "rtiplf",
            "sDom": '<"top"ip>rt<"bottom"fl><"clear">',
            'processing': true,
            'serverSide': true,
            'serverMethod': 'post',
            'ajax': {
                'url': 'ajax/paginations/renewal_mis.php?year=<?php echo $year_search ?>&status=<?php echo $renewal_status ?>'
            },
            'columns': [
                {data: 'provisionalid'},
                {data: 'email_address'},
                {data: 'renewal_pin'},
                {data: 'renewal_usercheck_status'},
                {data: 'renewal_admincheck_status'},
                {data: 'renewal_period'},
                {data: 'applicant_id'}
            ]
        });

        $("#search_load_btn").click(function () {
            var id_index = $("#selectapplicant").val();
            var id_year = '<?php echo $year_search ?>';
            //alert(id_index+' '+id_year);

            $('html, body').animate({
                scrollTop: $("#approval_div").offset().top
            }, 2000);
            $.ajax({
                type: "POST",
                url: "approvalmis_renewal.php",
                data: {
                    id_index:id_index,
                    id_year:id_year
                },
                beforeSend: function () {
                    KTApp.blockPage({
                        overlayColor: "#000000",
                        type: "v2",
                        state: "success",
                        message: "Please wait..."
                    })
                },
                success: function (text) {
                    $('#approval_div').html(text);
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + " " + thrownError);
                },
                complete: function () {
                    KTApp.unblockPage();
                },
            });
        });
    }


   /* $('#renewal_search').keyup(function () {
        oTable.search($(this).val()).draw();
    });

    $('#example_search').keyup(function () {
        dTable.search($(this).val()).draw();
    });*/

</script>