<?php
/* @var $this yii\web\View */

use miloschuman\highcharts\Highcharts;
use yii\grid\GridView;

//use kartik\grid\GridView;
$this->registerJsFile('./js/chart_dial.js');

$this->title = 'Love Loei';
Yii::$app->db->open();
?>


<div class="site-index">
    <div class="row">
        <div style="display: none">
            <?php
            echo Highcharts::widget([
                'scripts' => [
                    'highcharts-more',
                    'modules/exporting',
                    'highcharts-3d',
                //'modules/drilldown'
                ]
            ]);
            ?>
        </div>

        <div class="col-md-8">
            <div id="chart-column">
            </div>

            <?php
            $this->registerJs("$(function () { 
                                    Highcharts.getOptions().colors = Highcharts.map(Highcharts.getOptions().colors, function (color) {
                                        return {
                                            radialGradient: {
                                                cx: 0.5,
                                                cy: 0.3,
                                                r: 0.7
                                            },
                                            stops: [
                                            [0, color],
                                            [1, Highcharts.Color(color).brighten(-0.3).get('rgb')] // darken
                                            ]
                                        };
                                    });
                                    $('#chart-column').highcharts({
                                        chart: {
                                            type: 'column',
                                            margin: 75,
                                            options3d: {   
                                                enabled: true,
                                                alpha: 10,
                                                beta: 15,
                                                depth: 70
                                            }
                                        },
                                        title: {
                                            text: 'จำนวนประชากร'
                                        },
                                        plotOptions: {
                                            pie: {
                                                allowPointSelect: true,
                                                cursor: 'pointer',
                                                depth: 35,
                                                dataLabels: {
                                                    enabled: true,
                                                    format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                                                    style: {
                                                        color:'black'                     
                                                    },
                                                    connectorColor: 'silver'
                                                }
                                            }
                                        },
                                        xAxis: {
                                            type: 'category'
                                        },
                                        yAxis: {
                                            title: {
                                                text: '<b>คน</b>'
                                            },
                                        },
                                        legend: {
                                            enabled: true
                                        },
                                        plotOptions: {
                                            series: {
                                                borderWidth: 0,
                                                dataLabels: {
                                                    enabled: true
                                                }
                                            }
                                        },
                                        series: [
                                        {
                                            name: 'ครั้ง',
                                            colorByPoint: true,
                                            data:$main
                                        }
                                        ],
                                    });
                                });");
            ?>    
        </div>
        <!-- end column chart -->
        <div class="col-md-4">
            <!--?=
            GridView::widget([
                'dataProvider' => $dataProvider,
                'columns' => [
                    'subdistname',
                    'human',
                // ...
                ],
            ])
            ?-->
            <?php
            echo GridView::widget([
                'dataProvider' => $dataProvider,
                'columns' => [
                    [
                        'class' => 'yii\grid\SerialColumn',
                        'header' => 'ลำดับ',
                        'options' => ['width' => '20'],
                        'contentOptions' => ['class' => 'text-center'],
                        'headerOptions' => ['class' => 'text-center'],
                    ],
                    [
                        'attribute' => 'subdistname',
                        'header' => 'ตำบล',
                        'options' => ['width' => '100'],
                        'contentOptions' => ['class' => 'text-center'],
                        'headerOptions' => ['class' => 'text-center'],
                    ],
                    [
                        'attribute' => 'human',
                        'header' => 'จำนวน',
                        'options' => ['width' => '100'],
                        'contentOptions' => ['class' => 'text-center'],
                        'headerOptions' => ['class' => 'text-center'],
                    ],
                ],
            ]);
            ?>
        </div>
    </div>


    <div class="col-lg-12">
        <div class="row">
            <?php
            $target = 20;
            $result = 10;

            $persent = 0.00;
            if ($target > 0) {
                $persent = $result / $target * 100;
                $persent = number_format($persent, 2);
            }
            $base = 90;
            $this->registerJs("
                        var obj_div=$('#ch1');
                        gen_dial(obj_div,$base,$persent);
                    ");
            ?>
            <center><h4>ร้อยละ</h4></center>
            <div id="ch1"></div>
        </div>
    </div>
</div>

</div>
