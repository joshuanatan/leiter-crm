
<?php $backgroundColor = array("rgba(178,34,34, .8)","rgba(4, 3, 86, .2)","rgba(124, 104, 238, .2)","rgba(30,144,254, .2)","rgba(137,205,250, .2)");?>
<?php $borderColor = array("blue-grey","primary","primary","primary","primary");?>
<?php $hoverBackgroundColor = array("rgba(178,34,34, 1)","rgba(4, 3, 86, .3)","rgba(124, 104, 238, .3)","rgba(30,144,254, .3)","rgba(137,205,250, .3)");?>

<script>
(function (global, factory) {
    if (typeof define === "function" && define.amd) {
        define("/widgets/chart", ["jquery", "Site"], factory);
    } 
    else if (typeof exports !== "undefined") {
        factory(require("jquery"), require("Site"));
    } 
    else {
        var mod = {
            exports: {}
        };
        factory(global.jQuery, global.Site);
        global.widgetsChart = mod.exports;
    }
})
(this, function (_jquery, _Site) {
    "use strict";

    _jquery = babelHelpers.interopRequireDefault(_jquery);
    (function () {
        var stacked_bar = new Chartist.Bar('#chartBarStacked1 .ct-chart', {
            labels: ['TGT', '12', ' 13', '14'],
            series: [[5,11,15,20]]
        }, {
            stackBars: true,
            fullWidth: true,
            seriesBarDistance: 0,
            chartPadding: {
                top: -10,
                right: 0,
                bottom: 0,
                left: 0
            },
            axisX: {
                showLabel: true,
                showGrid: false,
                offset: 30
            },
            axisY: {
                showLabel: true,
                showGrid: true,
                offset: 30
            }
        });
    })(); // Chart Pie
    (function () {
        var stacked_bar = new Chartist.Bar('#chartBarStacked2 .ct-chart', {
            labels: ['TGT', '12', ' 13', '14'],
            series: [[20,30,50,40]]
        }, {
            stackBars: true,
            fullWidth: true,
            seriesBarDistance: 0,
            chartPadding: {
                top: -10,
                right: 0,
                bottom: 0,
                left: 0
            },
            axisX: {
                showLabel: true,
                showGrid: false,
                offset: 30
            },
            axisY: {
                showLabel: true,
                showGrid: true,
                offset: 30
            }
        });
    })(); // Chart Pie
    (function () {
        var stacked_bar = new Chartist.Bar('#chartBarStacked3 .ct-chart', {
            labels: ['TGT', '12', ' 13', '14'],
            series: [[11,10,15,20]]
        }, {
            stackBars: true,
            fullWidth: true,
            seriesBarDistance: 0,
            chartPadding: {
                top: -10,
                right: 0,
                bottom: 0,
                left: 0
            },
            axisX: {
                showLabel: true,
                showGrid: false,
                offset: 30
            },
            axisY: {
                showLabel: true,
                showGrid: true,
                offset: 30
            }
        });
    })(); // Chart Pie
    (function () {
        var stacked_bar = new Chartist.Bar('#chartBarStacked4 .ct-chart', {
            labels: ['TGT', '12', ' 13', '14'],
            series: [[11,10,15,20]]
        }, {
            stackBars: true,
            fullWidth: true,
            seriesBarDistance: 0,
            chartPadding: {
                top: -10,
                right: 0,
                bottom: 0,
                left: 0
            },
            axisX: {
                showLabel: true,
                showGrid: false,
                offset: 30
            },
            axisY: {
                showLabel: true,
                showGrid: true,
                offset: 30
            }
        });
    })(); // Chart Pie
});
</script>
<script>
(function (global, factory) {
    if (typeof define === "function" && define.amd) {
        define("/charts/chartjs", ["jquery", "Site"], factory);
    } 
    else if (typeof exports !== "undefined") {
        factory(require("jquery"), require("Site"));
    } 
    else {
        var mod = {
            exports: {}
        };
        factory(global.jQuery, global.Site);
        global.chartsChartjs = mod.exports;
    }
    })(this, function (_jquery, _Site) {
    "use strict";
    _jquery = babelHelpers.interopRequireDefault(_jquery);
    (function () {
        var barChartData = {
            <?php for($a = 0; $a<count($kpi_graph[$start_week]);$a++){
                $kpi_labels[$a] = "KPI ".($a+1);
            }?>
            labels: <?php echo json_encode($kpi_labels);?>,
            datasets: 
            [
                <?php $counterDays = 0;for($a = $start_week; $a>0; $a--):?> /*nge hold iterasi minggu*/
                <?php if($counterDays == 5){
                    break;
                }
                ?>
                { /*week 1- sekian*/
                    label: <?php if($a == 0) echo "'Target'"; else echo "'WEEK ".$a."'";?>,
                    backgroundColor: <?php echo "'".$backgroundColor[$a]."'";?>,
                    borderColor: Config.colors(<?php echo "'".$borderColor[$a]."'";?>, 600),
                    hoverBackgroundColor: <?php echo "'".$hoverBackgroundColor[$a]."'";?>,
                    borderWidth: 2,
                    <?php $amounts = array();$counterData = -1;
                    for($b = 0; $b<count($kpi_graph[$a]); $b++){ /*iterasi di sebuah minggu*/
                        
                        $counterData++;
                        if($a == 0){
                            $amounts[$counterData] = $kpi_graph[$a][$b]["target_kpi"];
                        }
                        else{
                            $amounts[$counterData] = $kpi_graph[$a][$b]["jumlah_report"];
                        }
                         /*dalam sebuah minggu, di setiap kpi*/
                    }
                    ?>
                    data: <?php echo json_encode($amounts[$counterData]);?> /*TARGET KPI1, TARGET KPI2, TARGET KPI3*/
                }, 
                <?php $counterDays++;endfor;?>
            ]
        };
        var myBar = new Chart(document.getElementById("kpiGraph").getContext("2d"), {
        type: 'bar',
        data: barChartData,
        options: {
            responsive: true,
            scales: {
            xAxes: [{
                display: true
            }],
            yAxes: [{
                display: true
            }]
            }
        }
        });
    })();
});
</script>