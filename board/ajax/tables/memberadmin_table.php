<?php include('../../../config.php');
$query = $mysqli->query("select * from users ORDER BY id DESC");

?>
<style>
    .dataTables_filter {
        display: none;
    }
</style>
<input type="text" id="acc_search" class="form-control"
       placeholder="Search...">



<!--begin: Datatable-->
<table class="table table-separate table-head-custom table-checkable" id="admintable">
    <thead>
    <tr>
        <th>More Details</th>
        <th>Full Name</th>
        <th>Telephone</th>
        <th>Email Address</th>
        <th>Location</th>
        <th>Country</th>
        <th>Status</th>
        <th>Next of Kin</th>
        <th>Next of Kin Phone</th>
        <th>Introducer</th>
        <th>Role</th>
        <th>Existing</th>
        <th>Action</th>
    </tr>
    </thead>

</table>
<!--end: Datatable-->


<script>

    $('#acc_search').keyup(function () {
        oTable.search($(this).val()).draw();
    });

    oTable = $('#admintable').DataTable({
        stateSave: true,
        responsive: true,
        "bLengthChange": false,
        'processing': true,
        'serverSide': true,
        'serverMethod': 'post',
        'ajax': {
            'url': 'ajax/paginations/adminaccounts.php'
        },
        'columns': [
            {data: 'view'},
            {data: 'fullname'},
            {data: 'telephone'},
            {data: 'emailaddress'},
            {data: 'location'},
            {data: 'country'},
            {data: 'userstatus'},
            {data: 'nextofkin'},
            {data: 'nextofkintelephone'},
            {data: 'introducer'},
            {data: 'userrole'},
            {data: 'existing'},
            {data: 'userid'}
        ]
    });
    $('#account_search').keyup(function () {
        oTable.search($(this).val()).draw();
    });

</script>

