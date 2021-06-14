<?php include('../../../config.php');

?>
<style>
    .dataTables_filter {
        display: none;
    }
</style>


<div class="kt-section">

    `
    <div class="kt-section__content responsive">
        <div class="kt-searchbar">
            <div class="input-group">
                <div class="input-group-prepend"><span class="input-group-text" id="basic-addon1">
                                <i class="la la-search"></i>
                            </span></div>
                <input type="text" id="temporal_search" class="form-control"
                       placeholder="Search Full Name or email address" aria-describedby="basic-addon1">
            </div>
        </div>


        <div class="table-responsive">
            <table id="prov-table" class="table" style="margin-top: 3% !important;">
                <thead>
                <tr>
                    <th style="width: 30%">Applicant Details</th>
                    <th style="width: 20%">Other Details</th>
                    <th style="width: 5%">Completion Year</th>
                    <th style="width: 30%">Reason</th>
                    <th style="width: 10%">Random Code</th>
                    <th style="width: 5%">Action</th>
                </tr>
                </thead>
            </table>
        </div>
    </div>
</div>


<script>

    oTable = $('#prov-table').DataTable({
        stateSave: true,
        "bLengthChange": false,
        dom: "rtiplf",
        "sDom": '<"top"ip>rt<"bottom"fl><"clear">',
        'processing': true,
        'serverSide': true,
        'serverMethod': 'post',
        'ajax': {
            'url': 'ajax/paginations/temporal_specialcase.php'
        },
        'columns': [
            {data: 'firstname'},
            {data: 'email_address'},
            {data: 'completion_year'},
            {data: 'reason'},
            {data: 'random_code'},
            {data: 'id'}
        ]
    });

    $('#temporal_search').keyup(function () {
        oTable.search($(this).val()).draw();
    });

    $(document).off('click', '.delete_applicant').on('click', '.delete_applicant', function () {
        var theindex = $(this).attr('i_index');
        $.confirm({
            title: 'Delete Record!',
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
                            url: "ajax/queries/delete_specialcasetem.php",
                            data: {
                                i_index: theindex
                            },
                            dataType: "html",
                            success: function (text) {
                                $.ajax({
                                    url: "ajax/tables/temporal_specialcases.php",
                                    beforeSend: function () {
                                        KTApp.blockPage({
                                            overlayColor: "#000000",
                                            type: "v2",
                                            state: "success",
                                            message: "Please wait..."
                                        })
                                    },
                                    success: function (text) {
                                        $('#specialcasetabletem_div').html(text);
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