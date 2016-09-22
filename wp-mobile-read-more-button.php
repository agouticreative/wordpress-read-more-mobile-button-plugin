<?php
/**
 * @package WP_Mobile_Read_More
 * @version 0.1
 */
/*
Plugin Name: WP Mobile Read More Button
Plugin URI:  https://developer.wordpress.org/plugins/the-basics/
Description: A configurable plugin that installs a "read more" button and fade at the bottom of posts in mobile devices, based on the height of the viewport and the content.
Version:     0.1
Author:      Travis Morrison
Author URI:  https://travismorrisonwp.wordpress.org/
License:     GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Text Domain: wporg
Domain Path: /languages
*/


require_once('wp-automatic-read-more-button-options.php');

function armb_render_options()
{
    $armb_height_multiple = get_option('armb_height_multiple', 2);
    $armb_btn_txt = get_option('armb_btn_txt', 'Read More');
    ?>
        <script>
            readMoreOptions = {
                viewportMultiples: <?= $armb_height_multiple ?>,
                buttonText: "<?= $armb_btn_txt ?>"
            }
        </script>
    <?php
}

if (get_option('armb_activated', true)) {
    add_action('wp_head', 'armb_render_options');
    wp_enqueue_style(
        'wp-automatic-read-more-css',
        plugins_url('wp-automatic-read-more-button/wp-automatic-read-more-button.css'),
        array(),
        false,
        'screen and (max-width:768px)'
    );

    wp_enqueue_script(
        'wp-automatic-read-more-js',
        plugins_url('wp-automatic-read-more-button/wp-automatic-read-more-button.js'),
        array('jquery'),
        '0.1',
        true
    );
}

