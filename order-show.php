<?php

function orderBuddy_orders_show() {
    //include Javascript
    wp_register_script( 'showTotal', plugins_url( '/js/showTotal.js', __FILE__ ) );
    wp_enqueue_script( 'showTotal' );

    $path = 'wp-content/plugins/orderBuddy/img/';
    ?>
    <link type="text/css" href="<?php echo WP_PLUGIN_URL; ?>/orderBuddy/style-admin.css" rel="stylesheet" />
    <div class="wrap">
        <h2>Orders</h2>      
        <?php
        global $wpdb;
        $table_name = $wpdb->prefix . "orders";

        $rows = $wpdb->get_results("SELECT id, order_name, order_desc, order_liters, order_price, img_url from $table_name");
        ?>
        <!-- <form action="order_order.php" method="POST"> -->
        <table class='wp-list-table widefat fixed striped posts'>
            <tr>                
                <th class="manage-column ss-list-width"> Name </th>
                <th class="manage-column ss-list-width"> Description </th>                
                <th class="manage-column ss-list-width"> Liters </th>
                <th class="manage-column ss-list-width"> Price </th>
                <th class="manage-column ss-list-width"> Image </th>
                <th class="manage-column ss-list-width"> Amount </th>
                <th class="manage-column ss-list-width"> Total </th>
                <!-- <th class="manage-column ss-list-width">Update</th> -->
                <th>&nbsp;</th>
            </tr>
            
            <?php foreach ($rows as $row) { ?>
                <tr>
                    <td class="order_name manage-column ss-list-width"><?php echo $row->order_name; ?></td>
                    <td class="manage-column ss-list-width"><?php echo $row->order_desc; ?></td>
                    <td class="order_liters manage-column ss-list-width"><?php echo $row->order_liters; ?></td>
                    <td class="order_price manage-column ss-list-width"><?php echo $row->order_price; ?></td>
                    <td class="manage-column ss-list-width"><img src = "<?php echo $path . $row->img_url; ?>"/></td>
                    <td class="manage-column ss-list-width"><input type="number" class="amount" name="amount"/></td>
                    <th class="order_totalprice manage-column ss-list-width">0</th>
                    <!-- <td><a href="<?php //echo admin_url('admin.php?page=orderBuddy_orders_update&id=' . $row->id); ?>">Update</img></td> -->
                </tr>
            <?php } ?>    
                <tr> 
                    <td class="manage-column ss-list-width" ></td>
                    <td class="manage-column ss-list-width" ></td>
                    <td class="manage-column ss-list-width" ></td>
                    <td class="manage-column ss-list-width" ></td>
                    <td class="manage-column ss-list-width" ></td>
                    <th class="manage-column ss-list-width" >Total:</th>
                    <th class="manage-column ss-list-width" id="totalprice">0</th>
                </tr>      
        </table>       
        <button type="button">Order</button>
        <!-- </form> -->
        
    </div>
    <?php
}
add_shortcode("order_show", "orderBuddy_orders_show");
?>