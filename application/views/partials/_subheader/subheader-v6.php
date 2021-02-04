
<!--begin::Subheader-->
						<div class="subheader py-3 py-lg-8 subheader-transparent" id="kt_subheader">
							<div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">

								<!--begin::Info-->
								<div class="d-flex align-items-center mr-1">

									<!--begin::Page Heading-->
									<div class="d-flex align-items-baseline flex-wrap mr-5">


										<!--begin::Breadcrumb-->
										<ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold my-2 p-0">
											<?php
												foreach($subheader as $sub){
													$href = "#";
													$text = $sub;
													if(is_array($sub)){
														$href = base_url($sub['href']);
														$text = $sub['text'];
													}
													echo '
														<li class="breadcrumb-item text-muted">
															<a href="'.$href.'" class="text-muted">'.$text.'</a>
														</li>
													';
												}
											?>
											
										</ul>

										<!--end::Breadcrumb-->
									</div>

									<!--end::Page Heading-->
								</div>

								<!--end::Info-->

							</div>
						</div>

						<!--end::Subheader-->
