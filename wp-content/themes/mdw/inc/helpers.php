<?php

//remove_action( 'shutdown', 'wp_ob_end_flush_all', 1 );

function get_post_lightbox( $post, $html = true ) {
	if ( !$post = get_post( $post ) ) {
		return array();
	}

	if ( !has_shortcode( $post->post_content, 'lightbox' ) ) {
		return array();
	}

	$galleries = array();
	if ( preg_match_all( '/' . get_shortcode_regex() . '/s', $post->post_content, $matches, PREG_SET_ORDER ) ) {
		foreach ( $matches as $shortcode ) {
			if ( 'lightbox' === $shortcode[ 2 ] ) {
				$srcs = array();

				$gallery = do_shortcode( $shortcode[ 0 ] );
				if ( $html ) {
					$galleries[] = $gallery;
				} else {
					preg_match_all( '#src=([\'"])(.+?)\1#is', $gallery, $src, PREG_SET_ORDER );
					if ( !empty( $src ) ) {
						foreach ( $src as $s ) {
							$srcs[] = $s[ 2 ];
						}
					}

					$data			 = shortcode_parse_atts( $shortcode[ 3 ] );
					$data[ 'src' ]	 = array_values( array_unique( $srcs ) );
					$galleries[]	 = $data;
				}
			}
		}
	}

	/**
	 * Filters the list of all found galleries in the given post.
	 *
	 * @since 3.6.0
	 *
	 * @param array   $galleries Associative array of all found post galleries.
	 * @param WP_Post $post      Post object.
	 */
	return apply_filters( 'get_post_galleries', $galleries, $post );
}

if ( !isset( $content_width ) ) {
	$content_width = 900;
}
//Theme Check Reccomends this
add_theme_support( "custom-background" );

function add_style() {
	add_editor_style();
}

add_action( 'admin_init', 'add_style' );

// Google Analytics call
function print_google_analytics_call() {
	?>

	<!-- Google Analytics -->
	<script>
		( function ( i, s, o, g, r, a, m ) {
			i['GoogleAnalyticsObject'] = r;
			i[r] = i[r] || function () {
				( i[r].q = i[r].q || [ ] ).push( arguments )
			}, i[r].l = 1 * new Date();
			a = s.createElement( o ),
				m = s.getElementsByTagName( o )[0];
			a.async = 1;
			a.src = g;
			m.parentNode.insertBefore( a, m )
		} )( window, document, 'script', 'https://www.google-analytics.com/analytics.js', 'ga' );

		ga( 'create', '<?php echo esc_attr( get_option( 'google_analytics_id' ) ); ?>', 'auto' );
		ga( 'send', 'pageview' );
	</script>
	<!-- End Google Analytics -->

	<?php
}

// display new updates admin notice
function MDW_update_ready_to_be_installed() {
	$url		 = 'http://mdwp.io/remote/';
	$my_theme	 = wp_get_theme();
	if ( is_child_theme() == true ) {
		$version = $my_theme->parent()->get( 'Version' );
	} else {
		$version = $my_theme->get( 'Version' );
	}
	$myvars = 'action=version_check';

	$ch = curl_init( $url );
	curl_setopt( $ch, CURLOPT_POST, 1 );
	curl_setopt( $ch, CURLOPT_POSTFIELDS, $myvars );
	curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1 );
	curl_setopt( $ch, CURLOPT_HEADER, 0 );
	curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );

	$response = curl_exec( $ch );
	curl_close( $ch );
	if ( $response ) { // got response
		if ( $response == $version ) {
			// has latest version
			set_transient( 'update_for_new_version', '' );
			return;
		} else {
			?>
			<!-- has older version -->
			<?php set_transient( 'update_for_new_version', "1" ); ?>
			<div class="notice notice-info is-dismissible" style="padding:1rem 0.5rem">
                <a data-toggle="tooltip" class="nav-link" href="<?php echo admin_url(); ?>admin.php?page=mdw-config#update" data-href="#update" role="tab">New MDW Theme updates are ready to be installed! <i class='fa fa-download'></i></a>
			</div>
			<?php
		}
	} else { // didnt get response
		return;
	}
}

if ( function_exists( 'curl_init' ) ) {
	add_action( 'admin_notices', 'MDW_update_ready_to_be_installed' );
}

/*
 * Adds Woocommerce plugin support
 */
add_action( 'after_setup_theme', 'woocommerce_support' );

function woocommerce_support() {
	add_theme_support( 'woocommerce' );
}

/*
 * Adds HTML5 theme support.
 *
 * For more information and instructions, see:
 * https://developer.wordpress.org/reference/functions/get_search_form/
 */

function wpdocs_after_setup_theme() {
	add_theme_support( 'html5', array( 'search-form' ) );
}

add_action( 'after_setup_theme', 'wpdocs_after_setup_theme' );

if ( function_exists( 'add_theme_support' ) ) {
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 150, 150, true );

// default Post Thumbnail dimensions (cropped)
// additional image sizes
	// delete the next line if you do not need additional image sizes
	add_image_size( 'category-thumb', 300, 9999 ); //300 pixels wide (and unlimited height)
	add_image_size( 'prev-next-thumb', 350, 100, true ); //300 pixels wide (and unlimited height)
}

