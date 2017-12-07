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
        <link rel="stylesheet" type="text/css" href="{{ asset('./plugins/datatables/dataTables.bootstrap.css') }}">
    </head>
    <body>
        <div class="container">
            <div class="row">
                <h1 class="text-center">LARAVEL DATATABLE</h1>
                <div class="col-md-12">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>CODE</th>
                                <th>FIRST NAME</th>
                                <th>LAST NAME</th>
                                <th>PROFILE</th>
                                <th>ACTIONS</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
        
        <script type="text/javascript" src="{{ asset('./plugins/jQuery/jquery.min.js')  }}"></script>
        <script type="text/javascript" src="{{ asset('./plugins/datatables/jquery.dataTables.js') }}"></script>
        <script type="text/javascript" src="{{ asset('./plugins/datatables/dataTables.bootstrap.js') }}"></script>
        <script type="text/javascript" src="{{ asset('./css/datatable.js') }}"></script>
        <script type="text/javascript">
            tableOptions.ajax.url   = '{!! route("users-list") !!}',            
            tableOptions.aoColumns  = [
                                        { data: 'code' },
                                        { data: 'first_name' },
                                        { data: 'last_name' },
                                        { data: 'profile.name' },
                                        { data: 'id', class: 'text-center', orderable: false, render: function(data){
                                            return  '<a href="url" class="btn btn-info btn-xs">Editar</a> '+
                                                    '<a href="url" class="btn btn-danger btn-xs">Eliminar</a>'; 
                                        }},
                                    ];
            $('.table').dataTable(tableOptions);
        </script>
    </body>
</html>
