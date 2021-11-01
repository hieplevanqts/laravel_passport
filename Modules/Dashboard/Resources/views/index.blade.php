@extends('dashboard::layouts.master')
@section("title", "Dashboard")
@section('content')

 @include('dashboard::dashboard.head_total')
@includeIf('dashboard::dashboard.chart')
@includeIf('dashboard::dashboard.bottom_total')
@includeIf('dashboard::dashboard.active_users')
@include('dashboard::dashboard.footer_total')
@endsection
