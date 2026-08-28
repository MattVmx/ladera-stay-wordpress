<?php
/**
 * Site footer.
 *
 * @package Ladera_Stay
 */
?>
</main>
<footer class="site-footer">
	<div class="shell footer-grid">
		<div>
			<a class="brand brand-light" href="<?php echo esc_url( home_url( '/' ) ); ?>">
				<span class="brand-mark" aria-hidden="true">L</span>
				<span class="brand-name">Ladera <em>Stay</em></span>
			</a>
			<p data-i18n="footerIntro">Refugios con diseño, naturaleza y tiempo para estar.</p>
		</div>
		<div>
			<p class="footer-label" data-i18n="footerExplore">Explorar</p>
			<a href="#stays" data-i18n="navStays">Estadías</a>
			<a href="#experience" data-i18n="navExperiences">Experiencias</a>
			<a href="#journal">Journal</a>
		</div>
		<div>
			<p class="footer-label" data-i18n="footerContact">Contacto</p>
			<a href="mailto:hola@laderastay.test">hola@laderastay.test</a>
			<p>Patagonia, Argentina</p>
		</div>
		<div>
			<p class="footer-label">Stay in the loop</p>
			<form class="newsletter" action="#" method="post">
				<label class="screen-reader-text" for="ladera-email" data-i18n="yourEmail">Tu email</label>
				<input id="ladera-email" type="email" placeholder="Tu email" data-i18n-placeholder="yourEmail" required>
				<button type="submit" aria-label="Suscribirme">→</button>
			</form>
		</div>
	</div>
	<div class="shell footer-bottom">
		<span>© <?php echo esc_html( gmdate( 'Y' ) ); ?> Ladera Stay</span>
		<span data-i18n="conceptCredit">Proyecto conceptual por Matías Speroni</span>
	</div>
</footer>
<?php wp_footer(); ?>
</body>
</html>
