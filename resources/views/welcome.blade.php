@extends('layouts.landing')

@section('content')
    @include('pages.hero')
    @include('pages.impact')
    @include('pages.smart-matching')
    @include('pages.ai-matching')
    @include('pages.activity-feed')
    {{-- @include('internships.index', ['internships' => $internships]) --}}
    @include('pages.demo-students')
    @include('pages.features')
    @include('pages.how-it-works')
    @include('pages.cta')
    @include('pages.faq')
@endsection
