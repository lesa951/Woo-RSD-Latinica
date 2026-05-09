<?php
/**
 * Plugin Name: RSD na latinici
 * Plugin URI:  https://sasahuremovic.rs
 * Description: Jednostavan dodatak koji dodaje srpski dinar (RSD) kao valutu za WooCommerce.
 * Version:     1.0.0
 * Requires at least: 6.0
 * Requires PHP: 7.4
 * Requires Plugins: woocommerce
 * Author: Saša Huremović
 * Author URI:  https://sasahuremovic.rs
 * License:     GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: rsd-na-latinici
 * Domain Path: /languages
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Ucitava prevode plugina.
 *
 * @return void
 */
function sh_rsd_ucitaj_textdomain() {
	load_plugin_textdomain( 'rsd-na-latinici', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
}

add_action( 'plugins_loaded', 'sh_rsd_ucitaj_textdomain' );

/**
 * Dodaje RSD u listu WooCommerce valuta.
 *
 * @param array<string, string> $valute Lista dostupnih valuta.
 * @return array<string, string>
 */
function sh_rsd_dodaj_valutu( $valute ) {
	$valute['RSD'] = __( 'Srpski dinar (RSD)', 'rsd-na-latinici' );

	return $valute;
}

add_filter( 'woocommerce_currencies', 'sh_rsd_dodaj_valutu' );

/**
 * Definise simbol za RSD valutu.
 *
 * @param string $simbol        Trenutni simbol valute.
 * @param string $kod_valute    Kod valute.
 * @return string
 */
function sh_rsd_dodaj_simbol_valute( $simbol, $kod_valute ) {
	if ( 'RSD' === $kod_valute ) {
		return 'RSD';
	}

	return $simbol;
}

add_filter( 'woocommerce_currency_symbol', 'sh_rsd_dodaj_simbol_valute', 10, 2 );
