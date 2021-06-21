<html>
<head>
    <link rel="stylesheet" href="{{ asset('assets/css/shared/style.css') }}">
    <style>

        body
        {
            background-color:#141019;
            background: radial-gradient(at 50% -20%, #908392, #0d060e) fixed;
            text-align: center;
        }

        .crying_emoj
        {
            font-size: 70px;
        }

        /*************swing************/
        @keyframes swing {
            0% { transform: rotate(10deg); }
            100% { transform: rotate(-10deg); }
        }


        /*************swing hair************/
        @keyframes swinghair {
            0% { transform: rotate(6deg); }
            100% { transform: rotate(-6deg); }
        }
    </style>
</head>
<body>
<a href="{{ route('material.index') }}" class="text-decoration-none">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-12 mt-5 mb-5 text-center justify-content-center text-white">
                <h1>The data you are trying to delete is in another tables (as a foreign keys).</h1>
                <h2>Make sure to delete other data before trying to launch this action.</h2>
                <p class="crying_emoj">
                    &#128528
                </p>
            </div>
        </div>
    </div>
</a>
</body>
</html>
