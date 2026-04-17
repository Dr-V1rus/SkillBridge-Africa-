@extends('layouts.landing')

@section('content')
    <div class="bg-red-500 text-white p-4">TEST 1</div>
    @include('pages.hero')
    <div class="bg-green-500 text-white p-4">TEST 2</div>
    @include('pages.impact')
    <div class="bg-blue-500 text-white p-4">TEST 3</div>
    @include('pages.smart-matching')
    <div class="bg-yellow-500 text-black p-4">TEST 4</div>
    @include('pages.demo-students')
    <div class="bg-purple-500 text-white p-4">TEST 5</div>
    @include('pages.features')
    @include('pages.how-it-works')
    @include('pages.cta')
    @include('pages.faq')
@endsection
