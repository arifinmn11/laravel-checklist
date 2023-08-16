<?php

namespace App\Http\Controllers;

use App\Models\Checklist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ChecklistController extends Controller
{
    public function getAll()
    {
        $checklists = Checklist::all();

        return response()->json($checklists);
    }

    public function add(Request $request)
    {

        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required:unique',
            ]
        );

        if ($validator->failed()) {
            return response()->json($validator->messages());
        }

        $checklists = Checklist::create([
            'name' => $request['name']
        ]);

        return response()->json($checklists);
    }

    public function update(Request $request, $id)
    {
        $postId = $this->route('checklists');

        $validator = Validator::make(
            $request->all(),
            [
                'name' => ['required', Rule::unique('checklists')->ignore($postId)],
            ]
        );

        if ($validator->failed()) {
            return response()->json(
                [
                    "data" => [],
                    "message" => $validator->messages()
                ]
            );
        }

        $checklists = Checklist::create([
            'name' => $request['name']
        ]);

        return response()->json([
            "data" => $checklists,
            "message" => ""
        ],);
    }

    public function delete(Request $request, $id)
    {

        $checklist = Checklist::find($id);

        if (!$checklist) {
            return response()->json(
                [
                    "data" => [],
                    "message" => 'data not found!'
                ],
                404
            );
        }

        $checklist->delete();
        $checklist->save();

        return response()->json([
            "data" => [],
            "message" => 'success!'
        ], 200);
    }
}
