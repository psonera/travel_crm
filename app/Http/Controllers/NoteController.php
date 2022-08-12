<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;
use App\Http\Requests\NoteFormRequest;

class NoteController extends Controller
{
       /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('notes.index', [
            'notes' => Note::latest()->paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('notes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param NoteFormRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(NoteFormRequest $request)
    {
        $validated = $request->validated();

        Note::create($validated);

        return redirect()->route('notes.index')->with('success', 'Note has been created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Note $note
     * @return \Illuminate\Http\Response
     */
    public function edit(Note $note)
    {
        return view('notes.edit', compact('note'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  NoteFormRequest  $request
     * @param  Note $note
     * @return \Illuminate\Http\Response
     */
    public function update(NoteFormRequest $request, Note $note)
    {
        $validated = $request->validated();
        
        if($note){
            $note->update($validated);
            $note->save();
        }
        return redirect()->route('notes.index')->with('success', 'Note Has Been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $note = Note::findOrFail($id);
        $note->delete();  
        return response()->json([
            'success' => true,
        ]);

    }
}
