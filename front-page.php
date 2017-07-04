<?php
/**
 * The front page template file
 */

include(get_template_directory() . '/initEiio.php');

get_header(); ?>

<?php if($projData['isHome']): ?>
	<div id="main">
		<?php foreach ($projData['homeData']['bloques'] as $bloque): ?>
			<div id="<?php echo $bloque['nombre_seccion']; ?>" class="blck <?php echo 'blck-' . $bloque['nombre_seccion'] . ' blck-' . ($bloque['color'] == 'gris' || $bloque['color'] == 'negro' ? 'dark' : 'light') . ' blck-' . $bloque['color']; ?>">

				<?php if($bloque['fondo']): // imagen del bloque ?>	
					<div class="blck-img">
						<img src="<?php echo $bloque['fondo']['url']; ?>" width="<?php echo $bloque['fondo']['width']; ?>" height="<?php echo $bloque['fondo']['height']; ?>" alt="<?php echo $bloque['fondo']['alt']; ?>" title="<?php echo $bloque['fondo']['title']; ?>">
					</div>
				<?php endif; ?>

				<?php if($bloque['titular_linea1']): // bloque de texto principal ?>

					<div class="blck-main<?php echo $bloque['fondo'] ? ' blck-fondo' : ''; ?>"><div class="blck-main-wrap">
						<h2>
							<div class="hd-l1"><span><?php echo $bloque['titular_linea1']; ?></span></div>
							<?php if($bloque['titular_linea_2']): ?><div class="hd-l2"><span><?php echo $bloque['titular_linea_2']; ?></span></div><?php endif; ?>
						</h2>

						<?php if($bloque['descripcion']): ?>
							<?php echo $bloque['descripcion']; ?>
						<?php endif; ?>
					</div></div>
				<?php endif; ?>
												

					<?php // bottom page ?>
				<?php switch($bloque['nombre_seccion']): 
					case 'Intro': ?>
						
					<?php break; ?>
				

					<?php case 'que': break; ?>
				

					<?php case 'quienes': // slide del equipo ?>
						<div class="bl-quienes swiper-container clearfix"><div class="bl-quienes-wrap swiper-wrapper clearfix">

							<?php foreach ($projData['homeData']['equipo'] as $person): ?>
								<div class="bl-quienes-elm swiper-slide">
									<div class="bl-quienes-main">

										<h4 class="ft-lato"><?php echo $person['nombre']; ?></h4>

										<?php if($person['puesto']): ?><p><?php echo $person['puesto']; ?></p><?php endif; ?>

										<ul class="bl-quienes-social">
											<?php if($person['twitter']): ?>
												<li><a target="_blank" href="<?php echo $person['twitter']; ?>" title="Perfil completo en Twitter"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
											<?php endif; ?>

											<li><a href="#" target="_blank" class="follow-contact" title="Contacta conmigo"><i class="fa fa-envelope" aria-hidden="true"></i></a></li>

											<?php if($person['linkedin']): ?>
												<li><a target="_blank" href="<?php echo $person['linkedin']; ?>" title="Perfil completo en Linkedin"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
											<?php endif; ?>
										</ul>

									</div>

									<?php if($person['foto']): ?>
										<div class="bl-quienes-img"><img src="<?php echo $person['foto']['url']; ?>" width="<?php echo $person['foto']['width']; ?>" height="<?php echo $person['foto']['height']; ?>" alt="<?php echo $person['foto']['alt']; ?>" title="<?php echo $person['foto']['title']; ?>"></div>
									<?php endif; ?>

								</div>
							<?php endforeach; ?>

						</div></div>
					<?php break; ?>

				
					<?php case 'whom': ?>
						<div class="bl-aliados clearfix">
							<?php foreach ($projData['homeData']['textos_aliados'] as $idx => $sect): ?>
								<div class="bl-aliados-sct">

									<h4><i class="fa fa-chevron-circle-right" aria-hidden="true"></i><?php echo $sect['titulo']; ?></h4>
									<?php if($sect['descripcion']): ?><p><?php echo $sect['descripcion']; ?></p><?php endif; ?>

									<?php switch($idx): 
										case 0: // financiación ?>
											<div class="bl-financiacion clearfix">
												<?php foreach ($projData['homeData']['fundaciones'] as $fundacion): ?>
													<?php if($fundacion['url']): ?>
														<div class="blck-logo">
															<a target="_blank" href="<?php echo $fundacion['url']; ?>" title="<?php echo $fundacion['nombre']; ?>">
																<img src="<?php echo $fundacion['logo']['url']; ?>" width="<?php echo $fundacion['logo']['width']; ?>" height="<?php echo $fundacion['logo']['height']; ?>" alt="<?php echo $fundacion['logo']['alt']; ?>" title="<?php echo $fundacion['logo']['title']; ?>">
															</a>
														</div>
													<?php else: ?>
														<div class="blck-logo">
															<img src="<?php echo $fundacion['logo']['url']; ?>" width="<?php echo $fundacion['logo']['width']; ?>" height="<?php echo $fundacion['logo']['height']; ?>" alt="<?php echo $fundacion['logo']['alt']; ?>" title="<?php echo $fundacion['logo']['title']; ?>">
														</div>
													<?php endif; ?>
												<?php endforeach; ?>
											</div>
										<?php break; ?>

										<?php case 1: // desarrollo ?>
											<img style="display: block; margin: 0 auto;" src="<?php echo $projData['homeUrl']; ?>/wp-content/uploads/2017/07/logo-medio-bl.png" alt="">
										<?php break; ?>

										<?php case 2: // publicación ?>
											<div class="bl-financiacion clearfix">
												<?php foreach ($projData['homeData']['medios'] as $fundacion): ?>
													<?php if($fundacion['url']): ?>
														<div class="blck-logo">
															<a target="_blank" href="<?php echo $fundacion['url']; ?>" title="<?php echo $fundacion['nombre']; ?>">
																<img style="display: block; margin: 0 auto 1em auto;" src="<?php echo $fundacion['logo']['url']; ?>" width="<?php echo $fundacion['logo']['width']; ?>" height="<?php echo $fundacion['logo']['height']; ?>" alt="<?php echo $fundacion['logo']['alt']; ?>" title="<?php echo $fundacion['logo']['title']; ?>">
															</a>
														</div>
													<?php else: ?>
														<div class="blck-logo">
															<img src="<?php echo $fundacion['logo']['url']; ?>" width="<?php echo $fundacion['logo']['width']; ?>" height="<?php echo $fundacion['logo']['height']; ?>" alt="<?php echo $fundacion['logo']['alt']; ?>" title="<?php echo $fundacion['logo']['title']; ?>">
														</div>
													<?php endif; ?>
												<?php endforeach; ?>
											</div>
										<?php break; ?>

									<?php endswitch; ?>
								</div>
							<?php endforeach; ?>
						</div>
					<?php break; ?>

				
					<?php case 'portfolio': ?>
						<?php echo 'SLIDE DE PROYECTOS'; ?>
						<?php
						    $loop = new WP_Query( array( 'ignore_sticky_posts' => 1, 'posts_per_page' => 5 ) );
						    if ( $loop->have_posts() ) :
						        while ( $loop->have_posts() ) : $loop->the_post(); ?>
						            <div class="pindex">
						                <?php if ( has_post_thumbnail() ) { ?>
						                    <div class="pimage">
						                        <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); ?></a>
						                    </div>
						                <?php } ?>
						                <div class="ptitle">
						                    <h2><?php echo get_the_title(); ?></h2>
						                </div>
						            </div>
						        <?php endwhile;
						        if (  $loop->max_num_pages > 1 ) : ?>
						            <div id="nav-below" class="navigation">
						                <div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Previous', 'domain' ) ); ?></div>
						                <div class="nav-next"><?php previous_posts_link( __( 'Next <span class="meta-nav">&rarr;</span>', 'domain' ) ); ?></div>
						            </div>
						        <?php endif;
						    endif;
						    wp_reset_postdata();
						?>
					<?php break; ?>

				
					<?php case 'contacto': ?>
						<div class="bl-contacto">
							<div class="bl-form">
								<?php echo do_shortcode( '[contact-form-7 id="70" title="Contact form 1"]' ); ?>
							</div>
							<div class="bl-contacto-data">
								<h4>Estamos en</h4>
								<p>Ciudad de Guatemala</p>
								<p><a href="mailto:contacto@elintercamb.io">contacto@elintercamb.io</a></p>
							</div>
							<div class="bl-contacto-map">
								<a target="_blank" href="https://www.google.es/maps/place/Guatemala+City,+Guatemala/@14.6263756,-90.562772,12z/data=!3m1!4b1!4m5!3m4!1s0x8589a180655c3345:0x4a72c7815b867b25!8m2!3d14.6349149!4d-90.5068824?hl=en">
									<img style="display: block" src="<?php echo $projData['homeUrl']; ?>/wp-content/uploads/2017/07/bg-map.jpg" alt="">
								</a>
							</div>
						</div>
					<?php break; ?>


					<?php /* default: ?>
					<?php break; */ ?>
				
				<?php endswitch; ?>
			</div>

			<?php if($bloque['nombre_seccion'] == 'Intro'): ?>
				<?php include(get_template_directory() . '/menu.php'); ?>
			<?php endif; ?>

		<?php endforeach; ?>
	</div>
<?php endif; ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/3.4.2/js/swiper.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/libs/jquery.waypoints.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/libs/waypoints-sticky.js"></script>


<?php get_footer();?>

</body>
</html>
