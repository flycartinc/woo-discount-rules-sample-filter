# woo-discount-rules-sample-filter
Example plugin to add additional filter in discount rules

You can add multiple filters through the method
<code>
protected static function setFilters(){
    self::$filter_types['product_weight'] = array(
        'label' => __('Product weight', 'woo-discount-rules-sample-filter'),
        'group' => __('Product', 'woo-discount-rules-sample-filter'),
        'template' => WDR_SAMPLE_FILTER_PLUGIN_PATH . 'views/filters/weight.php',
    );
}
</code>

here the backend UI will be handled in the path <code>'template' => WDR_SAMPLE_FILTER_PLUGIN_PATH . 'views/filters/weight.php',</code>

and the filter checks for front end(on apply rules) can be done through the method <code>checkFilterPassed</code>