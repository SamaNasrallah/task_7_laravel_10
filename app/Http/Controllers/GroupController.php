<?php

namespace App\Http\Controllers;
use App\Models\Course;

use App\Models\Group;
use App\Models\Material;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $groups = Group::all();
        $course_id = $request->route('course_id');
        $matGroup = Group::where('course_id', $course_id)->get();
         
        return view('admin.createGroup', compact('groups', 'matGroup', 'course_id'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
{
    $course_id = $request->route('course_id');
    $groups = Group::where('course_id', $course_id)->get();

    return view('admin.createGroup', compact('groups', 'course_id'));
}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);
        $course_id = $request->route('course_id');
        Group::create([
            "name" => $request->name,
            "course_id" => $course_id,
        ]);
        return redirect()->route('groups.create', $course_id)
        ->with('success', 'Group added successfully');

    }

    /**
     * Display the specified resource.
     */
    public function show(Group $group )
    {
        $group_id = $request->route('group_id');
        $matGroup = Material::where('group_id', $group_id)->get();

        return view('admin.showGroup', compact('matGroup','group_id'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Group $group)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
        ]);
        $group = Group::findOrFail($id);
        $course_id = $request->route('course_id');
        $group->name = $request->input('name');
        $group->save();
      
        return redirect()->back()
        ->with('success','Group Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Group $group)
    {
        if ($group->materials()->exists()) {
            foreach ($group->materials as $mate) {
                if (!is_null($mate->filePath)) {
                    Storage::delete($mate->filePath);
                    $mate->delete();

                }    
            }
        }
    
        $group->delete();
    
        return redirect()->back()
        ->with('success', 'Group and associated materials deleted successfully');
    }
    }
