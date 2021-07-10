<?php include('../../../config.php');
$query = $mysqli->query("select DISTINCT(boardid) as boardids from colourconfig");

?>
<style>
    .dataTables_filter {
        display: none;
    }
</style>

<input type="text" id="member_search" class="form-control"
       placeholder="Search...">

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
                            <?php
                            $colourid = $rescolourdetails['colourid'];
                            $colourpriority = $rescolourdetails['colourpriority'];
                            $colourcode = $rescolourdetails['colourcode'];
                             ?>
                            <td style="background:<?php echo $colourcode ?>">
                            <span style="text-transform:uppercase;;text-align:center;margin-left:10px">
                            <?php 
                                echo $rescolourdetails['colourname'] ?></span>
                            </td>
                            <td>
                            <table>
                                
                                <tbody>
                                <?php
                                $getmemberdetails = $mysqli->query("select * from previewboard where boardid = '$boardid' 
                                                                    and `status` != '2' and colourid = '$colourid'");
                                if (mysqli_num_rows($getmemberdetails) == '0') {
                                    echo "<i><small>No member found</small></i>";
                                }  
                                else {
                                    while ($resmemberdetails = $getmemberdetails->fetch_assoc()) { ?>

                                        <tr>
                                            <td>
                                                <?php
                                                $userid = $resmemberdetails['userid'];
                                                $previewid = $resmemberdetails['previd'];
                                                $payment = $resmemberdetails['payment'];
                                                $status = $resmemberdetails['status'];
                                                $getmem = $mysqli->query("select * from users where userid = '$userid'");
                                                $resmem = $getmem->fetch_assoc();
                                                echo $resmem['fullname']
                                                ?>
                                            </td>
                                            <td> <b><?php echo $resmem['username'] ?></b></td>
                                            <td>
                                                <?php
                                                if ($colourpriority == 'Lowest' && $payment == '1') {
                                                    echo "<span class='label label-lg label-light-success label-inline'>Paid</span><br/>";
                                                } else if ($colourpriority == 'Lowest' && $payment == '0') {
                                                    echo "<span class='label label-lg label-light-danger label-inline'>Not paid</span><br/>";
                                                }
                                                else {
                                                    echo "<span class='label label-lg label-light-primary label-inline'>N/A</span><br/>";
                                                }
                                                ?>

                                                 <?php
                                                if ($status == '1') {
                                                    echo "<span class='label label-sm label-default label-inline'>Pending Approval</span>";
                                                }
                                                else if ($status == '2') {
                                                    echo "<span class='label label-sm label-danger label-inline'>Removed</span>";
                                                }
                                                else if ($status == '3') {
                                                    echo "<span class='label label-sm label-warning label-inline'>Suspended</span>";
                                                } 
                                                else if ($status == '4') {
                                                    echo "<span class='label label-sm label-success label-inline'>Active</span>";
                                                }
                                                ?> 
                                                
                                                
                                                
                                            </td>
                                           
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
                                                                <a href="#" class="navi-link viewmemberdetails"
                                                                    i_index="<?php echo $previewid; ?>">
																		<span class="navi-icon">
																			<i class="navi-icon flaticon-eye"></i>
																		</span>
																		<span class="navi-text">View Details</span>
																		
																	</a>
																</li>
                                                               
																<li class="navi-item">
                                                                <a href="#" class="navi-link suspendmember"
                                                                    i_index="<?php echo $previewid; ?>">
																		<span class="navi-icon">
																			<i class="flaticon-warning-sign"></i>
																		</span>
																		<span class="navi-text">Suspend</span>
																	</a>
																</li>
                                                                <li class="navi-item">
																	<a href="#" class="navi-link deletemember"
                                                                    i_index="<?php echo $previewid; ?>">
																		<span class="navi-icon">
																			<i class="flaticon-cancel"></i>
																		</span>
																		<span class="navi-text">Remove</span>
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

    $('#member_search').keyup(function () {
        oTable.search($(this).val()).draw();
    });


    $(document).off('click', '.deletemember').on('click', '.deletemember', function () {
        var theindex = $(this).attr('i_index');
        //alert(theindex)
        $.confirm({
            title: 'Remove Member!',
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
                            url: "ajax/queries/delete_member.php",
                            data: {
                                i_index: theindex
                            },
                            dataType: "html",
                            success: function (text) {
                                //alert(text);
                                $.ajax({
                                    url: "ajax/tables/member_table.php",
                                    beforeSend: function () {
                                        KTApp.blockPage({
                                            overlayColor: "#000000",
                                            type: "v2",
                                            state: "success",
                                            message: "Please wait..."
                                        })
                                    },
                                    success: function (text) {
                                        $('#membertable_div').html(text);
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

    $(document).off('click', '.suspendmember').on('click', '.suspendmember', function () {
        var theindex = $(this).attr('i_index');
        //alert(theindex)
        $.confirm({
            title: 'Suspend Member!',
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
                            url: "ajax/queries/suspend_member.php",
                            data: {
                                i_index: theindex
                            },
                            dataType: "html",
                            success: function (text) {
                                //alert(text);
                                $.ajax({
                                    url: "ajax/tables/member_table.php",
                                    beforeSend: function () {
                                        KTApp.blockPage({
                                            overlayColor: "#000000",
                                            type: "v2",
                                            state: "success",
                                            message: "Please wait..."
                                        })
                                    },
                                    success: function (text) {
                                        $('#membertable_div').html(text);
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

    $(document).off('click', '.viewmemberdetails').on('click', '.viewmemberdetails', function () {
        var theindex = $(this).attr('i_index');
        //alert(theindex);

        $.ajax({
                type: "POST",
                url: "ajax/forms/viewmemberdetails.php",
                beforeSend: function () {
                    KTApp.blockPage({
                        overlayColor: "#000000",
                        type: "v2",
                        state: "success",
                        message: "Please wait..."
                    })
                },
                data: {
                    theindex: theindex
                },
                success: function (text) {
                    $('#viewmemberdiv').html(text);
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