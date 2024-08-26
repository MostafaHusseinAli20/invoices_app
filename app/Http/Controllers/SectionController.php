<?php

namespace App\Http\Controllers;

use App\Models\Section;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:الاقسام'] , ['only' => ['index']]);
        $this->middleware(['permission:اضافة قسم'], ['only' => ['create', 'store']]);
        $this->middleware(['permission:تعديل قسم'], ['only' => ['edit', 'update']]);
        $this->middleware(['permission:حذف قسم'], ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $show = Section::all();
        return view('sections.sections' , compact('show'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $vaidator = $request->validate([
            'section_name' => 'required|unique:sections',
        ],
        [
            'section_name.required' => 'يرجي ادخال اسم القسم',
            'section_name.unique' => 'هذا الأسم مسجل بالفعل'
        ]);
            Section::create([
                'section_name' => $request->section_name,
                'section_description' => $request->section_description, 
                'Created_by' => (Auth::User()->name),
            ]);
            session()->flash('Add' , 'تم أضافة القسم بنجاح');
            return redirect('/sections');
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Section $section)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Section $section)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $id = $request->id;

        $this->validate($request, [

            'section_name' => 'required|max:255|unique:sections,section_name,'.$id,
        ],[

            'section_name.required' => 'يرجي ادخال اسم القسم',
            'section_name.unique' => 'هذا الأسم مسجل بالفعل'

        ]);

        $sections = Section::find($id);
        $sections->update([
            'section_name' => $request->section_name,
            'section_description' => $request->section_description,
        ]);

        session()->flash('edit','تم تعديل القسم بنجاج');
        return redirect('/sections');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $id = $request->id;
        Section::find($id)->delete();
        session()->flash('delete' , 'تم حذف القسم بنجاح');
        return redirect('/sections');
    }
}