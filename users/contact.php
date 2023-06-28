<?php session_start(); ?>
<?php include("../components/frontend/users/header.php") ?>
<?php include("../includes/dbconfig.php") ?>
<?php include("../components/frontend/users/menu.php") ?>

<div class="wrapper">
	<div class="clearfix"></div>
	<div class="container_fullwidth">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<h5 class="title contact-title"> Contact Us </h5>
					<div class="clearfix"></div>
					<div class="map">
						<iframe width="600" height="350" src="https://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=Vietnam&amp;aq=&amp;sll=14.058324,108.277199&amp;sspn=21.827722,43.286133&amp;ie=UTF8&amp;hq=&amp;hnear=Vietnam&amp;ll=14.058324,108.277199&amp;spn=8.883583,21.643066&amp;t=m&amp;z=6&amp;output=embed"></iframe>
					</div>
					<div class="clearfix"></div>
					<div class="row">
						<div class="col-md-4">
							<div class="contact-infoormation">
								<h5> Thông tin liên hệ </h5>
								<p> Lorem ipsum dolor sit amet, consectetur ad ipis cing elit. Suspendisse at sapien mascsa. Lorem ipsum dolor sit amet, consectetur se adipiscing elit. Sed fermentum, sapien scele risque volutp at tempor, lacus est sodales massa, a hendrerit dolor slase turpis non mi. </p>
								<ul>
									<li>
										<span class="icon">
                      						<img src="../public/frontend/images/message.png" alt="">
                    					</span>
										<p> contact@mvku.udn.vn
										<br>support@vku.udn.vn </p>
									</li>
									<li>
										<span class="icon">
                      						<img src="../public/frontend/images/phone.png" alt="">
                    					</span>
										<p> 084. 123 4567
										<br> 084. 987 6543 </p>
									</li>
									<li>
										<span class="icon">
											<img src="../public/frontend/images/address.png" alt="">
										</span>
										<p> No. 02 Khai Tay 2, Hoa Hai,
										<br> HaNoi, Vietnam </p>
									</li>
								</ul>
							</div>
						</div>
						<div class="col-md-8">
							<div class="ContactForm">
								<h5> Biểu mẫu Liên hệ </h5>
								<form>
									<div class="row">
										<div class="col-md-6">
											<label> Your Name <strong class="red"> * </strong> </label>
											<input class="inputfild" type="text" name=""> </div>
										<div class="col-md-6">
											<label> Your Email <strong class="red"> * </strong> </label>
											<input class="inputfild" type="email" name=""> </div>
									</div>
									<div class="row">
										<div class="col-md-12">
											<label> Your Message <strong class="red"> * </strong> </label>
											<textarea class="inputfild" rows="8" name=""></textarea>
										</div>
									</div>
									<button class="pull-right"> Send Message </button>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php include("../components/frontend/footer.php") ?>
<?php include("../components/frontend/users/footer.php") ?>