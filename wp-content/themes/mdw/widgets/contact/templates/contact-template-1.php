<?php
$title			 = ( isset( $instance[ 'title' ] ) ) ? $instance[ 'title' ] : '';
$main_content	 = ( isset( $instance[ 'main_content' ] ) ) ? $instance[ 'main_content' ] : '';
$box_layout		 = ( isset( $instance[ 'box_layout' ] ) ) ? $instance[ 'box_layout' ] : 'container';
$animation		 = ( isset( $instance[ 'animation' ] ) ) ? $instance[ 'animation' ] : 'None';
$widget_id		 = ( isset( $instance[ 'widget_id' ] ) ) ? $instance[ 'widget_id' ] : "";

$address			 = ( isset( $instance[ 'address' ] ) ) ? $instance[ 'address' ] : '';
$country			 = ( isset( $instance[ 'country' ] ) ) ? $instance[ 'country' ] : '';
$phone				 = ( isset( $instance[ 'phone' ] ) ) ? $instance[ 'phone' ] : '';
$opening_hours		 = ( isset( $instance[ 'opening_hours' ] ) ) ? $instance[ 'opening_hours' ] : '';
$email_1			 = ( isset( $instance[ 'email_1' ] ) ) ? $instance[ 'email_1' ] : '';
$email_2			 = ( isset( $instance[ 'email_2' ] ) ) ? $instance[ 'email_2' ] : '';
$lat				 = ( isset( $instance[ 'lat' ] ) ) ? $instance[ 'lat' ] : 40.725118;
$lng				 = ( isset( $instance[ 'lng' ] ) ) ? $instance[ 'lng' ] : -73.997699;
$zoom				 = ( isset( $instance[ 'zoom' ] ) ) ? $instance[ 'zoom' ] : 14;
$form				 = ( isset( $instance[ 'form' ] ) ) ? $instance[ 'form' ] : '';
$form_header		 = ( isset( $instance[ 'form_header' ] ) ) ? $instance[ 'form_header' ] : '';
$form_description	 = ( isset( $instance[ 'form_description' ] ) ) ? $instance[ 'form_description' ] : '';
$map_api_key		 = ( isset( $instance[ 'map_api_key' ] ) ) ? $instance[ 'map_api_key' ] : '';
$amount				 = 3;
$image = ( isset( $instance[ 'image' ] ) ) ? $instance[ 'image' ] : '';
$image_url = ( isset( $instance[ 'image_url' ] ) ) ? $instance[ 'image_url' ] : '';
$what_to_feed = ( isset( $instance[ 'what_to_feed' ] ) ) ? $instance[ 'what_to_feed' ] : 'posts';
for ( $i = 1; $i <= $amount; $i++ ) {

	${"icon_" . $i}				 = ( isset( $instance[ 'icon_' . $i ] ) ) ? $instance[ 'icon_' . $i ] : '';
	${"icon_container_" . $i}	 = ( isset( $instance[ 'icon_container_' . $i ] ) ) ? $instance[ 'icon_container_' . $i ] : '';
	${"icon_color_" . $i}		 = ( isset( $instance[ 'icon_color_' . $i ] ) ) ? $instance[ 'icon_color_' . $i ] : '';
	${"icon_text_". $i}		 = ( isset( $instance[ 'icon_text_' . $i ] ) ) ? $instance[ 'icon_text_' . $i ] : '';
	${"icon_url_" . $i}			 = ( isset( $instance[ "icon_url_" . $i ] ) ) ? $instance[ "icon_url_" . $i ] : '';
}

