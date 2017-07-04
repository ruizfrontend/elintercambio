<?php 

$homeUrl = get_home_url();
$isHome = is_front_page();
$currentUrl = home_url(add_query_arg(array(),$wp->request));
$frontpage_id = get_option('page_on_front');
$homeData = get_fields($frontpage_id);

print_R($homeData);die();

$projData = array(
	'homeUrl' => $homeUrl,
	'isHome' => $isHome,
	'currentUrl' => $currentUrl,
	'frontpage_id' => $frontpage_id,
	'homeData' => $homeData
);