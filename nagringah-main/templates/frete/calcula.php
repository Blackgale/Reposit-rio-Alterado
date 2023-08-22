<?php
global $product;

$helper = new WC_Frenet_Helper;

if ('variable' == $product->get_type()) {
    //$style = 'display: none';
    $ids = array();

    foreach ($product->get_available_variations() as $variation) {
        //$_variation = self::getProduct($variation);
        $ids[] = $variation['variation_id'];
    }

    $ids = implode(',', array_filter($ids));
} else {
    $style = '';
    $ids = $product->get_id();
}

$options = $helper->get_options();
$instance_id = $helper->get_instance_id();
$additional_time = $options['additional_time'];

$current_user = get_current_user_id();
$zipcode = get_user_meta($current_user, 'shipping_postcode', true).trim(' ');
?>
<div class="clearfix">
    <div id="shipping-simulator" style="<?php echo esc_attr($style); ?>"
        data-product-ids="<?php echo esc_attr($ids); ?>"
        data-product-type="<?php echo esc_attr($product->product_type); ?>">
        <form method="post" class="cart">

            <label for="shipping">Calcular Frete</label>

            <div class="title">
                <input required type="text" name="zipcode" id="zipcode" maxlength="9" placeholder="00000-000" value="<?php echo $zipcode; ?>">
                <input type="hidden" name="instance_id" id="instance_id" value="<?php echo $instance_id; ?>">
                <input type="hidden" name="additional_time" id="additional_time" value="<?php echo $additional_time; ?>">
                <input type="hidden" name="qty_simulator" id="qty_simulator" class="qty_simulator" value="1">
                <button name="idx-calc_shipping" id="idx-calc_shipping" value="1" class="button">calcular</button>
                <br class="clear"/>
                <div>
                <div id='loading_simulator' style='display:none'>
                    <p>Aguarde...</p>
                </div>
                <div id="simulator-data"></div>
                </div>
            </div>

            
            
            <!--display data -->

        </form>
    </div>
</div>