<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Term;
use App\Http\Resources\TermResource;

class TermController extends Controller
{

    public function getTerms() {
        $terms = TermResource::collection(Term::all());
        return response()->json($terms, 200, [], JSON_PRETTY_PRINT);
    }

    public function getTerm($id) {
        $term = new TermResource(Term::find($id));
        return response()->json($term, 200, [], JSON_PRETTY_PRINT);
    }

    public function getTermTitle($title) {
        $terms = Term::where("title", $title)->get();
        return response()->json($terms, 200, [], JSON_PRETTY_PRINT);
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