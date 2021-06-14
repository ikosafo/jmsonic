<?php require('includes/header.php');
$usertype = $_SESSION['user_type'];
?>

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
                                    Licensure Examination Registrations
                                    <small>Examination Search</small>
                                </h3>
                            </div>
                        </div>

                        <div class="form-group row">

                            <div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
                                <div class="kt-form__group kt-form__group--inline">
                                    <div class="kt-form__label">
                                        <label>Select Year:</label>
                                    </div>
                                    <div class="kt-form__control">
                                        <select class="form-control kt-select2" id="select_year" name="param">
                                            <option></option>
                                            <optgroup label="Main">
                                                <option value="<?php echo date('Y') ?>"><?php echo date('Y') ?></option>
                                                <option value="Any">All</option>
                                            </optgroup>
                                            <optgroup label="Other">

                                                <option value="2018">2018</option>
                                                <option value="2019">2019</option>
                                                <option value="2020">2020</option>
                                                <option value="2021">2021</option>
                                                <option value="2022">2022</option>
                                                <option value="2023">2023</option>
                                                <option value="2024">2024</option>
                                                <option value="2025">2025</option>
                                                <option value="2026">2026</option>
                                                <option value="2026">2026</option>
                                                <option value="2027">2027</option>
                                                <option value="2028">2028</option>
                                                <option value="2029">2029</option>
                                                <option value="2030">2030</option>
                                                <option value="2031">2031</option>
                                                <option value="2032">2032</option>
                                                <option value="2033">2033</option>
                                                <option value="2034">2034</option>
                                                <option value="2035">2035</option>
                                                <option value="2036">2036</option>
                                                <option value="2037">2037</option>
                                                <option value="2038">2038</option>
                                                <option value="2039">2039</option>
                                                <option value="2040">2040</option>

                                            </optgroup>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4 kt-margin-b-20-tablet-and-mobile">
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

                            <div class="col-md-4 kt-margin-b-20-tablet-and-mobile">
                                <div class="kt-form__group kt-form__group--inline">
                                    <div class="kt-form__label">
                                        <label>Status:</label>
                                    </div>
                                    <div class="kt-form__control">
                                        <select class="form-control bootstrap-select" id="examination_status">
                                            <option value="Any">Any</option>
                                            <option value="Passed">Passed</option>
                                            <option value="Failed">Failed</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-1 kt-margin-b-20-tablet-and-mobile">
                                <div class="kt-form__group kt-form__group--inline">
                                    <div class="kt-form__label">
                                        <label>Search:</label>
                                    </div>
                                    <button type="button" id="search_examination" class="btn btn-primary">
                                        <i class="flaticon2-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>


                        <div class="form-group row">
                            <div class="col-md-12">
                                <div id="examination_table_div"></div>
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
            $("#select_year").select2({placeholder: "Select a year"});
            $("#search_region").select2({placeholder: "Select region"});
        }
    };
    jQuery(document).ready(function () {
        KTSelect2.init()
    });

    $("#search_examination").click(function () {

        var search_year = $("#select_year").val();
        var search_region = $("#search_region").val();
        var search_approval = $("#examination_status").val();

        var error = '';
        if (search_year == "") {
            error += 'Please select year \n';
            $("#select_year").focus();
        }

        if (error == "") {

            $.ajax({
                type: "POST",
                url: "ajax/tables/examination_searchtable.php",
                beforeSend: function () {
                    $.blockUI({
                        message: '<img src="../assets/img/wait.gif" style="border:0 !important"/>'
                    });
                },
                data: {
                    search_year: search_year,
                    search_region: search_region,
                    search_approval: search_approval
                },
                success: function (text) {
                    $('#examination_table_div').html(text);
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + " " + thrownError);
                },
                complete: function () {
                    $.unblockUI();
                },
            });
        }

        else {
            $.notify(error, {position: "top center"});
        }
        return false;
    });


    $("#examination_status").selectpicker();


</script>

