<?php

namespace App\Http\Controllers;


use App\Models\Client;
use App\Models\Setting;
use App\Models\Invoice;
use Illuminate\Http\Request;
use DataTables;
use Response;
use Validator;
use Auth;

class ClientController extends Controller
{
    ////////////////////////////index/ عرض كل العملاء   /////////////////////////////
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $data = Client::where('user_id',Auth::user()->id)->latest()->get();
            return DataTables::of($data)
                ->addColumn('action', 'admin.clients.actions')
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }
        $data['title'] = Setting::find(1);
        return view('admin.clients.clients', $data);

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
            'name' => 'required',
            'mobile' => 'required',
            'email' => 'required',
            'address' => 'required',
        ]);
        if ($error->fails()) {
            return response()->json(['errors' => $error->errors()->all()], 404);

        }

        $client= Client::updateOrCreate(
            ['id' => $request->id],

            ['name' => $request->name,
                'mobile' => $request->mobile,
                'address' => $request->address,
                'email' => $request->email,
                'user_id' => Auth::user()->id
            ]

        );

        return Response::json($client);

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
        $client = Client::where('id',$id)->where('user_id',Auth::user()->id)->first();
        return Response::json($client);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $client = Client::where('id',$id)->where('user_id',Auth::user()->id)->first();
        return Response::json($client);
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

        Client::where('id',$id)->where('user_id',Auth::user()->id)->delete();
     Invoice::where('client_id',$id)->where('user_id',Auth::user()->id)->delete();
    }
}
