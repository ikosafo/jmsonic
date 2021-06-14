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


                        <div class="form-group row">
                            <label class="col-form-label col-lg-3 col-sm-12">Select year for messages</label>

                            <div class=" col-lg-4 col-md-9 col-sm-12">
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


                        <div class="form-group row">
                            <div class="col-md-12">
                                <div id="reply_form_div"></div>
                            </div>
                        </div>


                        <div class="form-group row">
                            <div class="col-md-12">
                                <div id="messages_table_div"></div>

                            </div>

                        </div>

                    </div>
                </div>
            </div>
            <!--end:: Widgets/Applications/User/Profile3-->
        </div>
    </div>

    <!--End::Dashboard 3-->    </div>
<!-- end:: Content -->

<?php require('includes/footer.php') ?>


<script>
    var KTSelect2 = {
        init: function () {
            $("#select_year").select2({placeholder: "Select a year"})
        }
    };
    jQuery(document).ready(function () {
        KTSelect2.init()
    });


    $("#select_year").change(function () {
        var year_search = $("#select_year").val();
        $.ajax({
            type: "POST",
            url: "ajax/tables/messages_table.php",
            beforeSend: function () {
                KTApp.blockPage({
                    overlayColor: "#000000",
                    type: "v2",
                    state: "success",
                    message: "Please wait..."
                })
            },
            data: {
                year_search: year_search
            },
            success: function (text) {
                $('#messages_table_div').html(text);
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(xhr.status + " " + thrownError);
            },
            complete: function () {
                KTApp.unblockPage();
            },

        });
    });


    $(document).on('click', '.reply_message', function() {
        var id_index = $(this).attr('i_index');
        var year_search = $("#select_year").val();
        //alert(year_search);
        $('html, body').animate({
            scrollTop: $(".kt-portlet__body").offset().top
        }, 2000);

        $.ajax({
            type: "POST",
            url: "ajax/forms/reply_form.php",
            data: {
                id_index:id_index,
                year_search:year_search
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
                $('#reply_form_div').html(text);
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

