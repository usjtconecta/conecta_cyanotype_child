<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Conecta - Cyanotype Child
 */
?>
		<?php get_sidebar(); ?>

	</div><!-- .site-content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="site-info">
		<?php print date('Y'); ?> <a href="http://usjt.br/" target="_blank">Universidade São Judas Tadeu</a><br />
		<img class="footer-cc" src="<?php echo get_stylesheet_directory_uri(); ?>/img/footer_cc.png" align="absmiddle" alt="Creative Commons" /> Conteúdo licenciado sob <a href="https://creativecommons.org/licenses/by-nc/4.0/" target="_blank">Creative Commons by-nc</a><br />
		Agência Conecta usa <a href="http://wordpress.org" target="_blank">Wordpress</a> - tema <a href="https://wordpress.com/themes/" rel="designer" target="_blank">Cyanotype</a>
		</div><!-- .site-info -->
	</footer><!-- .site-footer -->
</div><!-- .site -->

<?php wp_footer(); ?>
</body>
</html>
