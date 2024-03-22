<script>
    function renderChart(chartDataDays, chartsDataOrders) {
        var optionsArea = {
            series: [{
                name: "",
                data: chartsDataOrders
            }],
            chart: {
                height: 300,
                type: 'area',
                group: 'social',
                toolbar: {
                    show: false
                },
                zoom: {
                    enabled: false
                },
            },
            // Weitere Optionen...
        };

        // Erstelle eine neue Instanz der ApexCharts-Grafik und rendere sie
        var chartArea = new ApexCharts(document.querySelector("#chart"), optionsArea);
        chartArea.render();
    }

    // Rufe die Funktion zum Rendern der Chart auf
    renderChart(@json($chartDataDays), @json($chartsDataOrders));
</script>
