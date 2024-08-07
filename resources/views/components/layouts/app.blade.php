@extends('frontend.layouts.default')
    <!-- seitenabhengig css -->
    @push('specific-css')
        <link href="{{ asset('frontend/css/blog.css') }}" rel="stylesheet">
    @endpush

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>{{ $title ?? 'Page Title' }}</title>
    </head>
    <body>
        @include('frontend.includes.header-in-clearfix')





        {{ $slot }}
    </body>


    @include('frontend.includes.page-snipped.broker-seller')


</html>


<style>
    .welcome-message {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .greeting {
            color: #ff7f50; /* Hauptfarbe von Appetit */
            font-size: 2em;
            margin-bottom: 10px;
        }

        .welcome-text {
            color: #343a40; /* Sekundärfarbe von Appetit */
            font-size: 1.2em;
            line-height: 1.5em;
        }

        .highlight {
            color: #ff7f50; /* Hauptfarbe von Appetit */
            font-weight: bold;
        }

        .thumb_dashboard {
            display: inline-block;
            vertical-align: middle;
            margin-left: 10px;
        }

        .avatar_dashboard {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            object-fit: cover;
        }

        h1 {
            display: inline-block;
            vertical-align: middle;
        }
    </style>
