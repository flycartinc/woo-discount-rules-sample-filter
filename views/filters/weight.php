<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
$filter_row_key = isset($filter_row_count)? $filter_row_count: "{i}";
$filter_method_value = isset($filter->method)? $filter->method: "greater_than_or_equal";
$filter_value = isset($filter->value)? $filter->value: "";
?>
<div class="product_weight wdr-condition-type-options">
    <div class="product_weight_group products_group wdr-products_group">
        <div class="wdr-product_filter_method">
            <select name="filters[<?php echo $filter_row_key; ?>][method]">
                <option value="greater_than_or_equal" <?php echo ($filter_method_value == 'greater_than_or_equal') ? 'selected' : ''; ?>><?php _e('Greater than or equal', 'woo-discount-rules-sample-filter'); ?></option>
                <option value="less_than_or_equal" <?php echo ($filter_method_value == 'less_than_or_equal') ? 'selected' : ''; ?>><?php _e('Less than or equal', 'woo-discount-rules-sample-filter'); ?></option>
            </select>
        </div>
        <div class="awdr-product-selector">
            <input class="awdr_validation" type="text" name="filters[<?php echo $filter_row_key; ?>][value]" value="<?php echo $filter_value; ?>"/>
        </div>
    </div>
</div>