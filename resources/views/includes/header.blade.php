<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('pageTitle')|@yield('pageSubTitle')</title>
    @yield('meta')

    <!-- css -->
    <link rel="stylesheet" href="{{asset('front/css/main.css')}}" />
    <link rel="stylesheet" href="{{asset('front/css/single.css')}}" />
    <!-- Bootsrap 5.3 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous" />
    <!-- Bootstrap icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css" />
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&display=swap" rel="stylesheet">
    <!-- Font Awesome 6.0 -->
    <link rel="stylesheet" href="{{asset('front/fontawesome/css/all.min.css')}}" type="text/css"/>
    <!--begin::Page Scripts(used by this page)-->
    @stack('styles')
    <!--end::Page Scripts-->
</head>
<body>