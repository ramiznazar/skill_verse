<?php

namespace App\Http\Controllers\Admin\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::all();
        return view('admin.pages.website.project.all-project',compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.website.project.add-project');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'image'    => 'nullable|image',
            'title'    => 'nullable|string|max:255',
            'link' => 'nullable|string|max:100',
            'description' => 'nullable|string|max:255',
        ]);
        $path = null;
        if($request->hasFile('image')){
            $image = $request->file('image');
            $imageName =  time() . '.' . $image->getClientOriginalName();
            $path = 'assets/admin/images/code/project/' . $imageName ; //Define path for store
            //$image = $request->file('image)
            $image->move(public_path('assets/admin/images/code/project/'),$imageName);
        }
        Project::create([
            'image' => $path,
            'title' => $request->title,
            'link' => $request->link,
            'description' => $request->description,
        ]);
        return redirect()->route('project.index')->with('store','Project Added Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $project = Project::find($id);
        return view('admin.pages.website.project.update-project',compact('project'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'image'    => 'nullable|image',
            'title'    => 'nullable|string|max:255',
            'link' => 'nullable|string|max:100',
            'description' => 'nullable|string|max:255',
        ]);
        $project = Project::find($id);
        //Delete old Image if user insert new one
        if($request->hasFile('image')){
            if($project->image){
                $oldImagePath = public_path($project->image);
                if(file_exists($oldImagePath)){
                    unlink($oldImagePath);
                }
            }
            //Store new Image
            $image = $request->file('image');
            $imageName =   time() . '.' . $image->getClientOriginalName();
            $path = 'assets/admin/images/code/project/' . $imageName;
            $image->move(public_path('assets/admin/images/code/project'),$imageName);
            
            //store in database
            $project->image = $path;
        }
        $project->title = $request->title;
        $project->link = $request->link;
        $project->description = $request->description;
        $project->save();
        return redirect()->route('project.index')->with('update','Project Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $project = Project::find($id); 
  
        $imagePath = public_path( $project->image);
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }
    
        $project->delete();
    return redirect()->route('project.index')->with('delete', 'Project deleted successfully!');
    }
}
