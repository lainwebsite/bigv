<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = Event::orderBy('created_at', 'desc')->paginate(10);

        return view('admin.manage.event.index', [
            'events' => $events,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.manage.event.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $featured = 'event-' . time() . '-' . $request->featured_image->getClientOriginalName();
        $request->featured_image->move(public_path('uploads'), $featured);
        
        $event = Event::create([
            'title' => $request->title,
            'date' => $request->date,
            'description' => $request->description,
            'button_name' => $request->btn_name,
            'button_url' => $request->btn_url,
            'featured_image' => $featured
        ]);
        
        return redirect()->route('admin.event.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        return view('admin.manage.event.edit', compact('event'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Event $event)
    {
        if ($request->featured_image) {
            $oldlink = public_path('uploads')."/".$event->featured_image;
            unlink($oldlink);
            $featured = 'event-' . time() . '-' . $request->featured_image->getClientOriginalName();
            $request->featured_image->move(public_path('uploads'), $featured);
        } else {
            $featured = $event->featured_image;
        }
        
        $event->update([
            'title' => $request->title,
            'date' => $request->date,
            'description' => $request->description,
            'button_name' => $request->btn_name,
            'button_url' => $request->btn_url,
            'featured_image' => $featured
        ]);
        
        return redirect()->route('admin.event.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        $event->delete();
        return redirect()->route('admin.event.index');
    }
    
    public function sort(Request $request)
    {
        $events = Event::where('title', 'LIKE', '%' . $request->search . '%')
                ->orderBy($request->metric, $request->sort)
                ->paginate(10);
        return view('admin.manage.event.inc.event', compact('events'));
    }
}
