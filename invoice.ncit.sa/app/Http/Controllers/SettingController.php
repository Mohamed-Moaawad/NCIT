<?php

namespace App\Http\Controllers;


use App\Models\Setting;
use App\Models\User;
use App\Models\Client;
use App\Models\Item;
use App\Models\Invoice;
use Illuminate\Http\Request;
use DataTables;
use Auth;
use DB;
use App;


class SettingController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('checktype');

    }




    ////////////////////////////////setting\صفحة الاعدادات/////////////////////////////////////
    public function setting()
    {

        $data['setting'] = Setting::find(1);
        $data['title'] = Setting::find(1);
        return view('admin.genral.updateSetting', $data);

    }

    public function updateSetting(Request $request)
    {


        $setting = Setting::find(1);
        $setting->name = $request->name;
        $setting->tax = $request->tax;
        $setting->color = $request->color;

        if ($request->hasFile('img')) {
            $image = $request->file('img');

            $input['imagename'] = time() . '.' . $image->getClientOriginalExtension();

            $destinationPath = base_path() . '/img/';

            $image->move($destinationPath, $input['imagename']);
        }

        if ($request->hasFile('img')) {
            $setting->img = $input['imagename'];
        }
        ////////////////////////////////////////////////////////////////////////

        $setting->update();
        $request->session()->flash('alert-success', 'تم بنجاح');
        return redirect()->back();

    }




}
