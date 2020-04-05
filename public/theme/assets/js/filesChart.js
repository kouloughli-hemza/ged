$(function() {

    'use strict'

    var ctxLabel = months;
    var ctxData1 = files;
    var ctxColor1 = '#001737';

// Line chart
    var ctx4 = document.getElementById('filesChartLine');
    new Chart(ctx4, {
        type: 'line',
        data: {
            labels: ctxLabel,
            datasets: [{
                data: ctxData1,
                borderColor: ctxColor1,
                borderWidth: 1,
                fill: false
            }]
        },
        options: {
            maintainAspectRatio: false,
            title: {
                display: true,
                text: 'Fichiers/Mois'
            },
            legend: {
                display: false,
                labels: {
                    display: false
                }
            },
            scales: {
                yAxes: [{
                    gridLines: {
                        color: '#e5e9f2'
                    },
                    ticks: {
                        beginAtZero: true,
                        fontSize: 10,
                        max: 80
                    }
                }],
                xAxes: [{
                    gridLines: {
                        display: false
                    },
                    ticks: {
                        beginAtZero: true,
                        fontSize: 11
                    }
                }]
            }
        }
    });
});