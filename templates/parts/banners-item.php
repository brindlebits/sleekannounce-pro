<li>
	<div class="sa-banner" data-id="<?php echo $post->ID; ?>">
		<div class="sa-banner__content">
			<p><a href="<?php echo get_edit_post_link( $post->ID ); ?>"><?php echo get_the_title( $post->ID ) ?></p></a>
		</div><!-- /.sa-banner__content -->

		<div class="sa-banner__actions">
			<ul>
				<li>
					<div data-status="<?php echo $post_status; ?>" class="sa-dropdown-status sa-js-status-dropdown">
						<div class="dropdown__head">
							<span
							class="sa-status <?php echo $post_status === 'live' ? 'sa-live' : 'sa-draft' ?>">
								<?php echo ucfirst( $post_status ); ?>
							</span>
						</div><!-- /.dropdown__head -->

						<div class="dropdown__body">
							<ul>
								<li>
									<a class="sa-live" data-status="live" href="#">
										<?php _e( 'Live', 'mb-sa' ); ?>
									</a>
								</li>

								<li>
									<a class="sa-draft" data-status="disabled" href="#">
										<?php _e( 'Disabled', 'mb-sa' ); ?>
									</a>
								</li>
							</ul>
						</div><!-- /.dropdown__body -->
					</div><!-- /.sa-dropdown -->
				</li>

				<li>
					<a class="sa-banner__btn-duplicate js-duplicate-popup" href="">
						<img src="<?php echo SA_PLUGIN_URL . 'images/ico-duplicate.png' ?>" alt="" />
					</a>
				</li>

				<li>
					<a class="sa-banner__btn-edit" href="<?php echo get_delete_post_link( $post->ID, '', true ) ?>">
						<img src="<?php echo SA_PLUGIN_URL . 'images/ico-trash.png' ?>" alt="" />
					</a>
				</li>

				<li>
					<a class="sa-banner__btn-edit" href="<?php echo get_edit_post_link( $post->ID ) ?>">
						<img src="<?php echo SA_PLUGIN_URL . 'images/ico-edit.png' ?>" alt="" />
					</a>
				</li>
			</ul>
		</div><!-- /.sa-banner__actions -->
	</div><!-- /.qp-popup -->
</li>