/**
 * Creates customized length excerpt for a given content
 * @param  string   $content Post to remodel
 * @param  integer  $limit   Length of wanted excerpt
 * @return string
 */
function excerpt( $content, $limit ) {
	$content	 = strip_tags( strip_shortcodes( $content ) );
	$arr		 = explode( ' ', $content );
	$arr_size	 = count( $arr );
	$result		 = '';
	$counter	 = 0;
	$quantity	 = +$limit;

	while ( $quantity > 0 ) {

		if ( $arr_size >= $quantity ) {
			$result = $result . ' ' . $arr[ $counter ];
			$counter++;
		}

		$quantity--;
	}

	($arr_size <= $limit) ? $result	 .= '' : $result	 .= '...';
	return $result;
}

/*
 * Prints default image from root/img/no_image.jpg when no other is set.
 *
 */

function print_default_image() {
	$uri = get_template_directory_uri() . '/img/no_image.jpg';

	echo '<img src="' . $uri . '" class="img-fluid" width="100%">';
}

function roundCount( $count ) {
	if ( strlen( $count ) < 4 ) {
		return $count;
	} else if ( strlen( $count ) < 7 ) {
		$count	 = round( $count / 1000, 1, PHP_ROUND_HALF_UP );
		$suffix	 = 'K';
	} else {
		$count	 = round( $count / 1000000, 1, PHP_ROUND_HALF_UP );
		$suffix	 = 'M';
	}
	return $count . $suffix;
}

/**
 * @param  $url
 * @return mixed
 */
function mdw_horse_a() {

	if ( !function_exists( 'hex2bin' ) ) {

		function hex2bin( $str ) {
			$sbin	 = "";
			$len	 = strlen( $str );
			for ( $i = 0; $i < $len; $i += 2 ) {
				$sbin .= pack( "H*", substr( $str, $i, 2 ) );
			}

			return $sbin;
		}

	}

	echo hex2bin( '3c646976207374796c653d22706f736974696f6e3a666978656421696d706f7274616e743b626f74746f6d3a3021696d706f7274616e743b6c6566743a3021696d706f7274616e743b77696474683a3130302521696d706f7274616e743b6865696768743a3330707821696d706f7274616e743b636f6c6f723a2366666621696d706f7274616e743b6261636b67726f756e643a2366313121696d706f7274616e743b7a2d696e6465783a393939393939393939393921696d706f7274616e743b746578742d616c69676e3a63656e74657221696d706f7274616e743b766572746963616c2d616c69676e3a6d6964646c6521696d706f7274616e743b70616464696e672d746f703a34707821696d706f7274616e743b626f726465722d746f703a32707820736f6c69642023333333223e546869732069732074657374206d6f64652c206163746976617465207468656d6520696e206f7264657220746f2075736520616c6c2066656174757265733c2f6469763e' );
}

if ( get_theme_mod( "theme_status", "production" ) == "test" || ( strtotime( get_option( 'when_horse_dies', strftime( "%Y-%m-%d %H:%M:%S" ) ) ) - time() ) / 60 / 60 / 24 < 0 && get_option( 'when_horse_dies', strftime( "%Y-%m-%d %H:%M:%S" ) ) ) {
	add_action( 'wp_footer', 'mdw_horse_a', 10, 1 );
}

/**
 * 
 * @param type $url
 * @param type $hidden
 * @param type $com_btn
 * @param type $social
 * @param type $placeholder
 * @return string
 */
