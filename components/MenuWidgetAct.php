<?php
/**
 * Created by PhpStorm.
 * User: Andrey
 * Date: 07.05.2016
 * Time: 10:35
 */

namespace app\components;
use yii\base\Widget;
use app\models\Acts;

use Yii;

class MenuWidgetAct extends Widget{

    public $tpl;
    public $data;
    public $tree;
    public $menuHtml;
    public $model;

    public function init(){
        parent::init();
        if( $this->tpl === null ){
            $this->tpl = 'menu_act';
        }
        $this->tpl .= '.php';
    }

    public function run(){
        // get cache
        if ($this->tpl=='menu_act.php') {
            $menu = Yii::$app->cache->get('menu_act');
            if($menu) return $menu;
        }

        $this->data = Acts::find()->indexBy('id')->asArray()->all();
        $this->tree = $this->getTree();
        $this->menuHtml = $this->getMenuHtml($this->tree);
        // set cache
        if ($this->tpl=='menu_act.php') {
            Yii::$app->cache->set('menu_act', $this->menuHtml, 60);

        }
        return $this->menuHtml;
    }

    protected function getTree(){
        $tree = [];
        foreach ($this->data as $id=>&$node) {

            $tree[$id] = &$node;
        }
        return $tree;
    }

    protected function getMenuHtml($tree){
        $str = '';
        foreach ($tree as $act) {
            $str .= $this->catToTemplate($act);
        }
        return $str;
    }

    protected function catToTemplate($act){
        ob_start();
        include __DIR__ . '/menu_tpl/' . $this->tpl;
        return ob_get_clean();
    }

}