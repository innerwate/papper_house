<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Poem;
use DB;

class PoemsController extends Controller

{
    
    public function getAll(){
        //$poems = DB::table('poems');
        // $poems = DB::table('poems')->get();
         $poems= Poem::all();
       return $poems;

    }
    public function getSingle($id){
        $poem =  DB::table('poems')->where('id', $id)->get();
       
        return $poem;
    } 
    public function createPoem(Request $request){
        if(isset($request->poem)){
            $validatedData = $request->validate([
                'poem' => 'required',
               
            ]);
            $poem = $request->poem;
            
            if(isset($request->author)){
               
                $author = $request->author;
                
            }
            else{
                $author ='***';
            }
            if(isset($request->year)){
               
                $year = $request->year;
                
            }
            else{
                $year = "0000";
            }
            if(isset($request->title)){
               
                $title= $request->title;
            }
            else{
                $title = '***';
         
            }
            DB::table('poems')->insert(
                array('author' => $author, 'title' => $title, 'year' => $year, 'content' => $poem)
             );
            $data['message'] = 'success';
        }
       
        return response()->json($data);
    }
    public function editSingle(Request $request,$id){
        $author = $request->author;
        $title = $request->title;
        $year= $request->year;
        $poem = $request->content;
        $poem =  DB::table('poems')
        ->where('id', $id)
        ->update(['author' => $author,
            'title' => $title,
            'year'=>$year,
            'content'=>$poem]);
            
       
        return 'success update';
    }
    public function deletePoem($id){
        
        $poem =  DB::table('poems')
        ->where('id', $id)
        ->delete();
       
        return 'success delete';
    }
}
