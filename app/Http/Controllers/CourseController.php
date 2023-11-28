<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class CourseController extends Controller
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


    public function index()
    {
        $courses = Course::all();
        return view('courses.index', compact('courses'));
    }

    public function create()
    {
        return view('courses.create');
    }

    public function store(Request $request)
    {
        try {

            $rules = array(
                'title' => 'required|unique:courses|min:5|max:255',
                'description' => 'required',
            );
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return back()->withInput()->with(['status' => 'danger', 'message' => $validator->errors()->first()]);
            }

            $course = new Course;
            $course->title = $request->title;
            $course->description = $request->description;
            $course->save();

            return redirect('courses')->with(['status' => 'success', 'message' => 'Course created successfully']);
        } catch (\Exception $e) {
            return back()->with(['status' => 'success', 'message' => $e->getMessage()])->withInput();
        }
    }

    public function show($id)
    {
        $course = Course::findOrFail($id);
        return view('courses.show', compact('course'));
    }

    public function edit($id)
    {
        $course = Course::findOrFail($id);
        return response()->json($course);
    }

    public function update(Request $request)
    {
        try {

            $rules = array(
                'id' => 'required|exists:courses,id',
                'title' => 'required|unique:courses,title,' . $request->id . ',id|min:5|max:255',
                'description' => 'required',
            );
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return back()->withInput()->with(['status' => 'danger', 'message' => $validator->errors()->first()]);
            }
            $course = Course::findOrFail($request->id);
            $course->title = $request->title;
            $course->description = $request->description;
            $course->save();

            return back()->with(['status' => 'success', 'message' => 'Course updated successfully']);
        } catch (\Exception $e) {
            return back()->with(['status' => 'success', 'message' => $e->getMessage()])->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            $course = Course::findOrFail($id);
            $course->delete();

            return back()->with(['status' => 'success', 'message' => 'Course deleted successfully']);
        } catch (\Exception $e) {
            return back()->with(['status' => 'success', 'message' => $e->getMessage()])->withInput();
        }
    }
}
