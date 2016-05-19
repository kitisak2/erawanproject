<?php
/* @var $this yii\web\View */

use miloschuman\highcharts\Highcharts;
use kartik\grid\GridView;

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

        <div class="col-xs-8 col-md-8 col-sm-8">
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


        <div class="col-xs-4 col-sm-4 col-md-4">
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
        <!-- donut chart -->
        <div class="panel-body">
            <div style="display: none">
                <?php
                echo Highcharts::widget([
                    'scripts' => [
                        'highcharts-more', // enables supplementary chart types (gauge, arearange, columnrange, etc.)
                        'modules/exporting', // adds Exporting button/menu to chart
                    //'themes/grid', // applies global 'grid' theme to all charts
                    //'highcharts-3d'
                    //'modules/drilldown'
                    ]
                ]);
                ?>
            </div>
            <div id="pie-donut">
            </div>
            <?php
            $title = "จำนวนผู้ป่วยที่อยู่ในเขต";
            $sql04780 = Yii::$app->db->createCommand("SELECT total FROM pop_loei WHERE hoscode = '04780'")->queryScalar();
            $sql04781 = Yii::$app->db->createCommand("SELECT total FROM pop_loei WHERE hoscode = '04781'")->queryScalar();
            $sql04776 = Yii::$app->db->createCommand("SELECT total FROM pop_loei WHERE hoscode = '04776'")->queryScalar();
            $sql04777 = Yii::$app->db->createCommand("SELECT total FROM pop_loei WHERE hoscode = '04777'")->queryScalar();
            $sql04778 = Yii::$app->db->createCommand("SELECT total FROM pop_loei WHERE hoscode = '04778'")->queryScalar();
            $sql13930 = Yii::$app->db->createCommand("SELECT total FROM pop_loei WHERE hoscode = '13930'")->queryScalar();
            $sql14353 = Yii::$app->db->createCommand("SELECT total FROM pop_loei WHERE hoscode = '14353'")->queryScalar();
            $sql14356 = Yii::$app->db->createCommand("SELECT total FROM pop_loei WHERE hoscode = '14356'")->queryScalar();
            $this->registerJs("$(function () {
                                    $('#pie-donut').highcharts({
                                        chart: {
                                            plotBackgroundColor: null,
                                            plotBorderWidth: null,
                                            plotShadow: false,
                                            type: 'pie'
                                        },
                                        title: {
                                            text: '$title'
                                        },
                                        tooltip: {
                                            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                                        },
                                        plotOptions: {
                                            pie: {
                                                allowPointSelect: true,
                                                cursor: 'pointer',
                                                depth: 35,
                                                dataLabels: {
                                                    enabled: true,
                                                    format: '<b>{point.name}</b>: {point.percentage:.1f} %',    //  แสดง %
                                                    style: {
                                                        color:'black'                     
                                                    },
                                                    connectorColor: 'silver'
                                                },
                                                startAngle: -90,
                                                endAngle: 90,
                                                center: ['50%', '75%']
                                            }
                                        },
                                        /*plotOptions: {
                                            pie: {
                                                dataLabels: {
                                                    allowPointSelect: true,
                                                    cursor: 'pointer',
                                                    depth: 35,
                                                    style: {
                                                        color:'black',                 
                                                    },
                                                    connectorColor: 'silver'
                                                },
                                                startAngle: -90,
                                                endAngle: 90,
                                                center: ['50%', '75%']
                                            }
                                        },*/
                                        legend: {
                                            enabled: true
                                        },
                                        series: [{
                                            type: 'pie',
                                            name: 'ร้อยละ',
                                            innerSize: '50%',
                                            data: [
                                            ['รพสต.ห้วยป่าน',   $sql04780],
                                                ['รพสต.ซำบุ่น',   $sql04781],
                                                    ['รพสต.หัวฝาย',   $sql04776],
                                                        ['รพสต.โป่งศรีโทน',   $sql04777],
                                                            ['รพสต.หนองใหญ่',   $sql04778],
                                                                ['รพสต.โนนสวรรค์',   $sql13930],
                                                                    ['รพสต.พรประเสริฐ',   $sql14353],
                                                                        ['รพสต.นาอ่างคำ',   $sql14356],
                                                   
                                            ]
                                        }]
                                    });
                                });
                                ");
            ?>
        </div>
        <!-- end donut -->
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
var obj_div=$('‪#‎ch1‬');
gen_dial(obj_div,$base,$persent);
");
            ?>
            <center><h4>ร้อยละ</h4></center>
            <div id="ch1"></div>
        </div>
    </div>
</div>
