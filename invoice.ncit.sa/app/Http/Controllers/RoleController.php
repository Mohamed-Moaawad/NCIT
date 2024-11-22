<?php

namespace App\Http\Controllers;


use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;
use DataTables;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
         $this->middleware('permission:role-list|role-create|role-edit|role-delete', ['only' => ['index','store']]);
         $this->middleware('permission:role-create', ['only' => ['create','store']]);
         $this->middleware('permission:role-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:role-delete', ['only' => ['destroy']]);
    }
    ////////////////////////////index/ عرض الصلاحيات   /////////////////////////////
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Role::latest()->get();
            return DataTables::of($data)
                ->addColumn('action', 'admin.roles.actions')
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }
        $data['title'] = Setting::find(1);
        return view('admin.roles.roles',$data);

    }
    ////////////////////////////create/ صفحة الاضافة   /////////////////////////////
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['permission'] = Permission::get();
        $data['title'] = Setting::find(1);
        return view('admin.roles.create',$data);
    }
    ////////////////////////////store/ حفظ   /////////////////////////////
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:roles,name',
            'permission' => 'required',
        ]);

        $role = Role::create(['name' => $request->input('name')]);
        $role->syncPermissions($request->input('permission'));

        return redirect()->route('roles.index')
                        ->with('success','تم الاضافة بنجاح');
    }
    ////////////////////////////show/ عرض   /////////////////////////////
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $role = Role::find($id);
        $permission = Permission::get();
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$id)
            ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
            ->all();
        $title = Setting::find(1);
        return view('admin.roles.show',compact('role','rolePermissions','title','permission'));
    }
    ////////////////////////////edit/ صفحة التعديل   /////////////////////////////
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Role::find($id);
        $permission = Permission::get();
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$id)
            ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
            ->all();
        $title = Setting::find(1);
        return view('admin.roles.edit',compact('role','permission','rolePermissions','title'));
    }
    ////////////////////////////update/ حفظ التعديل   /////////////////////////////
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'permission' => 'required',
        ]);

        $role = Role::find($id);
        $role->name = $request->input('name');
        $role->save();

        $role->syncPermissions($request->input('permission'));
        return redirect()->route('roles.index')
                        ->with('success','  تم التعديل');
    }
    ////////////////////////////delete/ حذف   /////////////////////////////
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table("roles")->where('id',$id)->delete();

    }
}
