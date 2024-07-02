<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aboutpage;
use App\Models\Cofounder;
use App\Models\Core;
use App\Models\Vision;
use App\Models\Spread;
use Image;

class AboutController extends Controller
{
    // add new story
    public function addCofounder(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            //dd($data);
            $story = new Cofounder;
            $story->title = $data['title'];
            $story->subtitle = $data['subtitle'];
            $story->status = !empty($data['status']) ? 1 : 0;


            if($request->hasFile('image')) {
                $image_tmp = $request->image;
                if ($image_tmp->isValid()) {
                    $filename = strtotime("now").'-'. $image_tmp->getClientOriginalName();
                    $newsviews_path = 'assets/imgs/about/'.$filename;
                    Image::make($image_tmp)->save($newsviews_path);
                    $story->image = $filename;
                }
            }

            $story->save();
            return redirect('admin/view-cofounder')->with('flash_message_success','New record added successfully');
        }
        return view('admin.cofounder.add-cofounder');
    }
    
    // edit specific story
    public function editCofounder(Request $request, $id){
        if($request->isMethod('post')){
            $data = $request->all();

            if ($request->hasFile('image')) {
                $image_tmp = $request->image;
                $filename = time() . '.' . $image_tmp->clientExtension();
                if ($image_tmp->isValid()) {
                    $extension = $image_tmp->getClientOriginalExtension();
                    $filename = rand(1111, 99999) . '.' . $extension;
                    $collaborate_path = 'assets/imgs/about/' . $filename;
                    Image::make($image_tmp)->save($collaborate_path);
                }
            } else if (!empty($data['current_image'])) {
                $filename = $data['current_image'];
            } else {
                $filename = '';
            }

            

            Cofounder::where('id',$id)->update(['title'=>$data['title'],'subtitle'=>$data['subtitle'],'status' => !empty($data['status']) ? 1 : 0,'image'=>$filename]);
            return redirect('admin/view-cofounder')->with('flash_message_success','New record updated successfully');
        }
        $story = Cofounder::where('id',$id)->first();
        return view('admin.cofounder.edit-cofounder')->with(compact('story'));
    }

     public function viewCofounder(){
        $story = Cofounder::orderBy('id','ASC')->get();
        // dd($newsviewss);
        return view('admin.cofounder.view-cofounder')->with(compact('story'));
    }

    public function deleteCofounder(Request $request, $id){
        Cofounder::where('id',$id)->delete();
        return redirect()->back()->with('flash_message_success','Data deleted successfully');
    }


    // add new aboutpage
    public function addAboutpage(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            //dd($data);
            $aboutpage = new Aboutpage;
            $aboutpage->title = $data['title'];
            $aboutpage->description = $data['description'];
            $aboutpage->vision = $data['vision'];
            $aboutpage->mission = $data['mission'];
            $aboutpage->corevalue = $data['corevalue'];


            if($request->hasFile('image')) {
                $image_tmp = $request->image;
                if ($image_tmp->isValid()) {
                    $filename = strtotime("now").'-'. $image_tmp->getClientOriginalName();
                    $newsviews_path = 'assets/imgs/about/'.$filename;
                    Image::make($image_tmp)->save($newsviews_path);
                    $about->image = $filename;
                }
            }
            
            $aboutpage->save();
            return redirect('admin/view-aboutpage')->with('flash_message_success','New record added successfully');
        }
        return view('admin.aboutpage.add-aboutpage');
    }
    
    // edit specific aboutpage
    public function editAboutpage(Request $request, $id){
        if($request->isMethod('post')){
            $data = $request->all();

            if ($request->hasFile('image')) {
                $image_tmp = $request->image;
                if ($image_tmp->isValid()) {
                    $extension = $image_tmp->getClientOriginalName();
                    $filename = strtotime("now") . '.' . $extension;
                    $collaborate_path = 'assets/imgs/about/' . $filename;
                    Image::make($image_tmp)->save($collaborate_path);
                }
            } else if (!empty($data['current_image'])) {
                $filename = $data['current_image'];
            } else {
                $filename = '';
            }

            Aboutpage::where('id',$id)->update(['title'=>$data['title'],'description'=>$data['description'],'vision'=>$data['vision'],'mission'=>$data['mission'],'corevalue'=>$data['corevalue'],'image'=>$filename,]);
            return redirect('admin/view-aboutpage')->with('flash_message_success','New record updated successfully');
        }
        $aboutpage = Aboutpage::where('id',$id)->first();
        return view('admin.aboutpage.edit-aboutpage')->with(compact('aboutpage'));
    }

     public function viewAboutpage(){
        $aboutpage = Aboutpage::orderBy('id','ASC')->get();
        // dd($newsviewss);
        return view('admin.aboutpage.view-aboutpage')->with(compact('aboutpage'));
    }

    public function deleteAboutpage(Request $request, $id){
        Aboutpage::where('id',$id)->delete();
        return redirect()->back()->with('flash_message_success','Data deleted successfully');
    }


    // add new vision
    public function addVision(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            //dd($data);
            $vision = new Vision;
            $vision->vision = $data['vision'];
            $vision->mission = $data['mission'];

            $vision->save();
            return redirect('admin/view-vision')->with('flash_message_success','New record added successfully');
        }
        return view('admin.vision.add-vision');
    }
    
    // edit specific vision
    public function editVision(Request $request, $id){
        if($request->isMethod('post')){
            $data = $request->all();

            Vision::where('id',$id)->update(['vision'=>$data['vision'],'mission'=>$data['mission']]);
            return redirect('admin/view-vision')->with('flash_message_success','New record updated successfully');
        }
        $vision = Vision::where('id',$id)->first();
        return view('admin.vision.edit-vision')->with(compact('vision'));
    }

     public function viewVision(){
        $vision = Vision::orderBy('id','ASC')->get();
        // dd($newsviewss);
        return view('admin.vision.view-vision')->with(compact('vision'));
    }

    public function deleteVision(Request $request, $id){
        Vision::where('id',$id)->delete();
        return redirect()->back()->with('flash_message_success','Data deleted successfully');
    }


    // add new core
    public function addCore(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            //dd($data);
            $core = new Core;
            $core->title = $data['title'];
            $core->description = $data['description'];

            $core->save();
            return redirect('admin/view-core')->with('flash_message_success','New record added successfully');
        }
        return view('admin.core.add-core');
    }
    
    // edit specific core
    public function editCore(Request $request, $id){
        if($request->isMethod('post')){
            $data = $request->all();

            Core::where('id',$id)->update(['title'=>$data['title'],'description'=>$data['description']]);
            return redirect('admin/view-core')->with('flash_message_success','New record updated successfully');
        }
        $core = Core::where('id',$id)->first();
        return view('admin.core.edit-core')->with(compact('core'));
    }

     public function viewCore(){
        $core = Core::orderBy('id','ASC')->get();
        // dd($newsviewss);
        return view('admin.core.view-core')->with(compact('core'));
    }

    public function deleteCore(Request $request, $id){
        Core::where('id',$id)->delete();
        return redirect()->back()->with('flash_message_success','Data deleted successfully');
    }


    // add new spread
    public function addSpread(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            //dd($data);
            $spread = new Spread;
            $spread->title = $data['title'];

            if($request->hasFile('image')) {
                $image_tmp = $request->image;
                if ($image_tmp->isValid()) {
                    $filename = strtotime("now").'-'. $image_tmp->getClientOriginalName();
                    $newsviews_path = 'assets/imgs/spread/'.$filename;
                    Image::make($image_tmp)->save($newsviews_path);
                    $spread->image = $filename;
                }
            }

            $spread->save();
            return redirect('admin/view-spread')->with('flash_message_success','New record added successfully');
        }
        return view('admin.spread.add-spread');
    }
    
    // edit specific spread
    public function editSpread(Request $request, $id){
        if($request->isMethod('post')){
            $data = $request->all();

            if ($request->hasFile('image')) {
                $image_tmp = $request->image;
                $filename = time() . '.' . $image_tmp->clientExtension();
                if ($image_tmp->isValid()) {
                    $extension = $image_tmp->getClientOriginalExtension();
                    $filename = rand(1111, 99999) . '.' . $extension;
                    $collaborate_path = 'assets/imgs/spread/' . $filename;
                    Image::make($image_tmp)->save($collaborate_path);
                }
            } else if (!empty($data['current_image'])) {
                $filename = $data['current_image'];
            } else {
                $filename = '';
            }

            Spread::where('id',$id)->update(['title'=>$data['title'],'image'=>$filename]);
            return redirect('admin/view-spread')->with('flash_message_success','New record updated successfully');
        }
        $spread = Spread::where('id',$id)->first();
        return view('admin.spread.edit-spread')->with(compact('spread'));
    }

     public function viewSpread(){
        $spread = Spread::orderBy('id','ASC')->get();
        // dd($newsviewss);
        return view('admin.spread.view-spread')->with(compact('spread'));
    }

    public function deleteSpread(Request $request, $id){
        Spread::where('id',$id)->delete();
        return redirect()->back()->with('flash_message_success','Data deleted successfully');
    }

}
