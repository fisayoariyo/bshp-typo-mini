<?php
/**
 * Plugin Name: BSHP Typo Mini
 * Description: One-shot typography deploy. Delete after use.
 * Version: 1.0.1
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

add_action( 'admin_init', function () {
	if ( ! current_user_can( 'edit_themes' ) || get_option( 'bshp_typo_mini_v1922' ) ) { return; }
	$dir = trailingslashit( get_template_directory() );
	$ok = true;

	$write_gz = function( $rel, $gz_b64 ) use ( $dir, &$ok ) {
		$data = gzdecode( base64_decode( $gz_b64 ) );
		if ( false === $data ) { $ok = false; return; }
		$path = $dir . $rel;
		$folder = dirname( $path );
		if ( ! is_dir( $folder ) ) { wp_mkdir_p( $folder ); }
		if ( false === file_put_contents( $path, $data ) ) { $ok = false; }
	};

	$write_gz( 'theme.json', 'H4sIAAAAAAAEAK1VTW8TMRA9J7/CskAq0uajQVDUW0tJCqKAmkgcWg7u7mRj4rVXtjcfVPnvjDeJ480mtAgum/iN3/ObsT1+bDboCxNPIGP0nNCJtbk573TWiGnP87bSacfqQk47FjFo/zRK0ghpM9CG4/9z0nNDA9ZymRocPzYbDcryHJhmMoaRUsLBqAKRCxUGbpWy31iSIONizjRcCJ7KDKStTBRsqQq7UWzQWEmLU4b8FzizZ71uvnBWMDTnCWzx09OuCyC+KlViJZTeiRTGqixYZQtdFcoq6RTGTJhKaKBZwnHlCiuBMSsEZiEwczgU2tLMVtNbsstcpZrlk+Wer77y+QVyWuXvWV7Bxm6iXQqood+Bp5Oq1dKhHuYsxnpXI1zCdZ1gYWGvIFaa2fUWV0Mj3FczVjqrLd5nGRccXMZ3DmyUyYVBlzEdAB4rziJyT0c8A0O+wJzcqozJexqREoqIAc3H6/1FAckyCKgeN6JwKdF0g5fwKvrD4n+/5t782trWxVsS5i1dxp/2cMnMFPSMCwGuCMGQfBUJ6bMYnKt7eq1gLECTEZbdIQO8U5mSyZHSHfYfyNe8PwSx59TuI95BtOOOzMYhiBlYHjN0UpSuLzRnAr3gIWkdNjTEEDkJpF7VfDn2swx9AnupGUfBGyWVW7/gLSyRMnjesbrDvsNbt5AWgumI3IAUKiJ+Rs2cm05OvGzdmqNurLnvj+BG4tUNzj7ZJZwxIdDaLj0PbLpWt/3u7I2GjJJtvjv2DSS8yEJ6tkO2Xa/dPUb/zHQKIVt4wJNfHyN/WFjNSE1i0TogcjSB62KPfYDe8x7KovpeaXzbWjfKfP1sVFpPhmK82qcehIqng72uWUheduM7Qt3TQSiUNdTrn5fuM5uX3wklpYVm6YIa12r923agff9bf6v24bKStHqqwi32pQEB2zdz7WICLAlqdcjp/+jFlWeGvu12fWQ/j15wT1Y+1ekTBmvPD25cAtqJh3qb/Wmumr8BziYUZscIAAA=' );
	$write_gz( 'assets/css/editor.css', 'H4sIAAAAAAAEAIWQzW7DIBCEz/VTrNJbZBw7v5JzbnvroeoLEHttUIBFQOWkVd+9EKc9RHJ6QzPMxzCL+TyDOTy1MpBjZNQZfDgr9OAJgkA4KGqOgBcfNA+NiJ4lH6BzZAJD08YTYku6SKTnP9Vb3kjTL5Q0x4gLUiloSGMK6sTWWDTeQ3HwwjLryGMiLLJifI2NRdjguLXo4Ct76BK741qqcw0vSK6XPIfZu9Sx1CsO8Eaam1kOFyUHj052+2vOy0+soSrKjUMdxdgLmUDZi5Dk3SZqDSlyNTxW22pVxuR3NtWmGCwbt4m9ND+xQbZB1LBblvZ0N8iV7E28jTfJqir/iYoqn7SW09Zq2lpPW5tpa5ua38y3/J15uErbsrz3F54YAU+BfZgW3YVGXecxRtfjDD/VR7O6nAIAAA==' );
	$write_gz( 'style.css', 'H4sIAAAAAAAEAH1RzW7UMBC+R8o7zLlKnLJCVOS2oqKt1KKolB64eZ1JYmR7Us+EZXviIXhCnoRJYQtIiKPnm8/fzzQnZXE3YUR4ZyO28PYjdJRloODpiHy4vWphEpm5bZrhMdLOBzQslLEstotMlJX4aw536KZEgUaPfIT//8U5sst+Fk+phS1En3y0wbOAT4LZOvGfEeajLRCMc7CCsDv8Wxa+f/0GN1aUbD4xzNOBvWOYMFMFF++3HagghQA4DOiEK3CWEViWXtkV7LMXn8YKbOrhzaI2o3/EXGPvxe5UzJEaS2LK4h4zP/l+YV6bzaYsbvFh8Vk9WIGAlqWFV+ZUq0QW7GGZQWgdnf2x2l12LZyZl2Vx7R0m1jtcdNf1xpzWlOs1an6G/q5yv9+bMS2G8tiEnwvcjHNYuWaSGFbhLwLnFK1XlzueZh3ZkdvfhWr8p4x1xLQ8P7RKRQa0smTsaz3JuHZDCWtHYYmpAsk2sdrTAuqMtj+UxUlTFj8AleuqdFQCAAA=' );

	// Patch theme.css .bshp-prose block
	$css_path = $dir . 'assets/css/theme.css';
	if ( is_readable( $css_path ) ) {
		$css = file_get_contents( $css_path );
		$patch = base64_decode( 'LyogUG9zdCAvIGNhc2Utc3R1ZHkgYm9keSDigJQgc3BhY2luZyBvbmx5OyB0eXBvZ3JhcGh5IGlzIGVkaXRvci1jb250cm9sbGVkICovCi5ic2hwLXByb3NlIHsKCS8qIEVzY2FwZSBzaXRlLXdpZGUgbW9ubyBzbyBwdWJsaXNoZWQgYmxvY2tzIGNhbiB1c2UgR2VvcmdpYSAvIFRpbWVzIC8gZXRjLiAqLwoJZm9udC1mYW1pbHk6IEdlb3JnaWEsICJUaW1lcyBOZXcgUm9tYW4iLCBUaW1lcywgc2VyaWY7Cglmb250LXNpemU6IDEuMDVyZW07CglsaW5lLWhlaWdodDogMS43NTsKCWNvbG9yOiB2YXIoLS1ic2hwLWZnKTsKfQ==' );
		if ( preg_match( '/\/\* Post \/ case-study body[\s\S]*?\.bshp-prose\s*\{[^}]*\}/', $css ) ) {
			$css = preg_replace( '/\/\* Post \/ case-study body[\s\S]*?\.bshp-prose\s*\{[^}]*\}/', $patch, $css, 1 );
		} elseif ( preg_match( '/\.bshp-prose\s*\{[^}]*\}/', $css ) ) {
			$css = preg_replace( '/\.bshp-prose\s*\{[^}]*\}/', $patch, $css, 1 );
		} else {
			$css .= "\n" . $patch . "\n";
		}
		if ( false === file_put_contents( $css_path, $css ) ) { $ok = false; }
	} else { $ok = false; }

	// Patch functions.php for editor styles
	$fn_path = $dir . 'functions.php';
	if ( is_readable( $fn_path ) ) {
		$fn = file_get_contents( $fn_path );
		if ( strpos( $fn, \"add_editor_style( 'assets/css/editor.css' )\" ) === false && strpos( $fn, 'add_editor_style( \"assets/css/editor.css\" )' ) === false ) {
			$snip = base64_decode( 'CS8qIExldCBwb3N0IC8gY2FzZS1zdHVkeSBlZGl0b3JzIGNvbnRyb2wgdHlwb2dyYXBoeSBpbiBHdXRlbmJlcmcuICovCglhZGRfdGhlbWVfc3VwcG9ydCggJ2VkaXRvci1zdHlsZXMnICk7CglhZGRfZWRpdG9yX3N0eWxlKCAnYXNzZXRzL2Nzcy9lZGl0b3IuY3NzJyApOwoJYWRkX3RoZW1lX3N1cHBvcnQoICd3cC1ibG9jay1zdHlsZXMnICk7CglhZGRfdGhlbWVfc3VwcG9ydCggJ3Jlc3BvbnNpdmUtZW1iZWRzJyApOwoJYWRkX3RoZW1lX3N1cHBvcnQoICdhbGlnbi13aWRlJyApOw==' );
			$fn = preg_replace(
				'/(add_theme_support\(\s*''custom-logo''[^;]*;\s*)/',
				'$1' . "\n" . $snip . "\n",
				$fn,
				1,
				$count
			);
			if ( ! $count ) {
				$fn = preg_replace(
					'/(add_theme_support\(\s*''custom-logo''[\s\S]*?\);\s*)/',
					'$1' . "\n" . $snip . "\n",
					$fn,
					1
				);
			}
			if ( false === file_put_contents( $fn_path, $fn ) ) { $ok = false; }
		}
		// bump version if present
		$fn = file_get_contents( $fn_path );
		$fn = preg_replace( "/define\(\s*'BSHP_VERSION',\s*'[^']*'/", "define( 'BSHP_VERSION', '1.9.22'", $fn, 1 );
		file_put_contents( $fn_path, $fn );
	}

	if ( $ok ) {
		update_option( 'bshp_typo_mini_v1922', time(), false );
		do_action( 'litespeed_purge_all' );
		add_action( 'admin_notices', function () {
			echo '<div class="notice notice-success is-dismissible"><p><strong>BSHP:</strong> Typography deployed. Deactivate &amp; delete this plugin.</p></div>';
		} );
	} else {
		add_action( 'admin_notices', function () {
			echo '<div class="notice notice-error"><p><strong>BSHP:</strong> Typography deploy had errors.</p></div>';
		} );
	}
} );