<?php

namespace App\Http\Controllers;

use App\Grade;
use App\Subject;
use Illuminate\Http\Request;

class GradeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function index()
    {
        return Grade::with(['subject', 'subject.course'])->paginate(10);
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
            'grade' => 'required|numeric',
            'subject_id' => 'required|integer',
        ]);

        $grade = new Grade();

        $grade->grade = $validatedData['grade'];
        $grade->subject()->associate(Subject::find($validatedData['subject_id']));

        $grade->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Grade  $grade
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Grade::with(['subject', 'subject.course'])->find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Grade  $grade
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Grade $grade)
    {
        $validatedData = $request->validate([
            'grade' => 'required|numeric',
            'subject_id' => 'required|integer',
        ]);

        $grade->grade = $validatedData['grade'];
        $grade->subject()->associate(Subject::find($validatedData['subject_id']));

        $grade->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Grade $grade
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Grade $grade)
    {
        $grade->delete();
    }
}
