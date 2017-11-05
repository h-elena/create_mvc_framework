<?php

namespace controllers;

use Core\Controller,
    Core\View,
    Models\Test2,
    Models\Test3,
    Helpers\WorkWithString;

class Index extends Controller {

    public $view, $controllerNane;

    function __construct(){
        $this->view = new View();
        $this->controllerNane = 'index';
    }

    /**
     * Output main page
     */
    public function actionIndex(){
        $params = [];
        $params['title'] = 'Главная';
        return $this->view->render('index', $this->controllerNane, $params);
    }

    public function actionTest1(){
        $params = [];
        $params['title'] = 'Test1';
        $params['text'] = 'Дан текст с включенными в него тегами следующего вида:<br>
            [НАИМЕНОВАНИЕ_ТЕГА:описание]данные[/НАИМЕНОВАНИЕ_ТЕГА]<br>
             Дан текст с включенными в него тегами следующего вида: <br>
            [НАИМЕНОВАНИЕ_ТЕГА1]данные1[/НАИМЕНОВАНИЕ_ТЕГА1] fgfb dvdf';
        $params['masTagData'] = WorkWithString::findTagAndData($params['text']);
        $params['masTagDesc'] = WorkWithString::findTagAndDesc($params['text']);
        WorkWithString::findTagAndData($params['text']);
        return $this->view->render('test1', $this->controllerNane, $params);
    }

    public function actionTest2(){
        $params = [];
        $params['title'] = 'Test2';

        $model = new Test2();
        if(empty($model->error)) {
            if ($tree = $model->getAllTreeFromSql()) {
                if (!empty($tree)) {
                    $params['tree'] = $model->outTree($tree);
                }
            }
            else {
                $params['errors'] = $model->error;
            }
        }
        else {
            $params['errors'] = $model->error;
        }

        $model = new Test2();
        if (!$params['siblings'] = $model->getChildsHave2Parent()){
            $params['errors'] = $model->error;
        }

        return $this->view->render('test2', $this->controllerNane, $params);
    }

    public function actionTest3(){
        $params = [];
        $params['title'] = 'Test3';
        $mas = [
            ['a1', 'a2', 'a3'],
            ['b1', 'b2'],
            ['c1', 'c2', 'c3'],
            ['d1']
        ];
        $model = new Test3();
        $params['mas'] = $model->createNewMas($mas);

        return $this->view->render('test3', $this->controllerNane, $params);
    }
}