@extends('layout.app')

@section('header')
    @include('layout.partails.header')
@endsection

@section('body')
    @include('homapage.partails.banner')
    @include('homapage.partails.services')
@endsection


 @section('footer')
    @include('layout.partails.footer')
@endsection 