$args		 = array( 'post_type' => 'wpcf7_contact_form', 'posts_per_page' => -1 );
$cf7Forms	 = get_posts( $args );
$forms		 = class_exists( 'WPCF7_Mail' );
?>


	<div class="<?php echo $box_layout; ?>" id="<?php echo $widget_id; ?>">
		<!--Section: Contact v.1-->
		<section class="section mb-4">

			<!--Section heading-->
			<?php if ( $title != '' ) { ?><h1 class="section-heading"><?php echo $title; ?></h1><?php } ?>
			<!--Section sescription-->
			<?php if ( $main_content != '' ) { ?><p class="section-description mb-5"><?php echo $main_content; ?></p><?php } ?>

			<div class="row">

				<!--First column-->
				<?php if ( $form != 'empty' && $map_api_key == "" && $image == "")  { ?>

					<div class="col-md-12 <?php echo $animation == 'None' ? '' : ' wow ' . $animation; ?>">

						<!--Form with header-->
						<div class="card">

							<div style="color: #373a3c" class="card-block">
								<!--Header-->
								<div class="form-header">
									<h3><i class="fa fa-envelope"></i> <?php echo $form_header; ?></h3>
								</div>

								<p><?php echo $form_description; ?></p>
								<br>

								<!--Body-->
								<?php echo do_shortcode( $form ) ?>

							</div>

						</div>
						<!--/Form with header-->
					</div>
					<!--/First column-->

					<!--Second column-->
					<div class="col-md-12 <?php echo $animation == 'None' ? '' : ' wow ' . $animation; ?>">

						<!--Buttons-->
						<div class="text-xs-center">
							<?php if ( $icon_container_1 != '' ) { ?>
								<div class="col-md-4">
									<a href="<?php echo ($icon_url_1 ? $icon_url_1 : "#"); ?>" class="btn-floating btn-small <?php echo ($icon_color_1 == '' ? "mdb-color" : ""); ?>" style="background-color:<?php echo $icon_color_1; ?>"><i class="<?php echo $icon_container_1 ?>"></i></a>
									<p><?php echo $address; ?></p>
									<p><?php echo $country; ?></p>
									<p><?php echo ${"icon_text_" . 1}; ?></p>
								</div>
							<?php } ?>
							<?php if ( $icon_container_2 != '' ) { ?>
								<div class="col-md-4">
									<a href="<?php echo ($icon_url_2 ? $icon_url_2 : "#"); ?>" class="btn-floating btn-small <?php echo ($icon_color_2 == '' ? "mdb-color" : ""); ?>" style="background-color:<?php echo $icon_color_2; ?>"><i class="<?php echo $icon_container_2 ?>"></i></a>
									<p><?php echo $phone; ?></p>
									<p><?php echo $opening_hours; ?></p>
									<p><?php echo ${"icon_text_" . 2}; ?></p>
								</div>
							<?php } ?>
							<?php if ( $icon_container_3 != '' ) { ?>
								<div class="col-md-4">
									<a href="<?php echo ($icon_url_3 ? $icon_url_3 : "#"); ?>" class="btn-floating btn-small <?php echo ($icon_color_3 == '' ? "mdb-color" : ""); ?>" style="background-color:<?php echo $icon_color_3; ?>"><i class="<?php echo $icon_container_3 ?>"></i></a>
									<p><?php echo $email_1; ?></p>
									<p><?php echo $email_2; ?></p>
									<p><?php echo ${"icon_text_" . 3}; ?></p>
								</div>
							<?php } ?>
						</div>

					</div>
					<!--/Second column-->
				<?php } else if ($form == "empty") { ?>
					<div class="col-md-12 <?php echo $animation == 'None' ? '' : ' wow ' . $animation; ?>">

						<!--Google map-->
                        <?php if($what_to_feed == "posts"){ ?>
                        <div id="map-container" class="z-depth-1-half map-container" style="height: 400px"></div>
                        <?php } else if ($image != "") { ?>
                            <div class="view overlay hm-white-slight mb-2">
                                        <img src="<?php echo $image; ?>" class="img-fluid z-depth-1">
                                        <div class="mask"></div>
                            </div>
                        <?php } ?>

						<br>
						<!--Buttons-->
						<div class="row text-xs-center">
							<?php if ( $icon_container_1 != '' ) { ?>
								<div class="col-md-4">
									<a href="<?php echo ($icon_url_1 ? $icon_url_1 : "#"); ?>" class="btn-floating btn-small <?php echo ($icon_color_1 == '' ? "mdb-color" : ""); ?>" style="background-color:<?php echo $icon_color_1; ?>"><i class="<?php echo $icon_container_1 ?>"></i></a>
									<p><?php echo $address; ?></p>
									<p><?php echo $country; ?></p>
								</div>
							<?php } ?>
							<?php if ( $icon_container_2 != '' ) { ?>
								<div class="col-md-4">
									<a href="<?php echo ($icon_url_2 ? $icon_url_2 : "#"); ?>" class="btn-floating btn-small <?php echo ($icon_color_2 == '' ? "mdb-color" : ""); ?>" style="background-color:<?php echo $icon_color_2; ?>"><i class="<?php echo $icon_container_2 ?>"></i></a>
									<p><?php echo $phone; ?></p>
									<p><?php echo $opening_hours; ?></p>
								</div>
							<?php } ?>
							<?php if ( $icon_container_3 != '' ) { ?>
								<div class="col-md-4">
									<a href="<?php echo ($icon_url_3 ? $icon_url_3 : "#"); ?>" class="btn-floating btn-small <?php echo ($icon_color_3 == '' ? "mdb-color" : ""); ?>" style="background-color:<?php echo $icon_color_3; ?>"><i class="<?php echo $icon_container_3 ?>"></i></a>
									<p><?php echo $email_1; ?></p>
									<p><?php echo $email_2; ?></p>
								</div>
							<?php } ?>
						</div>
					</div>
				<?php } else { ?>
                    <div class="col-md-5 <?php echo $animation == 'None' ? '' : ' wow ' . $animation; ?>">

                        <!--Form with header-->
                        <div class="card">

                            <div class="card-block">
                                <!--Header-->
                                <div class="form-header">
                                    <h3><i class="fa fa-envelope"></i> <?php echo $form_header; ?></h3>
                                </div>

                                <p><?php echo $form_description; ?></p>
                                <br>

                                <!--Body-->
                                <?php echo do_shortcode( $form ) ?>

                            </div>

                        </div>
                        <!--/Form with header-->
                    </div>
                    <!--/First column-->

                    <!--Second column-->
                    <div class="col-md-7 <?php echo $animation == 'None' ? '' : ' wow ' . $animation; ?>">

                        <!--Google map-->
                        <?php if($what_to_feed == "posts"){ ?>
                        <div id="map-container" class="z-depth-1-half map-container" style="height: 400px"></div>
                        <?php } else if ($image != "") { ?>
                            <div class="view overlay hm-white-slight mb-2">
                                        <img src="<?php echo $image; ?>" class="img-fluid z-depth-1">
                                        <div class="mask"></div>
                            </div>
                        <?php } ?>
                        <br>
                        <!--Buttons-->
                        <div class="row text-xs-center">
                            <?php if ( $icon_container_1 != '' ) { ?>
                                <div class="col-md-4">
                                    <a href="<?php echo ($icon_url_1 ? $icon_url_1 : "#"); ?>" class="btn-floating btn-small <?php echo ($icon_color_1 == '' ? "mdb-color" : ""); ?>" style="background-color:<?php echo $icon_color_1; ?>"><i class="<?php echo $icon_container_1 ?>"></i></a>
                                    <p><?php echo $address; ?></p>
                                    <p><?php echo $country; ?></p>
                                </div>
                            <?php } ?>
                            <?php if ( $icon_container_2 != '' ) { ?>
                                <div class="col-md-4">
                                    <a href="<?php echo ($icon_url_2 ? $icon_url_2 : "#"); ?>" class="btn-floating btn-small <?php echo ($icon_color_2 == '' ? "mdb-color" : ""); ?>" style="background-color:<?php echo $icon_color_2; ?>"><i class="<?php echo $icon_container_2 ?>"></i></a>
                                    <p><?php echo $phone; ?></p>
                                    <p><?php echo $opening_hours; ?></p>
                                </div>
                            <?php } ?>
                            <?php if ( $icon_container_3 != '' ) { ?>
                                <div class="col-md-4">
                                    <a href="<?php echo ($icon_url_3 ? $icon_url_3 : "#"); ?>" class="btn-floating btn-small <?php echo ($icon_color_3 == '' ? "mdb-color" : ""); ?>" style="background-color:<?php echo $icon_color_3; ?>"><i class="<?php echo $icon_container_3 ?>"></i></a>
                                    <p><?php echo $email_1; ?></p>
                                    <p><?php echo $email_2; ?></p>
                                </div>
                            <?php } ?>
                        </div>

                    </div>
                <?php } ?>
			</div>

		</section>
		<!--/Section: Contact v.1-->
		<span style='display:none' id='latitude'><?php echo $latitude; ?></span>
		<span style='display:none' id='longtitude'><?php echo $longtitude; ?></span>
		<span style='display:none' id='zoom'><?php echo $zoom; ?></span>
		<span style='display:none' id='map_api_key'><?php echo $map_api_key; ?></span>

		<!--Google  Maps-->
		<script src="https://maps.googleapis.com/maps/api/js?key=<?php echo $map_api_key; ?>"
		type="text/javascript"></script>
		<script>

			function init_map() {

				var latitude = <?php echo $lat; ?>;
				var longtitude = <?php echo $lng; ?>;
				var zoom = <?php echo $zoom; ?>;


				var var_location = new google.maps.LatLng( latitude, longtitude );

				var var_mapoptions = {
					center: var_location,

					zoom: zoom
				};

				var var_marker = new google.maps.Marker( {
					position: var_location,
					map: var_map,
					title: "New York"
				} );

				var var_map = new google.maps.Map( document.getElementById( "map-container" ),
					var_mapoptions );

				var_marker.setMap( var_map );

			}

			google.maps.event.addDomListener( window, 'load', init_map );

		</script>
</div>
