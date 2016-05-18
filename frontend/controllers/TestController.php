<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace frontend\controllers;

use Yii;
use yii\web\Controller;


class TestController extends Controller {
    
    public function actionIndex () {
        
        return $this->render('index');
        
    }
    //put your code here
}
