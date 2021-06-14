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
                                    <small>Duplicate Data</small>
                                </h3>
                            </div>
                        </div>

                        <div class="form-group row">

                                <div class="col-md-4 kt-margin-b-20-tablet-and-mobile">
                                    <div class="kt-form__group kt-form__group--inline">
                                        <div class="kt-form__label">
                                            <label>Select Year:</label>
                                        </div>
                                        <div class="kt-form__control">
                                            <select class="form-control kt-select2" id="select_year" name="param">
                                                <option></option>
                                                <optgroup label="Main">
                                                    <option value="<?php echo date('Y') ?>"><?php echo date('Y') ?></option>
                                                    <option value="All">All</option>
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


                        <div class="form-group row">
                            <div class="col-md-12">
                                <div id="approval_div"></div>
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
        }
    };
    jQuery(document).ready(function () {
        KTSelect2.init()
    });

    $("#load_btn").click(function(){
        var select_year = $("#select_year").val();

        var error = '';
        if (select_year == "") {
            error += 'Please select year \n';
            $("#select_year").focus();
        }

        if (error == "") {
            $.ajax({
                type: "POST",
                url: "ajax/tables/examinationduplicate_table.php",
                beforeSend: function () {
                    KTApp.blockPage({
                        overlayColor: "#000000",
                        type: "v2",
                        state: "success",
                        message: "Please wait..."
                    })
                },
                data: {
                    select_year: select_year
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



    $(document).on('click', '.deleteexam_btn', function () {
        var id_index = $(this).attr('i_index');
        //alert(id_index);

        var r = confirm("Do you want to delete!");
        if (r == true) {
            $.ajax({
                type: "POST",
                url: "ajax/queries/delete_examination.php",
                data: {
                    id_index: id_index
                },
                dataType: "html",
                success: function (text) {
                    $("#prov-table").DataTable().ajax.reload(null, false );
                },
                complete: function () {
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + " " + thrownError);
                }
            });
        } else {
            alert('Account not deleted')
        }

    });


</script>
