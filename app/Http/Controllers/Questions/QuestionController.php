<?php

namespace OWS\Http\Controllers\Questions;

use OWS\{
    Category,
    Question
};
use OWS\Http\Controllers\Controller;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * List all questions.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $questions = Question::paginate(30);

        return view('questions.all')->with([
            'questions' => $questions
        ]);
    }

    /**
     * Show view for adding new questions.
     *
     * @return \Illuminate\Http\Response
     */
    public function new()
    {
        $categories = Category::all();
        return view('questions.new')
            ->with([
                'categories' => $categories
            ]);
    }

    /**
     * Store new question.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'category' => 'required|min:1',
            'question' => 'required|min:1',
            'difficulty' => 'required|between:1,3',
            'explanation' => 'required|min:1',
            'answer1' => 'required|min:1',
            'answer2' => 'required|min:1',
            'answer3' => 'required|min:1',
            'answer4' => 'required|min:1'
        ]);

        $question = $this->store_question($request);

        return redirect()
            ->route('question.all')
            ->with([
                'status' => 200,
                'message' => 'Question added'
            ]);
    }

    /**
     * Edit questions.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($question, Request $request)
    {
        $question = Question::findOrFail($question);
        $categories = Category::all();

        return view('questions.edit')
            ->with([
                'question' => $question,
                'categories' => $categories,
                'answer1' => $question->answer1,
                'answer2' => $question->answer2,
                'answer3' => $question->answer3,
                'answer4' => $question->answer4,
            ]);
    }

    /**
     * Update questions.
     *
     * @return \Illuminate\Http\Response
     */
    public function update($question, Request $request)
    {
        $this->validate($request, [
            'category' => 'required|min:1',
            'question' => 'required|min:1',
            'difficulty' => 'required|between:1,3',
            'explanation' => 'required|min:1',
            'answer1' => 'required|min:1',
            'answer2' => 'required|min:1',
            'answer3' => 'required|min:1',
            'answer4' => 'required|min:1',
        ]);

        $question = Question::findOrFail($question);

        $this->update_question($question, $request);

        return redirect()
            ->route('question.edit', ['question' => $question->id])
            ->with([
                'status' => 200,
                'message' => 'Question updated',
                'question' => $question,
                'answer1' => $request->answer1,
                'answer2' => $request->answer2,
                'answer3' => $request->answer3,
                'answer4' => $request->answer4,
            ]);
    }

    /**
     * Delete question.
     *
     * @return \Illuminate\Http\Response
     */
    public function delete($question, Request $request)
    {
        $question = Question::findOrFail($question);
        return view('questions.delete')
            ->with([
                'question' => $question
            ]);
    }

    /**
     * Delete question.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($question, Request $request)
    {
        Question::destroy($question);
        return redirect()
            ->route('question.all')
            ->with([
                'status' => 200,
                'message' => 'Question deleted'
            ]);
    }

    /**
     * Store new questions.
     *
     * @return OWS\Question
     */
    private function store_question(Request $request)
    {
        $category = Category::find($request->category);

        $question = $category
            ->questions()
            ->save(new Question([
                'question' => $request->question,
                'difficulty' => $request->difficulty,
                'explanation' => $request->explanation,
                'is_enabled' => $request->question_enabled == 1,
                'answer1' => $request->answer1,
                'answer2' => $request->answer2,
                'answer3' => $request->answer3,
                'answer4' => $request->answer4,
            ]));

        return $question;
    }

    /**
     * Update questions.
     *
     * @return OWS\Question
     */
    private function update_question($question, Request $request)
    {
        $question->category_id = $request->category;
        $question->question = $request->question;
        $question->difficulty = $request->difficulty;
        $question->explanation = $request->explanation;
        $question->is_enabled = $request->question_enabled == 1;
        $question->answer1 = $request->answer1;
        $question->answer2 = $request->answer2;
        $question->answer3 = $request->answer3;
        $question->answer4 = $request->answer4;
        $question->save();

        return $question;
    }
}
