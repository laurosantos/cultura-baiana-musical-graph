<?php
/**
 * Plugin Name: Cultura Baiana Musical Graph
 * Description: Gera grafos JSON-LD musicais personalizados para páginas biográficas e obras musicais.
 * Version: 0.1.0
 * Author: Lauro Santos
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

add_action( 'wp_head', 'cbmg_output_jsonld_graph', 30 );

function cbmg_output_jsonld_graph() {
    if ( ! is_singular() ) {
        return;
    }

    $post_id = get_queried_object_id();

    if ( ! $post_id ) {
        return;
    }

    $custom_graph = get_post_meta( $post_id, '_cbmg_jsonld_graph', true );

    if ( empty( $custom_graph ) && function_exists( 'get_field' ) ) {
        $acf_graph = get_field( 'cbmg_jsonld_graph', $post_id );

        if ( ! empty( $acf_graph ) ) {
            $custom_graph = $acf_graph;
        }
    }

    if ( empty( $custom_graph ) ) {
        return;
    }

    if ( is_array( $custom_graph ) ) {
        $decoded = $custom_graph;
    } else {
        $decoded = json_decode( wp_unslash( $custom_graph ), true );
    }

    if ( json_last_error() !== JSON_ERROR_NONE || ! is_array( $decoded ) ) {
        return;
    }

    echo "\n<script type=\"application/ld+json\">\n";
    echo wp_json_encode(
        $decoded,
        JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT
    );
    echo "\n</script>\n";
}