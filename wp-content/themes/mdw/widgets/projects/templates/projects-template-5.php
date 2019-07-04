<?php
$title						 = ( isset( $instance[ 'title' ] ) ) ? $instance[ 'title' ] : '';
$main_content				 = ( isset( $instance[ 'main_content' ] ) ) ? $instance[ 'main_content' ] : '';
$image						 = ( isset( $instance[ 'image' ] ) ) ? $instance[ 'image' ] : '';
$what_to_feed				 = ( isset( $instance[ 'what_to_feed' ] ) ) ? $instance[ 'what_to_feed' ] : 'posts';
$left_or_right				 = ( isset( $instance[ 'left_or_right' ] ) ) ? $instance[ 'left_or_right' ] : 'left';
$box_layout					 = ( isset( $instance[ 'box_layout' ] ) ) ? $instance[ 'box_layout' ] : 'container';

for($i=1; $i<=4; $i++ ){
${'image_'.$i}				 = ( isset( $instance[ 'image_'.$i ] ) ) ? $instance[ 'image_'.$i ] : '';
${'image_description_'.$i}	 = ( isset( $instance[ 'image_description_'.$i ] ) ) ? $instance[ 'image_description_'.$i ] : '';
${'icon_'.$i}			 = ( isset( $instance[ 'icon_'.$i ] ) ) ? $instance[ 'icon_'.$i ] : '';
${'icon_color_'.$i}		 = ( isset( $instance[ 'icon_color_'.$i ] ) ) ? $instance[ 'icon_color_'.$i ] : '';
${'icon_container_'.$i}  	 = ( isset( $instance[ 'icon_container_'.$i ] ) ) ? $instance[ 'icon_container_'.$i ] : '';
${'url_'.$i}					 = ( isset( $instance[ 'url_'.$i ] ) ) ? $instance[ 'url_'.$i ] : '';

${'category_'.$i} = ( isset( $instance[ 'category_'.$i ] ) ) ? $instance[ 'category_'.$i ] : 'No categories';
if ( ${'category_'.$i} != 'No categories' ) {
    ${'args_'.$i} = array( 'numberposts' => 1, 'cat' => ${'category_'.$i} );
} else {
    ${'args_'.$i} = array( 'numberposts' => 1 );
}

${'recent_posts'.$i} = wp_get_recent_posts( ${'args_'.$i} ); // type = array

${'post_image_'.$i}        = wp_get_attachment_url( get_post_thumbnail_id( ${'recent_posts'.$i}[ 0 ][ 'ID' ] ) );
${'post_url_'.$i}          = get_post_permalink( ${'recent_posts'.$i}[ 0 ][ 'ID' ] );
${'post_date_ID_'.$i}      = ${'recent_posts'.$i}[ 0 ][ 'ID' ];
${'post_categories_'.$i}   = implode( ", ", wp_get_post_categories( ${'recent_posts'.$i}[ 0 ][ 'ID' ], array( 'fields' => 'names' ) ) );

}
?>

<?php if ( $what_to_feed == 'custom' ) { ?>

	<div class="state-home-focus">
		<div class="state-home-focus-areas">
            <?php for($i=1; $i<=4; $i++ ){ ?>
			<div class="focus-area"  style="background-image: url(<?php echo ${'image_'.$i}; ?>);">
				<a class="focus-button" href="<?php echo ${'url_'.$i} ?>">
					<div class="focus-inner">
						<div class="focus-icon">
							<!-- ngInclude: icon --><span class="focus-icon-image ng-scope" ng-include="icon"><!--?xml version="1.0" encoding="utf-8"?-->
								<span class="icon" version="1.1" id="Layer_1" style="enable-background:new 0 0 37.2 45.9;">
									<i class="<?php echo ${'icon_container_'.$i}; ?> fa-3x"></i>
								</span>
							</span> </div>
						<div class="focus-text h3 ng-binding" ><?php echo ${'image_description_'.$i}; ?></div>
					</div>
					<div class="focus-tint"></div>
				</a>
			</div>
            <?php } ?>
		</div>
	</div>
<?php } else { // warunek dla custom ?> 
	<div class="state-home-focus">
		<div class="state-home-focus-areas">
			<?php for($i=1; $i<=4; $i++ ){
                        $categories  = get_the_category( ${'post_date_ID_'.$i} );   // get the categories for current post in the LOOP (array)
                        $cat         = $categories[ 0 ];   // selects first of the categories
                        $id          = $cat->term_id;
                        $slug        = $cat->slug;  // gets category id for $url and for select to wpdb
                        $url         = get_category_link( $id );
                        if ( array_key_exists( 'color', $category[ $slug ] ) ) {
                            $color = $category[ $slug ][ 'color' ];
                        } else {
                            $color = "#607d8b";
                        }
                        if ( array_key_exists( 'icon', $category[ $slug ] ) ) {
                            $icon = $category[ $slug ][ 'icon' ];
                        } else {
                            $icon = "fa fa-font-awesome";
                        }
                        if ( array_key_exists( 'cat_name', $category[ $slug ] ) ) {
                            $name = $category[ $slug ][ 'cat_name' ];
                        } else {
                            $name = "";
                        }

			?>
			<div class="focus-area" style="background-image: url(<?php echo ${'post_image_'.$i}; ?>);">
				<a class="focus-button" href="<?php ${'post_url_'.$i}  ?>">
					<div class="focus-inner">
						<div class="focus-icon">
							<!-- ngInclude: icon --><span class="focus-icon-image ng-scope"><!--?xml version="1.0" encoding="utf-8"?-->
								<span class="icon" version="1.1" id="Layer_1"  style="enable-background:new 0 0 37.2 45.9;">
									<i class="<?php echo $icon; ?> fa-3x"></i>
								</span>
							</span> </div>
						<div class="focus-text h3 ng-binding"><?php echo $name; ?></div>
					</div>
					<div class="focus-tint"></div>
				</a>
			</div>
            <?php } ?>
		</div>
	</div>
<?php } ?>