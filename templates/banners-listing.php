<?php

$query = new WP_Query( array(
	'post_type' => 'sa_banner',
) );

$posts = $query->posts;

?>

<link rel="stylesheet" href="https://use.typekit.net/eip0gix.css">

<section class="sa-section-banners">
	<div class="section__logo">
		<img src="<?php echo SA_PLUGIN_URL . 'images/sleek-announce-logo.png' ?>"/>
	</div><!-- /.section__logo -->

	<div class="section__inner">
		<div class="section__content">
			<header class="section__head">
				<p><?php echo __( 'Banners Library', 'mb-sa' ) ?></p>
			</header><!-- /.section__head -->

			<div class="section__body">
				<div class="sa-banners">
					<?php if ( $query->have_posts() ): ?>
						<div class="banners__head">
							<p><?php echo __( 'Title', 'mb-sa' ) ?></p>
						</div><!-- /.banners__head -->

						<div class="banners__body">
							<ul>
								<?php foreach ( $posts as $post ) :

									$post_status = $post->post_status;

									if ( $post_status === 'publish' ) {
										$post_status = 'live';
									} else {
										$post_status = 'disabled';
									}

									$post_disabled = carbon_get_post_meta( $post->ID, 'sa_status' );

									if ( $post_disabled === 'sa_disabled' ) {
										$post_status = 'disabled';
									}

								?>
									<?php include SA_PLUGIN_DIR . 'templates/parts/banners-item.php'; ?>
								<?php endforeach; ?>
							</ul>
						</div><!-- /.banners__body -->
					<?php endif ?>
				</div><!-- /.sa-banners -->
			</div><!-- /.section__body -->
		</div><!-- /.section__content -->

		<div class="section__sidebar">
			<div class="section__sidebar-navigation">
				<ul>
					<li>
						<a href="<?php echo admin_url('post-new.php?post_type=sa_banner'); ?>"><?php echo __( 'Design New Banner', 'mb-sa' ) ?></a>
					</li>

					<li>
						<a target="_blank" href="https://mybrindle.com/quickpop-pro-documentation/"><?php echo __( 'SleekAnnounce Documentation', 'mb-sa' ) ?></a>
					</li>
				</ul>
			</div><!-- /.section__sidebar-navigation -->
		</div><!-- /.section__sidebar -->

		<div class="section__confirmation">
			<div class="sa-banner-duplicate-confirmation">
				<p><?php echo sprintf( '%s', __( 'Are you sure you want to duplicate this banner?', 'mb-sa' ) ) ?></p>

				<a href="#" class="sa-btn js-confirm-duplicate">
					<?php _e( 'Confirm', 'mb-sa' ); ?>
				</a>

				<a href="#" class="sa-btn js-reject-duplicate">
					<?php _e( 'Cancel', 'mb-sa' ); ?>
				</a>
			</div><!-- /.sa-banner-duplicate-confirmation -->
		</div><!-- /.section__confirmation -->
	</div><!-- /.section__inner -->
</section><!-- /.sa-section-banners -->