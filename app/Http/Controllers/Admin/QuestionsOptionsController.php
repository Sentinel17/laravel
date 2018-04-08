<?php

namespace App\Http\Controllers\Admin;

use App\QuestionsOption;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreQuestionsOptionsRequest;
use App\Http\Requests\Admin\UpdateQuestionsOptionsRequest;

class QuestionsOptionsController extends Controller
{
    public function index()
    {
        if (! Gate::allows('questions_option_access')) {
            return abort(401);
        }


        if (request('show_deleted') == 1) {
            if (! Gate::allows('questions_option_delete')) {
                return abort(401);
            }
            $questions_options = QuestionsOption::onlyTrashed()->get();
        } else {
            $questions_options = QuestionsOption::all();
        }

        return view('admin.questions_options.index', compact('questions_options'));
    }

    public function create()
    {
        if (! Gate::allows('questions_option_create')) {
            return abort(401);
        }
        $questions = \App\Question::get()->pluck('question', 'id')->prepend('Please select', '');

        return view('admin.questions_options.create', compact('questions'));
    }

    public function store(StoreQuestionsOptionsRequest $request)
    {
        if (! Gate::allows('questions_option_create')) {
            return abort(401);
        }
        $questions_option = QuestionsOption::create($request->all());



        return redirect()->route('admin.questions_options.index');
    }

    public function edit($id)
    {
        if (! Gate::allows('questions_option_edit')) {
            return abort(401);
        }
        $questions = \App\Question::get()->pluck('question', 'id')->prepend('Please select', '');

        $questions_option = QuestionsOption::findOrFail($id);

        return view('admin.questions_options.edit', compact('questions_option', 'questions'));
    }

    public function update(UpdateQuestionsOptionsRequest $request, $id)
    {
        if (! Gate::allows('questions_option_edit')) {
            return abort(401);
        }
        $questions_option = QuestionsOption::findOrFail($id);
        $questions_option->update($request->all());



        return redirect()->route('admin.questions_options.index');
    }

    public function show($id)
    {
        if (! Gate::allows('questions_option_view')) {
            return abort(401);
        }
        $questions_option = QuestionsOption::findOrFail($id);

        return view('admin.questions_options.show', compact('questions_option'));
    }

    public function destroy($id)
    {
        if (! Gate::allows('questions_option_delete')) {
            return abort(401);
        }
        $questions_option = QuestionsOption::findOrFail($id);
        $questions_option->delete();

        return redirect()->route('admin.questions_options.index');
    }

    public function massDestroy(Request $request)
    {
        if (! Gate::allows('questions_option_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = QuestionsOption::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }

    public function restore($id)
    {
        if (! Gate::allows('questions_option_delete')) {
            return abort(401);
        }
        $questions_option = QuestionsOption::onlyTrashed()->findOrFail($id);
        $questions_option->restore();

        return redirect()->route('admin.questions_options.index');
    }

    public function perma_del($id)
    {
        if (! Gate::allows('questions_option_delete')) {
            return abort(401);
        }
        $questions_option = QuestionsOption::onlyTrashed()->findOrFail($id);
        $questions_option->forceDelete();

        return redirect()->route('admin.questions_options.index');
    }
}
