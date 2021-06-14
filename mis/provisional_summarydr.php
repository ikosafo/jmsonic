<?php require('includes/header.php') ?>

<!-- begin:: Subheader -->
<div class="kt-subheader  kt-grid__item" id="kt_subheader"></div>
<!-- end:: Subheader -->


<!-- begin:: Content -->
<div class="kt-container  kt-grid__item kt-grid__item--fluid">
    <!--Begin::Dashboard 3-->

    <div class="row">
        <div class="col-xl-12">
            <!--begin:: Widgets/Applications/User/Profile3-->
            <div class="kt-portlet kt-portlet--height-fluid">
                <div class="kt-portlet__body">
                    <div class="kt-portlet__body">


                        <div class="kt-portlet__head kt-portlet__head--lg mb-4">
                            <div class="kt-portlet__head-label">
                                <h3 class="kt-portlet__head-title">
                                    Provisional Registrations
                                    <small>Summary Data by Date Range</small>
                                </h3>
                            </div>
                        </div>


                        <div class="form-group row">

                            <div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
                                <div class="kt-form__group kt-form__group--inline">
                                    <div class="kt-form__label">
                                        <label>Start Date:</label>
                                    </div>
                                    <div class="kt-form__control">
                                        <input type="text" class="form-control" id="start_date" placeholder="Select Start Date"/>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
                                <div class="kt-form__group kt-form__group--inline">
                                    <div class="kt-form__label">
                                        <label>End Date:</label>
                                    </div>
                                    <div class="kt-form__control">
                                        <input type="text" class="form-control" id="end_date" placeholder="Select End Date">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-2 kt-margin-b-20-tablet-and-mobile">
                                <div class="kt-form__group kt-form__group--inline">
                                    <div class="kt-form__label">
                                        <label>Region:</label>
                                    </div>
                                    <div class="kt-form__control">
                                        <select id="search_region" class="form-control kt-select2" style="width: 100%">
                                            <option value="Any">Any</option>
                                            <option value="Ashanti Region">Ashanti Region</option>
                                            <option value="Brong Ahafo Region">Brong Ahafo Region</option>
                                            <option value="Central Region">Central Region</option>
                                            <option value="Eastern Region">Eastern Region</option>
                                            <option value="Greater Accra Region">Greater Accra Region</option>
                                            <option value="Northern Region">Northern Region</option>
                                            <option value="Upper East Region">Upper East Region</option>
                                            <option value="Upper West Region">Upper West Region</option>
                                            <option value="Volta Region">Volta Region</option>
                                            <option value="Western Region">Western Region</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
                                <div class="kt-form__group kt-form__group--inline">
                                    <div class="kt-form__label">
                                        <label>Profession:</label>
                                    </div>
                                    <div class="kt-form__control">
                                        <select id="search_profession" class="form-control kt-select2" style="width: 100%">
                                            <option value="Any">Any</option>
                                            <?php
                                            $query = $mysqli->query("select professionname from professions ORDER BY professionname");
                                            while ($result = $query->fetch_assoc()) { ?>
                                                <option <?php if (@$profession == $result['professionname']) echo "Selected" ?>><?php echo $result['professionname'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-1 kt-margin-b-20-tablet-and-mobile">
                                <div class="kt-form__group kt-form__group--inline">
                                    <div class="kt-form__label">
                                        <label>Search:</label>
                                    </div>
                                    <button type="button" id="search_provisional" class="btn btn-primary">
                                        <i class="flaticon2-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-12">
                                <div id="provisional_table_div"></div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
            <!--end:: Widgets/Applications/User/Profile3-->
        </div>
    </div>

</div>
<!--End::Dashboard 3-->
<!-- end:: Content -->

<?php require('includes/footer.php') ?>


<script>
    var KTSelect2 = {
        init: function () {
            $("#search_region").select2({placeholder: "Select Region"});
            $("#search_profession").select2({placeholder: "Select Profession"});
        }
    };
    jQuery(document).ready(function () {
        KTSelect2.init()
    });

    $("#start_date").datepicker({
        format: 'yyyy-mm-dd',
        autoclose: true,
        orientation: "bottom"
    });

    $("#end_date").datepicker({
        format: 'yyyy-mm-dd',
        autoclose: true,
        orientation: "bottom"
    });

    $("#search_provisional").click(function(){
        var start_date = $("#start_date").val();
        var end_date = $("#end_date").val();
        var search_region = $("#search_region").val();
        var search_profession = $("#search_profession").val();
        var provisional_status = $("#provisional_status").val();

        var error = '';
        if (start_date == "") {
            error += 'Please select start date \n';
            $("#start_date").focus();
        }
        if (end_date == "") {
            error += 'Please select end date \n';
            $("#end_date").focus();
        }
        if (start_date > end_date) {
            error += 'Please select correct date range \n';
            $("#end_date").focus();
        }
        if (search_region == "") {
            error += 'Please select region \n';
        }
        if (provisional_status == "") {
            error += 'Please select status \n';
        }
        if (search_profession == "") {
            error += 'Please select profession \n';
        }

        if (error == "") {
            $.ajax({
                type: "POST",
                url: "ajax/tables/provisional_summary_tabledr.php",
                beforeSend: function () {
                    KTApp.blockPage({
                        overlayColor: "#000000",
                        type: "v2",
                        state: "success",
                        message: "Please wait..."
                    })
                },
                data: {
                    start_date: start_date,
                    end_date: end_date,
                    search_region: search_region,
                    search_approval: provisional_status,
                    search_profession: search_profession
                },
                success: function (text) {
                    $('#provisional_table_div').html(text);
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + " " + thrownError);
                },
                complete: function () {
                    KTApp.unblockPage();
                },
            });
        }
        else {
            $.notify(error, {position: "top center"});
        }
        return false;

    });


    $("#provisional_status").selectpicker();


</script>

