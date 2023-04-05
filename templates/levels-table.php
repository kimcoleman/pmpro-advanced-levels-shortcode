<<<<<<< HEAD
<?php
/*
	template for layout="table"
*/

global $pmproal_link_arguments;
?>
<table id="pmpro_levels" class="<?php echo pmpro_advanced_levels_wrapper_class( $layout, $template ); ?>">
<thead>
  <tr>
	<?php do_action( 'pmproal_extra_cols_before_header' ); ?>
	<th><?php _e('Level', 'pmpro-advanced-levels-shortcode' );?></th>
	<?php if ( ! empty( $show_price ) ) { ?>
		<th><?php _e( 'Price', 'pmpro-advanced-levels-shortcode' ); ?></th>
	<?php } ?>
	<?php if ( ! empty( $expiration ) ) { ?>
		<th><?php _e( 'Expiration', 'pmpro-advanced-levels-shortcode' ); ?></th>
	<?php } ?>
	<th>&nbsp;</th>
	<?php do_action( 'pmproal_extra_cols_after_header' ); ?>
  </tr>
</thead>
<tbody>
<?php
	foreach( $pmpro_levels_filtered as $level ) {
		$pmproal_link_arguments['level'] = $level->id;
		$current_level = pmpro_hasMembershipLevel( $level->id );
	?>
	<tr id="pmpro_level-<?php echo $level->id; ?>" class="<?php echo pmpro_advanced_levels_level_inner_class( $level->id, $layout, $template, $current_level, $highlight ); ?>">

		<?php do_action( 'pmproal_extra_cols_before_body', $level->id, $template ); ?>

		<td>
			<h2 class="level-name"><?php echo $level->name; ?></h2>
			<?php if ( ! empty( $description ) ) { ?>
				<div class="level-description">
					<?php echo wpautop( $level->description ); ?>
				</div>
			<?php } ?>
		</td>

		<?php if ( ! empty( $show_price ) ) { ?>
			<td class="pmpro_level-price">
				<?php if ( $price === 'full' ) {
						echo pmpro_getLevelCost( $level, true, false );
					} else {
						echo pmpro_getLevelCost( $level, false, true );
					}
				?>
			</td>
		<?php } ?>

		<?php if ( ! empty( $expiration ) ) { ?>
			<td class="pmpro_level-expiration">
			<?php 
				$level_expiration = pmpro_getLevelExpiration( $level );
				if ( empty( $level_expiration ) ) {
					_e( 'Membership Never Expires.', 'pmpro-advanced-levels-shortcode' );
				} else {
					echo $level_expiration;
				}
			?>
			</td>
			<?php
			} 
		?>

		<td>
			<a class="<?php echo pmpro_advanced_levels_level_button_class( $level->id, $layout, $template, $current_level ); ?>" href="<?php echo pmpro_advanced_levels_level_button_link( $pmproal_link_arguments, $level->id, $current_level ); ?>"><?php echo pmpro_advanced_levels_level_button_text( $level->id, $current_level, $checkout_button, $renew_button, $account_button ); ?></a>
		</td>

		<?php do_action( 'pmproal_extra_cols_after_body', $level->id, $template ); ?>

	</tr>
	<?php
	}
?>
</tbody>
</table>
=======
<?php
/*
	template for layout="table"
*/

global $pmproal_link_arguments;
?>
<table id="pmpro_levels" class="<?php
	if(!empty($template))
		echo "pmpro_advanced_levels-" . esc_attr( $template );
	else
		echo "pmpro_advanced_levels-table";
	if($template === "gantry" || $template === "bootstrap")
		echo " table table-striped table-bordered";
?>">
<thead>
  <tr>
	<?php do_action('pmproal_extra_cols_before_header'); ?>
	<th><?php esc_html_e('Level', 'pmpro-advanced-levels-shortcode');?></th>
	<?php if(!empty($show_price)) { ?>
		<th><?php esc_html_e('Price', 'pmpro-advanced-levels-shortcode');?></th>
	<?php } ?>
	<?php if(!empty($expiration)) { ?>
		<th><?php esc_html_e('Expiration', 'pmpro-advanced-levels-shortcode');?></th>
	<?php } ?>
	<th>&nbsp;</th>
	<?php do_action('pmproal_extra_cols_after_header'); ?>
  </tr>
