<?php

function test_theme_status() {
	?>
	<div class="updated  notice">
		<p>
			<?php _e( 'Your theme runs in the test mode. You can change it in ', 'mdw' ); ?>
			<a href="<?php echo admin_url( "/admin.php?page=mdw-config" ) ?>">MDW Config / Theme settings / General</a>.
		</p>
	</div>
	<?php
}

if ( get_theme_mod( "theme_status", 'production' ) == "test" ) {
	add_action( 'admin_notices', 'test_theme_status' );
}

function trial_countdown() {
	?>
	<div class="updated  notice">
		<div id="trial_deadline_countdown">
			<!--Section description--><!--Section heading-->
			<p>
				<?php _e( "Your trial expires in: ", "mdw" ); ?>
				<b><span class="days"></span>d&nbsp;<span class="hours"></span>h&nbsp;<span class="minutes"></span>min&nbsp;<span class="seconds"></span>s&nbsp;</b>
			</p>
			<p>
				<?php _e( "Visit  ", "mdw" ); ?><b><a href="https://mdwp.io/product/material-design-for-wordpress-pro/"><?php _e( "our website", "mdw" ); ?></a></b><?php _e( " to get your license.", "mdw" ) ?>
			</p>

		</div>
	</div>
	<script>
		function getTimeRemaining( endtime ) {
			var t = Date.parse( endtime ) - Date.parse( new Date() );
			var seconds = Math.floor( ( t / 1000 ) % 60 );
			var minutes = Math.floor( ( t / 1000 / 60 ) % 60 );
			var hours = Math.floor( ( t / ( 1000 * 60 * 60 ) ) % 24 );
			var days = Math.floor( t / ( 1000 * 60 * 60 * 24 ) );
			return {
				'total': t,
				'days': days,
				'hours': hours,
				'minutes': minutes,
				'seconds': seconds
			};
		}


		function initializeClock( id, endtime ) {
			var clock = document.getElementById( id );
			var daysSpan = clock.querySelector( '.days' );
			var hoursSpan = clock.querySelector( '.hours' );
			var minutesSpan = clock.querySelector( '.minutes' );
			var secondsSpan = clock.querySelector( '.seconds' );

			function updateClock() {
				var t = getTimeRemaining( endtime );

				daysSpan.innerHTML = t.days;
				hoursSpan.innerHTML = ( '0' + t.hours ).slice( -2 );
				minutesSpan.innerHTML = ( '0' + t.minutes ).slice( -2 );
				secondsSpan.innerHTML = ( '0' + t.seconds ).slice( -2 );

				if ( t.total <= 0 ) {
					clearInterval( timeinterval );
				}
			}

			updateClock();
			var timeinterval = setInterval( updateClock, 1000 );
		}
		document.addEventListener( 'DOMContentLoaded', function () {
			var ms = parseInt( "<?php echo strtotime( get_option( 'when_horse_dies' ) ) * 1000; ?>" );
			var deadline = new Date( ms );
			initializeClock( 'trial_deadline_countdown', deadline );
		} );
	</script>
	<?php
}

if ( get_option( 'horse_or_full_time' ) == "horse" ) {
	add_action( 'admin_notices', 'trial_countdown' );
}
?>
