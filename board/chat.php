<?php require('includes/header.php');
$userid = $_SESSION['userid'];
$username = getusername($userid);

$getonechat = $mysqli->query("select * from chat where user = '$username' order by dateentry DESC LIMIT 1");
$resonechat = $getonechat->fetch_assoc();
$adminuser = $resonechat['adminuser'];

?>



<div class="d-flex flex-column flex-root">
			<!--begin::Page-->
			<div class="d-flex flex-row flex-column-fluid page">
				<!--begin::Wrapper-->
				<div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">
					
					<!--begin::Content-->
					<div class="content d-flex flex-column flex-column-fluid" id="kt_content" style="margin-top:50px">
						<!--begin::Entry-->
						<div class="d-flex flex-column-fluid">
							<!--begin::Container-->
							<div class="container">
								<!--begin::Chat-->
								<div class="d-flex flex-row">
									<!--begin::Aside-->
									<div class="flex-row-auto offcanvas-mobile w-350px w-xl-400px" id="kt_chat_aside">
										<!--begin::Card-->
										<div class="card card-custom">
											<!--begin::Body-->
											<div class="card-body">
												<!--begin:Search-->
												<div class="input-group input-group-solid">
													<div class="input-group-prepend">
														<span class="input-group-text">
															<span class="svg-icon svg-icon-lg">
																<!--begin::Svg Icon | path:/metronic/theme/html/demo2/dist/assets/media/svg/icons/General/Search.svg-->
																<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
																	<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																		<rect x="0" y="0" width="24" height="24" />
																		<path d="M14.2928932,16.7071068 C13.9023689,16.3165825 13.9023689,15.6834175 14.2928932,15.2928932 C14.6834175,14.9023689 15.3165825,14.9023689 15.7071068,15.2928932 L19.7071068,19.2928932 C20.0976311,19.6834175 20.0976311,20.3165825 19.7071068,20.7071068 C19.3165825,21.0976311 18.6834175,21.0976311 18.2928932,20.7071068 L14.2928932,16.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
																		<path d="M11,16 C13.7614237,16 16,13.7614237 16,11 C16,8.23857625 13.7614237,6 11,6 C8.23857625,6 6,8.23857625 6,11 C6,13.7614237 8.23857625,16 11,16 Z M11,18 C7.13400675,18 4,14.8659932 4,11 C4,7.13400675 7.13400675,4 11,4 C14.8659932,4 18,7.13400675 18,11 C18,14.8659932 14.8659932,18 11,18 Z" fill="#000000" fill-rule="nonzero" />
																	</g>
																</svg>
																<!--end::Svg Icon-->
															</span>
														</span>
													</div>
													<input type="text" class="form-control py-4 h-auto" placeholder="Search Admin" />
												</div>
												<!--end:Search-->
												<!--begin:Users-->
												<div class="mt-7 scroll scroll-pull">

                                                <?php
                                                $getalladmins = $mysqli->query("select * from users where (roleid = '1' or roleid = '2') and userstatus != '2'");
                                                while ($resalladmins = $getalladmins->fetch_assoc()) { ?>

                                                <!--begin:User-->
													<div class="d-flex align-items-center justify-content-between mb-5">
														<div class="d-flex align-items-center">
															<div class="d-flex flex-column">
																<a href="#" 
                                                            	i_index="<?php echo $resalladmins['username'];?>" 
                                                                class="clickchat text-dark-75 text-hover-primary font-weight-bold font-size-lg">
                                                                    <?php echo $resalladmins['fullname']; ?>
                                                                </a>
																<span class="text-muted font-weight-bold font-size-sm">
                                                                    <?php echo $resalladmins['username']; ?>
                                                                </span>
															</div>
														</div>
														<div class="d-flex flex-column align-items-end">
															<span class="text-muted font-weight-bold font-size-sm">3 hrs</span>
														</div>
													</div>
													<!--end:User-->

                                               <?php }
                                                ?>
												
													
												
												</div>
												<!--end:Users-->
											</div>
											<!--end::Body-->
										</div>
										<!--end::Card-->
									</div>
									<!--end::Aside-->
									<!--begin::Content-->
									<div class="flex-row-fluid ml-lg-8" id="kt_chat_content">
										<div id="chathere"></div>
									</div>
									<!--end::Content-->
								</div>
								<!--end::Chat-->
							</div>
							<!--end::Container-->
						</div>
						<!--end::Entry-->
					</div>
					<!--end::Content-->
					
				</div>
				<!--end::Wrapper-->
			</div>
			<!--end::Page-->
		</div>
<!--end::Main-->

<?php require('includes/footer.php') ?>


<script>


	$.ajax({
        type: "POST",
        url: "ajax/forms/chatformone.php",
        beforeSend: function () {
            KTApp.blockPage({
                overlayColor: "#000000",
                type: "v2",
                state: "success",
                message: "Please wait..."
            })
        },
        data: {
                username: '<?php echo $username ?>',
				adminusername: '<?php echo $adminuser ?>'
            },
        success: function (text) {
            $('#chathere').html(text);
        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert(xhr.status + " " + thrownError);
        },
        complete: function () {
            KTApp.unblockPage();
        },

    });

	$(document).off('click', '.clickchat').on('click', '.clickchat', function () {
    var theindex = $(this).attr('i_index');
    //alert(theindex);
    $.ajax({
        type: "POST",
        url: "ajax/forms/chatform.php",
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
            $('#chathere').html(text);
        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert(xhr.status + " " + thrownError);
        },
        complete: function () {
            KTApp.unblockPage();
        },

    });
})

    

</script>
