<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use App\Models\Events;
 
use App\Models\Ratings;
use Illuminate\Support\Facades\DB;
use Image;

class EventsController extends Controller
{
    public function getEvents()
    {
        $events = Events::orderBy('id', 'ASC')->get();
        return response()->json($events);
    }
    public function addEvents(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            $events = new Events;            
            $events->name = $data['name'];
            $events->location = $data['location'];
    
            if($request->hasFile('image')) {
                $image_tmp = $request->image;
                if ($image_tmp->isValid()) {
                    $filename = time() . '-' . $image_tmp->getClientOriginalName();
                    $eventsviews_path = 'assets/imgs/events/' . $filename;
                    Image::make($image_tmp)->save($eventsviews_path);
                    $events->image = $filename;
                }
            }
            $events->save();
            return redirect('admin/view-events')->with('flash_message_success', 'New record added successfully');
        }
        return view('admin.events.add-events');
    }
    
    
    // edit specific events 
    public function editEvents(Request $request, $id){
        if($request->isMethod('post')){
            $data = $request->all();
    
            if ($request->hasFile('image')) {
                $image_tmp = $request->image;
                if ($image_tmp->isValid()) {
                    $extension = $image_tmp->getClientOriginalExtension();
                    $filename = time() . '.' . $extension;
                    $collaborate_path = 'assets/imgs/events/' . $filename;
                    Image::make($image_tmp)->save($collaborate_path);
                    $current_image = $filename;
                }
            } else if (!empty($data['current_image'])) {
                $current_image = $data['current_image'];
            } else {
                $current_image = '';
            }
    
            Events::where('id', $id)->update([
                'name' => $data['name'],
                'location' => $data['location'],
                'image' => $current_image
            ]);
    
            return redirect('admin/view-events')->with('flash_message_success', 'Record updated successfully');
        }
        $events = Events::where('id', $id)->first();
        return view('admin.events.edit-events')->with(compact('events'));
    }
    

    public function viewEvents(){
        $events = Events::orderBy('id','ASC')->get();
        // dd($newsviewss);
        // return response()->json($events);
        return view('admin.events.view-events')->with(compact('events'));
    }
   
    
    public function deleteEvents(Request $request, $id){
        Events::where('id',$id)->delete();
        return redirect()->back()->with('flash_message_success','Data deleted successfully');
    }

    public function storeRatings(Request $request)
{
    
    try {
        $request->validate([
            'eventId' => 'required|integer',
            'userId' => 'required|integer',
            'rating' => 'required|integer|min:1|max:10',
        ]);

        $rating = Ratings::updateOrCreate(
            [
                'event_id' => $request->eventId,
                'user_id' => $request->userId,
            ],
            [
                'rating' => $request->rating,
            ]
        );

        return response()->json(['message' => 'Rating stored successfully', 'rating' => $rating]);
    } catch (\Exception $e) {
        return response()->json(['error' => 'Failed to store rating', 'message' => $e->getMessage()], 500);
    }
}

public function viewRatings()
    {
        // Fetch average ratings for each event
        $averageRatings = Ratings::select('event_id', DB::raw('AVG(rating) as average_rating'))
            ->groupBy('event_id')
            ->with('event')
            ->get();

        return view('admin.ratings.view-ratings')->with(compact('averageRatings'));
    }
   
}
