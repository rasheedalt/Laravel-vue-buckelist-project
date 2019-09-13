<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Bucketlist;
use App\Item;

class BucketlistController extends Controller
{
    //Display all bucketlist
    public function index(Request $request)
    {
        //return $request->all();
        $result = Bucketlist::all()->where('user_id', $request->user);


        return response()->json($result, 200);
    }


    //Create a new bucketlist
    public function create(Request $request)
    {
        $new_bucketlist = new Bucketlist;

        $this->validate($request,[
            'name' => 'required',
            'user' => 'required',
        ]);
        
        $new_bucketlist->user_id = $request->user;
        $new_bucketlist->name = $request->name;
        $new_bucketlist->created_by = $request->creator;

        $new_bucketlist->save();


        return response()->json([$new_bucketlist],200);
    }

   //Get a single bucketlist
    public function single($id)
    {
        $single_bucketlist = Bucketlist::find($id);

        return response()->json([$single_bucketlist], 200);

    }

    //Edit group Details
    public function update(Request $request, $id)
    {
        $bucketlist = Bucketlist::find($id);

        $bucketlist->name = $request->name;
        $bucketlist->created_by = $request->creator;
        $bucketlist->save();

        return response()->json([$bucketlist],200);
    }


    //Fetching the groups a user belong
    public function delete($id)
    {
        $bucketlist = Bucketlist::destroy($id);
        return response()->json(['status' => 'item deleted',  $bucketlist], 200);   
     }

     public function search(Request $request){
         //return $request->q;
         $bucketlist = Bucketlist::where('name',$request->q )->with('items')->get();
          return response()->json($bucketlist, 200);

     }

    
}
