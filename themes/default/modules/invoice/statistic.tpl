<!-- BEGIN: main -->
<script type="text/javascript" src="{NV_BASE_SITEURL}{NV_ASSETS_DIR}/js/chart/Chart.bundle.min.js"></script>
<canvas id="myChart" width="100%" height="35"></canvas>
<script>
    var ctx = document.getElementById("myChart");
    
    var data = {
        labels: {LABEL},
        datasets: {DATASETS}
    };
    
    var myChart = new Chart(ctx, {
        type : 'bar',
        data : data,
        options : {
            tooltips: {
                mode: 'label',
                label: 'mylabel',
                callbacks: {
                    label: function (tooltipItems, data) {
                        return data.datasets[tooltipItems.datasetIndex].label + ' : ' + tooltipItems.yLabel.toLocaleString() + ' VNĐ';
                    }
                }
             },
            scales : {
                yAxes : [ {
                    ticks: {
                        beginAtZero: true,
                        stepSize: 1000000,

                        // Return an empty string to draw the tick line but hide the tick label
                        // Return `null` or `undefined` to hide the tick line entirely
                        userCallback: function(value, index, values) {
                            // Convert the number to a string and splite the string every 3 charaters from the end
                            value = value.toString();
                            value = value.split(/(?=(?:...)*$)/);

                            // Convert the array to a string and format the output
                            value = value.join('.');
                            return value;
                        }
                    }
                } ]
            }
        }
    });
</script>
<!-- END: main -->