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
    <?php
    $uang_masuk = array(0,0,0,0,0,0,0,0,0,0,0,0);
    $uang_keluar = array(0,0,0,0,0,0,0,0,0,0,0,0);
    for($a = 0; $a<count($uang_masuk_bulanan); $a++){
        $uang_masuk[$uang_masuk_bulanan[$a]["bulan_transaksi"]-1] = abs($uang_masuk_bulanan[$a]["total_pembayaran"]);
        
    }
    for($a = 0; $a<count($uang_keluar_bulanan); $a++){
        $uang_keluar[$uang_keluar_bulanan[$a]["bulan_transaksi"]-1] = abs($uang_keluar_bulanan[$a]["total_pembayaran"]);
    }
    
    ?>
    (function () {
        var barChartData = {
            labels: ["January", "February", "March", "April", "May", "June", "July","Agst","September","November","December"],
            datasets: [
                {
                label: "Uang Masuk",
                backgroundColor: "rgba(186, 107, 99, .8)",
                borderColor: "rgba(186, 107, 99, .6)",
                hoverBackgroundColor: "rgba(186, 107, 99, .4)",
                borderWidth: 2,
                data: [
                    <?php 
                    for($a = 0; $a<count($uang_masuk); $a++){
                        echo $uang_masuk[$a];
                        if(($a+1) != count($uang_masuk)){
                            echo ",";
                        }
                    }
                    ?>]
                }, 
                {
                label: "Uang Keluar",
                backgroundColor: "rgba(245, 223, 218, .8)",
                borderColor: "rgba(245, 223, 218, .6)",
                hoverBackgroundColor: "rgba(245, 223, 218, .4)",
                borderWidth: 2,
                data: [
                    <?php 
                    for($a = 0; $a<count($uang_keluar); $a++){
                        echo $uang_keluar[$a];
                        if(($a+1) != count($uang_keluar)){
                            echo ",";
                        }
                    }
                    ?>
                    ]
                },
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
    })(); 
    (function () {
        var barChartData = {
        labels: ["January", "February", "March", "April", "May", "June", "July","Agst","September","November","December"],
        datasets: [{
            label: "2017",
            backgroundColor: "rgba(204, 213, 219, .2)",
            borderColor: Config.colors("blue-grey", 300),
            hoverBackgroundColor: "rgba(204, 213, 219, .3)",
            borderWidth: 2,
            data: [65, 45, 75, 50, 60, 45, 55,43,66,78,99,34]
        }, {
            label: "2018",
            backgroundColor: "rgba(98, 168, 234, .2)",
            borderColor: Config.colors("primary", 600),
            hoverBackgroundColor: "rgba(98, 168, 234, .3)",
            borderWidth: 2,
            data: [30, 20, 40, 25, 45, 35, 40,43,66,78,99,34]
        }, {
            label: "2019",
            backgroundColor: "rgba(98, 168, 234, .2)",
            borderColor: Config.colors("primary", 600),
            hoverBackgroundColor: "rgba(98, 168, 234, .3)",
            borderWidth: 2,
            data: [30, 20, 40, 25, 45, 35, 40,43,66,78,99,34]
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
    })(); // Example Chartjs Radar
    // --------------------

});
</script>