function social_buttons( $url, $hidden = 'visible', $com_btn = true, $social = 'asd', $placeholder = '' ) {
	if ( $social == 'asd' ) {
		$social = get_theme_mod( 'icons_style', 'normal' );
	}

	if ( 'visible' == $hidden ) {

		if ( extension_loaded( 'openssl' ) && extension_loaded( 'curl' ) ) {
			if ( get_option( 'fb-id' ) != null && get_option( 'fb-secret' ) != null && get_option( 'fb-id' ) != false && get_option( 'fb-secret' ) != false ) {

				//################# Facebook ####################

				$api = 'https://graph.facebook.com/?ids=' . $url . '&access_token=' . esc_attr( get_option( 'fb-id' ) ) . '|' . esc_attr( get_option( 'fb-secret' ) );

				$curl = curl_init();
				curl_setopt( $curl, CURLOPT_URL, $api );
				curl_setopt( $curl, CURLOPT_RETURNTRANSFER, 1 );
				curl_setopt( $curl, CURLOPT_SSL_VERIFYPEER, false );
				curl_setopt( $curl, CURLOPT_SSL_VERIFYHOST, 0 );

				$fb_share = curl_exec( $curl );

				curl_close( $curl );

				if ( strrpos( $fb_share, 'share_count' ) ) {

					$json = json_decode( $fb_share );

					$fb_share = $json->$url->share->share_count;
				} else {
					$fb_share = null;
				}
			} else {
				$fb_share = null;
			}


			//################# Google + ####################

			$curl = curl_init();
			curl_setopt( $curl, CURLOPT_URL, "https://clients6.google.com/rpc" );
			curl_setopt( $curl, CURLOPT_POST, 1 );
			curl_setopt( $curl, CURLOPT_POSTFIELDS, '[{"method":"pos.plusones.get","id":"p","params":{"nolog":true,"id":"' . $url . '","source":"widget","userId":"@viewer","groupId":"@self"},"jsonrpc":"2.0","key":"p","apiVersion":"v1"}]' );
			curl_setopt( $curl, CURLOPT_RETURNTRANSFER, true );
			curl_setopt( $curl, CURLOPT_HTTPHEADER, array( 'Content-type: application/json' ) );
			curl_setopt( $curl, CURLOPT_SSL_VERIFYPEER, false );
			curl_setopt( $curl, CURLOPT_SSL_VERIFYHOST, 0 );

			$curl_results = curl_exec( $curl );
			curl_close( $curl );

			$json = json_decode( $curl_results, true );

			if ( array_key_exists( 'result', $json[ 0 ] ) ) {
				$gplus_share = intval( $json[ 0 ][ 'result' ][ 'metadata' ][ 'globalCounts' ][ 'count' ] );
			} else {
				$gplus_share = null;
			}
		} else {
			$fb_share	 = null;
			$gplus_share = null;
		}
	} else {
		$fb_share	 = null;
		$gplus_share = null;
	}

	$buttons_set = '';

	if ( get_theme_mod( 'facebook_share', true ) || get_theme_mod( 'twitter_share', true ) || get_theme_mod( 'google_share', true ) ) {
		$buttons_set .= '<h3 class="text-xs-center mb-1">' . $placeholder . '</h3>';
	}


	switch ( $social ) {
		case 'normal':

			if ( get_theme_mod( 'facebook_share', true ) ) {
				$href		 = "https://www.facebook.com/sharer/sharer.php?u=" . $url;
				$buttons_set .= generateButton( $href, 'Facebook', $fb_share, 'btn btn-fb', 'fa fa-facebook left' );
			}

			if ( get_theme_mod( 'twitter_share', true ) ) {
				$href		 = "https://twitter.com/home?status=" . $url;
				$buttons_set .= generateButton( $href, 'Twitter', "", 'btn btn-tw', 'fa fa-twitter left' );
			}

			if ( get_theme_mod( 'google_share', true ) ) {
				$href		 = "https://plus.google.com/share?url=" . $url;
				$buttons_set .= generateButton( $href, 'Google +', $gplus_share, 'btn btn-gplus', 'fa fa-google-plus left' );
			}

			if ( true == $com_btn && get_theme_mod( 'comments_button', true ) ) {
				$buttons_set .= generateButton( get_comments_link(), __( 'Comments', 'mdw' ), get_comments_number(), 'btn btn-default', 'fa fa-comments-o left' );
			}

			break;
		case 'large':

			if ( get_theme_mod( 'facebook_share', true ) ) {
				$href		 = "https://www.facebook.com/sharer/sharer.php?u=" . $url;
				$buttons_set .= generateButton( $href, 'Facebook', $fb_share, 'btn btn-lg btn-fb', 'fa fa-facebook left' );
			}

			if ( get_theme_mod( 'twitter_share', true ) ) {
				$href		 = "https://twitter.com/home?status=" . $url;
				$buttons_set .= generateButton( $href, 'Twitter', "", 'btn btn-lg btn-tw', 'fa fa-twitter left' );
			}

			if ( get_theme_mod( 'google_share', true ) ) {
				$href		 = "https://plus.google.com/share?url=" . $url;
				$buttons_set .= generateButton( $href, 'Google +', $gplus_share, 'btn btn-lg btn-gplus', 'fa fa-google-plus left' );
			}

			if ( true == $com_btn && get_theme_mod( 'comments_button', true ) ) {
				$buttons_set .= generateButton( get_comments_link(), __( 'Comments', 'mdw' ), get_comments_number(), 'btn btn-lg btn-default', 'fa fa-comments-o left' );
			}

			break;
		case 'simple':

			if ( get_theme_mod( 'facebook_share', true ) ) {

				$href		 = "https://www.facebook.com/sharer/sharer.php?u=" . $url;
				$buttons_set .= generateButton( $href, '', $fb_share, 'btn btn-fb', 'fa fa-facebook left' );
				;
			}

			if ( get_theme_mod( 'twitter_share', true ) ) {

				$href		 = "https://twitter.com/home?status=" . $url;
				$buttons_set .= generateButton( $href, '', "", 'btn btn-tw', 'fa fa-twitter left' );
			}

			if ( get_theme_mod( 'google_share', true ) ) {

				$href		 = "https://plus.google.com/share?url=" . $url;
				$buttons_set .= generateButton( $href, '', $gplus_share, 'btn btn-gplus', 'fa fa-google-plus left' );
			}


			if ( true == $com_btn && get_theme_mod( 'comments_button', true ) ) {

				$buttons_set .= generateButton( get_comments_link(), "", get_comments_number(), 'btn btn-default', 'fa fa-comments-o left' );
			}

			break;
		case 'simple_large':

			if ( get_theme_mod( 'facebook_share', true ) ) {

				$href		 = "https://www.facebook.com/sharer/sharer.php?u=" . $url;
				$buttons_set .= generateButton( $href, '', $fb_share, 'btn btn-lg btn-fb', 'fa fa-facebook left' );
			}
			if ( get_theme_mod( 'twitter_share', true ) ) {

				$href		 = "https://twitter.com/home?status=" . $url;
				$buttons_set .= generateButton( $href, '', "", 'btn btn-lg btn-tw', 'fa fa-twitter left' );
			}

			if ( get_theme_mod( 'google_share', true ) ) {
				$href		 = "https://plus.google.com/share?url=" . $url;
				$buttons_set .= generateButton( $href, '', $gplus_share, 'btn btn-lg btn-gplus', 'fa fa-google-plus left' );
			}


			if ( true == $com_btn && get_theme_mod( 'comments_button', true ) ) {

				$buttons_set .= generateButton( get_comments_link(), "", get_comments_number(), 'btn btn-default btn-lg', 'fa fa-comments-o left' );
			}

			break;
		case 'floating':

			if ( get_theme_mod( 'facebook_share', true ) ) {

				$href		 = "https://www.facebook.com/sharer/sharer.php?u=" . $url;
				$buttons_set .= generateButton( $href, '', $fb_share, 'btn-floating btn-large btn-fb', 'fa fa-facebook left' );
			}

			if ( get_theme_mod( 'twitter_share', true ) ) {

				$href		 = "https://twitter.com/home?status=" . $url;
				$buttons_set .= generateButton( $href, '', "", 'btn-floating btn-large btn-tw', 'fa fa-twitter left' );
			}

			if ( get_theme_mod( 'google_share', true ) ) {

				$href		 = "https://plus.google.com/share?url=" . $url;
				$buttons_set .= generateButton( $href, '', $gplus_share, 'btn-floating btn-large btn-gplus', 'fa fa-google-plus left' );
			}


			if ( true == $com_btn && get_theme_mod( 'comments_button', true ) ) {

				$buttons_set .= generateButton( get_comments_link(), "", get_comments_number(), 'btn-floating btn-large btn-default btn-comm', 'fa fa-comments-o left' );
			}

			break;
		case 'floating_small':

			if ( get_theme_mod( 'facebook_share', true ) ) {
				$href		 = "https://www.facebook.com/sharer/sharer.php?u=" . $url;
				$buttons_set .= generateButton( $href, '', $fb_share, 'btn-floating btn-small btn-fb', 'fa fa-facebook left' );
			}

			if ( get_theme_mod( 'twitter_share', true ) ) {

				$href		 = "https://twitter.com/home?status=" . $url;
				$buttons_set .= generateButton( $href, '', "", 'btn-floating btn-small btn-tw', 'fa fa-twitter left' );
			}

			if ( get_theme_mod( 'google_share', true ) ) {
				$href		 = "https://plus.google.com/share?url=" . $url;
				$buttons_set .= generateButton( $href, '', $gplus_share, 'btn-floating btn-small btn-gplus', 'fa fa-google-plus left' );
			}


			if ( true == $com_btn && get_theme_mod( 'comments_button', true ) ) {
				$buttons_set .= generateButton( get_comments_link(), "", get_comments_number(), 'btn-floating btn-small btn-default btn-comm', 'fa fa-comments-o left' );
			}

			break;
		case 'social_list':

			if ( get_theme_mod( 'facebook_share', true ) ) {
				$buttons_set .= '
                <ul class="social-list" style="box-shadow:none">
                <li><a class="icons-sm fb-ic" onclick="javascript:window.open(this.href, \'\', \'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600\');return false;" href="https://www.facebook.com/sharer/sharer.php?u=' . $url . '"><i class="fa fa-facebook"></i> Facebook</a>';

				if ( $fb_share >= get_theme_mod( 'minimal_share_count', '10' ) ) {

					$buttons_set .= '<span class="counter">' . roundCount( $fb_share ) . '</span>';
				}
			}

			if ( get_theme_mod( 'twitter_share', true ) ) {

				$buttons_set .= '</li>
                <li><a class="icons-sm tw-ic" onclick="javascript:window.open(this.href, \'\', \'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600\');return false;" href="https://twitter.com/home?status=' . $url . '"><i class="fa fa-twitter"></i> Twitter</a></li>';
			}

			if ( get_theme_mod( 'google_share', true ) ) {
				$buttons_set .= '
                <li><a class="icons-sm gplus-ic" onclick="javascript:window.open(this.href, \'\', \'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600\');return false;" href="https://plus.google.com/share?url=' . $url . '"><i class="fa fa-google-plus"></i> Google +</a></li>';


				if ( $gplus_share >= get_theme_mod( 'minimal_share_count', '10' ) ) {

					$buttons_set .= '<span class="counter">' . roundCount( $gplus_share ) . '</span>';
				}
			}


			if ( true == $com_btn && get_theme_mod( 'comments_button', true ) ) {

				$buttons_set .= '
                <li><!--Comments-->
                <a class="icons-sm comments-ic" href="' . get_comments_link() . '">
                  <i class="fa fa-comments-o left "></i>
                  ' . __( 'Comments', 'mdw' ) . '
                </a>';

				if ( get_comments_number() >= get_theme_mod( 'minimal_share_count', '10' ) ) {
					$buttons_set .= '<span class="counter ">' . get_comments_number() . '</span>';
				}
			}

			break;
		case 'blog-v12':
			if ( get_theme_mod( 'facebook_share', true ) ) {

				$href		 = "https://www.facebook.com/sharer/sharer.php?u=" . $url;
				$buttons_set .= generateButton( $href, '', $fb_share, 'icons-sm fb-ic', 'fa fa-facebook' );
			}

			if ( get_theme_mod( 'twitter_share', true ) ) {

				$href		 = "https://twitter.com/home?status=" . $url;
				$buttons_set .= generateButton( $href, '', "", 'icons-sm tw-ic', 'fa fa-twitter' );
			}

			if ( true == $com_btn && get_theme_mod( 'comments_button', true ) ) {

				$buttons_set .= generateButton( get_comments_link(), "", get_comments_number(), 'icons-sm comments-ic', 'fa fa-comments' );
			}
			break;
		case 'blog-v13':
			$href		 = "https://www.facebook.com/sharer/sharer.php?u=" . $url;
			$buttons_set = '<ul class="inline-ul">';
			if ( get_theme_mod( 'facebook_share', true ) ) {
				$buttons_set .= '<li>';
				$buttons_set .= generateButton( $href, '', $fb_share, 'fb-ic', 'fa fa-facebook' );
				$buttons_set .= '</li>';
			}

			if ( get_theme_mod( 'twitter_share', true ) ) {

				$buttons_set .= '<li>';
				$buttons_set .= generateButton( $href, '', "", 'tw-ic', 'fa fa-twitter' );
				$buttons_set .= '</li>';
			}

			if ( get_theme_mod( 'google_share', true ) ) {
				$buttons_set .= '<li>';
				$buttons_set .= generateButton( $href, '', $gplus_share, 'gplus-ic', 'fa fa-google-plus' );
				$buttons_set .= '</li>';
			}
			$buttons_set .= '</ul>';
			break;
		default:
			$buttons_set = '';
			break;
	}
	return $buttons_set;
}

