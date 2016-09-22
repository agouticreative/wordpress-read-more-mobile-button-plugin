<?php

function setUpOptionsPage()
{
    add_options_page(
        'Automatic Read More Button Settings',
        'Read More Button',
        'manage_options',
        'automatic-read-more-button-menu',
        'automatic_read_more_options'
    );
}

add_action('admin_menu', 'setUpOptionsPage');

    // mt_settings_page() displays the page content for the Test Settings submenu
function automatic_read_more_options()
{
    //must check that the user has the required capability
    if (!current_user_can('manage_options')) {
        wp_die(__('You do not have sufficient permissions to access this page.'));
    }

    // See if the user has posted us some information
    // If they did, this hidden field will be set to 'Y'
    if (isset($_POST[ 'mt_submit_hidden']) && $_POST['mt_submit_hidden'] == 'Y') {
        // Read their posted value
        // Save the posted value in the database
        update_option('armb_activated', $_POST[ 'armb_activated']);
        update_option('armb_height_multiple', $_POST[ 'armb_height_multiple']);
        update_option('armb_btn_txt', $_POST[ 'armb_btn_txt']);
        // Put a "settings saved" message on the screen

?>
    <div class="updated">
        <p>
            <strong>
                <?php _e('settings saved.', 'menu-test'); ?>
            </strong>
        </p>
    </div>
<?php
    }
    echo '<div class="wrap">';
    echo "<h2>" . __('Read More Button Settings', 'menu') . "</h2>";

    $armb_activated = get_option('armb_activated', 1);
    $armb_height_multiple = get_option('armb_height_multiple', 2);
    $armb_btn_txt = get_option('armb_btn_txt', 'Read More');
?>
        <form name="form1" method="post" action="">
            <input type="hidden" name="mt_submit_hidden" value="Y">

            <p><?php _e("Read More button activated:", 'menu-test'); ?>
            <input type="checkbox" name="armb_activated" value="<?= $armb_activated ?>" checked="<?= $armb_activated ?>">
            </p>

            <p><?php _e("Height of visible content:", 'menu-test'); ?>
            <input type="number" name="armb_height_multiple" value="<?= $armb_height_multiple ?>" size="2"><span>x viewport's height</span>
            </p>

            <p><?php _e("Text of Read More button:", 'menu-test'); ?>
            <input type="text" name="armb_btn_txt" value="<?= $armb_btn_txt ?>" size="30">
            </p>

            <p class="submit">
                <input type="submit" name="Submit" class="button-primary" value="<?php esc_attr_e('Save Changes') ?>" />
            </p>
        </form>
    </div>

<?php
}