</thead>
<tbody>
<?php	
	$count = 0;
	foreach($pmpro_levels_filtered as $level)
	{
		$pmproal_link_arguments['level'] = $level->id;
		$current_level = pmpro_hasMembershipLevel( $level->id );

	?>
	<tr id="pmpro_level-<?php echo esc_attr( $level->id ); ?>" class="<?php if($current_level) { echo 'pmpro_level-current '; } if($highlight == $level->id) { echo 'pmpro_level-highlight '; } ?>">
		<?php do_action('pmproal_extra_cols_before_body', $level->id, $template); ?>
		<td>
			<h2><?php echo wp_kses( $level->name, pmproal_allowed_html() ); ?></h2>
			<?php if(!empty($description)) { echo wp_kses_post( wpautop($level->description) ); } ?>
		</td>
		<?php if(!empty($show_price)) { ?>
		<td>
			<?php 
				if($price === 'full')
					echo wp_kses( pmpro_getLevelCost( $level, true, false ), array( 'strong' => array() ) );
				else
					echo wp_kses( pmpro_getLevelCost( $level, false, true ), array( 'strong' => array() ) );
			?>
		</td>
		<?php } ?>
		<?php 
			if(!empty($expiration)) 
			{ 
				?>
				<td>
				<?php 
					$level_expiration = pmpro_getLevelExpiration($level);
					if(empty($level_expiration))
						esc_html_e('Membership Never Expires.', 'pmpro-advanced-levels-shortcode');
					else
						echo wp_kses( $level_expiration, pmproal_allowed_html() );
				?>
				</td>
				<?php 
			} 
		?>
		<td>
		<?php if ( ! pmpro_hasMembershipLevel() ) { ?>
			<a class="<?php
				if($template === "genesis" || $template === "foundation" || $template === "twentyfourteen") { echo "button"; }
				elseif($template === "gantry" || $template === "bootstrap") { echo "btn btn-primary"; }
				elseif($template === "woothemes") { echo "woo-sc-button custom"; }
				else { echo "pmpro_btn pmpro_btn-select"; }
			?>" href="<?php echo esc_url( add_query_arg( $pmproal_link_arguments, pmpro_url("checkout", null, "https") ) ); ?>"><?php echo esc_html( $checkout_button ); ?></a>
		<?php } elseif ( !$current_level ) { ?>                	
			<a class="<?php
				if($template === "genesis" || $template === "foundation" || $template === "twentyfourteen") { echo "button"; }
				elseif($template === "gantry" || $template === "bootstrap") { echo "btn btn-primary"; }
				elseif($template === "woothemes") { echo "woo-sc-button custom"; }
				else { echo "pmpro_btn pmpro_btn-select"; }
			?>" href="<?php echo esc_url( add_query_arg( $pmproal_link_arguments, pmpro_url("checkout", null, "https") ) ); ?>"><?php echo esc_html( $checkout_button ); ?></a>
		<?php } elseif($current_level) { ?>      
			
			<?php
				//if it's a one-time-payment level or recurring level that's expiring soon, offer a link to renew	
				$specific_level = pmpro_getSpecificMembershipLevelForUser($current_user->ID, $level->id);										
				if( pmpro_isLevelExpiringSoon( $specific_level) && $specific_level->allow_signups )
				{
				?>
					<a class="<?php
						if($template === "genesis" || $template === "foundation" || $template === "twentyfourteen") { echo "button"; }
						elseif($template === "gantry" || $template === "bootstrap") { echo "btn btn-primary"; }
						elseif($template === "woothemes") { echo "woo-sc-button custom"; }
						else { echo "pmpro_btn pmpro_btn-select"; }
					?>" href="<?php echo esc_url( add_query_arg( $pmproal_link_arguments, pmpro_url("checkout", null, "https") ) ); ?>"><?php echo esc_html( $renew_button ); ?></a>
				<?php
				}
				else
				{
				?>
					<a class="<?php
						if($template === "genesis" || $template === "twentyfourteen") { echo "button"; }
						elseif($template === "foundation") { echo "button info"; }
						elseif($template === "gantry" || $template === "bootstrap") { echo "btn btn-info"; }
						elseif($template === "woothemes") { echo "woo-sc-button silver"; }
						else { echo "pmpro_btn disabled"; }
					?>" href="<?php echo esc_url( pmpro_url("account") ); ?>"><?php echo esc_html( $account_button ); ?></a>
				<?php
				}
			?>
			
		<?php } ?>
		</td>
		<?php do_action('pmproal_extra_cols_after_body', $level->id, $template); ?>
	</tr>
	<?php
	}
?>
</tbody>
</table>
>>>>>>> 5aa10857bb6d3e6f651ba1fc9ece174aa15e5fe7
