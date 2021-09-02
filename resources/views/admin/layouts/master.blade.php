<html>

<head>
    <title>@yield('title') - G5R BLOG</title>
    <base href=" {{url('/admin')}}" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" value="{{ csrf_token() }}">
    <link href="https://fontawesome.com/v4.7/assets/font-awesome/css/font-awesome.css" rel=stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v6.0.0-beta1/css/all.css" />
    <link rel="stylesheet" href="{{asset('/css/custom.css')}}" />
</head>

<body class="background-gray">
    @include('admin.particales._header')

    <div class="container background-white" id="app">
        @include('admin.particales._messages')
        @yield('content')
       
    </div>
    @include('admin.particales._footer')
</body>

</html>