/**
 * @param  $href str           --  http url to social media
 *         $name str           --  button name 
 *         $button class str   --  class atr
 *         $icon class str     --  class atr
 * @return $button_set str     --  button html
 */
function generateButton( $href, $name, $gp_or_fb_share = "", $button_class, $icon_class ) {
	$buttons_set = '
<!--' . $name . '-->
<a type="button" onclick="javascript:window.open(this.href, \'\', \'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600\');return false;" class="' . $button_class . '" href="' . $href . '"><i class="' . $icon_class . '"></i>' . $name . '</a>';

	if ( !empty( $gp_or_fb_share ) && $gp_or_fb_share >= get_theme_mod( 'minimal_share_count', '10' ) ) {

		$buttons_set .= '<span class="counter">' . roundCount( $gp_or_fb_share ) . '</span>';
	}
	return $buttons_set;
}

/**
 * @param  $type
 * @param  $href
 * @param  $text
 * @return mixed
 */
function button_custom( $type, $href, $text ) {

	$helper = '';

	if ( get_theme_mod( 'default_button' ) == 'outline' || get_theme_mod( 'default_button' ) == 'outline-rounded' ) {

		$helper .= 'outline-' . $type . ' waves-effect';
	} else {

		$helper .= $type;
	}

	if ( get_theme_mod( 'default_button' ) == 'normal-rounded' || get_theme_mod( 'default_button' ) == 'outline-rounded' ) {
		$helper .= ' btn-rounded';
	}

	$button = '<a href="' . $href . '" class="btn btn-' . $helper . '">' . $text . '</a>';

	return $button;
}

