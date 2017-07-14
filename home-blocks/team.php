
<div class="bl-quienes swiper-container clearfix">
	<div class="bl-quienes-wrap swiper-wrapper clearfix">

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
				
				<div class="bl-quienes-img">
					<img src="<?php echo $person['foto']['sizes']['proyect-team']; ?>" width="<?php echo $person['foto']['sizes']['proyect-team-width']; ?>" height="<?php echo $person['foto']['sizes']['proyect-team-height']; ?>" alt="<?php echo $person['foto']['alt']; ?>" title="<?php echo $person['foto']['title']; ?>">
				</div>

			</div>
		<?php endforeach; ?>
	</div>
	
    <div class="swiper-button-prev" title="anterior proyecto"><i class="fa fa-chevron-circle-left" aria-hidden="true"></i></div>
    <div class="swiper-button-next" title="siguiente proyecto"><i class="fa fa-chevron-circle-right" aria-hidden="true"></i></div>
</div>