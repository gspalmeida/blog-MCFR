<?php
/*
 * Post format creator
 */

/**
 * adds custom posts format
 */
function add_post_formats() {
	add_theme_support( 'post-formats', array( 'video', 'gallery', 'quote', 'aside', 'image', 'link', 'audio', 'chat' ) ); // 
}

add_action( 'after_setup_theme', 'add_post_formats', 20 );

/**
 * 
 * @param str $post_format
 * @return string
 */
function post_format_content( $post_format ) {
	$format = "";
	if ( $post_format == 'quote' ) {
		createPostFormatQuoteContent();
	} else if ( $post_format == 'gallery' && is_single() ) {
		$format .= galleryPostFormatContent( $format );
	} else if ( $post_format == 'audio' ) {
        $format .= contentWithoutShortcodeAudio( $format );
    }else if ( $post_format == 'video' ) {
		$format .= contentWithoutShortcodeVideo($format);
	} else if ( $post_format == 'chat' ) {
		my_format_chat_content( the_content() );
	} else {
		the_content();
	}
	return $format;
}

/**
 * 
 * @global type $wp_embed
 * @param type $post_format
 * @param type $content_or_featured
 * @param type $display
 * @return string
 */
function posts_format( $post_format, $content_or_featured, $display = "yes" ) {
	$format = "";
	if ( $display == "yes" ) {
		if ( $post_format == 'gallery' ) {
			$format .= creatPostFormatGallery( $format );
		} else if ( $post_format == 'image' ) {
			$format .= createPostFormatImage( $format );
		} else if ( $post_format == 'video' ) {
			$format .= createPostFormatVideo( $format );
		} else if ( $post_format == 'audio' ) {
			$format .= createPostFormatAudio( $format );
		} else if ( $post_format == 'link' ) {
			createPostFormatLink();
		}
	}
	return $format;
}

/**
 * 
 * @param string $format
 * @return string
 */
function creatPostFormatGallery( $format ) {
	$galleries	 = get_post_galleries( get_the_ID(), false );
	$k			 = 0;
	if ( is_single() ) {
		if ( isset( $galleries[ 0 ] ) ) {
			$src		 = $galleries[ 0 ][ 'src' ][ 0 ];
			$image_link	 = substr( $src, 0, -1 * ( strlen( $src ) - strrpos( $src, "-" ) ) ) . ".jpg";
			$format		 .= '<img src="' . $image_link . '" class="img-fluid">';
		}
	} else {
		?> 
		<div class="col-md-12" data-template-uri="<?php echo get_template_directory_uri(); ?>">
			<div id="mdb-lightbox-ui"></div>
			<div class="mdb-lightbox no-margin">
				<?php
				if ( isset( $galleries[ 0 ] ) ) {
					foreach ( $galleries[ 0 ][ 'src' ] as $src ) {
						$k++;
						?>
						<figure class="col-md-4">
							<a href="<?php echo substr( $src, 0, -1 * ( strlen( $src ) - strrpos( $src, '-' ) ) ) . '.jpg'; ?>" data-size="1600x1067">
								<!-- Thumbnail-->
								<img src="<?php echo substr( $src, 0, -1 * ( strlen( $src ) - strrpos( $src, '-' ) ) ) . '.jpg'; ?>" class="img-fluid">
							</a>
						</figure> 
						<?php
						if ( $k == 9 ) {
							break;
						}
					}
				}
				?>
			</div>
		</div>
		<?php
	}
	return $format;
}

/**
 * 
 * @param string $format
 * @return string
 */
function createPostFormatImage( $format ) {
	$first_image = catch_that_image();
	$format		 .= '<img src="' . $first_image . '" class="img-fluid">';
	return $format;
}

/**
 * 
 * @param type $format
 * @return string
 */
