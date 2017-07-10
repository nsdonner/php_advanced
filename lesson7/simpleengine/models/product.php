<?php
/**
 * Created by PhpStorm.
 * User: Donner
 * Date: 09.07.2017
 * Time: 20:06
 */

namespace simpleengine\models;

use simpleengine\core\Application;

class Product implements DbModelInterface
{

    private $catalog = [
        '1' => '1',
        '2' => '2',
        'что то пошло не так раз тут данные не из БД, верно?' => '3'];

    public function __construct($count = 10)
    {
        if ((int)$count > 0) {
            $this->find($count);
        }
    }


    /**
     * @return mixed
     */
    public function getCatalog()
    {
        return $this->catalog;
    }

    public function find($count = 10)
    {
        // TODO: Implement find() method.


        /*   $sql = 'SELECT products.id, product_name, product_price, product_sku, product_properties_values.property_value FROM `products`
                   LEFT JOIN product_properties_values ON products.id = product_properties_values.id_product AND product_properties_values.id_property=1
                   WHERE product_sku < 999999
                    LIMIT 0,' . (int)$count;*/

        $sql = 'SELECT products.id, product_name, product_price, product_sku FROM `products`              
                WHERE product_sku < 999999
                LIMIT 0,' . (int)$count;
        $app = Application::instance();
        $catalog = $this->catalog = $app->db()->getArrayBySqlQuery($sql);
        $sql = 'SELECT id_product, property_value FROM product_properties_values WHERE id_property = 1';
        $images = $this->catalog = $app->db()->getArrayBySqlQuery($sql);

        /*

                $tmp = array_merge_recursive($catalog[1],$catalog[0]);
                foreach ($tmp as $key => $value) {
                    $tmp[$key] = array_unique($tmp[$key]);
                }
                ksort($tmp);
                $catalog[0] = $tmp;
                $catalog = array_intersect_assoc($catalog[0],$catalog[1]);
        */


        foreach ($catalog as $key => $value){
            foreach ($images as $key1 => $value1){
                if ($images[$key1]['id_product'] == $catalog[$key]['id']){
                    $catalog[$key]['images'][] = $images[$key1]['property_value'];
                }
            }
        }

        $this->catalog = $catalog;
        return $catalog;
    }

    public function save()
    {
        // TODO: Implement save() method.
    }

}