<?
date_default_timezone_set('Asia/Seoul');
// $myip = $_SERVER["REMOTE_ADDR"];
// if ($myip != "58.232.128.122") {
// 	echo "사이트 준비중입니다.";
// 	exit;
// }

?>
<!DOCTYPE html>
<html class="no-js" <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="profile" href="https://gmpg.org/xfn/11" />
	<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-rqn26AG5Pj86AF4SO72RK5fyefcQ/x32DNQfChxWvbXIyXFePlEktwD18fEz+kQU" crossorigin="anonymous">
	<link href="/wp-content/themes/doubleimg/assets/css/dimg-load-font.css" rel="stylesheet" />
	<script src="/wp-content/themes/doubleimg/assets/js/jquery.js"></script>
	<link href="/wp-content/themes/doubleimg/assets/css/dimg-default.css" rel="stylesheet" />
	<link href="/wp-content/themes/doubleimg/assets/css/dimg-responsive.css" rel="stylesheet" />
	<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-2264064779827388" crossorigin="anonymous"></script>
	<?php wp_head(); ?>
</head>
<body>


<header>
	<div class="dimg-header-wrapper">

		<div class="dimg-logo-area">
			<div class="dimg-logo-img">
				<a href="/"><?= get_custom_logo(); ?></a>
			</div>
			<!-- <div class="dimg-logo-txt">
				<a href="/"><?= get_bloginfo('name'); ?></a>
			</div> -->
		</div><!-- dimg-logo-area -->

		<div class="dimg-menu-area">
			<div class="dimg-menu-wrapper">
				<div class="dimg-mobile-close-btn"><i class="fal fa-times"></i></div>
				<?=
					wp_nav_menu(array(
						'menu'              => 'primary',
						'menu_class'		=> 'dimg-menu',
						'menu_id'			=> 'dimg-primary-menu',
						'theme_location'    => 'primary',
						'depth'             => 2,
						'container'         => 'nav',
						'container_class'   => 'dimg-menu-wrapper-inner'
					));
				?>
			</div>

			<div class="dimg-mobile-menu-btn"><i class="fal fa-bars"></i></div>
		</div><!-- dimg-menu-area -->

	</div><!-- dimg-header-wrapper -->
</header>