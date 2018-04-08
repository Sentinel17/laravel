@extends('layouts.home')

@section('main')

    @if (!is_null($purchased_courses))

        <div class="row">

        @foreach($purchased_courses as $course)
            <div class="col-sm-5 col-lg-5 col-md-5">
                <div class="thumbnail">
                    <img src="adminlte\img\test.jpg" alt="">
                    <div class="caption">
                        <h4><a href="{{ route('courses.show', [$course->slug]) }}">{{ $course->title }}</a>
                        </h4>
                        <p>{{ $course->description }}</p>
                    </div>
                </div>
            </div>
        @endforeach
        </div>
        <hr />

    @endif

    <h3>Список предметов</h3>
    <div class="row">
    @foreach($courses as $course)
        <div class="col-sm-5 col-lg-5 col-md-5">
            <div class="thumbnail">
                <img src="adminlte\img\test.jpg" alt="">
                <div class="caption">
                    <h4><a href="{{ route('courses.show', [$course->slug]) }}">{{ $course->title }}</a>
                    </h4>
                    <p>{{ $course->description }}</p>
                </div>
            </div>
        </div>
    @endforeach
    </div>
	{{ $courses->links() }}
@endsection