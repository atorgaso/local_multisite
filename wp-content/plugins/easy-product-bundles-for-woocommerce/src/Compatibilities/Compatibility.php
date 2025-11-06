<?php

namespace AsanaPlugins\WooCommerce\ProductBundles\Compatibilities;

defined( 'ABSPATH' ) || exit;

class Compatibility {

	public static function init() {
		if ( 'woodmart' === get_stylesheet() || 'woodmart' === get_template() ) {
			Woodmart::init();
		}

		// CURCY - Multi Currency for WooCommerce compatibility.
		if (
			is_callable( [ '\WOOMULTI_CURRENCY_F_Data', 'get_ins' ] ) ||
			is_callable( [ '\WOOMULTI_CURRENCY_Data', 'get_ins' ] )
		) {
			Curcy::init();
		}

		// FOX - WooCommerce Currency Switcher(WOOCS) compatibility.
		if ( class_exists( '\WOOCS_STARTER' ) ) {
			WOOCS::init();
		}

		if ( class_exists( '\WooCommerce_Square_Loader' ) ) {
			Square::init();
		}

		// WooCommerce Payments compatibility.
		if ( defined( 'WCPAY_PLUGIN_FILE' ) && \WC_Payments_Features::is_customer_multi_currency_enabled() ) {
			WooPayments::init();
		}

		SideCart::init();
	}

}
