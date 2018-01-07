<?php

namespace OWS\Http\Controllers\Questions;

use OWS\{
    Answer,
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
            'answer4' => 'required|min:1',
            'correct_answer' => 'required|min:1'
        ]);

        $question = $this->store_question($request);
        $this->store_answers($request, $question);

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

        $answers = $question->answers;
        return view('questions.edit')
            ->with([
                'question' => $question,
                'categories' => $categories,
                'answer1' =>$answers[0],
                'answer2' =>$answers[1],
                'answer3' =>$answers[2],
                'answer4' =>$answers[3],
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
            'question' => 'required|min:1',
            'difficulty' => 'required|between:1,3',
            'explanation' => 'required|min:1',
            'answer1' => 'required|min:1',
            'answer2' => 'required|min:1',
            'answer3' => 'required|min:1',
            'answer4' => 'required|min:1',
            'correct_answer' => 'required|min:1'
        ]);

        $question = Question::findOrFail($question);

        // update question
        $question->question = $request->question;
        $question->difficulty = $request->difficulty;
        $question->explanation = $request->explanation;
        $question->is_enabled = $request->question_enabled == 1;
        $question->save();

        // answers
        $question->answers->each(function ($answer, $key) use ($request) {
            $answer->answer = $request->{'answer' . ($key + 1) };
            $answer->is_correct = $request->correct_answer == $key + 1;
            $answer->save();
        });
        $answers = $question->answer;

        return redirect()
            ->route('question.edit', ['question' => $question->id])
            ->with([
                'status' => 200,
                'message' => 'Question updated',
                'question' => $question,
                'answer1' =>$answers[0],
                'answer2' =>$answers[1],
                'answer3' =>$answers[2],
                'answer4' =>$answers[3],
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
                'is_enabled' => $request->question_enabled == 1
            ]));

        return $question;
    }

    /**
     * Store new answers.
     *
     * @return void
     */
    private function store_answers(Request $request, $question)
    {
        $question->answers()->saveMany([
            new Answer([
                'answer' => $request->answer1,
                'is_correct' => $request->correct_answer == 1
            ]),
            new Answer([
                'answer' => $request->answer2,
                'is_correct' => $request->correct_answer == 2
            ]),
            new Answer([
                'answer' => $request->answer3,
                'is_correct' => $request->correct_answer == 3
            ]),
            new Answer([
                'answer' => $request->answer4,
                'is_correct' => $request->correct_answer == 4
            ]),
        ]);
    }
}