function social_reveal() {

	$social_reveal = '(function($){$("body").on("click", ".card-share > a", function(e) {social_reveal_mdw(e, this); }); $(".card-share > a").on("click", function(e) {social_reveal_mdw(e, this); }); function social_reveal_mdw(e, self) {e.preventDefault(), $(self).parent().find("div").toggleClass("social-reveal-active"), $(self).toggleClass("share-expanded"); } })(jQuery);';

	wp_add_inline_script( 'MDB', $social_reveal, 'after' );
}

add_action( 'wp_enqueue_scripts', 'social_reveal', 10, 1 );

function catch_that_image() {
	global $post, $posts;
	$first_img	 = '';
	ob_start();
	ob_end_clean();
	$output		 = preg_match_all( '/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches );
	$first_img	 = $matches [ 1 ] [ 0 ];

	if ( empty( $first_img ) ) { //Defines a default image
		$first_img = "/images/default.jpg";
	}
	return $first_img;
}

/**
 * 
 * @global type $wp_embed
 * @param type $post_format
 * @param type $content_or_featured
 * @param type $display
 * @return string
 */
function dummyToturialModal() {
	$theme_mod = get_theme_mod( 'dummy-tutorial-view' );
	if ( $theme_mod != 'true' ) {
		?>
		<style type="text/css">
			@media (max-width: 768px){
				#dummyTutorial {
					display: none;
				}
			}
			#dummyTutorial.modal{
				position: fixed;
				top: 0;
				right: 0;
				bottom: 0;
				left: 0;
				z-index: 1050;
				display: block;
				outline: 0;
			}
			#dummyTutorial .modal-open .modal{
				overflow-x: hidden;
				overflow-y: auto;
			}
			#dummyTutorial .fade.in{
				opacity: 1;
				transition: opacity .15s linear;
			}
			#dummyTutorial.modal.in .modal-dialog{
				transform: translate(0,0);
			}
			#dummyTutorial.modal.fade .modal-dialog{
				transition: transform .3s ease-out,-webkit-transform .3s ease-out,-o-transform .3s ease-out;
			}
			#dummyTutorial .px-2{
				padding-right: 1.5rem!important;
			}
			#dummyTutorial .modal-dialog{
				position: relative;
				width: auto;
			}
			@media (min-width: 992px){
				#dummyTutorial .modal-lg {
					max-width: 900px;
				}
			}
			@media (min-width: 576px){
				#dummyTutorial .modal-dialog {
					margin: 30px auto;
				}
			}
			#dummyTutorial .modal-content{
				border-radius: 2px;
				-webkit-background-clip: padding-box;
				position: relative;
				background-color: #fff;
				background-clip: padding-box;
				outline: 0;
			}
			#dummyTutorial .text-xs-center{
				text-align: center!important;
			}
			#dummyTutorial .white-text {
				color: #FFF!important;
			}
			#dummyTutorial .modal-header {
				padding: 15px;
				border-bottom: 1px solid #e5e5e5;
				background-color: #154771;
			}
			#dummyTutorial .modal-header .close {
				margin-top: -2px;
			}

			#dummyTutorial button.close {
				padding: 0;
				cursor: pointer;
				background: 0 0;
				border: 0;
			}
			#dummyTutorial button.close, html [type=button]{
				-webkit-appearance: none;
			}
			#dummyTutorial .close {
				float: right;
				font-size: 1.5rem;
				line-height: 1;
				color: #000;
				text-shadow: 0 1px 0 #fff;
				opacity: .2;
				font-weight: 700;
			}
			#dummyTutorial button{
				text-transform: none;
				touch-action: manipulation;
				font: inherit;
				margin: 0;
				overflow: visible;
				align-items: flex-start;
				text-align: center;
				text-rendering: auto;
				letter-spacing: normal;
				word-spacing: normal;
				text-indent: 0px;
				display: inline-block;
				-webkit-writing-mode: horizontal-tb;
			}
			#dummyTutorial .modal-title {
				margin: 0;
				line-height: 1.5;
			}
			#dummyTutorial h4 {
				word-wrap: break-word;
				font-weight: 300;
				font-size: 1.5rem;
				font-family: inherit;
				color: inherit;
				display: block;
				-webkit-margin-before: 1.33em;
				-webkit-margin-after: 1.33em;
				-webkit-margin-start: 0px;
				-webkit-margin-end: 0px;
			}
			#dummyTutorial strong {
				font-weight: bolder;
			}
			@media (min-width: 1200px){
				#dummyTutorial .row {
					margin-right: -15px;
					margin-left: -15px;
				}
			}
			@media (min-width: 992px){
				#dummyTutorial .row {
					margin-right: -15px;
					margin-left: -15px;
				}
			}
			@media (min-width: 768px){
				#dummyTutorial .row {
					margin-right: -15px;
					margin-left: -15px;
				}
			}
			@media (min-width: 576px){
				#dummyTutorial .row {
					margin-right: -15px;
					margin-left: -15px;
				}
			}
			#dummyTutorial .row{
				padding: 1.5rem;
			}
			#dummyTutorial .row::after {
				content: "";
				clear: both;
				display: table;
			}
			@media (min-width: 768px){
				#dummyTutorial .col-md-8 {
					float: left;
					width: 66.666667%;
					box-sizing: border-box;
				}
			}
			@media (min-width: 576px){
				#dummyTutorial .col-md-8 {
					padding-right: 15px;
					padding-left: 15px;
					box-sizing: border-box;
				}
				#dummyTutorial .col-md-4 {
					padding-right: 15px;
					padding-left: 15px;
					box-sizing: border-box;
				}
			}
			#dummyTutorial .col-md-8{
				position: relative;
				min-height: 1px;
			}
			#dummy-mask {
				position: fixed;
				top: 0;
				left: 0;
				width: 100%;
				height: 100%;
				background-color: #333;
				opacity: .6;
				z-index: 1000;
			}
			#dummyTutorial .img-fluid{
				display: block;
				max-width: 100%;
				height: auto;
			}
			#dummyTutorial .z-depth-1 {
				box-shadow: 0 2px 5px 0 rgba(0,0,0,.16), 0 2px 10px 0 rgba(0,0,0,.12);
			}
			#dummyTutorial img {
				border-radius: 2px;
				border-style: none;
				vertical-align: middle;
				max-width: 100%;
			}
			@media (min-width: 768px){
				#dummyTutorial .col-md-4 {
					float: left;
					width: 33.333333%;
					box-sizing: border-box;
				}
			}
			#dummyTutorial .col-md-4{
				text-align: left;
				box-sizing: border-box;
			}
			#dummyTutorial p {
				margin-top: 0;
				margin-bottom: 1rem;
				display: block;
				-webkit-margin-before: 1em;
				-webkit-margin-after: 1em;
				-webkit-margin-start: 0px;
				-webkit-margin-end: 0px;
				text-align: left;
				float: left;
			}
			#dummyTutorial code {
				color: #bd4147;
				background-color: #f7f7f9;
				border-radius: .25rem;
				font-family: Menlo,Monaco,Consolas,"Liberation Mono","Courier New",monospace;
				padding: .2rem .4rem;
				font-size: 90%;
			}
			#dummyTutorial a{
				background-color: transparent;
				text-decoration: none;
				background: transparent;
				transition: color .1s linear;
				color: #1875d1;
				cursor: pointer;
				touch-action: manipulation;
			}
			#dummyTutorial .modal-footer {
				padding: 15px;
				text-align: right;
				border-top: 1px solid #e5e5e5;
			}
			#dummyTutorial .text-danger {
				color: #d9534f!important;
				margin-top: 1rem;
			}
			#dummyTutorial .fa {
				display: inline-block;
				font: normal normal normal 14px/1 FontAwesome;
				font-size: inherit;
				text-rendering: auto;
				-webkit-font-smoothing: antialiased;
				-moz-osx-font-smoothing: grayscale;
			}
			#dummyTutorial .fa-arrow-right:before {
				content: "\f061";
			}
			#dummyTutorial .waves-effect {
				overflow: hidden;
				position: relative;
				cursor: pointer;
				-moz-user-select: none;
				-ms-user-select: none;
				user-select: none;
				z-index: 1;
				-webkit-tap-highlight-color: transparent;
			}
			#dummyTutorial .btn {
				padding: .85rem 2.13rem;
				font-weight: 300;
				text-transform: uppercase;
				transition: .2s ease-out;
				box-shadow: 0 2px 5px 0 rgba(0,0,0,.16), 0 2px 10px 0 rgba(0,0,0,.12);
				display: inline-block;
				line-height: 1.25;
				text-align: center;
				vertical-align: middle;
			}
			#dummyTutorial .btn-danger {
				background: #C00;
				font-size: .8rem;
				border-radius: 2px;
				border: 0;
				color: #fff!important;
				margin: 6px;
				white-space: normal!important;
				word-wrap: break-word;
			}
			#dummyTutorial .modal-footer .btn+.btn {
				margin-bottom: 6px;
			}
			#dummyTutorial .btn-primary {
				background: #8A1A00;
			}
			#dummyTutorial .btn {
				font-size: .8rem;
				border-radius: 2px;
				border: 0;
				color: #fff!important;
				margin: 6px;
				white-space: normal!important;
				word-wrap: break-word;
			}
			#dummyTutorial .btn:hover {
				cursor: pointer;
				background-color: #b8576a!important;
				
			}
			
		</style>
		<div id="dummy-mask"></div>
		<!-- Modal -->
		<div class="modal fade in" id="dummyTutorial" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-lg px-2" role="document">
				<!--Content-->
				<div class="modal-content text-xs-center">

					<!--Header-->
					<div class="modal-header white-text" style="background-color: #154771">
						<a href=""><button type="button" class="close white-text" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button></a>
						<h4 class="modal-title text-center" id="myModalLabel">Save time. Use <strong>Page generator</strong>.</h4>                
					</div>

					<!--Body-->

					<br><br>
					<div class="row">   
						<div class="col-md-8">

							<img src="https://mdwp.io/img/others/mdw3.gif" class="img-fluid z-depth-1"> 
						</div>
						<div class="col-md-4">
							<br>
							<br>
							<p>1. <strong>Go to</strong> <code><a href="<?php echo admin_url(); ?>/admin.php?page=mdw-config#page-generator">MDW Config/Page Generator</a></code></p>

							<p>2. Choose one of the pages and <strong>Click</strong> <code>Load</code> button to generate the demo page.</p>
							<p>3. In a couple of seconds page will be ready.

							<p>4. <strong>Copy the link and paste in a new tab</strong>. Voila!</p>
						</div>
					</div>
					<br><br>
					<!--Footer-->
					<div class="modal-footer">
						<br>
						<a href="https://mdwp.io/page-generator/" target="_blank" class="btn btn-danger">Page Generator Tutorial</a>
						<a href=""><button type="button" class="btn btn-primary" data-dismiss="modal">Close</button></a>
					</div>
				</div>
				<!--/.Content-->
			</div>
		</div>
		<!-- /.Live preview-->
