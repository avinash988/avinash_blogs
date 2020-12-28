/* ------------------------------------------------------------------------------
 *
 *  # Echarts - Basic pie example
 *
 *  Demo JS code for basic pie chart [light theme]
 *
 * ---------------------------------------------------------------------------- */


// Setup module
// ------------------------------

var EchartsPieBasicLight = function() {


    //
    // Setup module components
    //

    // Basic pie chart
    var _scatterPieBasicLightExample = function() {
        if (typeof echarts == 'undefined') {
            console.warn('Warning - echarts.min.js is not loaded.');
            return;
        }

        // Define element
        var pie_basic_element = document.getElementById('pie_basic');

        var lead_count = $('#lead_count').val();

        var lead_count_progress = $('#lead_count_progress').val();
        var lead_count_closed = $('#lead_count_closed').val();
        var lead_count_hold = $('#lead_count_hold').val();
        var lead_count_success = $('#lead_count_success').val();

        // console.log(lead_count);

        //
        // Charts configuration
        //

        if (pie_basic_element) {

            // Initialize chart
            var pie_basic = echarts.init(pie_basic_element);

            //
            // Chart config
            //

            // Options
            pie_basic.setOption({

                // Colors
                color: [
                    '#1ec94c','#d41515','#247816','#1eb8c9'
                ],

                // Global text styles
                textStyle: {
                    fontFamily: 'Roboto, Arial, Verdana, sans-serif',
                    fontSize: 13
                },

                // Add title
                title: {
                    text: 'Total Leads : ' + lead_count,
                    // subtext: lead_count,
                    top: 110,
                    textStyle: {
                        fontSize: 15,
                        fontWeight: 500
                    },
                    // subtextStyle: {
                    //     fontSize: 12
                    // }
                },

                // Add tooltip
                tooltip: {
                    trigger: 'item',
                    backgroundColor: 'rgba(0,0,0,0.75)',
                    padding: [8, 8],
                    textStyle: {
                        fontSize: 15,
                        fontFamily: 'Roboto, sans-serif'
                    },
                    formatter: "{a} <br/>{b}: {c} ({d}%)"
                },

                // Add legend
                legend: {
                    orient: 'vertical',
                    top: 'center',
                    left: 0,
                    data: ['In Progress', 'Closed', 'Success', 'Hold'],
                    itemHeight: 15,
                    itemWidth: 15
                },

                // Add series
                series: [{
                    name: 'Total',
                    type: 'pie',
                    radius: '35%',
                    center: ['60%', '48%'],
                    itemStyle: {
                        normal: {
                            borderWidth: 1,
                            borderColor: '#fff'
                        }
                    },
                    data: [
                        {value: lead_count_progress, name: 'In Progress'},
                        {value: lead_count_closed, name: 'Closed'},
                        {value: lead_count_success, name: 'Success'},
                        {value: lead_count_hold, name: 'Hold'},
                    ]
                }]
            });
        }


        //
        // Resize charts
        //

        // Resize function
        var triggerChartResize = function() {
            pie_basic_element && pie_basic.resize();
        };

        // On sidebar width change
        var sidebarToggle = document.querySelector('.sidebar-control');
        sidebarToggle && sidebarToggle.addEventListener('click', triggerChartResize);

        // On window resize
        var resizeCharts;
        window.addEventListener('resize', function() {
            clearTimeout(resizeCharts);
            resizeCharts = setTimeout(function () {
                triggerChartResize();
            }, 200);
        });
    };


    //
    // Return objects assigned to module
    //

    return {
        init: function() {
            _scatterPieBasicLightExample();
        }
    }
}();


// Initialize module
// ------------------------------

document.addEventListener('DOMContentLoaded', function() {
    EchartsPieBasicLight.init();
});
