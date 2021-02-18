<?php

namespace App\Http\Controllers;

use App\HistoryPerson;
use Illuminate\Http\Request;
use App\Author;
use App\User;
class HistoryPersonController extends Controller
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\HistoryPerson  $historyPerson
     * @return \Illuminate\Http\Response
     */
    public function show(HistoryPerson $historyPerson)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\HistoryPerson  $historyPerson
     * @return \Illuminate\Http\Response
     */
    public function edit(HistoryPerson $historyPerson)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\HistoryPerson  $historyPerson
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, HistoryPerson $historyPerson)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\HistoryPerson  $historyPerson
     * @return \Illuminate\Http\Response
     */
    public function destroy(HistoryPerson $historyPerson)
    {
        //
    }
    public function historyPerson()
    {   
       //author creator add
       $hp = HistoryPerson::find(1);   
 
       $creator = new Author;
       $creator->body = "Hi nicesnippets.com";
     
       $hp->creators()->save($creator);

       //video creator add
       $user = User::find(1);   
 
       $creator = new Author;
       $creator->body = "Hi nicesnippets.com 2";
       $user->creators()->save($creator);
    }
}