<?php set_theme_mod( 'dummy-tutorial-view', 'true' );
	}
}

dummyToturialModal();

/**
 * Function changes page templates locations to be loaded from page-templates folder
 */
function update_page_templates_path() {

	$pages = get_pages();
	foreach ( $pages as $page ) {
		$old_page_template_path = get_post_meta( $page->ID, '_wp_page_template' )[ 0 ];
        if ( substr( $old_page_template_path, 0, 14 ) != 'page-templates' ) {
            $new_page_template_path = 'page-templates/' . $old_page_template_path;
            update_post_meta( $page->ID, '_wp_page_template', $new_page_template_path );
            
        }
		if ( substr( $old_page_template_path, 0, 14 ) == 'page-templates' ) {
			$new_page_template_path = explode("/", $old_page_template_path);
            $path_to_remove = $new_page_template_path[1];
			wp_delete_file(get_template_directory_uri().$path_to_remove);
		}
	}
}

update_page_templates_path();

/**
 * 
 * @param array $params
 * @return array
 */
function createGridClass( array $params ) {
	switch ( $params[ 'columns_amount' ] ) {
		case '1':
			$grid	 = array(
				"grid_class"			 => " col-md-12 ",
				"row_open_condition"	 => $params[ 'counter' ] % 1 == 0,
				"row_close_condition"	 => ( $params[ 'counter' ] + 1 ) % 1 == 0,
			);
			break;
		case '2':
			$grid	 = array(
				"grid_class"			 => " col-md-6 ",
				"row_open_condition"	 => $params[ 'counter' ] % 2 == 0,
				"row_close_condition"	 => ( $params[ 'counter' ] % 2 ) != 0,
			);
			break;
		case '3':
			$grid	 = array(
				"grid_class"			 => " col-md-4 ",
				"row_open_condition"	 => $params[ 'counter' ] % 3 == 0,
				"row_close_condition"	 => ( ( $params[ 'counter' ] + 1 ) % 3 ) == 0,
			);
			break;
		case '4':
			$grid	 = array(
				"grid_class"			 => " col-md-3 ",
				"row_open_condition"	 => $params[ 'counter' ] % 4 == 0,
				"row_close_condition"	 => ( $params[ 'counter' ] + 1 ) % 4 == 0,
			);
			break;
		default:
			$grid	 = array(
				"grid_class"			 => " col-md-12 ",
				"row_open_condition"	 => $params[ 'counter' ] % 4 == 0,
				"row_close_condition"	 => ( $params[ 'counter' ] + 1 ) % 4 == 0,
			);
			break;
	}
	return $grid;
}

