<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Evolution Covid-19 {{ $title ?? '' }}</title>

    @if(\App\Support\GitVersion::getSha1() !== null)
        <meta name="sha" content="{{ \App\Support\GitVersion::getSha1() }}">
    @endif

    <meta name="twitter:card" content="article">
    <meta property="og:type" content="article">

    <meta name="title" content="Evolution Covid-19">
    <meta name="twitter:title" content="Evolution Covid-19">
    <meta property="og:title" content="Evolution Covid-19">
    <meta itemprop="name" content="Evolution Covid-19">

    <meta name="description" content="Evolution Covid-19 par pays">
    <meta name="twitter:description" content="Evolution Covid-19 par pays">
    <meta property="og:description" content="Evolution Covid-19 par pays">
    <meta itemprop="description" content="Evolution Covid-19 par pays">

    <link rel="dns-prefetch" href="//www.gstatic.com">
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>
<body>
{{ $slot ?? '' }}
</body>
</html>
