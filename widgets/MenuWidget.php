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
        $this->data = new Category();
        $this->data = $this->data->getCategories();
        $this->data = $this->categorieToTemplate($this->data);
        return $this->data;

    }

    public function categorieToTemplate($data)
    {
        ob_start();
        include __DIR__ ."/template/menu.php";
        return ob_get_clean();
    }

}