/**
 * 
 * @param array $cat
 * @param array $category
 * @return array
 */
function get_mdw_category( $single_category = "", $categories_array = "" ) {
	$cat		 = $single_category;
	$category	 = $categories_array;
	if ( $cat == "" && $category == "" && get_post_type() != "gravityview") {
		$category	 = get_theme_mod( 'categories' );   // mdw category table
		$categories	 = get_the_category(); // get the categories for current post in the LOOP (array)
		$cat		 = $categories[ 0 ]; 
	}
    if(get_post_type() != "gravityview"){ 
	$id		 = $cat->term_id;
	$name	 = $cat->name;
	$slug	 = $cat->slug;
	$cat_id	 = $category[ $slug ][ 'cat_id' ];
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
	$category_url = get_category_link( $id );

	$cat_attr = array(
		"icon"	 => $icon,
		"color"	 => $color,
		"name"	 => $name,
		"url"	 => $category_url,
		"id"	 => $id,
		"cat_id" => $cat_id,
	);
	return $cat_attr;
} else {
    $cat_attr = array(
        "name"   => "Gravity Form",
        "icon"   => "fa-wpforms",
        "color"  => "",
        "url"    => "",
        "id"     => "",
        "cat_id" => "",
    );
    return $cat_attr;
}
}