function createPostFormatVideo( $format ) {
	$content_post	 = get_post( get_the_id() );
	$video_content	 = $content_post->post_content;
	$video_content	 = apply_filters( 'the_content', $video_content );
    $str = $video_content;
    $str = substr($str, 0, strrpos($str, '</iframe>')+10);
    $str = strstr($str, '<iframe');
	$format			 .= '<div class="embed-responsive embed-responsive-16by9">';
	$format			 .= $str;
	$format			 .= '</div>';
	return $format;
}

/**
 * 
 */
function createPostFormatAudio() {
	the_post_thumbnail( 'full', array( 'class' => 'img-fluid' ) );
    $content_post    = get_post( get_the_id() );
    $video_content   = $content_post->post_content;
    $str = $video_content;
    $str = substr($str, 0, strrpos($str, ']')+1);
    $str = strstr($str, '[');

    $video_content   = apply_filters( 'the_content', $str );
	?>
	<div class="format-audio">
		<?php echo $video_content; ?>
	</div> 
	<?php
}

function createPostFormatLink() {
	$post_id		 = get_the_id();
	$content_post	 = get_post( $post_id );
	$the_content	 = $content_post->post_content;
	?>
	<a href='<?php echo substr( $the_content, strpos( $the_content, 'href="' ) + 6, strlen( $the_content ) - strpos( $the_content, '">' ) + 1 ); ?>'>
		<?php the_post_thumbnail( 'full', array( 'class' => 'img-fluid' ) ); ?>
	</a>
	<?php
}

function createPostFormatQuoteContent() {
	$content_post	 = get_post( get_the_id() );
	$quote_content	 = $content_post->post_content;
	$quote_content	 = apply_filters( 'the_content', $quote_content );
	?>
	<blockquote class="blockquote">
		<p class="mb-0"><?php echo $quote_content ?></p>
	</blockquote>
	<?php
}

/**
 * 
 * @param type $format
 * @return type
 */
function galleryPostFormatContent( $format ) {
	$content			 = get_the_content();
	$content_replaced	 = str_replace( "[gallery", "[lightbox", $content );
	$the_content		 = apply_filters( 'the_content', $content_replaced );
	$format				 .= $the_content;
	return $format;
}

/**
 * 
 * @param str $format
 * @return type
 */
function contentWithoutShortcodeAudio( $format ) {
    $post_id         = get_the_id();
    $content_post    = get_post( $post_id );
    $the_content     = $content_post->post_content;
    $string = preg_replace('/\[.*?\]/i','', $the_content);
    $the_content     = apply_filters( 'the_content', $string );
    $format          .= $the_content;
    return $format;
}
/**
 * 
 * @param str $format
 * @return type
 */
function contentWithoutShortcodeVideo( $format ) {
    $content_post    = get_post( get_the_id() );
    $video_content   = $content_post->post_content;
    $video_content   = apply_filters( 'the_content', $video_content );
    $str = $video_content;
    $string = preg_replace('/<iframe.*?\/iframe>/i','', $str);
    $format          .= $string;
    return $format;
}

/* Filter the content of chat posts. */
add_filter( 'the_content', 'my_format_chat_content' );

/* Auto-add paragraphs to the chat text. */
add_filter( 'my_post_format_chat_text', 'wpautop' );

/**
 * 
 * @global array $_post_format_chat_ids
 * @param type $content
 * @return type
 */
