<?php
$load_more = get_theme_mod( 'load_more_posts', 'no' ); // no || onclick || onscroll
if ( $load_more != 'no' ) {
	?>
	<?php if ( $load_more == "onclick" ) { ?>
		<div id="ajax-loader">
			<button class="btn btn-primary"><?php _e( "Load more", "mdw" ); ?></button>
		</div>
		<script>
			var loadMore = true;
			var postsArea = jQuery( "#ajax-loader" ).siblings( "section" ); // posts will be loaded here
			var template = jQuery( "[data-template-version^='blog_template_']" ).data( "template-version" );
			var dataField = jQuery( "#dataForAjaxLoadMore" ).children();
			var preloader = jQuery( "#loadMorePreloader" );
			preloader.hide( 0 );
			var data = { // predefines data
				action: 'load_more_response',
				template: template,
				words_per_excerpt: 30,
				category: "No categories",
				counter: 0,
				amount: 3,
				social_buttons: 'yes',
				share_animation: 'rotating',
				column_count: '1'
			};
			dataField.each( function ( index, element ) { // reads data left by php
				if ( jQuery( element ).data( "words-per-excerpt" ) ) {
					data.words_per_excerpt = jQuery( element ).data( "words-per-excerpt" );
				} else if ( jQuery( element ).data( "counter" ) ) {
					data.counter = 0;
				} // again? wtf
				else if ( jQuery( element ).data( "category" ) ) {
					data.category = jQuery( element ).data( "category" );
				} else if ( jQuery( element ).data( "social-buttons" ) ) {
					data.social_buttons = jQuery( element ).data( "social-buttons" );
				} else if ( jQuery( element ).data( "amount" ) ) {
					data.amount = jQuery( element ).data( "amount" );
				} else if ( jQuery( element ).data( "cols" ) ) {
					data.column_count = jQuery( element ).data( "cols" );
				} else if ( jQuery( element ).data( "share-animation" ) ) {
					data.share_animation = jQuery( element ).data( "share-animation" );
				} else if ( jQuery( element ).data( "order" ) ) {
					data.order = jQuery( element ).data( "order" );
				} else if ( jQuery( element ).data( "order-by" ) ) {
					data.order_by = jQuery( element ).data( "order-by" );
				}
			} );

			var tVer = template.substr( template.lastIndexOf( '_' ) + 1 ); // templateVersion number
			var loadRows;
			var loadCols;
			/*
			 one post per row: 1, 3, 4: 1 3 4 (not a card);
			 one post per col: 2 5 6 7 8 9 (card)
			 */

			if ( tVer == "1" || tVer == "3" || tVer == "4" || tVer == '11' ) {
				loadRows = true;
				loadCols = false;
			} else {
				loadRows = false;
				loadCols = true;
			}
			var alreadyLoaded = postsArea.children( ".row" );
			var alreadyLoadedIDs = [ ];

			if ( loadRows ) {
				alreadyLoaded.each( function ( index, elem ) {
					data.counter++;
				} );
			} else {
				alreadyLoaded.each( function ( index, elem ) {
					alreadyLoaded.children( "[class*='col-']" ).each( function ( ind, el ) {
						data.counter++;
					} );
				} );
			}
			// data.counter = alreadyLoadedIDs.length;
			var notLoading = true;
			jQuery( 'body' ).on( "click", '#ajax-loader button', loadMoreButton );
			function loadMoreButton( event ) {
				// checks if user hit the bottom of the page
				if ( loadMore && notLoading ) {
					notLoading = false;
					preloader.show( 100 );

					var alreadyLoaded = postsArea.children( ".row" );

					var alreadyLoadedIDs = [ ];

					if ( loadRows ) {
						alreadyLoaded.each( function ( index, elem ) {
							var postID = jQuery( elem ).data( 'post-id' );
							alreadyLoadedIDs.push( postID );
							data.counter++;

						} );
					} else {

						alreadyLoaded.each( function ( index, elem ) {
							alreadyLoaded.children( "[class*='col-']" ).each( function ( ind, el ) {
								var postID = jQuery( el ).data( 'post-id' );
								alreadyLoadedIDs.push( postID );

							} );
						} );

					}

					data.counter = alreadyLoadedIDs.length;
					alreadyLoadedIDs = JSON.stringify( alreadyLoadedIDs );
					data.already_in = alreadyLoadedIDs;
					jQuery.ajax( {
						url: ajaxurl,
						type: 'post',
						data: data
					} ).done( function ( response ) {
						if ( response.trim() !== '' ) {
							postsArea.html( postsArea.html() + response );
							preloader.hide( 100 );
							notLoading = true;

							var footerHeight = 0;
							var footerTop = 0;
							$footer = jQuery( "footer.page-footer" );
							var documentHeight = jQuery( document ).height();
							var top = jQuery( document ).height() - footerHeight + "px";
							if ( documentHeight < window.innerHeight ) {

								$footer.css( {
									position: "absolute",
									bottom: 0,
									width: "100%"
								} );
							}

						} else {
							loadMore = false;
							preloader.remove();
						}

					} ).fail( function ( jqXHR, textStatus, errorThrown ) {
						console.log( errorThrown );
					} );

				}
			}

		</script>
	<?php } else if ( $load_more == "onscroll" ) { ?>
		<div id="ajax-loader">
			<div class="preloader-wrapper big active" id="loadMorePreloader">
				<div class="preloader-wrapper big active">
					<div class="preloader-wrapper big active">
						<div class="preloader-wrapper big active">
							<div class="spinner-layer spinner-blue-only">
								<div class="circle-clipper left">
									<div class="circle"></div>
								</div><div class="gap-patch">
									<div class="circle"></div>
								</div><div class="circle-clipper right">
									<div class="circle"></div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<script>
			var loadMore = true;
			var postsArea = jQuery( "#ajax-loader" ).siblings( "section" ); // posts will be loaded here
			var template = jQuery( "[data-template-version^='blog_template_']" ).data( "template-version" );
			var dataField = jQuery( "#dataForAjaxLoadMore" ).children();
			var preloader = jQuery( "#loadMorePreloader" );
			preloader.hide( 0 );
			var data = { // predefines data
				action: 'load_more_response',
				template: template,
				words_per_excerpt: 30,
				category: "No categories",
				counter: 0,
				amount: 3,
				social_buttons: 'yes',
				share_animation: 'rotating',
				column_count: '1'
			};
			dataField.each( function ( index, element ) { // reads data left by php
				if ( jQuery( element ).data( "words-per-excerpt" ) ) {
					data.words_per_excerpt = jQuery( element ).data( "words-per-excerpt" );
				} else if ( jQuery( element ).data( "counter" ) ) {
					data.counter = 0;
				} // again? wtf
				else if ( jQuery( element ).data( "category" ) ) {
					data.category = jQuery( element ).data( "category" );
				} else if ( jQuery( element ).data( "social-buttons" ) ) {
					data.social_buttons = jQuery( element ).data( "social-buttons" );
				} else if ( jQuery( element ).data( "amount" ) ) {
					data.amount = jQuery( element ).data( "amount" );
				} else if ( jQuery( element ).data( "cols" ) ) {
					data.column_count = jQuery( element ).data( "cols" );
				} else if ( jQuery( element ).data( "share-animation" ) ) {
					data.share_animation = jQuery( element ).data( "share-animation" );
				} else if ( jQuery( element ).data( "order" ) ) {
					data.order = jQuery( element ).data( "order" );
				} else if ( jQuery( element ).data( "order-by" ) ) {
					data.order_by = jQuery( element ).data( "order-by" );
				}
			} );

			var tVer = template.substr( template.lastIndexOf( '_' ) + 1 ); // templateVersion number
			var loadRows;
			var loadCols;
			/*
			 one post per row: 1, 3, 4: 1 3 4 (not a card);
			 one post per col: 2 5 6 7 8 9 (card)
			 */

			if ( tVer == "1" || tVer == "3" || tVer == "4" || tVer == '11' ) {
				loadRows = true;
				loadCols = false;
			} else {
				loadRows = false;
				loadCols = true;
			}
			var alreadyLoaded = postsArea.children( ".row" );
			var alreadyLoadedIDs = [ ];

			if ( loadRows ) {
				alreadyLoaded.each( function ( index, elem ) {
					data.counter++;
				} );
			} else {
				alreadyLoaded.each( function ( index, elem ) {
					alreadyLoaded.children( "[class*='col-']" ).each( function ( ind, el ) {
						data.counter++;
					} );
				} );
			}
			// data.counter = alreadyLoadedIDs.length;
			var notLoading = true;
			jQuery( window ).on( "scroll", { }, scrollingToBottom );
			function scrollingToBottom( event ) {
				// checks if user hit the bottom of the page
				if ( loadMore && notLoading && jQuery( window ).scrollTop() > jQuery( document ).height() - jQuery( window ).height() - 1 ) {
					notLoading = false;
					preloader.show( 100 );

					var alreadyLoaded = postsArea.children( ".row" );

					var alreadyLoadedIDs = [ ];

					if ( loadRows ) {
						alreadyLoaded.each( function ( index, elem ) {
							var postID = jQuery( elem ).data( 'post-id' );
							alreadyLoadedIDs.push( postID );
							data.counter++;

						} );
					} else {

						alreadyLoaded.each( function ( index, elem ) {
							alreadyLoaded.children( "[class*='col-']" ).each( function ( ind, el ) {
								var postID = jQuery( el ).data( 'post-id' );
								alreadyLoadedIDs.push( postID );

							} );
						} );
					}
					data.counter = alreadyLoadedIDs.length;
					alreadyLoadedIDs = JSON.stringify( alreadyLoadedIDs );
					data.already_in = alreadyLoadedIDs;
					jQuery.ajax( {
						url: ajaxurl,
						type: 'post',
						data: data
					} ).done( function ( response ) {
						if ( response.trim() !== '' ) {
							postsArea.html( postsArea.html() + response );
							preloader.hide( 100 );
							notLoading = true;

							var footerHeight = 0;
							var footerTop = 0;
							$footer = jQuery( "footer.page-footer" );
							var documentHeight = jQuery( document ).height();
							var top = jQuery( document ).height() - footerHeight + "px";

							if ( documentHeight < window.innerHeight ) {
								$footer.css( {
									position: "absolute",
									bottom: 0,
									width: "100%"
								} );

							}

						} else {
							loadMore = false;
							preloader.remove();
						}
					} ).fail( function ( jqXHR, textStatus, errorThrown ) {
						console.log( errorThrown );
					} );

				}
			}
		</script>
		<?php
	}
}
?>
