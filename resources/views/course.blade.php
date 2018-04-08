@extends('layouts.home')

@section('main')

    <h2>{{ $course->title }}</h2>

    <p>{{ $course->description }}</p>

    @foreach ($course->publishedLessons as $lesson)
        @if ($lesson->free_lesson)@endif {{ $loop->iteration }}.
        <a href="{{ route('lessons.show', [$lesson->course_id, $lesson->slug]) }}">{{ $lesson->title }}</a>
        <p>{{ $lesson->short_text }}</p>
        <hr />
    @endforeach

@endsection