function my_format_chat_content( $content ) {
	global $_post_format_chat_ids;

	if ( !has_post_format( 'chat' ) )
		return $content;
	$_post_format_chat_ids	 = array();
	$separator				 = apply_filters( 'my_post_format_chat_separator', ':' );
	$chat_output			 = "\n\t\t\t" . '<div id="chat-transcript-' . esc_attr( get_the_ID() ) . '" class="chat-transcript">';

	/* Split the content to get individual chat rows. */
	$chat_rows = preg_split( "/(\r?\n)+|(<br\s*\/?>\s*)+/", $content );

	/* Loop through each row and format the output. */
	foreach ( $chat_rows as $chat_row ) {

		/* If a speaker is found, create a new chat row with speaker and text. */
		if ( strpos( $chat_row, $separator ) ) {

			/* Split the chat row into author/text. */
			$chat_row_split = explode( $separator, trim( $chat_row ), 2 );

			/* Get the chat author and strip tags. */
			$chat_author = strip_tags( trim( $chat_row_split[ 0 ] ) );

			/* Get the chat text. */
			$chat_text = trim( $chat_row_split[ 1 ] );

			/* Get the chat row ID (based on chat author) to give a specific class to each row for styling. */
			$speaker_id = my_format_chat_row_id( $chat_author );

			if ( $chat_author == 'noAuthor' ) {
				$chat_output .= "\n\t\t\t\t" . '</div>';
				$chat_output .= "\n\t\t\t\t\t" . '<div class="chat-text">' . str_replace( array( "\r", "\n", "\t" ), '', apply_filters( 'my_post_format_chat_text', $chat_text, $chat_author, $speaker_id ) ) . '</div>';
				$chat_output .= "\n\t\t\t" . '<div id="chat-transcript-' . esc_attr( get_the_ID() ) . '" class="chat-transcript">';
			} else {


				/* Open the chat row. */
				$chat_output .= "\n\t\t\t\t" . '<div class="chat-row ' . sanitize_html_class( "chat-speaker-{$speaker_id}" ) . '">';

				/* Add the chat row author. */
				$chat_output .= "\n\t\t\t\t\t" . '<div class="chat-author ' . sanitize_html_class( strtolower( "chat-author-{$chat_author}" ) ) . ' vcard"><cite class="fn">' . apply_filters( 'my_post_format_chat_author', $chat_author, $speaker_id ) . '</cite>' . $separator . '</div>';

				/* Add the chat row text. */
				$chat_output .= "\n\t\t\t\t\t" . '<div class="chat-text">' . str_replace( array( "\r", "\n", "\t" ), '', apply_filters( 'my_post_format_chat_text', $chat_text, $chat_author, $speaker_id ) ) . '</div>';

				/* Close the chat row. */
				$chat_output .= "\n\t\t\t\t" . '</div><!-- .chat-row -->';
			}
		}

		/**
		 * If no author is found, assume this is a separate paragraph of text that belongs to the
		 * previous speaker and label it as such, but let's still create a new row.
		 */ else {

			/* Make sure we have text. */
			if ( !empty( $chat_row ) ) {

				/* Open the chat row. */
				$chat_output .= "\n\t\t\t\t" . '<div class="chat-row ' . sanitize_html_class( "chat-speaker-{$speaker_id}" ) . '">';

				/* Don't add a chat row author.  The label for the previous row should suffice. */

				/* Add the chat row text. */
				$chat_output .= "\n\t\t\t\t\t" . '<div class="chat-text">' . str_replace( array( "\r", "\n", "\t" ), '', apply_filters( 'my_post_format_chat_text', $chat_row, $chat_author, $speaker_id ) ) . '</div>';

				/* Close the chat row. */
				$chat_output .= "\n\t\t\t</div><!-- .chat-row -->";
			}
		}
	}

	/* Close the chat transcript div. */
	$chat_output .= "\n\t\t\t</div><!-- .chat-transcript -->\n";

	/* Return the chat content and apply filters for developers. */
	return apply_filters( 'my_post_format_chat_content', $chat_output );
}

/**
 * 
 * @global type $_post_format_chat_ids
 * @param type $chat_author
 * @return type
 */
function my_format_chat_row_id( $chat_author ) {
	global $_post_format_chat_ids;

	/* Let's sanitize the chat author to avoid craziness and differences like "John" and "john". */
	$chat_author = strtolower( strip_tags( $chat_author ) );

	/* Add the chat author to the array. */
	$_post_format_chat_ids[] = $chat_author;

	/* Make sure the array only holds unique values. */
	$_post_format_chat_ids = array_unique( $_post_format_chat_ids );

	/* Return the array key for the chat author and add "1" to avoid an ID of "0". */
	return absint( array_search( $chat_author, $_post_format_chat_ids ) ) + 1;
}
