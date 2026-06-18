<?php
/**
 * Plugin Name:       Cultura Baiana Musical Graph
 * Description:       Inserção manual de JSON-LD (dados estruturados) em posts, páginas e custom post types.
 * Version:           0.1.0
 * Author:            Lauro Santos
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       cultura-baiana-musical-graph
 */

/*
Cultura Baiana Musical Graph
Copyright (C) 2026  Lauro Santos

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <https://www.gnu.org/licenses/>.
*/

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

add_action( 'wp_head', 'cbmg_output_jsonld_graph', 30 );
add_action( 'add_meta_boxes', 'cbmg_register_jsonld_meta_box' );
add_action( 'save_post', 'cbmg_save_jsonld_graph_meta' );

function cbmg_get_supported_post_types() {
    $post_types = get_post_types(
        array(
            'public' => true,
        ),
        'names'
    );

    unset( $post_types['attachment'] );

    return array_values( $post_types );
}

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

function cbmg_register_jsonld_meta_box() {
    foreach ( cbmg_get_supported_post_types() as $post_type ) {
        add_meta_box(
            'cbmg_jsonld_graph',
            __( 'Grafo JSON-LD musical', 'cultura-baiana-musical-graph' ),
            'cbmg_render_jsonld_meta_box',
            $post_type,
            'normal',
            'default'
        );
    }
}

function cbmg_render_jsonld_meta_box( $post ) {
    $value = get_post_meta( $post->ID, '_cbmg_jsonld_graph', true );

    wp_nonce_field( 'cbmg_save_jsonld_graph_meta', 'cbmg_jsonld_graph_nonce' );
    ?>
    <p>
        <label for="cbmg_jsonld_graph">
            <?php esc_html_e( 'Insira o grafo JSON-LD personalizado para este conteúdo.', 'cultura-baiana-musical-graph' ); ?>
        </label>
    </p>
    <textarea
        id="cbmg_jsonld_graph"
        name="cbmg_jsonld_graph"
        rows="18"
        style="width: 100%; font-family: monospace;"
    ><?php echo esc_textarea( $value ); ?></textarea>
    <?php
}

function cbmg_save_jsonld_graph_meta( $post_id ) {
    if ( ! isset( $_POST['cbmg_jsonld_graph_nonce'] ) ) {
        return;
    }

    if ( ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['cbmg_jsonld_graph_nonce'] ) ), 'cbmg_save_jsonld_graph_meta' ) ) {
        return;
    }

    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }

    if ( wp_is_post_revision( $post_id ) ) {
        return;
    }

    $post_type = get_post_type( $post_id );

    if ( ! in_array( $post_type, cbmg_get_supported_post_types(), true ) ) {
        return;
    }

    if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    }

    if ( ! isset( $_POST['cbmg_jsonld_graph'] ) ) {
        delete_post_meta( $post_id, '_cbmg_jsonld_graph' );
        return;
    }

    $custom_graph = trim( wp_unslash( $_POST['cbmg_jsonld_graph'] ) );

    if ( '' === $custom_graph ) {
        delete_post_meta( $post_id, '_cbmg_jsonld_graph' );
        return;
    }

    update_post_meta( $post_id, '_cbmg_jsonld_graph', $custom_graph );
}
