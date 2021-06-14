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
                                    Licensure Examination
                                    <small>View Statistics and Report on Data by date range</small>
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
                                        <input type="text" class="form-control" autocomplete="off"
                                               id="start_date" placeholder="Select Start Date"/>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
                                <div class="kt-form__group kt-form__group--inline">
                                    <div class="kt-form__label">
                                        <label>End Date:</label>
                                    </div>
                                    <div class="kt-form__control">
                                        <input type="text" class="form-control" autocomplete="off"
                                               id="end_date" placeholder="Select End Date">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
                                <div class="kt-form__group kt-form__group--inline">
                                    <div class="kt-form__label">
                                        <label>Profession:</label>
                                    </div>
                                    <div class="kt-form__control">
                                        <select class="form-control kt-select2" id="profession" name="param">
                                            <option value="">Select Profession</option>
                                            <?php $getprofession = $mysqli->query("select * from professions ORDER BY professionname");
                                                 while ($resprofession = $getprofession->fetch_assoc()){ ?>
                                                     <option value="<?php echo $resprofession['professionid'] ?>">
                                                         <?php echo $resprofession['professionname'] ?>
                                                     </option>
                                                <?php }?>

                                        </select>
                                    </div>
                                </div>
                            </div>


                            <div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
                                <div class="kt-form__group kt-form__group--inline">
                                    <div class="kt-form__label">
                                        <label>Search Query:</label>
                                    </div>
                                    <button type="button" id="load_btn" class="btn btn-primary">
                                        Click to load Data
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
    //$("#search_status").selectpicker();

    var KTSelect2 = {
        init: function () {
            $("#profession").select2({placeholder: "Select Profession"});
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

    $("#load_btn").click(function(){
        var start_date = $("#start_date").val();
        var end_date = $("#end_date").val();
        var profession = $("#profession").val();

        var error = '';
        if (start_date == "") {
            error += 'Please select start date \n';
            $("#start_date").focus();
        }
        if (end_date == "") {
            error += 'Please select end date \n';
            $("#end_date").focus();
        }
        if (profession == "") {
            error += 'Please select profession \n';
            $("#profession").focus();
        }
        if (start_date > end_date) {
            error += 'Please select correct date range \n';
            $("#end_date").focus();
        }


        if (error == "") {
            $.ajax({
                type: "POST",
                url: "ajax/tables/examinationstat_table.php",
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
                    profession:profession
                },
                success: function (text) {
                    $('#examination_table_div').html(text);
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



</script>

