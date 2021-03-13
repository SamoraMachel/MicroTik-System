@extends('layouts.adminApp')

@section('styles')
    @yield('customStyle')
@endsection

@section('sectionHeading')
    @yield('section-Head')
@endsection

@section('sectionHeadingInfo')
    @yield('section-Head-Info')
@endsection

@section('content')
    @yield('contentMain')
@endsection

