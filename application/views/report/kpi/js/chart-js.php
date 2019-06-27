<?php print_r($kpi_graph);?>
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
            <?php 
            $kpi_label = array();
            for($target = 0; $target<count($kpi_graph_support["target_kpi"]); $target++){
                $kpi_label[$target] = $kpi_graph_support["target_kpi"][$target]["nama"];
            }?>
            labels: <?php echo json_encode($kpi_label);?>,
            datasets: 
            [
                { /*Target*/
                    label: "TARGET",
                    backgroundColor: "<?php echo $backgroundColor[0];?>",
                    borderColor: Config.colors("<?php echo $borderColor[0];?>", 600),
                    hoverBackgroundColor: "<?php echo $hoverBackgroundColor[0];?>",
                    borderWidth: 2,
                    <?php 
                    $amount = array();
                    for($target = 0; $target<count($kpi_graph_support["target_kpi"]); $target++){
                        $amount[$target] = $kpi_graph_support["target_kpi"][$target]["target"];
                    }?>
                    data: <?php echo json_encode($amount);?> /*TARGET KPI1, TARGET KPI2, TARGET KPI3*/
                }, 
                
                <?php for($week = 0; $week < count($kpi_graph); $week++):?>
                { /*week 1- sekian*/
                    label: "<?php echo $kpi_graph[$week]["nama_week"];?>",
                    backgroundColor: "<?php echo $backgroundColor[($week+1)];?>",
                    borderColor: Config.colors("<?php echo $borderColor[($week+1)];?>", 600),
                    hoverBackgroundColor: "<?php echo $hoverBackgroundColor[($week+1)];?>",
                    borderWidth: 2,
                    <?php 
                    $amount = array();
                    for($kpi = 0; $kpi<count($kpi_graph[$week]["kpi"]); $kpi++){
                        $amount[$kpi] = $kpi_graph[$week]["kpi"][$kpi]["jumlah_report"];
                    }
                    ?>
                    data: <?php echo json_encode($amount);?> /*TARGET KPI1, TARGET KPI2, TARGET KPI3*/
                }, 
                <?php endfor;?>
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