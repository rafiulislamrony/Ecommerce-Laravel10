<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Nette\Utils\Image;

class SettingController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function siteSetting()
    {
        try {
            $setting = DB::table('sitesetting')->first();
            return view('admin.setting.site_setting', compact('setting'));

        } catch (\Exception $e) {
            $notification = [
                'message' => 'Error: ' . $e->getMessage(),
                'alert-type' => 'error',
            ];
            return redirect()->back()->with($notification);
        }
    }

    public function updateSiteSetting(Request $request)
    {
        try {

            $oldLogo = $request->oldlogo;
            $newLogo = $request->file('newlogo');
            $id = $request->id;

            $data = array();
            $data['phone_one'] = $request->phone_one;
            $data['phone_two'] = $request->phone_two;
            $data['email'] = $request->email;
            $data['company_name'] = $request->company_name;
            $data['company_address'] = $request->company_address;
            $data['facebook'] = $request->facebook;
            $data['youtube'] = $request->youtube;
            $data['instagram'] = $request->instagram;
            $data['twitter'] = $request->twitter;
            $data['copyright'] = $request->copyright;

            if ($newLogo) {
                unlink($oldLogo);

                $nameMake = hexdec(uniqid()) . '.' . strtolower($newLogo->getClientOriginalExtension());
                $upload_path = 'media/logo/';
                $image_url = $upload_path . $nameMake;
                $newLogo->move($upload_path, $nameMake);
                $data['sitelogo'] = $image_url;

                DB::table('sitesetting')->where('id',$id)->update($data);

                $notification = [
                    'message' => 'Site Setting Update With Logo Successfully.',
                    'alert-type' => 'success',
                ];
                return redirect()->back()->with($notification);
            }else{
                $data['sitelogo'] = $oldLogo;
                $notification = [
                    'message' => 'Site Setting Updated Without Logo Successfully.',
                    'alert-type' => 'success',
                ];
                DB::table('sitesetting')->where('id',$id)->update($data);
                return redirect()->back()->with($notification);
            }
        } catch (\Exception $e) {
            $notification = [
                'message' => 'Error: ' . $e->getMessage(),
                'alert-type' => 'error',
            ];
            return redirect()->back()->with($notification);
        }
    }

    public function footerLinks(){
        try{
           $flinks =  DB::table('flinks')->orderBy('id', 'DESC')->get();
           return view('admin.setting.footer_setting', compact('flinks'));
        }catch(\Exception $e){
            $notification = [
                'message' => 'Error: ' . $e->getMessage(),
                'alert-type' => 'success',
            ];
            return redirect()->back()->with($notification);
        }
    }
    public function footerLinksStore(Request $request){
        try{
            $data = array();
            $data['name'] = $request->name;
            $data['url'] = $request->url;
            $data['columns_no'] = $request->columns_no;

            DB::table('flinks')->insert($data);
            $notification = [
                'message' => 'Footer Link Inserted Successfully.',
                'alert-type' => 'success',
            ];
            return redirect()->back()->with($notification);


        }catch(\Exception $e){
            $notification = [
                'message' => 'Error: ' . $e->getMessage(),
                'alert-type' => 'error',
            ];
            return redirect()->back()->with($notification);
        }
    }
    public function footerLinksEdit($id){
        try{
            $flinks = DB::table('flinks')->where('id', $id)->first();

            return view('admin.setting.footer_edit', compact('flinks'));
        }catch(\Exception $e){
            $notification = [
                'message' => 'Error: ' . $e->getMessage(),
                'alert-type' => 'error',
            ];
            return redirect()->back()->with($notification);
        }
    }
    public function footerLinksUpdate(Request $request){
        try{
            $id = $request->id;

            $data = array();
            $data['name'] = $request->name;
            $data['url'] = $request->url;
            $data['columns_no'] = $request->columns_no;

            DB::table('flinks')->where('id',$id)->update($data);

            $notification = [
                'message' => 'Footer Link Updated Successfully.',
                'alert-type' => 'success',
            ];
            return redirect()->route('footer.links')->with($notification);
        }catch(\Exception $e){
            $notification = [
                'message' => 'Error: ' . $e->getMessage(),
                'alert-type' => 'error',
            ];
            return redirect()->back()->with($notification);
        }
    }

    public function footerLinksDelete($id){
        try{
             DB::table('flinks')->where('id', $id)->delete();
             $notification = [
                'message' => 'Footer Link Deleted Successfully.',
                'alert-type' => 'error',
            ];
             return redirect()->back()->with($notification);
        }catch(\Exception $e){
            $notification = [
                'message' => 'Error: ' . $e->getMessage(),
                'alert-type' => 'error',
            ];
            return redirect()->back()->with($notification);
        }
    }

}
