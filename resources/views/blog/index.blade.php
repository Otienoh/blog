@extends('blog.layouts.app')

@section('title', sprintf('%s — %s', config('app.name'), 'Blog'))

@push('styles')
    @include('blog.partials.styles')
@endpush

@section('actions')
    <a href="{{ route('canvas.post.create') }}" class="btn btn-sm btn-outline-primary my-auto mx-3">
        New post
    </a>
@endsection

@section('body')
    @if(count($data['posts']) > 0 or isset($data['topic']))
        @include('blog.partials.navbar')

        <div class="container">
            <div class="row justify-content-md-center">
                <div class="col col-lg-8">
                    @foreach($data['posts'] as $post)
                        <p class="mt-5 mb-2 text-muted text-uppercase font-weight-bold">Published
                            on {{ \Carbon\Carbon::parse($post->published_at)->format('M d, Y') }}</p>
                        <h1 class="serif my-2 content-title"><a
                                    href="{{ route('blog.post', $post->slug) }}">{{ $post->title }}</a></h1>
                        <p class="content-body serif mb-2">{{ str_limit(strip_tags($post->body), 200) }}</p>

                        <div class="d-flex justify-content-between mb-5">
                            <p class="text-uppercase text-muted">{{ $post->readTime }}</p>
                            <a href="{{ route('blog.post', $post->slug) }}" class="text-muted text-uppercase">Read
                                full post</a>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="row mx-auto justify-content-center">
                {{ $data['posts']->links() }}
            </div>
        </div>
    @else
        <div style="height: 100vh">
            <div class="d-flex align-items-center justify-content-center h-100 position-relative">
                <div class="text-center">
                    <h1 class="display-4 welcome">Welcome to <span>C</span>anvas.</h1>
                    <p class="lead">A Laravel publishing platform.</p>
                    <a href="{{ route('canvas.index') }}" class="btn btn-primary">Dive in</a>
                </div>
            </div>
        </div>
    @endif
@endsection