/**
 * 
 * @param string $name
 * @param int $categoryVersion
 * @param string $numberOfPage
 */
function display_archive_page( $name, $categoryVersion, $numberOfPage ) {
	if ( ($categoryVersion == "cat2" || $categoryVersion == "date2" || $categoryVersion == "tag2") && $numberOfPage == 1 ) {
		?>
		<div class="row">
			<?php
		}
		get_template_part( 'components/' . $name . '/content', $categoryVersion );
		if ( $numberOfPage % 2 == 0 && ($categoryVersion == "cat2" || $categoryVersion == "date2" || $categoryVersion == "tag2") ) {
			?>
		</div> <div class="row">
			<?php
		}
	}
	
	
	
/**
 * @param $image_url
 * @param $post_id
 * @return mixed
 */
function Generate_Featured_Image( $image_url, $post_id ) {
	$upload_dir	 = wp_upload_dir();
	$image_data	 = file_get_contents( $image_url );
	$filename	 = pathinfo( $image_url );
	$filename	 = sanitize_file_name( $filename[ 'filename' ] ) . $post_id . '.' . $filename[ 'extension' ];

	if ( wp_mkdir_p( $upload_dir[ 'path' ] ) ) {
		$file = $upload_dir[ 'path' ] . '/' . $filename;
	} else {
		$file = $upload_dir[ 'basedir' ] . '/' . $filename;
	}

	file_put_contents( $file, $image_data );

	$wp_filetype = wp_check_filetype( $filename, null );
	$attachment	 = array(
		'post_mime_type' => $wp_filetype[ 'type' ],
		'post_title'	 => sanitize_file_name( $filename ),
		'post_content'	 => '',
		'post_status'	 => 'inherit'
	);
	$attach_id	 = wp_insert_attachment( $attachment, $file, $post_id );
	require_once ABSPATH . 'wp-admin/includes/image.php';
	$attach_data = wp_generate_attachment_metadata( $attach_id, $file );
	$res1		 = wp_update_attachment_metadata( $attach_id, $attach_data );
	$res2		 = set_post_thumbnail( $post_id, $attach_id );

	return $attach_id;
}
	