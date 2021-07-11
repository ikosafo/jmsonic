<?php include ('includes/userheader.php'); ?>

					<!--begin::Content-->
					<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
						
						<!--begin::Entry-->
							<div class="d-flex flex-column-fluid" style="margin-top:40px">
							<!--begin::Container-->
								<div class="container">
									<!--begin::Card-->
									<div class="card card-custom gutter-b">
										<div class="card-body">
											<div class="d-flex">
												<!--begin::Pic-->

												<!--end::Pic-->
												<!--begin: Info-->
												<div class="flex-grow-1">
													<!--begin::Title-->
													<div class="d-flex align-items-center justify-content-between flex-wrap">
														<!--begin::User-->
														<div class="mr-3">
															<div class="d-flex align-items-center mr-3">
																<!--begin::Name-->
																<a href="#" class="d-flex align-items-center text-dark text-hover-primary 
																font-size-h5 font-weight-bold mr-3">
																<?php echo $resuserdetails['fullname'] ?>
															</a>
																<!--end::Name-->
															
																<?php $status = $resuserdetails['userstatus'];
															
																if ($status == '1') {
																	echo "<span class='label label-light-default label-inline 
																	font-weight-bolder mr-1'>Pending Approval</span>";
																}
																else if ($status == '2') {
																	echo "<span class='label label-light-danger label-inline 
																	font-weight-bolder mr-1'>Removed</span>";
																}
																else if ($status == '3') {
																	echo "<span class='label label-light-warning label-inline 
																	font-weight-bolder mr-1'>Suspended</span>";
																} 
																else if ($status == '4') {
																	echo "<span class='label label-light-success label-inline 
																	font-weight-bolder mr-1'>Active</span>";
																}
																else if ($status == '5') {
																	echo "<span class='label label-light-primary label-inline 
																	font-weight-bolder mr-1'>Approved</span>";
																}
															
																?>
														

															</div>
															<!--begin::Contacts-->
															<div class="d-flex flex-wrap my-2">
																<a href="#" class="text-muted text-hover-primary font-weight-bold mr-lg-8 mr-5 mb-lg-0 mb-2">
																<span class="svg-icon svg-icon-md svg-icon-gray-500 mr-1">
																	<!--begin::Svg Icon | path:/metronic/theme/html/demo2/dist/assets/media/svg/icons/Communication/Mail-notification.svg-->
																	<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
																		<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																			<rect x="0" y="0" width="24" height="24" />
																			<path d="M21,12.0829584 C20.6747915,12.0283988 20.3407122,12 20,12 C16.6862915,12 14,14.6862915 14,18 C14,18.3407122 14.0283988,18.6747915 14.0829584,19 L5,19 C3.8954305,19 3,18.1045695 3,17 L3,8 C3,6.8954305 3.8954305,6 5,6 L19,6 C20.1045695,6 21,6.8954305 21,8 L21,12.0829584 Z M18.1444251,7.83964668 L12,11.1481833 L5.85557487,7.83964668 C5.4908718,7.6432681 5.03602525,7.77972206 4.83964668,8.14442513 C4.6432681,8.5091282 4.77972206,8.96397475 5.14442513,9.16035332 L11.6444251,12.6603533 C11.8664074,12.7798822 12.1335926,12.7798822 12.3555749,12.6603533 L18.8555749,9.16035332 C19.2202779,8.96397475 19.3567319,8.5091282 19.1603533,8.14442513 C18.9639747,7.77972206 18.5091282,7.6432681 18.1444251,7.83964668 Z" fill="#000000" />
																			<circle fill="#000000" opacity="0.3" cx="19.5" cy="17.5" r="2.5" />
																		</g>
																	</svg>
																	<!--end::Svg Icon-->
																</span><?php echo $resuserdetails['emailaddress'] ?></a>
																<a href="#" class="text-muted text-hover-primary font-weight-bold mr-lg-8 mr-5 mb-lg-0 mb-2">
																<span class="svg-icon svg-icon-md svg-icon-gray-500 mr-1">
																	<!--begin::Svg Icon | path:/metronic/theme/html/demo2/dist/assets/media/svg/icons/General/Lock.svg-->
																	<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
																		<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																			<mask fill="white">
																				<use xlink:href="#path-1" />
																			</mask>
																			<g />
																			<path d="M7,10 L7,8 C7,5.23857625 9.23857625,3 12,3 C14.7614237,3 17,5.23857625 17,8 L17,10 L18,10 C19.1045695,10 20,10.8954305 20,12 L20,18 C20,19.1045695 19.1045695,20 18,20 L6,20 C4.8954305,20 4,19.1045695 4,18 L4,12 C4,10.8954305 4.8954305,10 6,10 L7,10 Z M12,5 C10.3431458,5 9,6.34314575 9,8 L9,10 L15,10 L15,8 C15,6.34314575 13.6568542,5 12,5 Z" fill="#000000" />
																		</g>
																	</svg>
																	<!--end::Svg Icon-->
																</span>
														
															<?php $roleid = $resuserdetails['roleid'];
															if ($roleid == '1') {
																echo "Administrator";
															}
															else if ($roleid == '2') {
																echo "Superadmin";
															}
															else if ($roleid == '3') {
																echo "Normal";
															}
															else if ($roleid == '4') {
																echo "General";
															}
															else {
																echo "Pending Approval";
															}
															?>
															</a>
																<a href="#" class="text-muted text-hover-primary font-weight-bold">
																<span class="svg-icon svg-icon-md svg-icon-gray-500 mr-1">
																	<!--begin::Svg Icon | path:/metronic/theme/html/demo2/dist/assets/media/svg/icons/Map/Marker2.svg-->
																	<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
																		<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																			<rect x="0" y="0" width="24" height="24" />
																			<path d="M9.82829464,16.6565893 C7.02541569,15.7427556 5,13.1079084 5,10 C5,6.13400675 8.13400675,3 12,3 C15.8659932,3 19,6.13400675 19,10 C19,13.1079084 16.9745843,15.7427556 14.1717054,16.6565893 L12,21 L9.82829464,16.6565893 Z M12,12 C13.1045695,12 14,11.1045695 14,10 C14,8.8954305 13.1045695,8 12,8 C10.8954305,8 10,8.8954305 10,10 C10,11.1045695 10.8954305,12 12,12 Z" fill="#000000" />
																		</g>
																	</svg>
																	<!--end::Svg Icon-->
																</span>
															<?php echo $resuserdetails['location'] ?>
															</a>
															</div>
															<!--end::Contacts-->
														</div>
														<!--begin::User-->
													
													</div>
													<!--end::Title-->
													
												</div>
												<!--end::Info-->
											</div>
										</div>
									</div>
									<!--end::Card-->
									<!--begin::Row-->
									<div class="row">
										<div class="col-xl-4">
											<!--begin::Card-->
											<div class="card card-custom gutter-b">
												<div class="card-header h-auto py-3 border-0">
													<div class="card-title">
														<h3 class="card-label text-danger">Important Notice</h3>
													</div>
													<div class="card-toolbar">
														<span class="label font-weight-bold label label-inline label-light-danger">
															<?php
															$getannouncement = $mysqli->query("select * from announcements ORDER BY id DESC limit 1");
															$resannoucement = $getannouncement->fetch_assoc();
															echo time_elapsed_string($resannoucement['periodsent'])
															?>
														</span>
													</div>
												</div>
												<div class="card-body pt-2">
													<p class="text-dark-50">
														<?php
														echo $resannoucement['announcement'];
														?>
													</p>
													
												</div>
											</div>
											<!--end::Card-->
											<!--begin::Card-->
											<div class="card card-custom">
												<!--begin::Header-->
												<div class="card-header h-auto py-4">
													<div class="card-title">
														<h3 class="card-label">
															<?php
															$getcurrentboard = $mysqli->query("select * from previewboard 
																							where userid = '$user_id' and `status` != '2' ORDER BY previd DESC LIMIT 1");										   
															$rescurrentboard = $getcurrentboard->fetch_assoc();
															$boardid = $rescurrentboard['boardid'];

															$getboardname = $mysqli->query("select * from boards where boardid = '$boardid'");
															$resboardname = $getboardname->fetch_assoc();
															echo $resboardname['boardname'];
															?>
														<span class="d-block text-muted pt-2 font-size-sm">Current Board</span></h3>
													</div>
													
												</div>
												<!--end::Header-->
												<!--begin::Body-->
												<div class="card-body py-4">
													<div class="form-group row my-2">
														<label class="col-4 col-form-label">Name:</label>
														<div class="col-8">
															<span class="form-control-plaintext font-weight-bolder">
																<?php echo $resuserdetails['fullname'] ?>
															</span>
														</div>
													</div>
													<div class="form-group row my-2">
														<label class="col-4 col-form-label">Board Name:</label>
														<div class="col-8">
															<span class="form-control-plaintext font-weight-bolder">
																<?php echo $resuserdetails['username'] ?>
															</span>
														</div>
													</div>
													<div class="form-group row my-2">
														<label class="col-4 col-form-label">Telephone:</label>
														<div class="col-8">
															<span class="form-control-plaintext font-weight-bolder">
																<?php echo $resuserdetails['telephone'] ?>
															</span>
														</div>
													</div>
													<div class="form-group row my-2">
														<label class="col-4 col-form-label">Email Address:</label>
														<div class="col-8">
															<span class="form-control-plaintext font-weight-bolder">
																<?php echo $resuserdetails['emailaddress'] ?>
															</span>
														</div>
													</div>
													<div class="form-group row my-2">
														<label class="col-4 col-form-label">Location:</label>
														<div class="col-8">
															<span class="form-control-plaintext font-weight-bolder">
																<?php echo $resuserdetails['location'] ?>
															</span>
														</div>
													</div>
													<div class="form-group row my-2">
														<label class="col-4 col-form-label">Next of Kin:</label>
														<div class="col-8">
															<span class="form-control-plaintext font-weight-bolder">
																<?php echo $resuserdetails['nextofkin'] ?>
															</span>
														</div>
													</div>
													<div class="form-group row my-2">
														<label class="col-4 col-form-label">Next of Kin Telephone:</label>
														<div class="col-8">
															<span class="form-control-plaintext font-weight-bolder">
																<?php echo $resuserdetails['nextofkintelephone'] ?>
															</span>
														</div>
													</div>
													<div class="form-group row my-2">
														<label class="col-4 col-form-label">Country:</label>
														<div class="col-8">
															<span class="form-control-plaintext font-weight-bolder">
																<?php echo $resuserdetails['country'] ?>
															</span>
														</div>
													</div>
													<div class="form-group row my-2">
														<label class="col-4 col-form-label">Role:</label>
														<div class="col-8">
															<span class="form-control-plaintext font-weight-bolder">
																<?php
																	if ($roleid == '1') {
																		echo "Administrator";
																	}
																	else if ($roleid == '2') {
																		echo "Superadmin";
																	}
																	else if ($roleid == '3') {
																		echo "Normal";
																	}
																	else if ($roleid == '4') {
																		echo "General";
																	}
																	else {
																		echo "Pending Approval";
																	}
																?>
															</span>
														</div>
													</div>

													<div class="separator separator-dashed my-10"></div>
													
													<div class="form-group row my-2">
														<label class="col-4 col-form-label">Introducer:</label>
														<div class="col-8">
															<span class="form-control-plaintext font-weight-bolder">
															<?php echo $resuserdetails['introusername'] ?>
															</span>
														</div>
													</div>
												</div>
												<!--end::Body-->
												
											</div>
											<!--end::Card-->
										</div>
										<div class="col-xl-8">
											<!--begin::Card-->
											<div class="card card-custom gutter-b">
												<!--begin::Header-->
												<div class="card-header card-header-tabs-line">
													<div class="card-toolbar">
														<ul class="nav nav-tabs nav-tabs-space-lg nav-tabs-line nav-bold nav-tabs-line-3x" role="tablist">
															<li class="nav-item">
																<a class="nav-link active" data-toggle="tab" href="#kt_apps_contacts_view_tab_1">
																	<span class="nav-icon mr-2">
																		<span class="svg-icon mr-3">
																			<!--begin::Svg Icon | path:/metronic/theme/html/demo2/dist/assets/media/svg/icons/General/Notification2.svg-->
																			<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
																				<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																					<rect x="0" y="0" width="24" height="24" />
																					<path d="M13.2070325,4 C13.0721672,4.47683179 13,4.97998812 13,5.5 C13,8.53756612 15.4624339,11 18.5,11 C19.0200119,11 19.5231682,10.9278328 20,10.7929675 L20,17 C20,18.6568542 18.6568542,20 17,20 L7,20 C5.34314575,20 4,18.6568542 4,17 L4,7 C4,5.34314575 5.34314575,4 7,4 L13.2070325,4 Z" fill="#000000" />
																					<circle fill="#000000" opacity="0.3" cx="18.5" cy="5.5" r="2.5" />
																				</g>
																			</svg>
																			<!--end::Svg Icon-->
																		</span>
																	</span>
																	<span class="nav-text">Boards</span>
																</a>
															</li>
															<li class="nav-item mr-3">
																<a class="nav-link" data-toggle="tab" href="#kt_apps_contacts_view_tab_2">
																	<span class="nav-icon mr-2">
																		<span class="svg-icon mr-3">
																			<!--begin::Svg Icon | path:/metronic/theme/html/demo2/dist/assets/media/svg/icons/Communication/Chat-check.svg-->
																			<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
																				<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																					<rect x="0" y="0" width="24" height="24" />
																					<path d="M4.875,20.75 C4.63541667,20.75 4.39583333,20.6541667 4.20416667,20.4625 L2.2875,18.5458333 C1.90416667,18.1625 1.90416667,17.5875 2.2875,17.2041667 C2.67083333,16.8208333 3.29375,16.8208333 3.62916667,17.2041667 L4.875,18.45 L8.0375,15.2875 C8.42083333,14.9041667 8.99583333,14.9041667 9.37916667,15.2875 C9.7625,15.6708333 9.7625,16.2458333 9.37916667,16.6291667 L5.54583333,20.4625 C5.35416667,20.6541667 5.11458333,20.75 4.875,20.75 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
																					<path d="M2,11.8650466 L2,6 C2,4.34314575 3.34314575,3 5,3 L19,3 C20.6568542,3 22,4.34314575 22,6 L22,15 C22,15.0032706 21.9999948,15.0065399 21.9999843,15.009808 L22.0249378,15 L22.0249378,19.5857864 C22.0249378,20.1380712 21.5772226,20.5857864 21.0249378,20.5857864 C20.7597213,20.5857864 20.5053674,20.4804296 20.317831,20.2928932 L18.0249378,18 L12.9835977,18 C12.7263047,14.0909841 9.47412135,11 5.5,11 C4.23590829,11 3.04485894,11.3127315 2,11.8650466 Z M6,7 C5.44771525,7 5,7.44771525 5,8 C5,8.55228475 5.44771525,9 6,9 L15,9 C15.5522847,9 16,8.55228475 16,8 C16,7.44771525 15.5522847,7 15,7 L6,7 Z" fill="#000000" />
																				</g>
																			</svg>
																			<!--end::Svg Icon-->
																		</span>
																	</span>
																	<span class="nav-text">History</span>
																</a>
															</li>
															<li class="nav-item mr-3">
																<a class="nav-link" data-toggle="tab" href="#kt_apps_contacts_view_tab_3">
																	<span class="nav-icon mr-2">
																		<span class="svg-icon mr-3">
																			<!--begin::Svg Icon | path:/metronic/theme/html/demo2/dist/assets/media/svg/icons/Devices/Display1.svg-->
																			<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
																				<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																					<rect x="0" y="0" width="24" height="24" />
																					<path d="M11,20 L11,17 C11,16.4477153 11.4477153,16 12,16 C12.5522847,16 13,16.4477153 13,17 L13,20 L15.5,20 C15.7761424,20 16,20.2238576 16,20.5 C16,20.7761424 15.7761424,21 15.5,21 L8.5,21 C8.22385763,21 8,20.7761424 8,20.5 C8,20.2238576 8.22385763,20 8.5,20 L11,20 Z" fill="#000000" opacity="0.3" />
																					<path d="M3,5 L21,5 C21.5522847,5 22,5.44771525 22,6 L22,16 C22,16.5522847 21.5522847,17 21,17 L3,17 C2.44771525,17 2,16.5522847 2,16 L2,6 C2,5.44771525 2.44771525,5 3,5 Z M4.5,8 C4.22385763,8 4,8.22385763 4,8.5 C4,8.77614237 4.22385763,9 4.5,9 L13.5,9 C13.7761424,9 14,8.77614237 14,8.5 C14,8.22385763 13.7761424,8 13.5,8 L4.5,8 Z M4.5,10 C4.22385763,10 4,10.2238576 4,10.5 C4,10.7761424 4.22385763,11 4.5,11 L7.5,11 C7.77614237,11 8,10.7761424 8,10.5 C8,10.2238576 7.77614237,10 7.5,10 L4.5,10 Z" fill="#000000" />
																				</g>
																			</svg>
																			<!--end::Svg Icon-->
																		</span>
																	</span>
																	<span class="nav-text">Payments</span>
																</a>
															</li>
															<li class="nav-item mr-3">
																<a class="nav-link" data-toggle="tab" href="#kt_apps_contacts_view_tab_4">
																	<span class="nav-icon mr-2">
																		<span class="svg-icon mr-3">
																			<!--begin::Svg Icon | path:/metronic/theme/html/demo2/dist/assets/media/svg/icons/Home/Globe.svg-->
																			<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
																				<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																					<rect x="0" y="0" width="24" height="24" />
																					<path d="M13,18.9450712 L13,20 L14,20 C15.1045695,20 16,20.8954305 16,22 L8,22 C8,20.8954305 8.8954305,20 10,20 L11,20 L11,18.9448245 C9.02872877,18.7261967 7.20827378,17.866394 5.79372555,16.5182701 L4.73856106,17.6741866 C4.36621808,18.0820826 3.73370941,18.110904 3.32581341,17.7385611 C2.9179174,17.3662181 2.88909597,16.7337094 3.26143894,16.3258134 L5.04940685,14.367122 C5.46150313,13.9156769 6.17860937,13.9363085 6.56406875,14.4106998 C7.88623094,16.037907 9.86320756,17 12,17 C15.8659932,17 19,13.8659932 19,10 C19,7.73468744 17.9175842,5.65198725 16.1214335,4.34123851 C15.6753081,4.01567657 15.5775721,3.39010038 15.903134,2.94397499 C16.228696,2.49784959 16.8542722,2.4001136 17.3003976,2.72567554 C19.6071362,4.40902808 21,7.08906798 21,10 C21,14.6325537 17.4999505,18.4476269 13,18.9450712 Z" fill="#000000" fill-rule="nonzero" />
																					<circle fill="#000000" opacity="0.3" cx="12" cy="10" r="6" />
																				</g>
																			</svg>
																			<!--end::Svg Icon-->
																		</span>
																	</span>
																	<span class="nav-text">Logs</span>
																</a>
															</li>
														</ul>
													</div>
												</div>
												<!--end::Header-->
												<!--begin::Body-->
												<div class="card-body px-0">
													<div class="tab-content pt-5">
														<!--begin::Tab Content-->
														<div class="tab-pane active" id="kt_apps_contacts_view_tab_1" role="tabpanel">
															<div class="container">
																<?php 
																$query = $mysqli->query("select DISTINCT(boardid) as boardids from previewboard where `status` != '2' and userid = '$user_id' ORDER BY previd desc");
																?>
															
																	<!--begin: Datatable-->
																		<table class="table table-separate table-head-custom table-checkable" id="membertable">
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
																														echo $resmem['fullname'];
																														?>
																													</td>
																													<td> <b><?php echo $resmem['username'] ?></b></td>
																													<td>
																														<?php
																														if ($colourpriority == 'Lowest' && $payment == '1') {
																															echo "<span class='label label-lg label-light-success label-inline'>Paid</span>";
																														} else if ($colourpriority == 'Lowest' && $payment == '0') {
																															echo "<span class='label label-lg label-light-danger label-inline'>Not paid</span>";
																														}
																														else {
																															echo "<span class='label label-lg label-light-primary label-inline'>N/A</span>";
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
																
															</div>
														</div>
														<!--end::Tab Content-->
														<!--begin::Tab Content-->
														<div class="tab-pane" id="kt_apps_contacts_view_tab_2" role="tabpanel">
															<form class="form">
																<div class="row">
																	<div class="col-lg-9 col-xl-6 offset-xl-3">
																		<h3 class="font-size-h6 mb-5">Contact Info:</h3>
																	</div>
																</div>
																<div class="form-group row">
																	<label class="col-xl-3 col-lg-3 col-form-label text-right">Contact Name</label>
																	<div class="col-lg-9 col-xl-6">
																		<input class="form-control form-control-lg form-control-solid" type="text" value="Nick" />
																	</div>
																</div>
																<div class="form-group row">
																	<label class="col-xl-3 col-lg-3 col-form-label text-right">Contact Owner</label>
																	<div class="col-lg-9 col-xl-6">
																		<input class="form-control form-control-lg form-control-solid" type="text" value="Bold" />
																	</div>
																</div>
																<div class="form-group row">
																	<label class="col-xl-3 col-lg-3 col-form-label text-right">Customer Name</label>
																	<div class="col-lg-9 col-xl-6">
																		<input class="form-control form-control-lg form-control-solid" type="text" value="Loop Inc." />
																		<span class="form-text text-muted">If you want your invoices addressed to a company. Leave blank to use your full name.</span>
																	</div>
																</div>
																<div class="separator separator-dashed my-10"></div>
																<!--begin::Heading-->
																<div class="row">
																	<div class="col-lg-9 col-xl-6 offset-xl-3">
																		<h3 class="font-size-h6 mb-5">Contact Info:</h3>
																	</div>
																</div>
																<!--end::Heading-->
																<div class="form-group row">
																	<label class="col-xl-3 col-lg-3 col-form-label text-right">Contact Phone</label>
																	<div class="col-lg-9 col-xl-6">
																		<div class="input-group input-group-lg input-group-solid">
																			<div class="input-group-prepend">
																				<span class="input-group-text">
																					<i class="la la-phone"></i>
																				</span>
																			</div>
																			<input type="text" class="form-control form-control-lg form-control-solid" value="+35278953712" placeholder="Phone" />
																		</div>
																		<span class="form-text text-muted">We'll never share your email with anyone else.</span>
																	</div>
																</div>
																<div class="form-group row">
																	<label class="col-xl-3 col-lg-3 col-form-label text-right">Email Address</label>
																	<div class="col-lg-9 col-xl-6">
																		<div class="input-group input-group-lg input-group-solid">
																			<div class="input-group-prepend">
																				<span class="input-group-text">
																					<i class="la la-at"></i>
																				</span>
																			</div>
																			<input type="text" class="form-control form-control-lg form-control-solid" value="nick.bold@loop.com" placeholder="Email" />
																		</div>
																	</div>
																</div>
																<div class="form-group row">
																	<label class="col-xl-3 col-lg-3 col-form-label text-right">Company Site</label>
																	<div class="col-lg-9 col-xl-6">
																		<div class="input-group input-group-lg input-group-solid">
																			<input type="text" class="form-control form-control-lg form-control-solid" placeholder="Username" value="loop" />
																			<div class="input-group-append">
																				<span class="input-group-text">.com</span>
																			</div>
																		</div>
																	</div>
																</div>
															</form>
														</div>
														<!--end::Tab Content-->
														<!--begin::Tab Content-->
														<div class="tab-pane" id="kt_apps_contacts_view_tab_3" role="tabpanel">
															                       <!--begin::Accordion-->
																				   <div
                                                                                    class="accordion accordion-solid accordion-panel accordion-svg-toggle"
                                                                                    id="accordionExample8">

                                                                                    <div class="card">
                                                                                        <div class="card-header"
                                                                                             id="headingterm1">
                                                                                            <div class="card-title"
                                                                                                 data-toggle="collapse"
                                                                                                 data-target="#term1">
                                                                                                <div class="card-label">
                                                                                                    PAYMENTS TO BE MADE
                                                                                                </div>
																								<span class="svg-icon">
																									<!--begin::Svg Icon | path:/metronic/theme/html/demo2/dist/assets/media/svg/icons/Navigation/Angle-double-right.svg-->
																									<svg xmlns="http://www.w3.org/2000/svg"
																										xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
																										height="24px" viewBox="0 0 24 24" version="1.1">
																										<g stroke="none" stroke-width="1" fill="none"
																										fill-rule="evenodd">
																											<polygon points="0 0 24 0 24 24 0 24"/>
																											<path
																												d="M12.2928955,6.70710318 C11.9023712,6.31657888 11.9023712,5.68341391 12.2928955,5.29288961 C12.6834198,4.90236532 13.3165848,4.90236532 13.7071091,5.29288961 L19.7071091,11.2928896 C20.085688,11.6714686 20.0989336,12.281055 19.7371564,12.675721 L14.2371564,18.675721 C13.863964,19.08284 13.2313966,19.1103429 12.8242777,18.7371505 C12.4171587,18.3639581 12.3896557,17.7313908 12.7628481,17.3242718 L17.6158645,12.0300721 L12.2928955,6.70710318 Z"
																												fill="#000000" fill-rule="nonzero"/>
																											<path
																												d="M3.70710678,15.7071068 C3.31658249,16.0976311 2.68341751,16.0976311 2.29289322,15.7071068 C1.90236893,15.3165825 1.90236893,14.6834175 2.29289322,14.2928932 L8.29289322,8.29289322 C8.67147216,7.91431428 9.28105859,7.90106866 9.67572463,8.26284586 L15.6757246,13.7628459 C16.0828436,14.1360383 16.1103465,14.7686056 15.7371541,15.1757246 C15.3639617,15.5828436 14.7313944,15.6103465 14.3242754,15.2371541 L9.03007575,10.3841378 L3.70710678,15.7071068 Z"
																												fill="#000000" fill-rule="nonzero" opacity="0.3"
																												transform="translate(9.000003, 11.999999) rotate(-270.000000) translate(-9.000003, -11.999999)"/>
																										</g>
																									</svg>
																									<!--end::Svg Icon-->
																								</span>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div id="term1"
                                                                                             class="collapse show"
                                                                                             data-parent="#accordionExample8">
                                                                                            <div class="card-body">
																								<?php 
																								$query = $mysqli->query("select DISTINCT(boardid) as boardids from previewboard where `status` != '2' and userid = '$user_id' ORDER BY previd desc");
																								?>
																
																								<!--begin: Datatable-->
																									<table class="table table-separate table-head-custom table-checkable" id="membertable">
																										<thead>
																										<tr>
																											<th>Board Name</th>
																											<th>Pay</th>
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
																													echo $resname['boardname']."<br/>";
																													
																													$getcolour = $mysqli->query("select * from colourconfig c JOIN previewboard p ON p.colourid = c.colourid
																													                              where c.colourpriority = 'Lowest' and p.userid = '$user_id' and p.`status` != '2'
																																				  and p.boardid = '$boardid'");
																													$rescolour = $getcolour->fetch_assoc();
																													echo "(".$receivecolour =  $rescolour['colourname'].")";
																													?>
																												</td>
																												<td>
																																<?php
																													if ($receivecolour == "") {
																														echo "No payment expected";
																													}
																													else { ?>
<table>
																													<tbody>
																													<?php
																														//get sender
																														$getsender = $mysqli->query("select * from previewboard p Join colourconfig c ON p.colourid = c.colourid where 
																														p.boardid = '$boardid' and c.colourpriority = 'Lowest' and p.`status` != '2' and p.userid = '$user_id'");

																														//get receipient
																														$getreci = $mysqli->query("select * from previewboard p Join colourconfig c ON p.colourid = c.colourid where 
																														p.boardid = '$boardid' and c.colourpriority = 'Highest' and p.`status` != '2'");
																														$resreci = $getreci->fetch_assoc();
																														$userid = $resreci['userid'];
																														$getreciept = $mysqli->query("select * from users where userid = '$userid'");
																														$resreciept = $getreciept->fetch_assoc();
																														$rec = $resreciept['fullname'].' - <b>'.$resreciept['username'].'</b>';

																														while ($ressender = $getsender->fetch_assoc()){ ?>
                                                                                                                            <tr>
																																<td>
																																	<?php

																														$getpaymentcon = $mysqli->query("select * from paymentconfig where boardid = '$boardid'");
																														$respaymentcon = $getpaymentcon->fetch_assoc();
																														$amounttopay = $respaymentcon['amounttopay']."<br/>";
																														echo 'GHS <span class="label label-lg font-weight-bold label-light-default 
																															label-inline mr-1">'.$amounttopay.'</span> to '.$rec;
																															if ($ressender['payment'] == '0') {
																																echo "<span class=' ml-3 label label-lg label-light-danger label-inline'>Not paid</span>";
																															}
																															else {
																																echo "<span class='ml-3 label label-lg label-light-success label-inline'>Paid</span>";
																															}
																														
																													?>

																																</td>
																																	
																															</tr>
																														<?php } ?>
																														</tbody>
																														</table>
																											
																													<?php }
																													?>
			
																																</td>
																					
																											</tr>
																											<?php
																										}
																										?>
																										</tbody>
																									</table>
																								<!--end: Datatable-->
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>

                                                                                    <div class="card">
                                                                                        <div class="card-header"
                                                                                             id="headingTerm2">
                                                                                            <div
                                                                                                class="card-title collapsed"
                                                                                                data-toggle="collapse"
                                                                                                data-target="#term2">
                                                                                                <div class="card-label">
                                                                                                    PAYMENTS TO RECEIVE
                                                                                                </div>
																								<span class="svg-icon">
																									<!--begin::Svg Icon | path:/metronic/theme/html/demo2/dist/assets/media/svg/icons/Navigation/Angle-double-right.svg-->
																									<svg xmlns="http://www.w3.org/2000/svg"
																										xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
																										height="24px" viewBox="0 0 24 24" version="1.1">
																										<g stroke="none" stroke-width="1" fill="none"
																										fill-rule="evenodd">
																											<polygon points="0 0 24 0 24 24 0 24"/>
																											<path
																												d="M12.2928955,6.70710318 C11.9023712,6.31657888 11.9023712,5.68341391 12.2928955,5.29288961 C12.6834198,4.90236532 13.3165848,4.90236532 13.7071091,5.29288961 L19.7071091,11.2928896 C20.085688,11.6714686 20.0989336,12.281055 19.7371564,12.675721 L14.2371564,18.675721 C13.863964,19.08284 13.2313966,19.1103429 12.8242777,18.7371505 C12.4171587,18.3639581 12.3896557,17.7313908 12.7628481,17.3242718 L17.6158645,12.0300721 L12.2928955,6.70710318 Z"
																												fill="#000000" fill-rule="nonzero"/>
																											<path
																												d="M3.70710678,15.7071068 C3.31658249,16.0976311 2.68341751,16.0976311 2.29289322,15.7071068 C1.90236893,15.3165825 1.90236893,14.6834175 2.29289322,14.2928932 L8.29289322,8.29289322 C8.67147216,7.91431428 9.28105859,7.90106866 9.67572463,8.26284586 L15.6757246,13.7628459 C16.0828436,14.1360383 16.1103465,14.7686056 15.7371541,15.1757246 C15.3639617,15.5828436 14.7313944,15.6103465 14.3242754,15.2371541 L9.03007575,10.3841378 L3.70710678,15.7071068 Z"
																												fill="#000000" fill-rule="nonzero" opacity="0.3"
																												transform="translate(9.000003, 11.999999) rotate(-270.000000) translate(-9.000003, -11.999999)"/>
																										</g>
																									</svg>
																									<!--end::Svg Icon-->
																								</span>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div id="term2" class="collapse"
                                                                                             data-parent="#accordionExample8">
																							 <div class="card-body">
																								<?php 
																								$query = $mysqli->query("select DISTINCT(boardid) as boardids from previewboard where userid = '$user_id' and `status` != '2' ORDER BY previd desc");
																								?>
																
																								<!--begin: Datatable-->
																									<table class="table table-separate table-head-custom table-checkable" id="receivepaytable">
																										<thead>
																										<tr>
																											<th>Board Name</th>
																											<th>Receive</th>
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
																													echo $resname['boardname']."<br/>";
																													
																													$getcolour = $mysqli->query("select * from colourconfig c JOIN previewboard p ON p.colourid = c.colourid
																													                              where c.colourpriority = 'Highest' and p.userid = '$user_id' and p.`status` != '2'
																																				  and p.boardid = '$boardid'");
																													$rescolour = $getcolour->fetch_assoc();
																													$receivecolour =  $rescolour['colourname'];
																													if ($receivecolour == "") {
																														echo "N/A";
																													}
																													else {
																														echo "(".$receivecolour.")";
																													}
																													
																													?>
																												</td>
																												
																												<td> <?php
																													if ($receivecolour == "") {
																														echo "No payment expected";
																													}
																													else { ?>
<table>
																													<tbody>
																													<?php
																														//get receipient
																														$getreceipient = $mysqli->query("select * from previewboard p Join colourconfig c ON p.colourid = c.colourid where 
																														p.boardid = '$boardid' and c.colourpriority = 'Lowest' and p.`status` != '2'");
																														while ($resreceipient = $getreceipient->fetch_assoc()){ ?>
                                                                                                                            <tr>
																																<td>
																																	<?php $userid = $resreceipient['userid'];
																														$getrec = $mysqli->query("select * from users where userid = '$userid'");
																														$resrec = $getrec->fetch_assoc();
																														$rec = $resrec['fullname'].' - <b>'.$resrec['username'].'</b>';

																														$getpaymentcon = $mysqli->query("select * from paymentconfig where boardid = '$boardid'");
																														$respaymentcon = $getpaymentcon->fetch_assoc();
																														$amounttopay = $respaymentcon['amounttopay']."<br/>";
																														echo 'GHS <span class="label label-lg font-weight-bold label-light-default 
																															label-inline mr-1">'.$amounttopay.'</span>from <span class="label label-lg font-weight-bold label-light-default 
																															label-inline mr-3">'.$rec.'</span>';
																															if ($resreceipient['payment'] == '0') {
																																echo "<span class='label label-lg label-light-danger label-inline'>Not paid</span>";
																															}
																															else {
																																echo "<span class='label label-lg label-light-success label-inline'>Paid</span>";
																															}
																														
																													?>

																																</td>
																																<td>
																																<button type="button"
																																	data-type="confirm"
																																	class="btn btn-primary btn-sm updatepayment"
																																	i_index="<?php echo $resreceipient['previd']; ?>"
																																	title="Update Payment"> Update Payment
																															</button>
																																</td>	
																															</tr>
																														<?php } ?>
																														</tbody>
																														</table>
																											
																													<?php }
																													?>
																												</td>
																												
																											</tr>
																											<?php
																										}
																										?>
																										</tbody>
																									</table>
																								<!--end: Datatable-->
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                   
                                                                                </div>
                                                                                <!--end::Accordion-->

														</div>
														<!--end::Tab Content-->
														<!--begin::Tab Content-->
														<div class="tab-pane" id="kt_apps_contacts_view_tab_4" role="tabpanel">
															<form class="form">
																<!--begin::Heading-->
																<div class="row">
																	<div class="col-lg-9 col-xl-6 offset-xl-3">
																		<h3 class="font-size-h6 mb-5">Setup Email Notification:</h3>
																	</div>
																</div>
																<!--end::Heading-->
																<div class="form-group row">
																	<label class="col-xl-3 col-lg-3 col-form-label text-right">Email Notification</label>
																	<div class="col-lg-9 col-xl-6">
																		<span class="switch">
																			<label>
																				<input type="checkbox" checked="checked" name="email_notification_1" />
																				<span></span>
																			</label>
																		</span>
																	</div>
																</div>
																<div class="form-group row mb-0">
																	<label class="col-xl-3 col-lg-3 col-form-label text-right">Send Copy To Personal Email</label>
																	<div class="col-lg-9 col-xl-6">
																		<span class="switch">
																			<label>
																				<input type="checkbox" name="email_notification_2" />
																				<span></span>
																			</label>
																		</span>
																	</div>
																</div>
																<div class="separator separator-dashed my-10"></div>
																<!--begin::Heading-->
																<div class="row">
																	<div class="col-lg-9 col-xl-6 offset-xl-3">
																		<h3 class="font-size-h6 mb-5">Activity Related Emails:</h3>
																	</div>
																</div>
																<!--end::Heading-->
																<div class="form-group row">
																	<label class="col-xl-3 col-lg-3 col-form-label text-right">When To Email</label>
																	<div class="col-lg-9 col-xl-6">
																		<div class="checkbox-list">
																			<label class="checkbox">
																			<input type="checkbox" />
																			<span></span>You have new notifications.</label>
																			<label class="checkbox">
																			<input type="checkbox" />
																			<span></span>You're sent a direct message</label>
																			<label class="checkbox">
																			<input type="checkbox" checked="checked" />
																			<span></span>Someone adds you as a connection</label>
																		</div>
																	</div>
																</div>
																<div class="form-group row mb-0">
																	<label class="col-xl-3 col-lg-3 col-form-label text-right">When To Escalate Emails</label>
																	<div class="col-lg-9 col-xl-6">
																		<div class="checkbox-list">
																			<label class="checkbox">
																			<input type="checkbox" />
																			<span></span>Upon new order.</label>
																			<label class="checkbox">
																			<input type="checkbox" />
																			<span></span>New membership approval</label>
																			<label class="checkbox">
																			<input type="checkbox" checked="checked" />
																			<span></span>Member registration</label>
																		</div>
																	</div>
																</div>
																<div class="separator separator-dashed my-10"></div>
																<!--begin::Heading-->
																<div class="row">
																	<div class="col-lg-9 col-xl-6 offset-xl-3">
																		<h3 class="font-size-h6 mb-5">Updates From Keenthemes:</h3>
																	</div>
																</div>
																<!--end::Heading-->
																<div class="form-group row">
																	<label class="col-xl-3 col-lg-3 col-form-label text-right">Email You With</label>
																	<div class="col-lg-9 col-xl-6">
																		<div class="checkbox-list">
																			<label class="checkbox">
																			<input type="checkbox" />
																			<span></span>News about Metronic product and feature updates</label>
																			<label class="checkbox">
																			<input type="checkbox" />
																			<span></span>Tips on getting more out of Keen</label>
																			<label class="checkbox">
																			<input type="checkbox" checked="checked" />
																			<span></span>Things you missed since you last logged into Keen</label>
																			<label class="checkbox">
																			<input type="checkbox" checked="checked" />
																			<span></span>News about Metronic on partner products and other services</label>
																			<label class="checkbox">
																			<input type="checkbox" checked="checked" />
																			<span></span>Tips on Metronic business products</label>
																		</div>
																	</div>
																</div>
															</form>
														</div>
														<!--end::Tab Content-->
													</div>
												</div>
												<!--end::Body-->
											</div>
											<!--end::Card-->
										</div>
									</div>
									<!--end::Row-->
								</div>
							<!--end::Container-->



						</div>
						<!--end::Entry-->
					</div>
<!--end::Content-->

<?php include ('includes/footer.php'); ?>

<script>

	
	 $(document).off('click', '.updatepayment').on('click', '.updatepayment', function () {
        var theindex = $(this).attr('i_index');
        //alert(theindex)
        $.confirm({
            title: 'Update Payment!',
            content: 'Input cannot be reversed',
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
                            url: "ajax/queries/update_payment.php",
                            data: {
                                i_index: theindex
                            },
                            dataType: "html",
                            success: function (text) {
								$("#term2").load(" #term2 > *");
								$("#term1").load(" #term1 > *");
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