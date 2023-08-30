<?php

namespace App\Http\Controllers;

use App\Models\Material;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $group_id = $request->route('group_id');
        $matGroup = Material::where('group_id', $group_id)->get();
        return view('admin.viewMat',compact('matGroup','group_id') );

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        
        $group_id = $request->route('group_id');
        $matGroup = Material::where('group_id', $group_id)->get();
        return view('admin.createMat',compact('matGroup','group_id') );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);
    
        $group_id = $request->route('group_id');
        $name = $request->input('name');
        $link = $request->input('link');
        $file = $request->file('file');
    
        if ($file && $file->isValid()) {
            $originalFileName = $file->getClientOriginalName();
            $filePath = $file->store('public');
    
            $result = Material::create([
                'name' => $name,
                'group_id' => $group_id,
                'file' => $originalFileName,
                'filePath'=>$filePath,
                'link' => null,
            ]);
    
            return redirect()->route('mate.index', $group_id)
                ->with('success', 'Material added successfully');
        } elseif (!empty($link)) {
            $result = Material::create([
                'name' => $name,
                'group_id' => $group_id,
                'file' => null,
                'filePath'=>null,
                'link' => $link,
            ]);
    
            return redirect()->route('mate.index', $group_id)
                ->with('success', 'Material added successfully');
        } else {
            return redirect()->back()
                ->with('error', '.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Material $material)
    {
        $publicFilePath = Storage::url($material->filePath);
        return view('admin.showfile',compact('material' , 'publicFilePath'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Material $material)
    {
        
        return view('admin.editMate',compact('material'));

        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Material $material)
{
    $request->validate([
        'name' => 'required',
    ]);

    $group_id = $material->group_id;
    $name = $request->input('name');
    $link = $request->input('link');
    $file = $request->file('file');

    if (!empty($link)) {
        if (!empty($material->filePath)) {
            Storage::delete($material->filePath);
        }

        $file = null;
        $originalFileName = null;
        $filePath = null;
    } else {
        if ($file && $file->isValid()) {
            if (!empty($material->filePath)) {
                Storage::delete($material->filePath);
            }

            $originalFileName = $file->getClientOriginalName();
            $filePath = $file->store('public');
        } else {
            $originalFileName = $material->file;
            $filePath = $material->filePath;
        }
    }

    $material->update([
        'name' => $name,
        'file' => $originalFileName,
        'filePath' => $filePath,
        'link' => $link,
    ]);

    return redirect()->route('mate.index', $group_id)
        ->with('success', 'Material updated successfully');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Material $material)
    {
        if ( Material::exists($material)) {
            if ($material->file && Storage::exists($material->filePath)) {
                Storage::delete($material->filePath);
            }
            $material->delete();
    
            return redirect()->back()
                ->with('success', 'Material Deleted successfully');
        } else {
            return response('Material Not Found', 404);
        }
    }
}


    

