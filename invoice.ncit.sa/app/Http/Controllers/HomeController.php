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
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:setting', ['only' => ['setting', 'updateSetting']]);

    }

    /**
     * Show the application dashboard.
     *الرئيسية
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data['title'] = Setting::find(1);
        if (Auth::user()->type == 1) {
            $data['clients'] = Client::count();
            $data['users'] = User::count();
            $data['items'] = Item::count();
            $data['invoices'] = Invoice::count();
            return view('admin.genral.home', $data);
        } else {
            $data['clients'] = Client::where('user_id', Auth::user()->id)->count();
            $data['items'] = Item::where('user_id', Auth::user()->id)->count();
            $data['invoices'] = Invoice::where('user_id', Auth::user()->id)->count();
            $data['invoices_reminder'] = Invoice::where('user_id', Auth::user()->id)->
            whereDate('reminder_date', Carbon::today())->get();
            return view('admin.genral.home_user', $data);
        }

    }
    ////////////////////////////////setting\صفحة الاعدادات/////////////////////////////////////
    public function user_setting()
    {

        $data['setting'] = User::find(Auth::user()->id);
        $data['title'] = Setting::find(1);
        return view('admin.genral.updateSettingUser', $data);

    }

    public function user_updateSetting(Request $request)
    {


        $setting = User::find(Auth::user()->id);
        $setting->company_name = $request->name;
        $setting->registration_no = $request->registration_no;
        $setting->tax_number=$request->tax_number;
        $setting->address = $request->address;
        if ($request->hasFile('img')) {
            $image = $request->file('img');

            $input['imagename'] = time() . '.' . $image->getClientOriginalExtension();

            $destinationPath = base_path() . '/img/';

            $image->move($destinationPath, $input['imagename']);
        }

        if ($request->hasFile('img')) {
            $setting->company_img = $input['imagename'];
        }
        ////////////////////////////////////////////////////////////////////////

        $setting->update();
        $request->session()->flash('alert-success', 'تم بنجاح');
        return redirect()->back();

    }


    ////////////////////////////password/ تغيير كلمة المرور/////////////////////////////
    public function changePassword()
    {
        $data['title'] = Setting::find(1);
        return view('admin.genral.changePassword', $data);
    }

    public function changePass(Request $r)
    {
        $this->validate($r, [
            'old_password' => 'required|max:204',
            'pass' => 'required|max:204',
        ]);
        $ch = User::where('id', Auth::user()->id)->where('pass', $r->old_password)->count();
        if ($ch > 0) {
            $u = User::find(Auth::user()->id);
            $u->password = bcrypt($r->pass);
            $u->pass = $r->pass;
            $u->update();
            return 1;
        } else {
            return 0;
        }

    }


}
