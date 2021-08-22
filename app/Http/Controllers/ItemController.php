<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use Illuminate\Support\Carbon;

class ItemController extends Controller
{
    public function index()
    {
        return Item::orderBy('created_at','DESC')->get();
        // return response()->json(Item::get(),200);
    }

    public function store( Request $request){

        // $item = Item::create($request->all());
        // return response()->json($item);

        $newItem = new Item;
        $newItem->name = $request->item["name"];
        $newItem->save();

        return $newItem;
    }

    public function update( Request $request , $id){

        $item = Item::find($id);

        // if(is_null($item)){
        //     return response()->json(["messsage"=>"record not found"],404);
        // }
        //  $item->update($request->all());

        //  return response()->json($item, 200);
            if($item)
       
                {
                    $item->completed = $request->item['completed'] ? true : false;
                    $item->completed_at = $request->item['completed'] ? Carbon::now() : null;
                    $item->save();

                    return $item;
                }

                return "item not found";
        
    }

    public function delete( Request $request , $id){

        $item= Item::find($id);

        if(is_null($item)){
            return response()->json(["messsage"=>"record not found"],404);
        }

        $item->delete();
        return response()->json(null, 200);
    }
}
