<?php

//Shortcodes section
/**
 * 
 * @param type $atts
 * @param type $content
 * @return string
 */
function buttons_shortcode( $atts, $content = null ) {

	$b = shortcode_atts( array(
		'color'		 => 'primary',
		'rounded'	 => 'false',
		'outline'	 => 'false',
		'flat'		 => 'false',
		'url'		 => '#!',
		'size'		 => '',
		'type'		 => '',
	), $atts );

	$class = '';

	if ( $b[ 'type' ] == 'floating' ) {
		$a = '<a class="btn-floating btn-' . $b[ 'size' ] . ' ' . $b[ 'color' ] . '">' . $content . '</a>';
	} elseif ( $b[ 'flat' ] == 'false' ) {

		if ( $b[ 'outline' ] == 'false' ) {
			$class .= ' btn-' . $b[ 'color' ];
		}

		$colors = array(
			'primary'	 => 1, 'default'	 => 1, 'secondary'	 => 1, 'success'	 => 1, 'info'		 => 1, 'warning'	 => 1, 'danger'	 => 1
		);


		if ( $b[ 'outline' ] == 'true' && isset( $colors[ $b[ 'color' ] ] ) ) {
			$class .= ' btn-outline-' . $b[ 'color' ] . " waves-effect";
		}

		if ( $b[ 'rounded' ] == 'true' ) {
			$class .= ' btn-rounded';
		}

		if ( $b[ 'size' ] == 'large' ) {
			$class .= ' btn-lg';
		}

		if ( $b[ 'size' ] == 'small' ) {
			$class .= ' btn-sm';
		}

		if ( $b[ 'size' ] == 'block' ) {
			$class .= ' btn-block';
		}

		$a = '<a type="button" class="btn' . $class . '" href="' . $b[ 'url' ] . '">' . $content . '</a>';
	} else {
		$a = '<button class="btn-flat waves-effect" href="' . $b[ 'url' ] . '">' . $content . '</button>';
	}
	return $a;
}

add_shortcode( 'button', 'buttons_shortcode' );

function labels_shortcode( $atts, $content = null ) {

	$b = shortcode_atts( array(
		'type' => 'primary',
	), $atts );

	$colors = array(
		'primary'	 => 1, 'default'	 => 1, 'secondary'	 => 1, 'success'	 => 1, 'info'		 => 1, 'warning'	 => 1, 'danger'	 => 1
	);

	$class = "";


	if ( isset( $colors[ $b[ 'type' ] ] ) ) {
		$class .= " tag-" . $b[ 'type' ];
	} else {
		$class .= " " . $b[ 'type' ];
	}

	$a = '<span class="tag' . $class . '">' . $content . '</span>';
	return $a;
}

add_shortcode( 'label', 'labels_shortcode' );

function tags_shortcode( $atts, $content = null ) {

	$a = '<div class="chip">
		    ' . $content . '
		    <!--<i class="close fa fa-times"></i>-->
		</div>';
	return $a;
}

add_shortcode( 'tag', 'tags_shortcode' );

