$(function() {
    'use strict'
    var flot2 = $.plot('#documentsByDirection', [{
        data: yDataSet,
        color: '#69b2f8'
    },], {
        legend : {show:true},
        series: {
           // lines: { show: true },
           // points: { show: true },
            stack: 0,
            bars: {
                show: true,
                lineWidth: 0,
                barWidth: .5,
                fill: 1
            }
        },
        grid: {
            borderWidth: 0,
            borderColor: '#edeff6'
        },
        yaxis: {
            show: true,
            max: directionsBestCount
        },
        xaxis: {
            ticks:xDataSet,
            color: 'rgba(255,255,255,0)',
        }
    });
});