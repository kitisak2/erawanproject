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
        $project_name= "Love Loei";
        $count = 450+550;        
        return $this->render('index',[
            'value' => 10,
            'value2' => 'hello',
            'project_name' => $project_name,
            'count' => $count,
           
        ]
               
                
                
                );
        
    }
    //put your code here
}
