<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\ReservedVehicle;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $note               = new Note;
        $note->reserve_id   = $request->input('reserve_id');
        $note->note         = $request->input('note');
        $note->executive_id = currentUserId();
        //$note->re_call_date = date('Y-m-d',strtotime($request->re_call_date));
        $note->created_by   = currentUserId();
        $note->save();
        // Redirect the user to the "requests" tab on the same page
        return redirect()->back()->with('success', 'Data saved successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function show(Note $note)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function edit(Note $note)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Note $note)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function destroy(Note $note)
    {
        //
    }
    public function note_by_vehicle_id(Request $request){
        $notes = Note::where('reserve_id',$request->reserve_id)->orderBy('id','desc')->get();
        $reserve_note = ReservedVehicle::where('id',$request->reserve_id)->first();
        $index = 1;
        $data = '';
        if(count($notes) > 0 || !empty($exe_note)){
            foreach($notes as $note){
                $data .= '<tr>';
                $data .= '<td>'.$index++.'</td>';
                //$data .= '<td width="120px">'.\Carbon\Carbon::createFromTimestamp(strtotime($note->re_call_date))->format('j M, Y').'</td>';
				$data .= '<td>'.$note->note.'</td>';
				$data .= '<td>'.$note->noteCreated->name.'</td>';
				$data .= '<td>'.$note->created_at.'</td>';
                $data .= '</tr>';
            }
        }else{
            $data .= '<tr><td colspan="5">No Note Found</td></tr>';
        }
        return response()->json(array('data' => $data));
    }
}
