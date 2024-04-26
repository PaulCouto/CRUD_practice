<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Note;
use App\Models\Category;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $notes = Note::with('category')->get(); // Eager load the category relationship
        return view('notes.index', compact('notes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::where('active', true)->get(); // Fetch all categories

        return view('notes.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $note = Note::create([
            'title' => $request->title,
            'content' => $request->content,
            'category_id' => $request->category_id, // Set category_id directly
        ]);

        return redirect()->route('notes.index')
            ->with('success', 'Nota creada exitosamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  Note $note
     * @return \Illuminate\Http\Response
     */
    public function show(Note $note) // Use route model binding for Note
    {
        return view('notes.show', compact('note'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Note $note
     * @return \Illuminate\Http\Response
     */
    public function edit(Note $note) // Use route model binding for Note
    {
        $categories = Category::all(); // Fetch all categories

        return view('notes.edit', compact('note', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Note $note
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Note $note)
    {
        $note->update([
            'title'     =>  $request->title,
            'content'   =>  $request->content,
            'category_id' => $request->category_id
        ]);

        $note->categories()->detach(); // Detach all existing categories
        $note->categories()->attach($request->category_id);

        return redirect()->route('notes.show', $note->id);
    }

    /**
     * Remove the specified resource from storage (soft delete).
     *
     * @param  Note $note
     * @return \Illuminate\Http\Response
     */
    public function destroy(Note $note)
    {
        $note->update([
            'active'     =>  false,
        ]);

        return redirect()->route('notes.index');
    }
}
