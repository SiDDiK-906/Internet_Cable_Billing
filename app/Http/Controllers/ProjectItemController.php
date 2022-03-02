<?php

namespace App\Http\Controllers;

use App\Models\ProjectItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ProjectItemController extends Controller
{
    public function __construct()
    {
       $this->middleware('auth');
       $this->middleware('checkrole');
    }



    /*
    |--------------------------------------------------------------------------
    | INDEX METHOD for Reading Project Item
    |--------------------------------------------------------------------------
    */
    public function index()
    {
        $projectItems = ProjectItem::all();
        return view('backend.project-items.index', compact('projectItems'));
    }



    /*
    |--------------------------------------------------------------------------
    | CREATE METHOD for Create ProjectItem
    |--------------------------------------------------------------------------
    */
    public function create()
    {
        return view('backend.project-items.create');
    }




    /*
    |--------------------------------------------------------------------------
    | STORE METHOD for Store Project Item
    |--------------------------------------------------------------------------
    */
    public function store(Request $request)
    {
        $projectItem = ProjectItem::create([
            'project_name'              =>  $request->project_name,
            'project_description'       =>  $request->project_description,
            'project_type'              =>  $request->project_type,
            'company_name'              =>  $request->company_name,
            'created_by'                =>  $request->created_by,
            'updated_by'                =>  $request->updated_by,

        ]);

        Session::flash('success', 'Project Item Added Successfully!!');
        return redirect()->route('all-project-item');
    }




    /*
    |--------------------------------------------------------------------------
    | SHOW METHOD
    |--------------------------------------------------------------------------
    */
    public function show($id)
    {
        //
    }




    /*
    |--------------------------------------------------------------------------
    | EDIT METHOD for Edit Project Item
    |--------------------------------------------------------------------------
    */
    public function edit($id)
    {
        $projectItem = ProjectItem::findOrfail($id);
        return view('backend.project-items.edit', compact('projectItem'));
    }




    /*
    |--------------------------------------------------------------------------
    | UPDATE METHOD for Update Project tem
    |--------------------------------------------------------------------------
    */
    public function update(Request $request, $id)
    {
        $projectItem = ProjectItem::findOrfail($id);


        $projectItem->update([
            'project_name'              =>  $request->project_name,
            'project_description'       =>  $request->project_description,
            'project_type'              =>  $request->project_type,
            'company_name'              =>  $request->company_name,
            'created_by'                =>  $request->created_by,
            'updated_by'                =>  $request->updated_by,

        ]);


        Session::flash('success', 'Project Item Updated Successfully!!');
        return redirect()->route('all-project-item');
    }




    /*
    |--------------------------------------------------------------------------
    | DESTROY METHOD for Destroy Project Item
    |--------------------------------------------------------------------------
    */
    public function destroy($id)
    {
        $projectItem =  ProjectItem::findOrfail($id);
        $projectItem->destroy($id);

        Session::flash('error', 'Project Item Parmanently Deleted!!');
        return redirect()->route('all-project-item');
    }





    /*
    |--------------------------------------------------------------------------
    | DEACTIVE METHOD for Deactive Project Item
    |--------------------------------------------------------------------------
    */
    public function deactive($id){
        $deactive = ProjectItem::where('project_status',1)->where('id',$id)->update(['project_status' => 0,]);
        if($deactive){
            Session::flash('info', 'Project Item Status  Deactivated!');
          return redirect(route('all-project-item'));
        }
    }




    /*
    |--------------------------------------------------------------------------
    | ACTIVE METHOD for Active Project Item
    |--------------------------------------------------------------------------
    */
    public function active($id){
        $active = ProjectItem::where('project_status',0)->where('id',$id)->update(['project_status' => 1,]);
        if($active){
            Session::flash('info', 'Project Item Status Actived!');
          return redirect(route('all-project-item'));
        }
     }
}
