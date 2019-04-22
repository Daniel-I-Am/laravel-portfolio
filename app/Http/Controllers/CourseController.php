<?php

namespace App\Http\Controllers;

use App\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Course[]|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function index()
    {
        return Course::with([
            'subjects' => function($query) {
                $query->orderBy('name', 'ASC');
            },
            'subjects.grades' => function($query) {
                $query->latest();
            },
        ])
            ->orderBy('term', 'ASC')
            ->orderBy('created_at', 'ASC')
            ->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Course
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:45',
            'term' => 'required|integer',
        ]);

        $course = new Course();

        $course->name = $validatedData['name'];
        $course->term = $validatedData['term'];

        $course->save();

        return Course::with(['subjects', 'subjects.grades'])->find($course->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Course  $course
     * @return \App\Course
     */
    public function show($id)
    {
        return Course::with(['subjects', 'subjects.grades'])->find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Course  $course
     * @return Course
     */
    public function update(Request $request, Course $course)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:45',
            'term' => 'required|integer',
        ]);

        $course->name = $validatedData['name'];
        $course->term = $validatedData['term'];

        $course->save();

        return Course::with(['subjects', 'subjects.grades'])->find($course->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Course $course
     * @return bool
     * @throws \Exception
     */
    public function destroy(Course $course)
    {
        $course->delete();
        return true;
    }
}
