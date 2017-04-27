<?php

namespace App\Http\Controllers;

use App\Entry;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;

class EntryController extends Controller
{
    public function index() {
        // list something - GET /entries
        $entries = Entry::all();
        return Response::json($entries);
    }

    public function create(Request $request) {
        // create new entry - POST /entries
        // DB::table('entries')->insert();
        $entry = Entry::create($request->all()); // create a new entry object
        return Response::json(['entry created' => true, 'id' => $entry->id]);
    }

    public function show($id) {
        // show a single entry info - GET /entries/$id
        $entry = Entry::find($id); // get single record back
        return Response::json($entry);
    }

    public function update(Request $request, $id) {
        // update a single entry - PUT /entries/$id
        $entry = Entry::find($id);
        $entry->update($request->all());
        return Response::json(['entry updated' => true]);
    }

    public function destroy($id) {
        // remove a single entry -  DELETE /entries/$id
        $entry = Entry::find($id);
        $entry->delete();
        return Response::json(['entry deleted' => true]);
    }
}
