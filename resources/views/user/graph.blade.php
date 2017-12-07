<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
        <title>Laravel Graphs PDF</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
    </head>
    <body>
        <div class="container">
            <div class="row">
                <h1 class="text-center">USER GRAPH</h1>
                <br>
                <button id="download-pdf" class="btn btn-lg btn-danger btn-block" disabled>Download PDF</button>
                <br>
                <div class="col-md-6 col-md-offset-3">
                    <div id="graphic"></div>
                </div>
            </div>
        </div>

        <form id="my-form" action="{{ route('download-pdf') }}" method="POST" target="_blank">
            {{ csrf_field() }}
            <div id="content-images-graphics"></div>
        </form>
        
        <script type="text/javascript" src="{{ asset('./plugins/printshop/es6-promise.js')  }}"></script>
        <script type="text/javascript" src="{{ asset('./plugins/printshop/promise.min.js')  }}"></script>
        <script type="text/javascript" src="{{ asset('./plugins/printshop/html2canvas.js')  }}"></script>
        <script type="text/javascript" src="{{ asset('./plugins/printshop/rgbcolor.js')  }}"></script>
        <script type="text/javascript" src="{{ asset('./plugins/printshop/canvg.js')  }}"></script>
        <script type="text/javascript" src="{{ asset('./plugins/printshop/canvas2image.js')  }}"></script>
        <script type="text/javascript" src="{{ asset('./plugins/printshop/base64.min.js')  }}"></script>
        <!--script type="text/javascript" src="{{ asset('./plugins/jspdf/jspdf.min.js')  }}"></script-->

        <script type="text/javascript" src="{{ asset('./plugins/jQuery/jquery.min.js')  }}"></script>
        <script type="text/javascript" src="{{ asset('./plugins/highcharts/highcharts.js')  }}"></script>
        <script type="text/javascript">
            $(document).ready(function(){
                let chart = Highcharts.chart('graphic', {
                    chart: {
                        plotBackgroundColor: null,
                        plotBorderWidth: null,
                        plotShadow: false,
                        type: 'pie',
                        events: {
                            load: function(event){
                                $('#download-pdf').removeAttr('disabled');
                            }
                        }
                    },
                    title: {
                        text: ' '
                    },
                    tooltip: {
                        pointFormat: '{series.name}: <b>{point.y} users</b>'
                    },
                    plotOptions: {
                        pie: {
                            allowPointSelect: true,
                            cursor: 'pointer',
                            dataLabels: {
                                enabled: true,
                                format: '<b>{point.name}</b>: {point.y} users',
                                style: {
                                    color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                                }
                            }
                        }
                    },
                    series: [{
                        name: 'users by profile',
                        colorByPoint: true,
                        data: {!! $data !!}
                    }]
                });

                $('#download-pdf').click(function(){
                    if( $('#content-images-graphics').children().length > 0 ){
                        $('#my-form').submit();
                    }else{
                        image2canvas();
                    }
                })
            })

            function image2canvas() {
                var img2canvasObj = {
                    useCORS: true,
                    background :'#FFFFFF',
                    onrendered: function (canvas) {
                        var ctx = canvas.getContext('2d');
                        ctx.webkitImageSmoothingEnabled = false;
                        ctx.imageSmoothingEnabled = false;

                        var input = '<input name="image" type="text" value="'+ canvas.toDataURL('image/png') +'" class="hide"/>'
                        $('#content-images-graphics').append(input);

                        $('#my-form').submit();

                    }
                };
                html2canvas(document.getElementById('graphic'), img2canvasObj);
            }
        </script>
    </body>
</html>
