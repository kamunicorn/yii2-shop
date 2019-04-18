<?php
/**
 * Created by PhpStorm.
 * User: Unicorn
 * Date: 17.04.2019
 * Time: 18:59
 */

namespace app\widgets;
use app\models\Category;
use yii\base\Widget;

class MenuWidget extends Widget
{
    public $data;

    public function run()
    {
        $data = new Category();
        $data = $data->getCategories();
        $this->data = $this->categorieToTemplate($data);
        return $this->data;
    }

    public function categorieToTemplate($data)
    {
        ob_start();
        include __DIR__ . "/template/menu.php";
        return ob_get_clean();
    }

}