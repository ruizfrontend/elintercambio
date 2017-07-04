<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js no-svg">
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<link href="https://fonts.googleapis.com/css?family=Lato:300,900|Ubuntu:400,700" rel="stylesheet">
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
<meta name="viewport" content="width=device-width, initial-scale=1">

<?php global $projData; ?>
<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>

<?php if(!$projData['isHome']): // la home lleva el menu en el cuerpo para el sticky ?>
	<?php include(get_template_directory() . '/menu.php'); ?>
<?php endif; ?>