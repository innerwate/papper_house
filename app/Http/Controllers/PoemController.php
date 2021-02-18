<?php

namespace App\Http\Controllers;

use App\Poem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use App\Author;
use App\User;

class PoemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $poems = Poem::orderBy('id', 'desc')->get();
        return response()->json($poems);
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
        $validator = Validator::make($request->all(), [
            'user' => 'required',
            'title' => 'string|max:50',
            'content' => 'required|string'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }
        if (!$request->title) {
            $request->title = '****';
        }
        if (!$request->year_of_created) {
            $now = Carbon::now();
            $request->year_of_created = $now->year;
        }
        $poem = new Poem([
            'title' => $request->title,
            'content' => $request->content,
            'year_of_created' => $request->year_of_created
        ]);
        $author = User::find($request->user)->creators->first();
        $poem = $author->poem()->save($poem);
        return response()->json($poem);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Poem  $poem
     * @return \Illuminate\Http\Response
     */
    public function show(Poem $poem)
    {
        return response()->json($poem);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Poem  $poem
     * @return \Illuminate\Http\Response
     */
    public function edit(Poem $poem)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Poem  $poem
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Poem $poem)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Poem  $poem
     * @return \Illuminate\Http\Response
     */
    public function destroy(Poem $poem)
    {
        //
    }
    public function closed()
    {
        $data = "Only authorized users can see this";
        return response()->json(compact('data'), 200);
    }
}
