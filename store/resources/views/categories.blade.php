@extends('layouts.master')

@section('title', 'Категории')

@section('content')
    @foreach($categories as $category)
        <div class="panel">
            <a href="{{ route('category', $category->slug) }}">
                <img src="{{ \Illuminate\Support\Facades\Storage::url($category->image) }}" style="width: 300px; height: 300px;">
                <h2>{{ $category->__('name') }}</h2>
            </a>
            <p>
                {{ $category->__('description') }}
            </p>
        </div>
    @endforeach
@endsection
