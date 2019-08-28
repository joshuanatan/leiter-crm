<script>
    (function (global, factory) {
    if (typeof define === "function" && define.amd) {
        define("/charts/chartjs", ["jquery", "Site"], factory);
    } else if (typeof exports !== "undefined") {
        factory(require("jquery"), require("Site"));
    } else {
        var mod = {
        exports: {}
        };
        factory(global.jQuery, global.Site);
        global.chartsChartjs = mod.exports;
    }
    })(this, function (_jquery, _Site) {
    "use strict";

    _jquery = babelHelpers.interopRequireDefault(_jquery);
    (0, _jquery.default)(document).ready(function ($$$1) {
        (0, _Site.run)();
    });
    Chart.defaults.global.responsive = true; // Example Chartjs Line
    // --------------------


    (function () {
        var barChartData = {
            labels: [
                "January", "February", "March", "April", "May", "June", "July","Agst","September","November","December"
            ],
            datasets: [
                {
                    label: "Quotation",
                    backgroundColor: "rgba(204, 213, 219, .2)",
                    borderColor: Config.colors("blue-grey", 300),
                    hoverBackgroundColor: "rgba(204, 213, 219, .3)",
                    borderWidth: 2,
                    data: [65, 45, 75, 50, 60, 45, 55,23,56,77,56,23]
                }, 
                {
                    label: "Win",
                    backgroundColor: "rgba(98, 168, 234, .2)",
                    borderColor: Config.colors("primary", 600),
                    hoverBackgroundColor: "rgba(98, 168, 234, .3)",
                    borderWidth: 2,
                    data: [30, 20, 40, 25, 45, 35, 40,23,12,55,24,23]
                }, 
                {
                    label: "Loss",
                    backgroundColor: "rgba(98, 168, 234, .2)",
                    borderColor: Config.colors("primary", 600),
                    hoverBackgroundColor: "rgba(98, 168, 234, .3)",
                    borderWidth: 2,
                    data: [30, 20, 40, 25, 45, 35, 40,23,34,12,22,0]
                }
            ]
        };
        var myBar = new Chart(document.getElementById("exampleChartjsBar2").getContext("2d"), {
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
    
    (function () {
        var barChartData = {
        labels: ["Customer 2", "Customer 3", "Customer 4", "Customer 5", "Customer 6", "Customer 7", "Customer 8","Customer 9","Customer 10","Customer 11"],
        datasets: [{
            label: "Quotation",
            backgroundColor: "rgba(204, 213, 219, .2)",
            borderColor: Config.colors("blue-grey", 300),
            hoverBackgroundColor: "rgba(204, 213, 219, .3)",
            borderWidth: 2,
            data: [65, 45, 75, 50, 60, 45, 55,23,56,77]
        }, {
            label: "Win",
            backgroundColor: "rgba(98, 168, 234, .2)",
            borderColor: Config.colors("primary", 600),
            hoverBackgroundColor: "rgba(98, 168, 234, .3)",
            borderWidth: 2,
            data: [30, 20, 40, 25, 45, 35, 40,23,12,55,24,23]
        }, {
            label: "Loss",
            backgroundColor: "rgba(98, 168, 234, .2)",
            borderColor: Config.colors("primary", 600),
            hoverBackgroundColor: "rgba(98, 168, 234, .3)",
            borderWidth: 2,
            data: [30, 20, 40, 25, 45, 35, 40,23,34,12]
        }]
        };
        var myBar = new Chart(document.getElementById("exampleChartjsBar3").getContext("2d"), {
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
    })(); // Example Chartjs Radar
    <?php
    $tahun = date("Y");
    $total_perbulan_1 = array("0,","0,","0,","0,","0,","0,","0,","0,","0,","0,","0,","0");
    for($a = 0; $a<count($penghasilan); $a++){
        for($bulan = 1; $bulan<= 12; $bulan++){
            if($penghasilan[$a]["bulan_invoice"] == sprintf("%02d",$bulan)){
                if($tahun-0 == $penghasilan[$a]["tahun_invoice"]){
                    $total_perbulan_1[$bulan-1] = $penghasilan[$a]["total"].",";
                }
            }
        }
    }
    $total_perbulan_2 = array("0,","0,","0,","0,","0,","0,","0,","0,","0,","0,","0,","0");
    for($a = 0; $a<count($penghasilan); $a++){
        for($bulan = 1; $bulan<= 12; $bulan++){
            if($penghasilan[$a]["bulan_invoice"] == sprintf("%02d",$bulan)){
                if($tahun-1 == $penghasilan[$a]["tahun_invoice"]){
                    $total_perbulan_2[$bulan-1] = ($penghasilan[$a]["total"]*10000).",";
                }
            }
        }
    }
    $total_perbulan_3 = array("0,","0,","0,","0,","0,","0,","0,","0,","0,","0,","0,","0");
    for($a = 0; $a<count($penghasilan); $a++){
        for($bulan = 1; $bulan<= 12; $bulan++){
            if($penghasilan[$a]["bulan_invoice"] == sprintf("%02d",$bulan)){
                if($tahun-2 == $penghasilan[$a]["tahun_invoice"]){
                    $total_perbulan_3[$bulan-1] = ($penghasilan[$a]["total"]*10000).",";
                }
            }
        }
    }
    ?>
    (function () {
        var warna = ["rgba(186, 107, 99, .8)","rgba(245, 223, 218, .8)","rgba(117, 96, 99, .8)"];
        var warna2 = ["rgba(186, 107, 99, .6)","rgba(245, 223, 218, .6)","rgba(117, 96, 99, .6)"];
        var counter = 0;
        <?php
        $color = array(
            "red","yellow","green"
        );
        $border_color = array(
            "dark-red","dark-yellow","dark-green"
        );
        
        ?>
        var barChartData = {
            labels: [
                "January", "February", "March", "April", "May", "June", "July","Agst","September","November","December"
            ],
            datasets: [
                {
                    label: <?php echo $tahun-0;?>,
                    backgroundColor: warna[0],
                    borderColor: warna2[0],
                    hoverBackgroundColor: "rgba(186, 107, 99, .4)",
                    borderWidth: 2,
                    data: [
                        <?php 
                        for($a = 0; $a<count($total_perbulan_1); $a++){
                            echo $total_perbulan_1[$a];
                        }   
                        ?>
                    ]
                },
                {
                    label: <?php echo $tahun-1;?>,
                    backgroundColor: warna[1],
                    borderColor: warna2[1],
                    hoverBackgroundColor: "rgba(245, 223, 218, .4)",
                    borderWidth: 2,
                    data: [
                        <?php 
                        for($a = 0; $a<count($total_perbulan_2); $a++){
                            echo $total_perbulan_2[$a];
                        }   
                        ?>
                    ] 
                }, 
                {
                    label: <?php echo $tahun-2;?>,
                    backgroundColor: warna[2],
                    borderColor: warna2[2],
                    hoverBackgroundColor: "rgba(117, 96, 99, .4)",
                    borderWidth: 2,
                    data: [
                        <?php 
                        for($a = 0; $a<count($total_perbulan_3); $a++){
                            echo $total_perbulan_3[$a];
                        }   
                        ?>
                    ] 
                }
                
            ]
        };
        var myBar = new Chart(document.getElementById("exampleChartjsBar").getContext("2d"), {
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
    })(); // Example Chartjs Radar
    // --------------------
});
</script>

<?php print_r($penghasilan);?>