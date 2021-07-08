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
        <th>Board Name</th>
        <th>Member Details</th>
       
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
                    
                    <tbody>
                    <?php
                    $getcolourdetails = $mysqli->query("select * from colourconfig where boardid = '$boardid' and `status` = 'Active'");
                    while ($rescolourdetails = $getcolourdetails->fetch_assoc()) { ?>

                        <tr>
                            <td>
                            <span style="text-transform:uppercase">
                            <?php 
                                $colourid = $rescolourdetails['colourid'];
                                echo $rescolourdetails['colourname'] ?></span>
                            </td>
                            <td>
                            <table>
                                
                                <tbody>
                                <?php
                                $getmemberdetails = $mysqli->query("select * from previewboard where boardid = '$boardid' and 
                                                                    `status` = '4' and colourid = '$colourid'");
                                if (mysqli_num_rows($getmemberdetails) == '0') {
                                    echo "<small>No member found</small>";
                                }  
                                else {
                                    while ($resmemberdetails = $getmemberdetails->fetch_assoc()) { ?>

                                        <tr>
                                            <td>
                                                <?php
                                                $userid = $resmemberdetails['userid'];
                                                $getmem = $mysqli->query("select * from users where userid = '$userid'");
                                                $resmem = $getmem->fetch_assoc();
                                                echo $resmem['fullname']
                                                ?>
                                            </td>
                                            <td> <b><?php echo $resmem['username'] ?></b></td>
                                            <td>
                                            <div class="card-toolbar">
													<div class="dropdown dropdown-inline">
														<a href="#" class="btn btn-clean btn-hover-light-primary btn-sm btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
															<i class="ki ki-bold-more-ver"></i>
														</a>
														<div class="dropdown-menu dropdown-menu-md dropdown-menu-right" style="">
															<!--begin::Naviigation-->
															<ul class="navi">
																<li class="navi-header font-weight-bold py-5">
																	<span class="font-size-lg">Action Details:</span>
																	<i class="flaticon2-information icon-md text-muted" data-toggle="tooltip" data-placement="right" title="" data-original-title="Click to learn more..."></i>
																</li>
																<li class="navi-separator mb-3 opacity-70"></li>
                                                                <li class="navi-item">
																	<a href="#" class="navi-link editmember" i_index="<?php echo $userid; ?>">
																		<span class="navi-icon">
																			<i class="navi-icon flaticon-edit"></i>
																		</span>
																		<span class="navi-text">Edit Details</span>
																		
																	</a>
																</li>
                                                                <li class="navi-item">
																	<a href="#" class="navi-link">
																		<span class="navi-icon">
																			<i class="navi-icon flaticon-eye"></i>
																		</span>
																		<span class="navi-text">View Details</span>
																		
																	</a>
																</li>
																<li class="navi-item">
																	<a href="#" class="navi-link">
																		<span class="navi-icon">
																			<i class="flaticon-cancel"></i>
																		</span>
																		<span class="navi-text">Remove</span>
																	</a>
																</li>
																<li class="navi-item">
																	<a href="#" class="navi-link">
																		<span class="navi-icon">
																			<i class="flaticon-warning-sign"></i>
																		</span>
																		<span class="navi-text">Suspend</span>
																	</a>
																</li>
																<li class="navi-item">
																	<a href="#" class="navi-link">
																		<span class="navi-icon">
																			<i class="navi-icon flaticon2-delete"></i>
																		</span>
																		<span class="navi-text">Delete Permanently</span>
																	</a>
																</li>
																
																
															</ul>
															<!--end::Naviigation-->
														</div>
													</div>
												</div>
                                           
                                            </td>
                                        </tr>
                                    <?php }

} 
                                    ?>
                                    
                                                                 
                              
                                </tbody>

                </table>
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

    oTable = $('#colourtable').DataTable({
        "bLengthChange": false
    });

    $('#colour_search').keyup(function () {
        oTable.search($(this).val()).draw();
    });

    $(document).off('click', '.editmember').on('click', '.editmember', function () {
        var theindex = $(this).attr('i_index');
        alert(theindex)
    
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