<?php

function orderBuddy_orders_update() {
    global $wpdb;
    $table_name = $wpdb->prefix . "orders";
    if(isset($_GET['id'])){
        $id = $_GET["id"];
    }else{
        $id = '';
    }
    if(isset($_POST['name'])){
        $name = $_POST["name"];
    }else{
        $name = '';
    }
    
//update
    if (isset($_POST['update'])) {
        $wpdb->update(
                $table_name, //table
                array('order_name' => $name), //data
                array('ID' => $id), //where
                array('%s'), //data format
                array('%s') //where format
        );
    }
//delete
    else if (isset($_POST['delete'])) {
        $wpdb->query($wpdb->prepare("DELETE FROM $table_name WHERE id = %s", $id));
    } else {//selecting value to update	
        $orders = $wpdb->get_results($wpdb->prepare("SELECT id, order_name from $table_name where id=%s", $id));
        foreach ($orders as $s) {
            $name = $s->name;
        }
    }
    ?>
    <link type="text/css" href="<?php echo WP_PLUGIN_URL; ?>/orderBuddy/style-admin.css" rel="stylesheet" />
    <div class="wrap">
        <h2>Orders</h2>

        <?php if ($_POST['delete']) { ?>
            <div class="updated"><p>Order deleted</p></div>
            <a href="<?php echo admin_url('admin.php?page=orderBuddy_orders_list') ?>">&laquo; Back to order list</a>

        <?php } else if ($_POST['update']) { ?>
            <div class="updated"><p>Order updated</p></div>
            <a href="<?php echo admin_url('admin.php?page=orderBuddy_orders_list') ?>">&laquo; Back to order list</a>

        <?php } else { ?>
            <form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
                <table class='wp-list-table widefat fixed'>
                    <tr><th>Name</th><td><input type="text" name="name" value="<?php echo $name; ?>"/></td></tr>
                </table>
                <input type='submit' name="update" value='Save' class='button'> &nbsp;&nbsp;
                <input type='submit' name="delete" value='Delete' class='button' onclick="return confirm('Are you sure you want to delete this order?')">
            </form>
        <?php } ?>

    </div>
    <?php
}