function modals_shortcode( $atts, $content = null ) {

	$content = do_shortcode( $content );

	$b = shortcode_atts( array(
		'title'					 => 'Modal dialog',
		'size'					 => '',
		'open_button'			 => 'Open dialog',
		'open_button_type'		 => 'primary',
		'open_button_rounded'	 => 'false',
		'open_button_outline'	 => 'false',
		'close_button'			 => 'Ok',
		'close_button_type'		 => 'primary',
		'close_button_rounded'	 => 'false',
		'close_button_outline'	 => 'false',
	), $atts );


	$class_open = '';

	$class_open .= ' btn-' . $b[ 'open_button_type' ];

	$colors = array(
		'primary'	 => 1, 'default'	 => 1, 'secondary'	 => 1, 'success'	 => 1, 'info'		 => 1, 'warning'	 => 1, 'danger'	 => 1
	);


	if ( $b[ 'open_button_outline' ] == 'true' && isset( $colors[ $b[ 'open_button_type' ] ] ) ) {
		$class_open .= "-outline waves-effect";
	}

	if ( $b[ 'open_button_rounded' ] == 'true' ) {
		$class_open .= ' btn-rounded';
	}

	$class_close = '';

	$class_close .= ' btn-' . $b[ 'close_button_type' ];


	if ( $b[ 'close_button_outline' ] == 'true' && isset( $colors[ $b[ 'close_button_type' ] ] ) ) {
		$class_close .= "-outline waves-effect";
	}

	if ( $b[ 'close_button_rounded' ] == 'true' ) {
		$class_close .= ' btn-rounded';
	}



	if ( $b[ 'size' ] == 'small' ) {
		$a = '
        <!-- Small modal -->
        <button type="button" class="btn ' . $class_open . '" data-toggle="modal" data-target=".bd-example-modal-sm">' . $b[ 'open_button' ] . '</button>

        <div class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-sm">
                <!--Content-->
                <div class="modal-content">
                    <!--Header-->
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title" id="myModalLabel">' . $b[ 'title' ] . '</h4>
                    </div>
                    <!--Body-->
                    <div class="modal-body">
                        ' . $content . '
                    </div>
                    <!--Footer-->
                    <div class="modal-footer">
                        <button type="button" class="btn' . $class_close . '" data-dismiss="modal">' . $b[ 'close_button' ] . '</button>
                    </div>
                </div>
                <!--/.Content-->
            </div>
        </div>
        <!-- /.Live preview-->

        ';
	} elseif ( $b[ 'size' ] == 'big' ) {
		$a = '

        <!-- Large modal -->
        <button class="btn' . $class_open . '" data-toggle="modal" data-target=".bd-example-modal-lg">' . $b[ 'open_button' ] . '</button>

        <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <!--Content-->
                <div class="modal-content">
                    <!--Header-->
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title" id="myModalLabel">' . $b[ 'title' ] . '</h4>
                    </div>
                    <!--Body-->
                    <div class="modal-body">
                        ' . $content . '
                    </div>
                    <!--Footer-->
                    <div class="modal-footer">
                        <button type="button" class="btn' . $class_close . '" data-dismiss="modal">' . $b[ 'close_button' ] . '</button>
                    </div>
                </div>
                <!--/.Content-->
            </div>
        </div>
        ';
	} else {
		$a = '
            <!-- Button trigger modal -->
            <button type="button" class="btn' . $class_open . '" data-toggle="modal" data-target="#myModal">
                ' . $b[ 'open_button' ] . '
            </button>

            <!-- Modal -->
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <!--Content-->
                    <div class="modal-content">
                        <!--Header-->
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <h4 class="modal-title" id="myModalLabel">' . $b[ 'title' ] . '</h4>
                        </div>
                        <!--Body-->
                        <div class="modal-body">
                            ' . $content . '
                        </div>
                        <!--Footer-->
                        <div class="modal-footer">
                            <button type="button" class="btn' . $class_close . '" data-dismiss="modal">' . $b[ 'close_button' ] . '</button>
                        </div>
                    </div>
                    <!--/.Content-->
                </div>
            </div>

        ';
	}



	return $a;
}

add_shortcode( 'modal', 'modals_shortcode' );

function imgs_shortcode( $atts, $content = null ) {

	$b = shortcode_atts( array(
		'alt'	 => 'Image',
		'style'	 => '',
	), $atts );

	if ( empty( $content ) ) {

		$content = get_template_directory_uri() . '/img/no_img.jpg';
	}

	if ( !empty( $b[ 'style' ] ) )
		$style	 = 'rounded-' . $b[ 'style' ];
	else
		$style	 = '';

	$a = '<img src="' . $content . '" class="img-fluid ' . $style . '" alt="' . $b[ 'alt' ] . '">';

	return $a;
}

add_shortcode( 'image', 'imgs_shortcode' );

function media_shortcode( $atts, $content = null ) {

	$b = shortcode_atts( array(
		'dimension'			 => '16by9',
		'allowfullscreen'	 => 'true',
		'type'				 => 'iframe'
	), $atts );

	if ( $b[ 'allowfullscreen' ] == 'true' ) {
		$al = 'allowfullscreen';
	}

	$a = '<div class="embed-responsive embed-responsive-' . $b[ 'dimension' ] . '">
            <' . $b[ 'type' ] . ' class="embed-responsive-item" src="' . $content . '" ' . $al . '></' . $b[ 'type' ] . '>
        </div>';

	return $a;
}

