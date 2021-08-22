<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;

class ItemController extends Controller
{
    public function index()
    {
        return Item::orderBy('created_at','DESC')->get();
        // return response()->json(Item::get(),200);
    }

    public function store( Request $request){

        $item = Item::create($request->all());
        return response()->json($item);
    }

    public function update( Request $request , $id){

        $item= Item::find($id);

        if(is_null($item)){
            return response()->json(["messsage"=>"record not found"],404);
        }

        $item->update($request->all());
        return response()->json($item, 200);
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
