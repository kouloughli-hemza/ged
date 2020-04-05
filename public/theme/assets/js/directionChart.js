$(function() {
    'use strict'
    var datapie = {
        labels: directions,
        datasets: [{
            data: directionFiles,
            backgroundColor: ['#560bd0', '#007bff', '#00cccc', '#cbe0e3', '#74de00']
        }]
    };

    var optionpie = {
        maintainAspectRatio: false,
        responsive: true,
        legend: {
            display: true,
        },
        animation: {
            animateScale: true,
            animateRotate: true
        }
    };

    var ctx9 = document.getElementById('directionChart');
    var myDonutChart = new Chart(ctx9, {
        type: 'pie',
        data: datapie,
        options: optionpie
    });
});