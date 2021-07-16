<?php include('../../../config.php');
$query = $mysqli->query("select DISTINCT(boardid) as boardids from previewboard ORDER BY boardid DESC");

?>
<style>
    .dataTables_filter {
        display: none;
    }
</style>

<input type="text" id="member_search" class="form-control"
       placeholder="Search...">

<!--begin: Datatable-->
<table class="table table-separate table-head-custom table-checkable" id="membertable">
    <thead>
    <tr>
        <th>Board Name</th>
        <th>Number of Members</th>
        <th>Number Paid</th>
        <th>Exit Fee Paid</th>
        <th>Board Status</th>
        <th>Split Boards</th>
        <th>Action</th>
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
                <b><?php 
                echo $countdb = mysqli_num_rows($mysqli->query("select * from previewboard where boardid = '$boardid' and status != '2'"));
                ?></b>
                Out of <?php 
                $getmainboardid = getmainboardid($boardid);
                echo $countmax = getmaxboardnumber($getmainboardid); ?>
            </td>
            <td>
                <b><?php echo $countpaid = mysqli_num_rows($mysqli->query("select * from previewboard where boardid = '$boardid' and status != '2' and payment = '1'"));
                ?></b>
                Out of <?php 
                $getmainboardid = getmainboardid($boardid);
                echo $countmaxpaid = getmaxpaidnumber($getmainboardid);
                
                ?>
            </td>
            <td>
                <?php
                //Check exit payment
                $getcheck = mysqli_num_rows($mysqli->query("select * from boards where boardid = '$boardid' 
                                            and exitfeepaid = '1'"));
                if ($getcheck == "0") {
                    if (($countdb == $countmax)) { ?>
                        <button type="button"
                        data-type="confirm"
                        class="btn btn-outline-primary js-sweetalert exitfeepaid btn-sm"
                        i_index="<?php echo $boardid; ?>"
                        title="Update Exit Fee">
                        Update Exit Fee
                    </button>
                    <?php }
                    else {
                        echo "<span class='label label-lg label-light-danger label-inline'>Incomplete</span>";
                    }
                }
                else {
                    echo "<span class='label label-lg label-light-success label-inline'>Payment Complete</span>";
                }
                
                 ?>
            </td>
            <td>
                <?php
                if (($countdb == $countmax) && ($countpaid == $countmaxpaid)) {
                    echo "<span class='label label-lg label-light-success label-inline'>Complete</span>";
                }
                else {
                    echo "<span class='label label-lg label-light-danger label-inline'>Incomplete</span>";
                }
                ?>
            </td>
            <td>
                <?php
                if (($countdb == $countmax) && ($countpaid == $countmaxpaid)) {
                    $countnewboard = mysqli_num_rows($mysqli->query("select * from boards where newboards = '1' and boardid= '$boardid'"));
                if ($countnewboard == '0') { ?>
                     <button type="button"
                        data-type="confirm"
                        class="btn btn-secondary js-sweetalert splitforms btn-sm"
                        i_index="<?php echo $boardid; ?>"
                        title="Edit">
                        Add Boards
                    </button>
                <?php }
                else { 
                    $getnewboards = $mysqli->query("select * from boards where parentboardid = '$boardid'");
                    while ($resnewboards = $getnewboards->fetch_assoc()) {
                        echo $resnewboards['boardname'].'<br/>';
                    }
                  }
                }
                else {
                    echo "<span class='label label-lg label-light-danger label-inline'>Incomplete</span>";
                }
                
                
                ?>
            </td>
            <td>
                <?php
                    if (($countdb == $countmax) && ($countpaid == $countmaxpaid)) { 
                        $countnewboard = mysqli_num_rows($mysqli->query("select * from boards where split = '0' and boardid= '$boardid'"));
                        if ($countnewboard == '0') {
                            echo "<span class='label label-lg label-light-success label-inline'>Splitted</span>";
                        } else { ?>
                        <button type="button"
                        data-type="confirm"
                        class="btn btn-primary js-sweetalert splitboard btn-sm"
                        i_index="<?php echo $boardid; ?>"
                        title="Split Board">
                        Split Board
                    </button>
                        <?php }
                          }
                    else {
                        echo "<span class='label label-lg label-light-danger label-inline'>Incomplete</span>";
                    }
                ?>
            </td>
                         
        </tr>
        <?php
    }
    ?>
    </tbody>
</table>
<!--end: Datatable-->


<script>

    oTable = $('#membertable').DataTable({
        "bLengthChange": false
    });

    $('#member_search').keyup(function () {
        oTable.search($(this).val()).draw();
    });


    $(document).off('click', '.splitforms').on('click', '.splitforms', function () {
        var theindex = $(this).attr('i_index');
        //alert(theindex)
        $.confirm({
            title: 'Add Boards!',
            content: '' +
            '<form action="" class="formName">' +
            '<div class="form-group">' +
            '<label>First Board</label>' +
            '<input type="text" placeholder="First Board" id="firstboard" class="name form-control" required />' +
            '</div>' +
            '<div class="form-group">' +
            '<label>Second Board</label>' +
            '<input type="text" placeholder="Second Board" id="secondboard" class="name form-control" required />' +
            '</div>' +
            '</form>',
            buttons: {
                formSubmit: {
                    text: 'Submit',
                    btnClass: 'btn-blue',
                    action: function () {
                        var firstboard = this.$content.find('#firstboard').val();
                        var secondboard = this.$content.find('#secondboard').val();
                        if(!firstboard){
                            $.alert('Provide a board name');
                            return false;
                        }
                        else if(!secondboard){
                            $.alert('Provide a board name');
                            return false;
                        }
                        $.ajax({
                            type: "POST",
                            url: "ajax/queries/saveform_splitdata.php",
                            beforeSend: function () {
                                KTApp.blockPage({
                                    overlayColor: "#000000",
                                    type: "v2",
                                    state: "success",
                                    message: "Please wait..."
                                })
                            },
                            data: {
                                firstboard: firstboard,
                                secondboard: secondboard,
                                theindex:theindex
                            },
                            success: function (text) {
                                //alert(text);
                                if (text == 1) {
                                        $.ajax({
                                            url: "ajax/tables/split_table.php",
                                            beforeSend: function () {
                                                KTApp.blockPage({
                                                    overlayColor: "#000000",
                                                    type: "v2",
                                                    state: "success",
                                                    message: "Please wait..."
                                                })
                                            },
                                            success: function (text) {
                                                $('#boardtable_div').html(text);
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
                                    $("#errorloc").notify("Board name already exists","error");
                                }

                            },
                            error: function (xhr, ajaxOptions, thrownError) {
                                alert(xhr.status + " " + thrownError);
                            },
                            complete: function () {
                                KTApp.unblockPage();
                            },
                        });
                    }
                },
                cancel: function () {
                    //close
                },
            },
            onContentReady: function () {
                // bind to events
                var jc = this;
                this.$content.find('form').on('submit', function (e) {
                    // if the user submits the form by pressing enter in the field.
                    e.preventDefault();
                    jc.$$formSubmit.trigger('click'); // reference the button and click it
                });
            }
        });
    });
    
    $(document).off('click', '.splitboard').on('click', '.splitboard', function () {
        var theindex = $(this).attr('i_index');
        //alert(theindex)
        $.confirm({
            title: 'Split Board!',
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
                    text: 'Yes, Split it!',
                    btnClass: 'btn-blue',
                    action: function () {
                        $.ajax({
                            type: "POST",
                            url: "ajax/queries/split_board.php",
                            data: {
                                i_index: theindex
                            },
                            dataType: "html",
                            success: function (text) {
                                alert(text);
                                $.ajax({
                                    url: "ajax/tables/split_table.php",
                                    beforeSend: function () {
                                        KTApp.blockPage({
                                            overlayColor: "#000000",
                                            type: "v2",
                                            state: "success",
                                            message: "Please wait..."
                                        })
                                    },
                                    success: function (text) {
                                        $('#boardtable_div').html(text);
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

    $(document).off('click', '.exitfeepaid').on('click', '.exitfeepaid', function () {
        var theindex = $(this).attr('i_index');
        //alert(theindex)
        $.confirm({
            title: 'Exit Fee Paid? Update Board!',
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
                    text: 'Yes, Update it!',
                    btnClass: 'btn-blue',
                    action: function () {
                        $.ajax({
                            type: "POST",
                            url: "ajax/queries/exitfee_paid.php",
                            data: {
                                i_index: theindex
                            },
                            dataType: "html",
                            success: function (text) {
                                alert(text);
                                $.ajax({
                                    url: "ajax/tables/split_table.php",
                                    beforeSend: function () {
                                        KTApp.blockPage({
                                            overlayColor: "#000000",
                                            type: "v2",
                                            state: "success",
                                            message: "Please wait..."
                                        })
                                    },
                                    success: function (text) {
                                        $('#boardtable_div').html(text);
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