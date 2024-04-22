<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Term;
//use App\Http\Resources\TaskResource;

class TermController extends Controller
{

    function getTerms(Request $request) {
        $terms= Term::all();
            return response()->json($terms, 200, [], JSON_PRETTY_PRINT);
        }


    function getTerm($id) {
        $term = Term::where("id", $id)->first();
        return response()->json($term, 200, [], JSON_PRETTY_PRINT);
    }

    function setTerm(Request $request) {
        $fields = $request->validate([
            "title" => "required",
        ]);

        $term = Term::create([
            "title" => $fields["title"],
        ]);

        return response()->json([
            "message" => "Term has been created",
            "data" => $term
        ], 201, [], JSON_PRETTY_PRINT);
    }

    function updateTerm(Request $request, $id) {
        $term = Term::where("id", $id)->first();

        if (!$term) {
            return response()->json([
                "message" => "Term does not exist"
            ], 404, [], JSON_PRETTY_PRINT);
        }
        
        $fields = $request->validate([
            "title" => "required",
        ]);

        $term->title = $fields["title"];
        $term->save();

        return response()->json([
            "message" => "Term has been updated",
            "data" => $term
        ], 200, [], JSON_PRETTY_PRINT);
    }

    function deleteTerm($id) {
        $term = Term::where("id", $id)->first();

        if (!$term) {
            return response()->json([
                "message" => "Term does not exist"
            ], 404, [], JSON_PRETTY_PRINT);
        }

        $term->delete();
        return response()->json([
            "message" => "Term has been deleted"
        ], 200, [], JSON_PRETTY_PRINT);
    }
}