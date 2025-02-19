<script type="text/javascript">
Highcharts.chart('chart-kunjungan-hc', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Grafik Jumlah Kunjungan dan Pengunjung Menurut Jenis Kelamin'
        },
        subtitle: {
            text: '{{ Generate::Grafik2Minggu()["subtitle"]}}'
        },
        xAxis: {
            categories: {!! Generate::Grafik2Minggu()['cat_final']!!},
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                text: ''
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y:.0f}</b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        credits: {
            enabled: false
        },
        series: {!! Generate::Grafik2Minggu()['data_final']!!}
});

Highcharts.chart('chart-tahunan-hc', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Grafik Jumlah Kunjungan dan Pengunjung Menurut Menurut Jenis Kelamin'
        },
        subtitle: {
            text: 'Tahun {{$tahun}}'
        },
        xAxis: {
            categories: {!! Generate::NewGrafikTahunan($tahun)['cat_final']!!},
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Kunjungan'
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y:.0f}</b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        credits: {
            enabled: false
        },
        series: {!! Generate::NewGrafikTahunan($tahun)['data_final']!!}
});

Highcharts.chart('donat-pendidikan', {
    chart: {
        type: 'pie',
        custom: {},
        events: {
            render() {
                const chart = this,
                    series = chart.series[0];
                let customLabel = chart.options.chart.custom.label;

                if (!customLabel) {
                    customLabel = chart.options.chart.custom.label =
                        chart.renderer.label(
                            'Total<br/>' +
                            '<strong>{!! Generate::NewDonatPendidikan()["jumlah_total"] !!}</strong>'
                        )
                            .css({
                                color: '#000',
                                textAnchor: 'middle'
                            })
                            .add();
                }

                const x = series.center[0] + chart.plotLeft,
                    y = series.center[1] + chart.plotTop -
                    (customLabel.attr('height') / 2);

                customLabel.attr({
                    x,
                    y
                });
                // Set font size based on chart diameter
                customLabel.css({
                    fontSize: `${series.center[2] / 12}px`
                });
            }
        }
    },
    accessibility: {
        point: {
            valueSuffix: '%'
        }
    },
    title: {
        text: ''
    },
    subtitle: {
        text: ''
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.0f}%</b>'
    },
    legend: {
        enabled: false
    },
    credits: {
        enabled: false
    },
    plotOptions: {
        series: {
            allowPointSelect: true,
            cursor: 'pointer',
            borderRadius: 8,
            dataLabels: [{
                enabled: true,
                distance: 10,
                format: '{point.name}'
            }, {
                enabled: true,
                distance: -15,
                format: '{point.percentage:.0f}%',
                style: {
                    fontSize: '0.9em'
                }
            }],
            showInLegend: true
        }
    },
    series: [{
        name: 'Kunjungan',
        colorByPoint: true,
        innerSize: '60%',
        data: {!! Generate::NewDonatPendidikan()['data'] !!}
    }]
});

Highcharts.chart('donat-jk', {
    chart: {
        type: 'pie',
        custom: {},
        events: {
            render() {
                const chart = this,
                    series = chart.series[0];
                let customLabel = chart.options.chart.custom.label;

                if (!customLabel) {
                    customLabel = chart.options.chart.custom.label =
                        chart.renderer.label(
                            'Total<br/>' +
                            '<strong>{!! Generate::NewDonatJenisKelamin()["jumlah_total"] !!}</strong>'
                        )
                            .css({
                                color: '#000',
                                textAnchor: 'middle'
                            })
                            .add();
                }

                const x = series.center[0] + chart.plotLeft,
                    y = series.center[1] + chart.plotTop -
                    (customLabel.attr('height') / 2);

                customLabel.attr({
                    x,
                    y
                });
                // Set font size based on chart diameter
                customLabel.css({
                    fontSize: `${series.center[2] / 12}px`
                });
            }
        }
    },
    accessibility: {
        point: {
            valueSuffix: '%'
        }
    },
    title: {
        text: ''
    },
    subtitle: {
        text: ''
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.0f}%</b>'
    },
    legend: {
        enabled: false
    },
    credits: {
        enabled: false
    },
    plotOptions: {
        series: {
            allowPointSelect: true,
            cursor: 'pointer',
            borderRadius: 8,
            dataLabels: [{
                enabled: true,
                distance: 10,
                format: '{point.name}'
            }, {
                enabled: true,
                distance: -15,
                format: '{point.percentage:.0f}%',
                style: {
                    fontSize: '0.9em'
                }
            }],
            showInLegend: true
        }
    },
    series: [{
        name: 'Kunjungan',
        colorByPoint: true,
        innerSize: '60%',
        data: {!! Generate::NewDonatJenisKelamin()['data'] !!}
    }]
});

Highcharts.chart('donat-layanan', {
    chart: {
        type: 'pie',
        custom: {},
        events: {
            render() {
                const chart = this,
                    series = chart.series[0];
                let customLabel = chart.options.chart.custom.label;

                if (!customLabel) {
                    customLabel = chart.options.chart.custom.label =
                        chart.renderer.label(
                            'Total<br/>' +
                            '<strong>{!! Generate::NewDonatLayananUtama()["jumlah_total"] !!}</strong>'
                        )
                            .css({
                                color: '#000',
                                textAnchor: 'middle'
                            })
                            .add();
                }

                const x = series.center[0] + chart.plotLeft,
                    y = series.center[1] + chart.plotTop -
                    (customLabel.attr('height') / 2);

                customLabel.attr({
                    x,
                    y
                });
                // Set font size based on chart diameter
                customLabel.css({
                    fontSize: `${series.center[2] / 12}px`
                });
            }
        }
    },
    accessibility: {
        point: {
            valueSuffix: '%'
        }
    },
    title: {
        text: ''
    },
    subtitle: {
        text: ''
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.0f}%</b>'
    },
    legend: {
        enabled: false
    },
    credits: {
        enabled: false
    },
    plotOptions: {
        series: {
            allowPointSelect: true,
            cursor: 'pointer',
            borderRadius: 8,
            dataLabels: [{
                enabled: true,
                distance: 10,
                format: '{point.name}'
            }, {
                enabled: true,
                distance: -15,
                format: '{point.percentage:.0f}%',
                style: {
                    fontSize: '0.9em'
                }
            }],
            showInLegend: true
        }
    },
    series: [{
        name: 'Kunjungan',
        colorByPoint: true,
        innerSize: '60%',
        data: {!! Generate::NewDonatLayananUtama()['data'] !!}
    }]
});
</script>