add_shortcode( 'media', 'media_shortcode' );

function figures_shortcode( $atts, $content = null ) {

	$b = shortcode_atts( array(
		'caption'		 => 'Image caption',
		'alt'			 => 'Image',
		'caption-align'	 => 'left',
	), $atts );

	$a = '<figure class="figure">
          <img src="' . $content . '" class="figure-img img-fluid" alt="' . $b[ 'alt' ] . '">
          <figcaption class="figure-caption text-xs-' . $b[ 'caption-align' ] . '">' . $b[ 'caption' ] . '</figcaption>
        </figure>';

	return $a;
}

add_shortcode( 'figure', 'figures_shortcode' );

function bars_shortcode( $atts, $content = null ) {

	$b = shortcode_atts( array(
		'color' => '',
	), $atts );

	/* space required for spliting class string */

	$class = " ";

	if ( !empty( $b[ 'color' ] ) ) {

		$class .= 'progress-' . $b[ 'color' ];
	}

	$a = '<progress class="progress ' . $class . '" value="' . substr( $content, 0, -1 ) . '" max="100">' . $content . '</progress>';

	return $a;
}

add_shortcode( 'bar', 'bars_shortcode' );

function chart_shortcode( $atts, $content = null ) {

	$b = do_shortcode( str_replace( array( "<br>", "<br/>", "</br>", "<br />" ), "", $content ) );

	// get rid of last "?^%$" so explode won't make empty element of array, trim to make sure that there isn't any whitespaces

	$b = explode( "?^%$", substr( trim( $b ), 0, -4 ) );



	wp_enqueue_script( 'general-js', get_template_directory_uri() . '/js/general.js' );

	$a = '<canvas id="myChart"></canvas>';

	$a .= ' <script type="text/javascript"><!--//--><![CDATA[//><!--

            var data = {
            labels: [' . $b[ 0 ] . '],
            datasets: [';

	//get rid of first array element (labels)

	array_shift( $b );

	foreach ( $b as $data ) {
		$a .= $data . ",";
	}

	$a .= ']
        };


           //--><!]]></script>';
	return $a;
}

add_shortcode( 'chart', 'chart_shortcode' );

function chart_labels_shortcode( $atts, $content = null ) {
	$a = str_replace( ",", "\",\"", $content );
	return "\"" . $a . "\"?^%$";
}

add_shortcode( 'labels', 'chart_labels_shortcode' );

function chart_data_shortcode( $atts, $content = null ) {

	$b	 = shortcode_atts( array(
		'label'				 => 'Example',
		'fillcolor'			 => 'rgba(151,187,205,0.5)',
		'strokecolor'		 => 'rgba(151,187,205,0.5)',
		'highlightfill'		 => 'rgba(151,187,205,0.5)',
		'highlightstroke'	 => 'rgba(151,187,205,0.5)',
	), $atts );
	$a	 = "
        label: '" . $b[ 'label' ] . "',
        fillColor: '" . $b[ 'fillcolor' ] . "',
        strokeColor: '" . $b[ 'strokecolor' ] . "',
        highlightFill: '" . $b[ 'highlightfill' ] . "',
        highlightStroke: '" . $b[ 'highlightstroke' ] . "',
        data: [" . $content . "],";

	return "{" . $a . "}?^%$";
}

add_shortcode( 'data', 'chart_data_shortcode' );

function carousel_shortcode( $atts, $content = null ) {

	if ( empty( $content ) ) {
		return;
	}

	$b = do_shortcode( str_replace( array( "<br>", "<br />" ), "", $content ) );


	// get rid of last "?^%$" so explode won't make empty element of array, trim to make sure that there isn't any whitespaces

	$b = explode( "?^%$", substr( trim( $b ), 0, -4 ) );

	$check_1 = true;
	$check_2 = true;

	$a		 = '
        <!--Carousel Wrapper-->
        <div id="carousel-example-1" class="carousel slide carousel-fade" data-ride="carousel">
            <!--Indicators-->
            <ol class="carousel-indicators">';
	$counter = count( $b );
	for ( $i = 0; $i < $counter; $i++ ) {
		$a .= '
        <li data-target="#carousel-example-1" data-slide-to="' . $i . '" ';
		if ( $check_1 ) {
			$a		 .= ' class="active"';
			$check_1 = false;
		} $a .= '></li>';
	}
	$a .= '
    </ol>
    <!--/.Indicators-->

    <!--Slides-->
    <div class="carousel-inner" role="listbox">';

	foreach ( $b as $slide ) {
		$slide = explode( "$%^?", $slide );
		if ( !empty( $slide[ 0 ] ) || !empty( $slide[ 1 ] ) ) {
			$a .= '<!--First slide-->
            <div class="carousel-item ';
			if ( $check_2 ) {
				$a		 .= ' active';
				$check_2 = false;
			} $a .= '">
                <!--Mask color-->
                <div class="view hm-black-light">
                    <img src="' . $slide[ 2 ] . '" class="img-fluid" alt="">
                    <div class="full-bg-img">
                    </div>
                </div>
                <!--Caption-->
                <div class="carousel-caption">
                    <div class="animated fadeInDown">
                        <h3 class="h3-responsive">' . $slide[ 0 ] . '</h3>
                        <p>' . $slide[ 1 ] . '</p>
                    </div>
                </div>
                <!--Caption-->
            </div>
            <!--/First slide-->';
		} else {
			$a .= '
            <!--First slide-->
            <div class="carousel-item ';
			if ( $check_2 ) {
				$a		 .= ' active';
				$check_2 = false;
			} $a .= '"></li>

                <img src="' . $slide[ 2 ] . '" alt="First slide">
                        </div>
            <!--/First slide-->';
		}
	}
	$a	 .= '
    </div>
    <!--/.Slides-->';
	$a	 .= '

    <!--Controls-->
    <a class="left carousel-control" href="#carousel-example-1" role="button" data-slide="prev">
        <span class="icon-prev" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#carousel-example-1" role="button" data-slide="next">
        <span class="icon-next" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
    <!--/.Controls-->
</div>
<!--/.Carousel Wrapper-->
';

	return $a;
}

add_shortcode( 'carousel', 'carousel_shortcode' );

function carousel_item_shortcode( $atts, $content = null ) {
	$c = shortcode_atts( array(
		'caption_title'		 => '',
		'caption_content'	 => '',
	), $atts );

	return $c[ 'caption_title' ] . "$%^?" . $c[ 'caption_content' ] . "$%^?" . $content . "?^%$";
}

add_shortcode( 'carousel_item', 'carousel_item_shortcode' );

function collapse_shortcode( $atts, $content = null ) {
	$a = shortcode_atts( array(
	), $atts );

	$c = do_shortcode( str_replace( array( "<br>", "<br />" ), "", $content ) );

	// get rid of last "?^%$" so explode won't make empty element of array, trim to make sure that there isn't any whitespaces

	$c = explode( "?^%$", substr( trim( $c ), 0, -4 ) );


	$i	 = 1;
	$b	 = '
       <!--Accordion wrapper-->
       <div class="accordion" id="accordion" role="tablist" aria-multiselectable="true">
       ';
	foreach ( $c as $collapse_array ) {
		$b			 .= "<!-- Panel " . $i . " -->";
		$collapse	 = explode( "$%^?", $collapse_array );

		$title			 = ( trim( $collapse[ 0 ] ) == null ) ? 'Panel #' . $i : trim( $collapse[ 0 ] );
		$collapsed_class = ($collapse[ 1 ] == "true") ? ' in' : '';


		$b .= '
                   <div class="panel panel-default">
                       <!--Panel heading-->
                       <div class="panel-heading" role="tab" id="heading-' . $i . '">
                           <h5 class="panel-title">
                               <a class="arrow-r" data-toggle="collapse" data-parent="#accordion" href="#collapse-' . $i . '" aria-expanded="true" aria-controls="collapseOne"> ' . $title . '<i class="fa fa-angle-down rotate-icon"></i>
   </a>
                           </h5>
                       </div>

                       <!-- Panel Body -->
                       <div id="collapse-' . $i . '" class="panel-collapse collapse' . $collapsed_class . '" role="tabpanel" aria-labelledby="headingOne">
                           ' . $collapse[ 2 ] . '
                       </div>
                       <!-- /.Panel Body -->
               ';

		$b	 .= '</div>';
		$b	 .= '<!-- /.Panel ' . $i . ' -->';
		$i++;
	}

	$b .= '
       </div>
       <!--/.Accordion wrapper-->
       ';

	return $b;
}

add_shortcode( 'collapse', 'collapse_shortcode' );

function collapse_item_shortcode( $atts, $content = null ) {
	$c = shortcode_atts( array(
		'title'		 => '',
		'collapsed'	 => 'false',
	), $atts );

	return $c[ 'title' ] . "$%^?" . $c[ 'collapsed' ] . "$%^?" . $content . "?^%$";
}

add_shortcode( 'collapse_item', 'collapse_item_shortcode' );

function toggle_shortcode( $atts, $content = null ) {
	$a = shortcode_atts( array(
	), $atts );

	$c = do_shortcode( str_replace( array( "<br>", "<br />" ), "", $content ) );

	// get rid of last "?^%$" so explode won't make empty element of array, trim to make sure that there isn't any whitespaces

	$c = explode( "?^%$", substr( trim( $c ), 0, -4 ) );


	$i	 = 1;
	$b	 = '
       <!--Toggle wrapper-->
       <div class="accordion" role="tablist" aria-multiselectable="true">
       ';
	foreach ( $c as $collapse_array ) {
		$b			 .= "<!-- Panel " . $i . " -->";
		$collapse	 = explode( "$%^?", $collapse_array );

		$title			 = (trim( $collapse[ 0 ] ) == null) ? 'Panel #' . $i : trim( $collapse[ 0 ] );
		$collapsed_class = ($collapse[ 1 ] == "true") ? ' in' : '';


		$b .= '
                   <div class="panel panel-default">
                       <!--Panel heading-->
                       <div class="panel-heading" role="tab" id="heading-' . $i . '">
                           <h5 class="panel-title">
                               <a data-toggle="collapse" href="#collapse-' . $i . '" aria-expanded="true" aria-controls="collapseOne"> ' . $title . '</a>
                           </h5>
                       </div>

                       <!-- Panel Body -->
                       <div id="collapse-' . $i . '" class="panel-collapse collapse' . $collapsed_class . '" role="tabpanel" aria-labelledby="headingOne">
                           ' . $collapse[ 2 ] . '
                       </div>
                       <!-- /.Panel Body -->
               ';

		$b	 .= '</div>';
		$b	 .= '<!-- /.Panel ' . $i . ' -->';
		$i++;
	}

	$b .= '
       </div>
       <!--/.Toggle wrapper-->
       ';

	return $b;
}

add_shortcode( 'toggle', 'toggle_shortcode' );

function toggle_item_shortcode( $atts, $content = null ) {
	$c = shortcode_atts( array(
		'title'		 => '',
		'collapsed'	 => 'false',
	), $atts );

	return $c[ 'title' ] . "$%^?" . $c[ 'collapsed' ] . "$%^?" . $content . "?^%$";
}

add_shortcode( 'toggle_item', 'toggle_item_shortcode' );

function tabs_shortcode( $atts, $content = null ) {
	$a = shortcode_atts( array(
		"version"	 => "1",
		"color"		 => "",
		"id"		 => "",
	), $atts );

	$c = do_shortcode( str_replace( array( "<br>", "<br />", ), "", $content ) );

	$c = explode( "||||||", substr( trim( $c ), 0, -6 ) );


	switch ( $a[ "version" ] ):

		case "1": // same as default, is it safe to remove?
			$ul_classes			 = " tabs-3 " . (!empty( $a[ "color" ] ) ? $a[ "color" ] : "red" );
			$tab_wrapper_class	 = " card";
			break;
		case "2":
			$ul_classes			 = " tabs-3 " . (!empty( $a[ "color" ] ) ? $a[ "color" ] : "indigo" );
			$tab_wrapper_class	 = "";
			break;
		case "3":
			$ul_classes			 = " md-pills pills-ins ";
			$tab_wrapper_class	 = "";
			break;
		case "4":
			$ul_classes			 = " md-pills pills-primary " . (!empty( $a[ "color" ] ) ? $a[ "color" ] : "" );
			$tab_wrapper_class	 = " vertical";
			break;
		case "5":
			$ul_classes			 = " md-pills pills-default " . (!empty( $a[ "color" ] ) ? $a[ "color" ] : "" );
			$tab_wrapper_class	 = "";
			break;
		case "6":
			$ul_classes			 = " md-pills pills-secondary " . (!empty( $a[ "color" ] ) ? $a[ "color" ] : "" );
			$tab_wrapper_class	 = " vertical";
			break;
		default:
			$ul_classes			 = " tabs-3 red";
			$tab_wrapper_class	 = " card";

	endswitch;

	$i				 = 0;
	$is_vertical	 = ( ( $tab_wrapper_class == " vertical" ) ? true : false );
	$is_icon_on_top	 = ( $a[ "version" ] == "5" || $a[ "version" ] == "6" ) ? true : false;
	$b				 = '';
	if ( $is_vertical ) {

		$b = '
    <div class="row">
      <div class="col-md-3">
    ';
	} else {
		$b = '
    <div class="row">
      <div class="col-md-12">
    ';
	}
	$b .= '
  <!-- Nav tabs -->
  <ul class="nav nav-tabs' . $ul_classes . '" role="tablist">';

	foreach ( $c as $collapse_array ) {

		$collapse	 = explode( ",*&^%#&#", $collapse_array );
		$active		 = $i == 0 ? ' active' : '';
		$icon		 = $collapse[ 2 ];
		$size		 = ( $icon != '' && $is_icon_on_top ) ? " fa-2x" : "";
		$space		 = ( $icon != '' && $is_icon_on_top ) ? "<br>" : '&nbsp;';
		$title		 = ( trim( $collapse[ 0 ] ) != null ? trim( $collapse[ 0 ] ) : ( "Tab #" . $i ) );
		$b			 .= '
    <li class="nav-item ">
      <a class="nav-link ' . $active . '" data-toggle="tab" href="#panel' . $a[ "id" ] . $i . '" role="tab"><i class="' . $icon . $size . '"></i>' . $space . $title . '</a>
    </li>
    ';
		$i++;
	}

	$b .= '</ul>';
	if ( $is_vertical ) {
		$b .= '
      </div>

      <div class="col-md-7">
    ';
	} else {
		$b .= '
      </div>

      <div class="col-md-12">
    ';
	}
	$b	 .= '
  <!-- Tab panels -->
      <div class="tab-content' . $tab_wrapper_class . '">';
	$i	 = 0;
	foreach ( $c as $collapse_array ) {

		$collapse	 = explode( ",*&^%#&#", $collapse_array );
		$active		 = $i == 0 ? ' active' : '';
		$tab_content = trim( $collapse[ 1 ] );
		$b			 .= '
    <!--Panel ' . $i . '-->
    <div class="tab-pane fade in' . $active . '" id="panel' . $a[ "id" ] . $i . '" role="tabpanel">
    <br>';
		$b			 .= $tab_content;
		$b			 .= '
    </div>
    <!--/Panel ' . $i . '-->
    ';
		$i++;
	}
	if ( $is_vertical ) {
		$b .= '
	      </div>
	    </div>
		</div>
    ';
	} else {
		$b .= '</div>';
	}

	return $b;
}

add_shortcode( 'tabs', 'tabs_shortcode' );

function tab_shortcode( $atts, $content = null ) {

	$c = shortcode_atts( array(
		'title'	 => '',
		'icon'	 => '',
	), $atts );

	return $c[ 'title' ] . ",*&^%#&#" . $content . ",*&^%#&#" . $c[ "icon" ] . "||||||";
}

add_shortcode( 'tab', 'tab_shortcode' );

function alerts_shortcode( $atts, $content = null ) {

	$b = shortcode_atts( array(
		'type'				 => 'info',
		'title'				 => '',
		'btntext'			 => '',
		'closebutton'		 => 'false',
		'newestontop'		 => 'false',
		'progressbar'		 => 'false',
		'positionclass'		 => 'toast-top-right',
		'preventduplicates'	 => 'false',
		'onclick'			 => 'null',
		'showduration'		 => '300',
		'hideduration'		 => '1000',
		'timeout'			 => '5000',
		'extendedtimeOut'	 => '1000',
		'showeasing'		 => 'swing',
		'hideeasing'		 => 'linear',
		'showmethod'		 => 'fadeIn',
		'hidemethod'		 => 'fadeOut'
	), $atts );

	$a = "";

	$options = "
    closeButton: " . $b[ 'closebutton' ] . ",
    newestOnTop: " . $b[ 'newestontop' ] . ",
    progressBar: " . $b[ 'progressbar' ] . ",
    positionClass: '" . $b[ 'positionclass' ] . "',
    preventDuplicates: " . $b[ 'preventduplicates' ] . ",
    onclick: " . $b[ 'onclick' ] . ",
    showDuration: '" . $b[ 'showduration' ] . "',
    hideDuration: '" . $b[ 'hideduration' ] . "',
    timeOut: '" . $b[ 'timeout' ] . "',
    extendedTimeOut: '" . $b[ 'extendedtimeOut' ] . "',
    showEasing: '" . $b[ 'showeasing' ] . "',
    hideEasing: '" . $b[ 'hideeasing' ] . "',
    showMethod: '" . $b[ 'showmethod' ] . "',
    hideMethod: '" . $b[ 'hidemethod' ] . "'";

	if ( $b[ 'type' ] != 'error' ) {
		$a = "<a class='btn btn-" . $b[ 'type' ] . "' onclick=\"toastr." . $b[ 'type' ] . "('" . $content . "', '" . $b[ 'title' ] . "', {" . $options . "})\" >" . $b[ 'btntext' ] . "</a>";
	}
	if ( $b[ 'type' ] == 'error' ) {
		$a = "<a class='btn btn-danger' onclick=\"toastr." . $b[ 'type' ] . "('" . $content . "', '" . $b[ 'title' ] . "', {" . $options . "})\" >" . $b[ 'btntext' ] . "</a>";
	}

	return $a;
}

add_shortcode( 'alert', 'alerts_shortcode' );

function tooltip_shortcode( $atts, $content = null ) {

	$c = shortcode_atts( array(
		'direction'	 => 'top',
		'label'		 => 'Button',
	), $atts );

	wp_enqueue_script( 'tooltips_init', get_template_directory_uri() . '/js/general.js' );

	$a = '<button type="button" class="btn btn-primary" data-toggle="tooltip" data-placement="' . $c[ 'direction' ] . '" title="' . $content . '">' . $c[ 'label' ] . '</button>';

	return $a;
}

add_shortcode( 'tooltip', 'tooltip_shortcode' );

function popver_shortcode( $atts, $content = null ) {

	$c = shortcode_atts( array(
		'title'		 => 'Title',
		'label'		 => 'Button',
		'direction'	 => 'top',
	), $atts );

	wp_enqueue_script( 'popover_init', get_template_directory_uri() . '/js/general.js' );

	$a = '<button type="button" class="btn btn-danger" data-toggle="popover" data-trigger="focus" title="' . $c[ 'title' ] . '" data-placement="' . $c[ 'direction' ] . '" data-content="' . $content . '">' . $c[ 'label' ] . '</button>';

	return $a;
}

add_shortcode( 'popover', 'popver_shortcode' );

function lightbox_shortcode( $atts, $content = null ) {
	$c		 = shortcode_atts( array(
		'ids' => ''
	), $atts );
	$ids	 = explode( ',', $c[ 'ids' ] );
	$photos	 = explode( ',', $c[ 'ids' ] );
	$a		 = '<div class="col-md-12" data-template-uri="' . get_template_directory_uri() . '">
      <div id="mdb-lightbox-ui"></div>
        <div class="mdb-lightbox no-margin">';
	foreach ( $photos as $id ) {
		$b = wp_get_attachment_link( $id );
		preg_match_all( '/<a[^>]+href=([\'"])(.+?)\1[^>]*>/i', $b, $image_link );
		if ( !empty( $image_link[ 2 ] ) ) {
			$img = $image_link[ 2 ][ 0 ];


			$a .= '<figure class="col-md-4">
            <a href="' . $img . '" data-size="1600x1067">
            <img src="' . $img . '" class="img-fluid">
            </a>
            </figure> ';
		}
	}
	$a .= '</div> </div>';

	return $a;
}

add_shortcode( 'lightbox', 'lightbox_shortcode' );
?>
