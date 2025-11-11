@extends('layouts.frontend')

@section('title', $page->title)
@section('meta_description', $page->meta_description)
@section('meta_keywords', $page->meta_keywords)

@section('content')
    @if($sections && $sections->count() > 0)
        @foreach($sections as $section)
            @if($section->is_active)
                @include("sections.{$section->section_type}", ['content' => $section->content])
            @endif
        @endforeach
    @else
        {{-- Default content if no sections are added --}}
        <section class="space">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-10">
                        <div class="title-area text-center">
                            <h2 class="sec-title">{{ $page->title }}</h2>
                        </div>
                        <div class="mt-4">
                            <p class="text-muted text-center">
                                This page is ready for content. Add sections from the admin panel to build your page.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif
@endsection
