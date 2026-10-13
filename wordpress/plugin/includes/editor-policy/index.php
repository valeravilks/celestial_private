<?php
/**
 * Global editor presentation policy.
 */

defined( 'ABSPATH' ) || exit;

/**
 * Hide typography selectors without removing the theme's runtime tokens.
 */
function celestial_restrict_editor_design_controls( array $settings ): array {
	$settings['__experimentalFeatures']['typography']['fontFamilies'] = array();
	$settings['__experimentalFeatures']['typography']['fontSizes']    = array();
	$settings['fontSizes']                                          = array();
	$settings['disableCustomFontSizes']                             = true;
	$settings['disableCustomColors']                                = true;
	$settings['disableCustomGradients']                             = true;
	$settings['enableCustomSpacing']                               = false;
	$settings['enableCustomUnits']                                 = false;
	$settings['enableCustomLineHeight']                            = false;
	$settings['enableAppearanceTools']                             = false;
	$settings['enableBorderControl']                               = false;
	$settings['colors']                                            = array();
	$settings['gradients']                                         = array();

	return $settings;
}

add_filter( 'block_editor_settings_all', 'celestial_restrict_editor_design_controls' );
