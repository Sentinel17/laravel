<?php

namespace App\Http\Controllers;

use App\Course;
use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Charge;
use Stripe\Customer;

class CoursesController extends Controller
{

    public function show($course_slug)
    {
        $course = Course::where('slug', $course_slug)->with('publishedLessons')->firstOrFail();
        $purchased_course = \Auth::check() && $course->students()->where('user_id', \Auth::id())->count() > 0;

        return view('course', compact('course', 'purchased_course'));
    }

    

}
