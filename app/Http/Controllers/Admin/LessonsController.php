<?php

namespace App\Http\Controllers\Admin;

use App\Course;
use App\Lesson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreLessonsRequest;
use App\Http\Requests\Admin\UpdateLessonsRequest;
use App\Http\Controllers\Traits\FileUploadTrait;

class LessonsController extends Controller
{
    use FileUploadTrait;

    public function index(Request $request)
    {
        if (! Gate::allows('lesson_access')) {
            return abort(401);
        }

        $lessons = Lesson::whereIn('course_id', Course::ofTeacher()->pluck('id'));
        if ($request->input('course_id')) {
            $lessons = $lessons->where('course_id', $request->input('course_id'));
        }
        if (request('show_deleted') == 1) {
            if (! Gate::allows('lesson_delete')) {
                return abort(401);
            }
            $lessons = $lessons->onlyTrashed()->get();
        } else {
            $lessons = $lessons->get();
        }

        return view('admin.lessons.index', compact('lessons'));
    }

    public function create()
    {
        if (! Gate::allows('lesson_create')) {
            return abort(401);
        }
        $courses = \App\Course::ofTeacher()->get()->pluck('title', 'id')->prepend('Please select', '');

        return view('admin.lessons.create', compact('courses'));
    }

    public function store(StoreLessonsRequest $request)
    {
        if (! Gate::allows('lesson_create')) {
            return abort(401);
        }
        $request = $this->saveFiles($request);
        $lesson = Lesson::create($request->all()
            + ['position' => Lesson::where('course_id', $request->course_id)->max('position') + 1]);

        foreach ($request->input('downloadable_files_id', []) as $index => $id) {
            $model          = config('laravel-medialibrary.media_model');
            $file           = $model::find($id);
            $file->model_id = $lesson->id;
            $file->save();
        }

        return redirect()->route('admin.lessons.index', ['course_id' => $request->course_id]);
    }

    public function edit($id)
    {
        if (! Gate::allows('lesson_edit')) {
            return abort(401);
        }
        $courses = \App\Course::ofTeacher()->get()->pluck('title', 'id')->prepend('Please select', '');

        $lesson = Lesson::findOrFail($id);

        return view('admin.lessons.edit', compact('lesson', 'courses'));
    }

    public function update(UpdateLessonsRequest $request, $id)
    {
        if (! Gate::allows('lesson_edit')) {
            return abort(401);
        }
        $request = $this->saveFiles($request);
        $lesson = Lesson::findOrFail($id);
        $lesson->update($request->all());


        $media = [];
        foreach ($request->input('downloadable_files_id', []) as $index => $id) {
            $model          = config('laravel-medialibrary.media_model');
            $file           = $model::find($id);
            $file->model_id = $lesson->id;
            $file->save();
            $media[] = $file;
        }
        $lesson->updateMedia($media, 'downloadable_files');

        return redirect()->route('admin.lessons.index', ['course_id' => $request->course_id]);
    }

    public function show($id)
    {
        if (! Gate::allows('lesson_view')) {
            return abort(401);
        }
        $courses = \App\Course::get()->pluck('title', 'id')->prepend('Please select', '');$tests = \App\Test::where('lesson_id', $id)->get();

        $lesson = Lesson::findOrFail($id);

        return view('admin.lessons.show', compact('lesson', 'tests'));
    }

    public function destroy($id)
    {
        if (! Gate::allows('lesson_delete')) {
            return abort(401);
        }
        $lesson = Lesson::findOrFail($id);
        $lesson->delete();

        return redirect()->route('admin.lessons.index');
    }

    public function massDestroy(Request $request)
    {
        if (! Gate::allows('lesson_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Lesson::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }

    public function restore($id)
    {
        if (! Gate::allows('lesson_delete')) {
            return abort(401);
        }
        $lesson = Lesson::onlyTrashed()->findOrFail($id);
        $lesson->restore();

        return redirect()->route('admin.lessons.index');
    }

    public function perma_del($id)
    {
        if (! Gate::allows('lesson_delete')) {
            return abort(401);
        }
        $lesson = Lesson::onlyTrashed()->findOrFail($id);
        $lesson->forceDelete();

        return redirect()->route('admin.lessons.index');
    }
}
