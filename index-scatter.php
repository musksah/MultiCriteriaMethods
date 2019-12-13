<html>

<head>
    <!-- Plotly.js -->
    <script src="https://cdn.plot.ly/plotly-latest.min.js"></script>
</head>

<body>
    <div id="myDiv">
        <!-- Plotly chart will be drawn inside this DIV -->
    </div>
    <script>
        // var trace1 = {
        //     x: [0, 0.1, 0.2, 0.3, 0.4, 0.5, 0.6, 0.7, 0.8, 0.9, 1],
        //     y: [12, 9.5, 7, 4.5, 2, 0.5, 3, 5.5, 8, 10.5, 13],
        //     mode: 'lines+markers'
        // };

        var trace2 = {
            x: [0, 0.1, 0.2, 0.3, 0.4, 0.5, 0.6, 0.7, 0.8, 0.9, 1],
            y: [-12, -9.5, -7, -4.5, -2, 0.5, 3, 5.5, 8, 10.5, 13],
            mode: 'lines+markers'
        };

        var trace3 = {
            x: [0, 0.1, 0.2, 0.3, 0.4, 0.5, 0.6, 0.7, 0.8, 0.9, 1],
            y: [11, 9.1, 7.2, 5.3, 3.4, 1.5, -0.4, -2.3, -4.2, -6.1, -8],
            mode: 'lines+markers'
        };

        var data = [trace2, trace3];

        var layout = {};

        Plotly.newPlot('myDiv', data, layout, { showSendToCloud: true });
    </script>
</body>


</html>