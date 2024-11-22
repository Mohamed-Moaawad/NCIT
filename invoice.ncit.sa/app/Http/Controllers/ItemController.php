<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Setting;
use App\Models\Invoice_item;
use Illuminate\Http\Request;
use DataTables;
use Response;
use Validator;
use Auth;

class ItemController extends Controller
{
    function __construct()
    {
        $this->middleware('checktypeuser');
    }
    ////////////////////////////index/ عرض كل    /////////////////////////////
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $data = Item::where('user_id',Auth::user()->id)->latest()->get();
            return DataTables::of($data)
                ->addColumn('action', 'admin.items.actions')
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }
        $data['title'] = Setting::find(1);
        return view('admin.items.items', $data);

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
            'name' => 'required'
        ]);
        if ($error->fails()) {
            return response()->json(['errors' => $error->errors()->all()], 404);

        }
        $item_name=$request->name;
        $item_name= str_replace('"', "", $item_name);
        $item_name= str_replace("'", "", $item_name);
        $item= Item::updateOrCreate(
            ['id' => $request->id],

            ['name' => $item_name,
            'user_id' => Auth::user()->id
            ]

        );

        return Response::json($item);

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
        $item = Item::find($id);
        return Response::json($item);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $item = Item::find($id);
        return Response::json($item);;

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

        Item::find($id)->delete();
        Invoice_item::where('item_id',$id)->delete();

    }
}
