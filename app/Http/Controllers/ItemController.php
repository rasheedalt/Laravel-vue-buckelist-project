<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bucketlist;
use App\Item;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, $id)
    {
        $item = new Item;
                
        $item->name = $request->name;
        $item->done = $request->done;
        $item->bucketlist_id = $id;
        
       if($item->save()){
            return response()->json([$item], 200);
        }else{
          return response()->json(['error' => "unable to create item"], 404);
      }

    }

    
    public function list($id)
    {
        $items = Bucketlist::find($id)->items;
        //$items = Bucketlist::find($id)->with('items')->paginate(1);
        
        return response()->json(['result' => $items],200);
        
        
    }

    
    public function single($list_id, $item_id)
    {
        $item = Bucketlist::find($list_id)->items->where('id', $item_id);
        return response()->json($item, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $bucket_id, $item_id)
    {   
        $query = Bucketlist::find($bucket_id)->items->where('id', $item_id);;
        
        $item = $query[0];
       
        $item->name = $request->name;
        $item->done = $request->done;
        $item->save();

        return response()->json([$item], 200);
    }

    public function delete($item_id)
    {
        $item = Item::destroy($item_id);

        return response()->json(['status' => 'item deleted',  $item], 200);

    }
}
