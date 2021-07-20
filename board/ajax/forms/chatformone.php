<?php include ('../../../config.php');

$username = $_POST['username'];
$adminuser = $_POST['adminusername'];
$getdetails = $mysqli->query("select * from users where username = '$adminuser'");
$resdetails = $getdetails->fetch_assoc();
$fullname = $resdetails['fullname'];
$userid = $_SESSION['userid'];
$username = getusername($userid);

?>

									<!--begin::Card-->
										<div class="card card-custom">
											<!--begin::Header-->
											<div class="card-header align-items-center px-4 py-3">
												<div class="text-left flex-grow-1"></div>
                                                <div class="text-center flex-grow-1">
													<div class="text-dark-75 font-weight-bold font-size-h5">
                                                        <?php echo $fullname ?>
                                                    </div>
													<div>
														<span class="label label-sm label-dot label-default"></span>
														<span class="font-weight-bold text-muted font-size-sm">Offline</span>
													</div>
												</div>
												<div class="text-right flex-grow-1"></div>
												
											</div>
											<!--end::Header-->
											<!--begin::Body-->
											<div class="card-body">
												<!--begin::Scroll-->
												<div class="scroll scroll-pull" data-mobile-height="350">
													<!--begin::Messages-->
													<div class="messages">
													<div id="errorloc">

                                                      <?php
													 $getchats = $mysqli->query("select * from chat where user = '$username' and adminuser = '$adminuser' ORDER BY dateentry");
													 while ($reschats = $getchats->fetch_assoc()) {
														$messagein = $reschats['messagein'];
														$messageout = $reschats['messageout'];
														$usernamechat = $reschats['user'];
														if ($username == $usernamechat) { ?>
														<!--begin::Message In-->
														<div class="d-flex flex-column mb-5 align-items-end">
															<div class="d-flex align-items-center">
																<div>
																	<span class="text-muted font-size-sm">3 minutes</span>
																	<a href="#" class="text-dark-75 text-hover-primary font-weight-bold font-size-h6">You</a>
																</div>
															</div>
															<div class="mt-2 rounded p-5 bg-light-primary text-dark-50 font-weight-bold font-size-lg 
															text-right max-w-400px"><?php echo $reschats['message'];?></div>
														</div>
														<!--end::Message In-->
														<?php } else { ?>
														<!--begin::Message Out-->
														<div class="d-flex flex-column mb-5 align-items-start">
															<div class="d-flex align-items-center"><div>
																	<a href="#" class="text-dark-75 text-hover-primary font-weight-bold font-size-h6">
																		<?php echo $username;?>
																	</a>
																	<span class="text-muted font-size-sm">2 Hours</span>
																</div>
															</div>
															<div class="mt-2 rounded p-5 bg-light-success text-dark-50 font-weight-bold 
															font-size-lg text-left max-w-400px">
																<?php echo $reschats['message'];?>
															</div>
														</div>
														
														<!--end::Message Out-->
														<?php }
														  ?>
                                                             
													 <?php }
													  ?>

														
														
														</div>
													<!--end::Messages-->
												</div>
												<!--end::Scroll-->
											</div>
											<!--end::Body-->
											<!--begin::Footer-->
											<div class="card-footer align-items-center">
												<!--begin::Compose-->
												<textarea class="form-control border-0 p-0" rows="2" 
												id="chatmessage"
												placeholder="Type a message"></textarea>
												<div class="d-flex align-items-center justify-content-between mt-5">
													<div class="mr-3">
														<a href="#" class="btn btn-clean btn-icon btn-md mr-1">
															<i class="flaticon2-photograph icon-lg"></i>
														</a>
														<a href="#" class="btn btn-clean btn-icon btn-md">
															<i class="flaticon2-photo-camera icon-lg"></i>
														</a>
													</div>
													<div>
														<button type="button" id="sendchat" class="btn btn-primary btn-md text-uppercase font-weight-bold py-2 px-6">
														Send</button>
													</div>
												</div>
												<!--begin::Compose-->
											</div>
											<!--end::Footer-->
										</div>
										<!--end::Card-->


				<script src="assets/js/pages/chat.js"></script>

<script>
$("#sendchat").click(function(){
	
})


$("#sendchat").click(function () {
        var chatmessage = $("#chatmessage").val();
		var adminusername = '<?php echo $adminuser ?>';
		var userid = '<?php echo $userid ?>';
		//alert(userid);


        var error = '';
        if (chatmessage == "") {
            error += 'Please enter a message\n';
            $("#chatmessage").focus();
        }
      
        if (error == "") {
            $.ajax({
                type: "POST",
                url: "ajax/queries/saveform_chat.php",
                beforeSend: function () {
                    KTApp.blockPage({
                        overlayColor: "#000000",
                        type: "v2",
                        state: "success",
                        message: "Please wait..."
                    })
                },
                data: {
                    chatmessage: chatmessage,
                    adminusername: adminusername,
					userid:userid
                },
                success: function (text) {
					location.reload();
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
            $("#errorloc").notify(error);
        }
        return false;
    });
</script>