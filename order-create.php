<?php

function orderBuddy_orders_create() {
    if(isset($_POST["name"])){       
        $name = $_POST["name"];
        $desc = $_POST["desc"];
        $liter = $_POST["liter"];
        $price = $_POST["price"];
        $img_url = $_POST["img_url"];
    }else{   
        $name = '';
        $desc = '';
        $liter = '';
        $price = '';
        $img_url = '';
    }
    //insert
    if (isset($_POST['insert'])) {
        global $wpdb;
        $table_name = $wpdb->prefix . "orders";

        $wpdb->insert(
                $table_name, //table
                array('order_name' => $name, 'order_desc' => $desc, 'order_liters' => $liter, 'order_price' => $price, 'img_url' => $img_url), //data
                array('%s', '%s', '%s', '%s', '%s' ) //data format			
        );
        $message = "";
        $message.="Orders inserted";
    }
    ?>
    <link type="text/css" href="<?php echo WP_PLUGIN_URL; ?>/orderBuddy/style-admin.css" rel="stylesheet" />
    <div class="wrap">
        <h2>Add New Order</h2>
        <?php if (isset($message)): ?><div class="updated"><p><?php echo $message; ?></p></div><?php endif; ?>
        <form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
            <table class='wp-list-table widefat fixed'>
                <tr>
                    <th class="ss-th-width">Name:</th>
                    <td><input type="text" name="name" value="<?php echo $name; ?>" class="ss-field-width" /></td>
                </tr>
                 <tr>
                    <th class="ss-th-width">Description:</th>
                    <td><input type="text" name="desc" value="<?php echo $desc; ?>" class="ss-field-width" /></td>
                </tr>
                 <tr>
                    <th class="ss-th-width">Liters</th>
                    <td><input type="number" name="liter" value="<?php echo $liter; ?>" class="ss-field-width" /></td>
                </tr>  
                 <tr>
                    <th class="ss-th-width">Price</th>
                    <td><input type="number" name="price" value="<?php echo $price; ?>" class="ss-field-width" /></td>
                </tr>   
                 <tr>
                    <th class="ss-th-width">Image</th>
                    <td><input type="text" name="img_url" value="<?php echo $img_url; ?>" class="ss-field-width" /></td>
                </tr>              
            </table>
            <input type='submit' name="insert" value='Add' class='button'>
        </form>
    </div>
    <?php
}