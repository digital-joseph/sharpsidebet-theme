<?php
/**
 * Footer.
 *
 * @package Sharpside
 */
?>
</main><!-- #content -->

<footer class="site-footer">
	<div class="wrap">
		<div class="f__grid">
			<div style="max-width:280px">
				<a class="brand" href="<?php echo esc_url( home_url( '/' ) ); ?>" style="margin-bottom:14px" rel="home">
					<img class="brand-logo" src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/sharpside-logo.png' ); ?>" width="796" height="160" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
				</a>
				<p style="color:var(--smoke);font-size:13.5px"><?php echo esc_html( get_bloginfo( 'description' ) ? get_bloginfo( 'description' ) : 'The sharp side of every line. Disciplined analytics for bettors who want receipts.' ); ?></p>
			</div>
			<div class="f__links">
				<?php if ( has_nav_menu( 'footer' ) ) : ?>
					<div class="f__col">
						<h5><?php esc_html_e( 'Explore', 'sharpside' ); ?></h5>
						<?php wp_nav_menu( array( 'theme_location' => 'footer', 'container' => false, 'menu_class' => 'foot-menu', 'depth' => 1 ) ); ?>
					</div>
				<?php else : ?>
					<div class="f__col">
						<h5>Product</h5>
						<ul>
							<li><a href="<?php echo esc_url( home_url( '/track-record/' ) ); ?>">Track Record</a></li>
							<li><a href="<?php echo esc_url( home_url( '/method/' ) ); ?>">Playbook</a></li>
							<li><a href="<?php echo esc_url( home_url( '/subscriptions/' ) ); ?>">Plans</a></li>
							<li><a href="<?php echo esc_url( home_url( '/blog/' ) ); ?>">Blog</a></li>
						</ul>
					</div>
					<div class="f__col">
						<h5>Company</h5>
						<ul>
							<li><a href="<?php echo esc_url( home_url( '/about/' ) ); ?>">About</a></li>
							<li><a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">Contact</a></li>
							<li><a href="https://www.instagram.com/sharpsidepicks/" rel="noopener">Instagram</a></li>
						</ul>
					</div>
				<?php endif; ?>
				<div class="f__col">
					<h5>Legal</h5>
					<ul>
						<li><a href="<?php echo esc_url( home_url( '/terms/' ) ); ?>">Terms</a></li>
						<li><a href="<?php echo esc_url( home_url( '/privacy/' ) ); ?>">Privacy</a></li>
						<li><a href="<?php echo esc_url( home_url( '/responsible-gambling/' ) ); ?>">Responsible Gambling</a></li>
					</ul>
				</div>
			</div>
		</div>
		<div class="rg">⚠ 21+ · <?php esc_html_e( 'If gambling is a problem, call 1-800-GAMBLER', 'sharpside' ); ?></div>
		<div class="disc">
			<?php echo esc_html( get_bloginfo( 'name' ) ); ?> provides sports information and statistical analysis for entertainment purposes only. Nothing here is a guarantee of winnings, financial advice, or a solicitation to place a wager. Sports betting involves risk, including loss of funds. Never bet more than you can afford to lose, and only where legal in your jurisdiction. Some outbound links may be affiliate links through which <?php echo esc_html( get_bloginfo( 'name' ) ); ?> may earn a commission at no cost to you. &copy; <span id="yr"><?php echo esc_html( date_i18n( 'Y' ) ); ?></span> <?php echo esc_html( get_bloginfo( 'name' ) ); ?>. All rights reserved.
		</div>
	</div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
