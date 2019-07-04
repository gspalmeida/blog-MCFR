<?php
$title		 = ( isset( $instance[ 'title' ] ) ) ? $instance[ 'title' ] : '';
$box_layout	 = ( isset( $instance[ 'box_layout' ] ) ) ? $instance[ 'box_layout' ] : 'container';
$insta_url	 = ( isset( $instance[ 'insta_url' ] ) ) ? $instance[ 'insta_url' ] : '';
$insta		 = ( isset( $instance[ 'insta' ] ) ) ? $instance[ 'insta' ] : '';
$widget_id   = ( isset( $instance[ 'widget_id' ] ) ) ? $instance[ 'widget_id' ] : '';
$img_count	 = ( isset( $instance[ 'img_count' ] ) ) ? $instance[ 'img_count' ] : '';
?>
<div class="<?php echo $box_layout; ?>" id="<?php echo $widget_id; ?>">


	<?php
	$response	 = file_get_contents( 'https://api.instagram.com/' . $insta . '/media/' );

	$response	 = json_decode( $response );
	?>
	<!-- Boxed gallery -->


	<div class="col-md-12">

		<!-- Instagram feed -->
		<h5 class="title"><?php echo $title ?></h5> 
		<!-- Instagram Photos -->
		<div class="footer-imgs">
			<ul class="instagram-photos" style="<?php if($img_count == "4"){ echo 'columns: 2;';} ?>">
				<?php $i = 0; ?>
				<?php
				foreach ( $response->items as $element ) {
					if ( $i == $img_count ) {
						break;
					}
					?>

					<li style="<?php if($img_count == "4"){ echo 'max-width: none;';} ?> ">
						<div class="view overlay hm-white-slight">
							<img class="img-fluid" src="<?php echo $element->images->standard_resolution->url ?>" alt="Instagram photo cap">
							<a href="<?php echo $insta_url ?>">
								<div class="mask waves-effect waves-light"></div>
							</a>
						</div>
					</li>

					<?php
					$i++;
				}
				?>
			</ul>



		</div>
	</div>



</div>