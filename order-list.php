<?php

function orderBuddy_orders_list() {
    ?>
    <link type="text/css" href="<?php echo WP_PLUGIN_URL; ?>/orderBuddy/style-admin.css" rel="stylesheet" />
    <div class="wrap">
        <h2>Orders</h2>
        <div class="tablenav top">
            <div class="alignleft actions">
                <a href="<?php echo admin_url('admin.php?page=orderBuddy_orders_create'); ?>">Add New Order</a>
            </div>
            <br class="clear">
        </div>
        <?php
        global $wpdb;
        $table_name = $wpdb->prefix . "orders";

        $rows = $wpdb->get_results("SELECT id, order_name, order_desc, order_liters, order_price, img_url from $table_name");
        ?>
        <table class='wp-list-table widefat fixed striped posts'>
            <tr>                
                <th class="manage-column ss-list-width">Name</th>
                <th class="manage-column ss-list-width">Description</th>                
                <th class="manage-column ss-list-width">Liters</th>
                <th class="manage-column ss-list-width">Price</th>
                <th class="manage-column ss-list-width">Image</th>
                <th class="manage-column ss-list-width">Update</th>
                <th>&nbsp;</th>
            </tr>
            <?php foreach ($rows as $row) { ?>
                <tr>
                    <td class="manage-column ss-list-width"><?php echo $row->order_name; ?></td>
                    <td class="manage-column ss-list-width"><?php echo $row->order_desc; ?></td>
                    <td class="manage-column ss-list-width"><?php echo $row->order_liters; ?></td>
                    <td class="manage-column ss-list-width"><?php echo $row->order_price; ?></td>
                    <td class="manage-column ss-list-width"><?php echo $row->img_url; ?></td>
                    <td><a href="<?php echo admin_url('admin.php?page=orderBuddy_orders_update&id=' . $row->id); ?>">Update</a></td>
                </tr>
            <?php } ?>
        </table>
    </div>
    <?php
}