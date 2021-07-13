<?php include ('includes/header.php'); ?>


            <!--begin::Content-->
            <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
                <!--begin::Subheader-->
                <div class="subheader py-2 py-lg-12 subheader-transparent" id="kt_subheader">
                    <div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
                        <!--begin::Info-->
                        <div class="d-flex align-items-center flex-wrap mr-1">
                            <!--begin::Heading-->
                            <div class="d-flex flex-column">
                                <!--begin::Title-->
                                <h2 class="text-white font-weight-bold my-2 mr-5">Dashboard</h2>
                                <!--end::Title-->
                               
                            </div>
                            <!--end::Heading-->
                        </div>
                        <!--end::Info-->
                       
                    </div>
                </div>
                <!--end::Subheader-->
                <!--begin::Entry-->
                <div class="d-flex flex-column-fluid">
                    <!--begin::Container-->
                    <div class="container-fluid">
                        <!--begin::Card-->
                        <div class="card card-custom gutter-b">
                            <div class="card-body">
                                <div class="d-flex">
                                   
                                    <!--begin: Info-->
                                    <div class="flex-grow-1">
                                        <!--begin: Title-->
                                        <div class="d-flex align-items-center justify-content-between flex-wrap">
                                            <div class="mr-3">
                                                <!--begin::Name-->
                                                <a href="#" class="d-flex align-items-center text-dark text-hover-primary font-size-h5 
                                                font-weight-bold mr-3">
                                                <?php echo getfullname($user_id) ?>
                                                   
                                                <!--end::Name-->
                                                <?php getuserstatus($user_id); ?>
														
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
															</span><?php echo getemailaddress($user_id); ?></a>
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
                                                            <?php echo getuserroles ($user_id)?></a>
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
															</span><?php echo getlocation($user_id) ?></a>
                                                </div>
                                                <!--end::Contacts-->
                                            </div>
                                            
                                        </div>
                                        <!--end: Title-->
                                        
                                    </div>
                                    <!--end: Info-->
                                </div>
                                <div class="separator separator-solid my-7"></div>
                                <!--begin: Items-->
                                <div class="d-flex align-items-center flex-wrap">
                                    <!--begin: Item-->
                                    <div class="d-flex align-items-center flex-lg-fill mr-5 my-1">
												
                                        <div class="d-flex flex-column text-dark-75">
                                            <span class="font-weight-bolder font-size-sm">Boards</span>
													<span class="font-weight-bolder font-size-h5">
                                                <?php
                                                echo mysqli_num_rows($mysqli->query("select * from boards where type = 'Main'"));
                                                ?>    
                                                    </span>
                                        </div>
                                    </div>
                                    <!--end: Item-->
                                     <!--begin: Item-->
                                     <div class="d-flex align-items-center flex-lg-fill mr-5 my-1">
										<div class="d-flex flex-column text-dark-75">
                                                    <span class="font-weight-bolder font-size-sm">Split Boards</span>
                                                            <span class="font-weight-bolder font-size-h5">
                                                        <?php
                                                        echo mysqli_num_rows($mysqli->query("select * from boards where type = 'Split'"));
                                                        ?>    
                                                    </span>
                                        </div>
                                    </div>
                                    <!--end: Item-->
                                    <!--begin: Item-->
                                      <div class="d-flex align-items-center flex-lg-fill mr-5 my-1">
										<div class="d-flex flex-column text-dark-75">
                                                <span class="font-weight-bolder font-size-sm">Active Users</span>
                                                        <span class="font-weight-bolder font-size-h5">
                                                    <?php
                                                    echo mysqli_num_rows($mysqli->query("select * from users where userstatus != '2'"));
                                                    ?>    
                                                </span>
                                        </div>
                                    </div>
                                     <!--end: Item-->
                                    <!--begin: Item-->
                                    <div class="d-flex align-items-center flex-lg-fill mr-5 my-1">
										<div class="d-flex flex-column text-dark-75">
                                                <span class="font-weight-bolder font-size-sm">Administrators</span>
                                                        <span class="font-weight-bolder font-size-h5">
                                                    <?php
                                                    echo mysqli_num_rows($mysqli->query("select * from users where roleid = '1'"));
                                                    ?>    
                                                </span>
                                        </div>
                                    </div>
                                     <!--end: Item-->
                                    <!--begin: Item-->
                                    <div class="d-flex align-items-center flex-lg-fill mr-5 my-1">
										<div class="d-flex flex-column text-dark-75">
                                                <span class="font-weight-bolder font-size-sm">Completed Boards</span>
                                                        <span class="font-weight-bolder font-size-h5">
                                                    <?php
                                                    echo mysqli_num_rows($mysqli->query("select * from boards where completion = '1'"));
                                                    ?>    
                                                </span>
                                        </div>
                                    </div>
                                     <!--end: Item-->
                                    
                           
                                </div>
                                <!--begin: Items-->
                            </div>
                        </div>
                        <!--end::Card-->
                       
                       
                    </div>
                    <!--end::Container-->
                </div>
                <!--end::Entry-->
            </div>
            <!--end::Content-->
           

<?php include ('includes/footer.php'); ?>           