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
            labels: ["KPI 1", "KPI 2", "KPI 3", "KPI 4"],
            datasets: [{
                label: "Target",
                backgroundColor: "rgba(178,34,34, .8)",
                borderColor: Config.colors("blue-grey", 300),
                hoverBackgroundColor: "rgba(178,34,34, 1)",
                borderWidth: 2,
                data: [65, 5, 2, 1]
            }, 
            {
                label: "Week 11",
                backgroundColor: "rgba(4, 3, 86, .2)",
                borderColor: Config.colors("primary", 600),
                hoverBackgroundColor: "rgba(4, 3, 86, .3)",
                borderWidth: 2,
                data: [30, 20, 40, 25]
            }, 
            {
                label: "Week 10",
                backgroundColor: "rgba(124, 104, 238, .2)",
                borderColor: Config.colors("primary", 600),
                hoverBackgroundColor: "rgba(124, 104, 238, .3)",
                borderWidth: 2,
                data: [11, 22, 33, 44]
            }, 
            {
                label: "Week 9",
                backgroundColor: "rgba(30,144,254, .2)",
                borderColor: Config.colors("primary", 600),
                hoverBackgroundColor: "rgba(30,144,254, .3)",
                borderWidth: 2,
                data: [33, 23, 58, 11]
            }, 
            {
                label: "Week 8",
                backgroundColor: "rgba(137,205,250, .2)",
                borderColor: Config.colors("primary", 600),
                hoverBackgroundColor: "rgba(137,205,250, .3)",
                borderWidth: 2,
                data: [44, 2, 1, 1]
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
    })();
});
</script>