@extends('blog.layouts.app')

@section('title', $data['post']->title)

@push('styles')
    @include('blog.partials.styles')
@endpush

@push('meta')
    <meta name="description" content="{{ $data['meta']['meta_description'] }}">
    <meta name="og:title" content="{{ $data['meta']['og_description'] }}">
    <meta name="og:description" content="{{ $data['meta']['og_description'] }}">
    <meta name="twitter:card" content="summary">
    <meta name="twitter:title" content="{{ $data['meta']['twitter_description'] }}">
    <meta name="twitter:description" content="{{ $data['meta']['twitter_description'] }}">
    @isset($data['post']->featured_image)
        <meta name="og:image" content="{{ url($data['post']->featured_image) }}">
        <meta name="twitter:image" content="{{ url($data['post']->featured_image) }}">
    @endisset
@endpush

@section('actions')
    <div class="dropdown">
        <a href="#" id="navbarDropdown" class="nav-link px-3 text-secondary" role="button" data-toggle="dropdown"
           aria-haspopup="true" aria-expanded="false" v-pre>
            <i class="fas fa-cog fa-fw"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
            <a href="{{ route('canvas.post.edit', $data['post']->id) }}"
               class="dropdown-item sans-serif">Edit post</a>
            <a href="{{ route('canvas.stats.show', $data['post']->id) }}"
               class="dropdown-item sans-serif">View stats</a>
        </div>
    </div>
@endsection

@section('body')
    @include('blog.partials.navbar')

    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col col-lg-8">
                <h1 class="content-title serif pt-5 @unless($data['post']->summary) mb-4 @endif">{{ $data['post']->title }}</h1>
                @if($data['post']->summary)
                    <h4 class="text-muted mb-4">{{ $data['post']->summary }}</h4>
                @endif

                <div class="media py-1">
                    <img src="{{ sprintf('%s%s%s', 'https://secure.gravatar.com/avatar/', md5(strtolower(trim($data['author']->email))), '?s=200') }}"
                         class="mr-3 rounded-circle"
                         style="width: 50px"
                         alt="{{ $data['author']->name }}">
                    <div class="media-body">
                        <p class="mt-0 mb-1 font-weight-bold">{{ $data['author']->name }}</p>
                        <span class="text-muted">{{ \Carbon\Carbon::parse($data['post']->published_at)->format('M d, Y') }} — {{ $data['post']->readTime }}</span>
                    </div>
                </div>

                @isset($data['post']->featured_image)
                    <img src="{{ $data['post']->featured_image }}" class="w-100 pt-4"
                         @isset($data['post']->featured_image_caption) alt="{{ $data['post']->featured_image_caption }}"
                         title="{{ $data['post']->featured_image_caption }}" @endisset>
                    @isset($data['post']->featured_image_caption)
                        <p class="text-muted text-center pt-3">{!! $data['post']->featured_image_caption !!}</p>
                    @endisset
                @endisset

                <div class="content-body serif mt-4 pb-3">{!! $data['post']->body !!}</div>

                @if($data['post']->tags->count() > 0)
                    <h5>
                        @foreach($data['post']->tags as $tag)
                            <span><a href="{{ route('blog.tag', $tag->slug) }}"
                                     class="badge badge-light p-2">{{ $tag->name }}</a></span>
                        @endforeach
                    </h5>
                @endif
            </div>
        </div>
    </div>

    <div class="read-more mt-5 container-fluid">
        <div class="row">
            @if($data['next'])
                <div class="col-lg bg-light text-center px-lg-5 py-5"
                     @if(!empty($data['next']->featured_image)) style="background: linear-gradient(rgba(0, 0, 0, 0.8),rgba(0, 0, 0, 0.8)),url({{ $data['next']->featured_image }}); background-size: cover" @endif>
                    <a href="{{ route('blog.post', $data['next']->slug) }}"
                       class="btn btn-sm @if(!empty($data['next']->featured_image)) btn-outline-light @else btn-outline-secondary @endif text-uppercase font-weight-bold mt-3">Read
                        this next</a>
                    <h2 class="font-weight-bold serif my-3 @if(!empty($data['next']->featured_image)) text-white @endif">
                        <a href="{{ route('blog.post', $data['next']->slug) }}"
                           class="title">{{ $data['next']->title }}</a></h2>
                    <p class="serif body @if(!empty($data['next']->featured_image)) text-white-50 @else text-muted @endif">{{ str_limit(strip_tags($data['next']->body), 140) }}</p>
                </div>
            @endif
            @if($data['random'])
                <div class="col-lg bg-light text-center px-lg-5 py-5"
                     @if(!empty($data['random']->featured_image)) style="background: linear-gradient(rgba(0, 0, 0, 0.8),rgba(0, 0, 0, 0.8)),url({{ $data['random']->featured_image }}); background-size: cover" @endif>
                    <a href="{{ route('blog.post', $data['random']->slug) }}"
                       class="btn btn-sm @if(!empty($data['random']->featured_image)) btn-outline-light @else btn-outline-secondary @endif text-uppercase font-weight-bold mt-3">You
                        might enjoy</a>
                    <h2 class="font-weight-bold serif my-3 @if(!empty($data['random']->featured_image)) text-white @endif">
                        <a href="{{ route('blog.post', $data['random']->slug) }}"
                           class="title">{{ $data['random']->title }}</a></h2>
                    <p class="serif body @if(!empty($data['random']->featured_image)) text-white-50 @else text-muted @endif">{{ str_limit(strip_tags($data['random']->body), 140) }}</p>
                </div>
            @endif
        </div>
    </div>
@endsection