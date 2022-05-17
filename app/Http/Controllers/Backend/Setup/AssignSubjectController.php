<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use App\Models\AssignSubject;
use App\Models\SchoolSubject;
use App\Models\StudentClass;
use Illuminate\Http\Request;

class AssignSubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['allData'] = AssignSubject::select('class_id')->groupBy('class_id')->get();
        return view('backend.setup.assign_subject.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['subjects'] = SchoolSubject::all();
        $data['classes'] = StudentClass::all();
        return view('backend.setup.assign_subject.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $subjectCount = count($request->subject_id);
        if ($subjectCount != null) {
            for ($i = 0; $i < $subjectCount; $i++) {
                $assign_subject = new AssignSubject();
                $assign_subject->class_id = $request->class_id;
                $assign_subject->subject_id = $request->subject_id[$i];
                $assign_subject->full_mark = $request->full_mark[$i];
                $assign_subject->pass_mark = $request->pass_mark[$i];
                $assign_subject->subjective_mark = $request->subjective_mark[$i];
                $assign_subject->save();

            } // End For Loop
        } // End If Condition

        $notification = array(
            'message' => 'Subject Assign Inserted Successfully',
            'alert-type' => 'success',
        );

        return redirect()->route('assign.subject.view')->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['detailsData'] = AssignSubject::where('class_id', $id)->orderBy('subject_id', 'asc')->get();
        return view('backend.setup.assign_subject.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['editData'] = AssignSubject::where('class_id', $id)->orderBy('subject_id', 'asc')->get();
        // dd($data['editData']->toArray());
        $data['subjects'] = SchoolSubject::all();
        $data['classes'] = StudentClass::all();
        return view('backend.setup.assign_subject.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if ($request->subject_id == null) {

            $notification = array(
                'message' => 'Sorry You do not select any Subject',
                'alert-type' => 'error',
            );

            return redirect()->route('assign.subject.edit', $id)->with($notification);

        } else {

            $countClass = count($request->subject_id);
            AssignSubject::where('class_id', $id)->delete();
            for ($i = 0; $i < $countClass; $i++) {
                $assign_subject = new AssignSubject();
                $assign_subject->class_id = $request->class_id;
                $assign_subject->subject_id = $request->subject_id[$i];
                $assign_subject->full_mark = $request->full_mark[$i];
                $assign_subject->pass_mark = $request->pass_mark[$i];
                $assign_subject->subjective_mark = $request->subjective_mark[$i];
                $assign_subject->save();

            } // End For Loop

        } // end Else

        $notification = array(
            'message' => 'Data Updated Successfully',
            'alert-type' => 'success',
        );

        return redirect()->route('assign.subject.view')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        AssignSubject::where('class_id', $id)->delete();
        $notification = array(
    		'message' => 'Subject Deleted Successfully',
    		'alert-type' => 'info'
    	);

        return redirect()->route('assign.subject.view')->with($notification);
    }
}
