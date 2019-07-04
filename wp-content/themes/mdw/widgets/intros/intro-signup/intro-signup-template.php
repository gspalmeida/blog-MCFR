<?php
$bg_image			 = ( isset( $instance[ 'background_image' ] ) ) ? $instance[ 'background_image' ] : '';
$title				 = ( isset( $instance[ 'title' ] ) ) ? $instance[ 'title' ] : '';
$title_description	 = ( isset( $instance[ 'title_description' ] ) ) ? $instance[ 'title_description' ] : '';
$button_text		 = ( isset( $instance[ 'button_text' ] ) ) ? $instance[ 'button_text' ] : '';
$button_url			 = ( isset( $instance[ 'button_url' ] ) ) ? $instance[ 'button_url' ] : '';
$form_header		 = ( isset( $instance[ 'form_header' ] ) ) ? $instance[ 'form_header' ] : '';
$form				 = ( isset( $instance[ 'form' ] ) ) ? $instance[ 'form' ] : '';
$big_font			 = ( isset( $instance[ 'big_font' ] ) ) ? $instance[ 'big_font' ] : '';
$mask				 = ( isset( $instance[ 'mask' ] ) ) ? $instance[ 'mask' ] : '';
$filled_buttons		 = ( isset( $instance[ 'filled_buttons' ] ) ) ? $instance[ 'filled_buttons' ] : '';
?>
<!--Mask-->
<div class="view <?php echo ($mask == 'checked') ? 'hm-black-strong' : '' ?> intro"  style="background:url('<?php echo esc_url( $bg_image ); ?>')no-repeat center center fixed;background-size:cover;height:100%;">
    <div class="full-bg-img flex-center">
        <div class="container">
            <div class="row" id="home">

                <!--First column-->
                <div class="<?php echo is_user_logged_in() ? "col-lg-12" : "col-lg-6" ?>">
                    <div class="description">
						<?php if ( $big_font == 'checked' ) { ?>  
							<h2 class="intro-heading wow fadeInLeft"><?php echo esc_html( $title ); ?></h2>
							<hr class="hr-dark">
							<h3 class="intro-subtext wow fadeInLeft" data-wow-delay="0.4s"><?php echo esc_html( $title_description ); ?></h3>
						<?php } else { ?>
							<h2 class="h2-responsive wow fadeInLeft"><?php echo esc_html( $title ); ?></h2>
							<hr class="hr-dark">
							<p class="wow fadeInLeft" data-wow-delay="0.4s"><?php echo esc_html( $title_description ); ?></p>
						<?php } ?>
						<br>
                        <div class="smooth_scroll">
							<?php if ( $filled_buttons == 'checked' ) { ?>
								<a class="btn btn-primary btn-lg waves-effect waves-light" data-wow-delay="0.7s" href="<?php echo $button_url; ?>"><?php echo $button_text; ?></a>
							<?php } else { ?>
								<a class="btn btn-outline-white btn-lg waves-effect waves-light" data-wow-delay="0.7s" href="<?php echo $button_url; ?>"><?php echo $button_text; ?></a>
							<?php } ?>
                        </div>
                    </div>
                </div>
                <!--/.First column-->

				<?php if ( !is_user_logged_in() ) { ?>
					<!--Second column-->
					<div class="col-lg-6">
						<!--Form-->
						<div class="card wow fadeInRight">


							<div class="card-block" >
								<!--Header-->
								<div class="text-xs-center">
									<h3><i class="fa fa-user"></i> Register</h3>

								</div>
								<form id="register" class="ajax-auth" action="register" method="post">
									<?php wp_nonce_field( 'ajax-register-nonce', 'signonsecurity' ); ?>

									<!--Body-->
									<p class="status"></p>

									<div class="md-form">
										<i class="fa fa-user prefix"></i>
										<input type="text" id="signonname" class="form-control" name="signonname">
										<label for="signonname">Your name</label>
									</div>


									<div class="md-form">
										<i class="fa fa-envelope prefix"></i>
										<input type="text" id="email" class="form-control" name="email">
										<label for="email">Your email</label>
									</div>

									<div class="md-form">
										<i class="fa fa-lock prefix"></i>
										<input type="password" id="signonpassword" class="form-control" name="signonpassword">
										<label for="signonpassword">Password</label>
									</div>

									<div class="md-form">
										<i class="fa fa-lock prefix"></i>
										<input type="password" id="password2" class="form-control" name="password2">
										<label for="password2">Repeat password</label>
									</div>
									<div class="text-xs-center">
										<button class="btn btn-primary btn-lg" type="submit" >Sign up</button>
										<!--                                <hr>-->
										<!--
																		<fieldset class="form-group">
																			<input type="checkbox" id="newsletter">
																			<label for="newsletter">Subscribe me to the newsletter</label>
																		</fieldset>
										-->
									</div>
									<p class="paragraph-singup-widget">Already registered? <a id="swapToLoginButton">Login.</a></p>
								</form>


								<form id="login" class="ajax-auth" action="login" method="post">
									<?php wp_nonce_field( 'ajax-login-nonce', 'security' ); ?>

									<!--Body-->
									<p class="status"></p>

									<div class="md-form">
										<i class="fa fa-user prefix"></i>
										<input type="text" id="username" class="form-control" name="username">
										<label for="username">Username</label>
									</div>

									<div class="md-form">
										<i class="fa fa-lock prefix"></i>
										<input type="password" id="password" class="form-control" name="password">
										<label for="password">Password</label>
									</div>


									<div class="text-xs-center">
										<button class="btn btn-primary btn-lg" type="submit" >Login</button>
										<!--
																		<hr>
																		<fieldset class="form-group">
																			<input type="checkbox" id="newsletter">
																			<label for="newsletter">Subscribe me to the newsletter</label>
																		</fieldset>
										-->
									</div>
									<p class="paragraph-singup-widget">Don't have an account? <a id="swapToSignUpButton">Sign up.</a></p>
								</form>

							</div>
						<?php } else { ?>

						<?php } ?>
                    </div>
                    <!--/.Form-->
                </div>
                <!--/Second column-->
            </div>
        </div>
    </div>
</div>
<!--/.Mask-->
