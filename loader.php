<?php

use Wdr\App\Helpers\Template;

if (!defined('ABSPATH')) {
    exit;
}

if(!class_exists('WooDiscountRulesSampleFilter')){
    class WooDiscountRulesSampleFilter
    {
        public static $filter_types = array();

        /**
         * Initialize
         * */
        public static function init()
        {
            self::setFilters();
            self::hooks();
        }

        /**
         * Add hooks
         * */
        protected static function hooks(){
            add_filter('advanced_woo_discount_rules_filters', array(__CLASS__, 'addFilters'));
            add_action('advanced_woo_discount_rules_admin_filter_fields', array(__CLASS__, 'loadFilterFields'), 10, 3);
            add_filter('advanced_woo_discount_rules_filter_passed', array(__CLASS__, 'checkFilterPassed'), 10, 5);
        }

        /**
         * Process filter check
         * */
        public static function checkFilterPassed($filter_passed, $rule, $product, $sale_badge, $product_table){
            $filters = $rule->getFilter();
            if (!empty($filters)) {
                foreach ($filters as $filter) {
                    $type = $rule->getFilterType($filter);
                    if($type == 'product_weight'){
                        $method = $rule->getFilterMethod($filter);
                        $values = $rule->getFilterOptionValue($filter);
                        $weight = $product->get_weight();
                        if($method == "greater_than_or_equal"){
                            if(!($weight >= $values)){
                                $filter_passed = false;
                            }
                        } else {
                            if(!($weight <= $values)){
                                $filter_passed = false;
                            }
                        }
                    }
                }
            }

            return $filter_passed;
        }

        /**
         * Set filters
         *
         * */
        protected static function setFilters(){
            self::$filter_types['product_weight'] = array(
                'label' => __('Product weight', 'woo-discount-rules-sample-filter'),
                'group' => __('Product', 'woo-discount-rules-sample-filter'),
                'template' => WDR_SAMPLE_FILTER_PLUGIN_PATH . 'views/filters/weight.php',
            );
        }

        /**
         * Add rule filters
         *
         * @param $filter_types array
         * @return array
         * */
        public static function addFilters($filter_types){
            $filter_types = array_merge($filter_types, self::$filter_types);

            return $filter_types;
        }

        /**
         * load filter fields
         * @param $rule
         * @param $filter
         * @param $filter_row_count
         * @return bool
         */
        public static function loadFilterFields($rule, $filter, $filter_row_count){
            if(isset($filter->type) && $filter->type == "products"){
                return false;
            }

            $data['rule'] = $rule;
            $data['filter'] = isset($filter)? $filter: null;
            $data['woocommerce_helper'] = new Woocommerce();
            $data['filter_row_count'] = $filter_row_count;
            if(isset($data['filter']->type)){
                $filter_type = $data['filter']->type;
                $filters = array_keys(self::$filter_types);
                if(in_array($filter_type, $filters)){
                    if(isset(self::$filter_types[$filter_type]['template'])){
                        $template = new \Wdr\App\Helpers\Template();
                        $template->setPath(self::$filter_types[$filter_type]['template']);
                        $template->setData($data);
                        $template->display();
                    } else {
                        return false;
                    }
                } else {
                    return false;
                }
            } else {
                return false;
            }
        }
    }
}

WooDiscountRulesSampleFilter::init();