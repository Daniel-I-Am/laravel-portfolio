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
     * @return \Illuminate\Http\Response
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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function show(Subject $subject)
    {
        return $subject;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subject $subject)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:45',
            'ec_value' => 'required|numeric',
            'course_id' => 'required|integer',
        ]);

        $subject->name = $validatedData['name'];
        $subject->ec_value = $validatedData['name'];
        $subject->course()->associate(Course::find($validatedData['course_id']));

        $subject->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Subject $subject
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Subject $subject)
    {
        $subject->delete();
    }
}
