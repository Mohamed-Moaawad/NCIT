<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Setting;
use Spatie\Permission\Models\Role;
use DB;
use Hash;
use DataTables;
use Response;
use Validator;
use Illuminate\Support\Arr;

class UserController extends Controller
{


    function __construct()
    {
        $this->middleware('checktype');
    }
    ////////////////////////////index/ عرض كل المستخدمين   /////////////////////////////
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $data = User::latest()->get();
            return DataTables::of($data)
                ->addColumn('action', 'admin.users.actions')
                ->addColumn('status', function ($m) {
                    if ($m->status == 1) {
                        return __('text.status1');
                    } else {
                        return __('text.status2');
                    }
                })
                ->addColumn('stype', function ($m) {
                    if ($m->type == 1) {
                        return __('text.admin_type1');
                    } else {
                        return __('text.admin_type2');
                    }
                })

                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }
        $data['title'] = Setting::find(1);
    //    $data['roles'] = Role::pluck('name', 'name')->all();
        return view('admin.users.users', $data);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }
    ////////////////////////////store/ حفظ   /////////////////////////////
    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $error = Validator::make($request->all(), [
            'fname' => 'required',
            'lname' => 'required',
            'password' => 'required',
            'email' => 'required|unique:users,email,' . $request->id,
        ]);
        if ($error->fails()) {
            return response()->json(['errors' => $error->errors()->all()], 404);

        }
        if ($request->id != null) {
            $u = User::find($request->id);
            $img = $u->img;
            if ($request->hasFile('img')) {
                if ($img!='av.jpg') {
                    unlink(base_path('img/' . $img));
                }
            }
        } else {
            $img = "av.jpg";

        }
        if ($request->hasFile('img')) {
            $image = $request->file('img');

            $input['imagename'] = time() . '.' . $image->getClientOriginalExtension();

            $destinationPath = base_path() . '/img/';

            $image->move($destinationPath, $input['imagename']);
        }

        if ($request->hasFile('img')) {
            $img = $input['imagename'];

        }
        $user = User::updateOrCreate(
            ['id' => $request->id],

            ['fname' => $request->fname,
                'lname' => $request->lname,
                'email' => $request->email,
                'status' => $request->status,
                'password' => bcrypt($request->password),
                'pass' => $request->password,
                'img' => $img,
                'type'=>$request->type
            ]

        );


     //   DB::table('model_has_roles')->where('model_id', $request->id)->delete();
     //   $user->assignRole($request->input('roles'));

        return Response::json($user);

    }
    ////////////////////////////show/ عرض   /////////////////////////////
    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
      //  $userRole = $user->roles->pluck('name', 'name')->all();
        return Response::json($user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $user = User::find($id);
       // $userRole = $user->roles->pluck('name', 'name')->all();
        return Response::json($user);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

    }
    ////////////////////////////delete/ حذف   /////////////////////////////
    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $u = User::find($id);
        $img = $u->img;
        if ($img!='av.jpg') {
            unlink(base_path('/img/' . $img));
        }

        User::find($id)->delete();

    }
}
