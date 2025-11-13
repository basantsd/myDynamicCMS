@extends('frontend.layouts.treasury')

@section('title', $page->title . ' - ' . ($settings['site_name'] ?? 'Accountant General\'s Department'))
@section('meta_description', $page->meta_description ?: ($settings['site_description'] ?? ''))
@section('meta_keywords', $page->meta_keywords ?: ($settings['site_keywords'] ?? ''))

@section('content')
@if($page->use_builder && $page->builder_html)
    <!-- Visual Builder Content -->
    <div class="builder-content">
        {!! $page->builder_html !!}
    </div>

    @if($page->builder_css)
    @push('styles')
    <style>
        {!! $page->builder_css !!}
    </style>
    @endpush
    @endif
@else
    <!-- Section-Based Content -->
    @foreach($sections as $section)
        @if($section->is_active)
            <div class="page-section" data-section-type="{{ $section->section_type }}">
                @if(isset($section->content['html']))
                    {!! $section->content['html'] !!}
                @else
                    @include('frontend.sections.' . $section->section_type, ['content' => $section->content])
                @endif
            </div>
        @endif
    @endforeach
@endif
@endsection
