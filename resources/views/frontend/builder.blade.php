@extends('frontend.layouts.treasury')

@section('title', $page->title)
@section('meta_description', $page->meta_description)
@section('meta_keywords', $page->meta_keywords)

@section('content')
    <!-- GrapesJS Builder Content -->
    @if($page->builder_css)
        <style>
            {!! $page->builder_css !!}
        </style>
    @endif

    <div class="builder-content">
        {!! $page->builder_html !!}
    </div>
@endsection

@push('styles')
<style>
    .builder-content {
        /* Ensure builder content displays properly */
        width: 100%;
    }

    .builder-content img {
        max-width: 100%;
        height: auto;
    }

    .builder-content .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 15px;
    }

    .builder-content .row {
        display: flex;
        flex-wrap: wrap;
        margin-right: -15px;
        margin-left: -15px;
    }

    .builder-content [class*="col-"] {
        padding-right: 15px;
        padding-left: 15px;
    }
</style>
@endpush
