<?php

namespace App\Http\Controllers;

use App\Course;
use App\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function index()
    {
        return Subject::with(['course', 'grades'])->paginate(10);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Subject
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:45',
            'ec_value' => 'required|numeric',
            'course_id' => 'required|integer',
        ]);

        $subject = new Subject();

        $subject->name = $validatedData['name'];
        $subject->ec_value = $validatedData['name'];
        $subject->course()->associate(Course::find($validatedData['course_id']));

        $subject->save();

        return Subject::with(['course', 'grades'])->find($subject->id);
    }

    /**
     * Display the specified resource.
     *
     * @param $id
     * @return Subject
     */
    public function show($id)
    {
        return Subject::with(['course', 'grades'])->find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Subject  $subject
     * @return Subject
     */
    public function update(Request $request, Subject $subject)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:45',
            'ec_value' => 'required|numeric',
            'course_id' => 'required|integer',
        ]);

        $subject->name = $validatedData['name'];
        $subject->ec_value = $validatedData['ec_value'];
        $subject->course()->associate(Course::find($validatedData['course_id']));

        $subject->save();

        return Subject::with(['course', 'grades'])->find($subject->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Subject $subject
     * @return bool
     * @throws \Exception
     */
    public function destroy(Subject $subject)
    {
        $subject->delete();
        return true;
    }
}
