<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{config('app.name')}}</title>
    <style>
        html. body {
            font-family: Roboto, serif;
        }
        #title{
            color: #000000;
            text-align: center;
        }
        #name{
            color: #757575;
            text-align: center;
        }
        #time{
            color: #757575;
            text-align: left;
        }

        table {
            width: 100%;
        }

        table,
        td,th {
            border: solid 1px lightgray;
            text-align: left;
            border-collapse: collapse;
        }

        .bold~tr td, th {
            border: solid 1px lightgray;
        }

        td,th {
            padding: 0.5em;
        }

    </style>
</head>
<body>
<div class="container mt-5">
    <h2 id="title">{{config('app.name')}}</h2>
    @yield('content')
    <h5 id="time">{{__('Report Date:')}} {{now()}}</h5>
</div>

</body>
</html>
