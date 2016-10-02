/* ------------------------------------------------------------------------------
 *
 *  # Echarts - columns and waterfalls
 *
 *  Columns and waterfalls chart configurations
 *
 *  Version: 1.0
 *  Latest update: August 1, 2015
 *
 * ---------------------------------------------------------------------------- */

$(function () {
    require.config({
        paths: {
            echarts: 'assets/js/plugins/visualization/echarts'
        }
    });
    require(
        [
            'echarts',
            'echarts/theme/limitless',
            'echarts/chart/bar',
            'echarts/chart/line'
        ],

        function (ec, limitless) {
            var basic_columns = ec.init(document.getElementById('basic_columns'), limitless);
			var stacked_area = ec.init(document.getElementById('stacked_area'), limitless);
			
			stacked_area_options = {

                // Setup grid
                grid: {
                    x: 40,
                    x2: 20,
                    y: 35,
                    y2: 25
                },

                // Add tooltip
                tooltip: {
                    trigger: 'axis'
                },

                // Add legend
                legend: {
                    data: ['Internet Explorer', 'Safari', 'Firefox', 'Chrome']
                },

                // Enable drag recalculate
                calculable: true,

                // Add horizontal axis 
                xAxis: [{
                    type: 'category',
                    boundaryGap: false,
                    data: ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec']
                }],

                // Add vertical axis
                yAxis: [{
                    type: 'value'
                }],

                // Add series
                series: [
                    {
                        name: 'Internet Explorer',
                        type: 'line',
                        stack: 'Total',
                        itemStyle: {normal: {areaStyle: {type: 'default'}}},
                        data: [100,100,100,100,100,100,100,100,100,100,100,100]
                    },
                    {
                        name: 'Safari',
                        type: 'line',
                        stack: 'Total',
                        itemStyle: {normal: {areaStyle: {type: 'default'}}},
                        data: [100,100,100,100,100,100,100,100,100,100,100,100]
                    },
                    {
                        name: 'Firefox',
                        type: 'line',
                        stack: 'Total',
                        itemStyle: {normal: {areaStyle: {type: 'default'}}},
                        data: [100,100,100,100,100,100,100,100,100,100,100,100]
                    },
                    {
                        name: 'Chrome',
                        type: 'line',
                        stack: 'Total',
                        itemStyle: {normal: {areaStyle: {type: 'default'}}},
                        data: [100,100,100,100,100,100,100,100,100,100,100,100]
                    }
                ]
            };


            //
            // Reversed value axis options
            //

            reversed_value_options = {

                // Setup grid
                grid: {
                    x: 40,
                    x2: 40,
                    y: 35,
                    y2: 25
                },

                // Add tooltip
                tooltip: {
                    trigger: 'axis',
                    formatter: function(params) {
                        return params[0].name + '<br/>'
                        + params[0].seriesName + ': ' + params[0].value + ' (m^3/s)<br/>'
                        + params[1].seriesName + ': ' + -params[1].value + ' (mm)';
                    }
                },

                // Add legend
                legend: {
                    data: ['Flow', 'Rainfall']
                },

                // Add horizontal axis
                xAxis: [{
                    type: 'category',
                    boundaryGap: false,
                    axisLine: {
                        onZero: false
                    },
                    data: ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec']
                }],

                // Add vertical axis
                yAxis: [
                    {
                        name: 'Flow(m^3/s)',
                        type: 'value',
                        max: 500
                    },
                    {
                        name: 'Rainfall(mm)',
                        type: 'value',
                        axisLabel: {
                            formatter: function(v) {
                                return - v;
                            }
                        }
                    }
                ],

                // Add series
                series: [
                    {
                        name: 'Flow',
                        type: 'line',
                        itemStyle: {normal: {areaStyle: {type: 'default'}}},
                        data:[100,100,100,100,100,100,100,100,100,100,100,100]
                    },
                    {
                        name: 'Rainfall',
                        type: 'line',
                        yAxisIndex: 1,
                        itemStyle: {normal: {areaStyle: {type: 'default'}}},
                        data: (function() {
                            var oriData = [
                                1, 2, 1.5, 7.4, 3.1, 4, 2
                            ];
                            var len = oriData.length;
                            while(len--) {
                                oriData[len] *= -1;
                            }
                            return oriData;
                        })()
                    }
                ]
            };
			
            basic_columns_options = {

                // Setup grid
                grid: {
                    x: 40,
                    x2: 40,
                    y: 35,
                    y2: 25
                },

                // Add tooltip
                tooltip: {
                    trigger: 'axis'
                },

                // Add legend
                legend: {
                    data: ['Kívülről érkező kérvények', 'Belülről induló kérvények']
                },

                // Enable drag recalculate
                calculable: true,

                // Horizontal axis
                xAxis: [{
                    type: 'category',
                    data: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
                }],

                // Vertical axis
                yAxis: [{
                    type: 'value'
                }],

                // Add series
                series: [
                    {
                        name: 'Kívülről érkező kérvények',
                        type: 'bar',
                        data: [0,0,0,0,1,0,0,0,0,0,0,0],
                        itemStyle: {
                            normal: {
                                label: {
                                    show: true,
                                    textStyle: {
                                        fontWeight: 500
                                    }
                                }
                            }
                        }
                    },
                    {
                        name: 'Belülről induló kérvények',
                        type: 'bar',
                        data: [0,0,0,0,56,0,0,0,0,0,0,0],
                        itemStyle: {
                            normal: {
                                label: {
                                    show: true,
                                    textStyle: {
                                        fontWeight: 500
                                    }
                                }
                            }
                        }
                    }
                ]
            };

            basic_columns.setOption(basic_columns_options);
			stacked_area.setOption(stacked_area_options);
			
            window.onresize = function () {
                setTimeout(function () {
                    basic_columns.resize();
					stacked_area.resize();
                }, 200);
            }
        }
    );
});
