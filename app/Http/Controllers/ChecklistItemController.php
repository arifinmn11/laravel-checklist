<?php

namespace App\Http\Controllers;

use App\Models\Checklist;
use App\Models\ChecklistItem;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class ChecklistItemController extends Controller
{
    public function getAllByChecklistId($id)
    {
        $checklistItem = ChecklistItem::where('checklist_id', $id)->get();

        return response()->json([$checklistItem]);
    }

    public function add(Request $request, $id)
    {
        $checklist = Checklist::find($id);

        if (!$checklist) {
            return response()->json(['data not found!'], 404);
        }

        $validator = Validator::make(
            $request->all(),
            [
                'itemName' => 'required',
            ]
        );

        if ($validator->failed()) {
            return response()->json($validator->messages());
        }

        $checklistItem = ChecklistItem::create([
            'checklist_id' => $checklist->id,
            'name' => $request['itemName']

        ]);

        return response()->json($checklistItem);
    }

    public function getAllByCheckIdItemId($checklistId, $checklistItemId)
    {

        $checklistItem = ChecklistItem::where('id', $checklistItemId)->where('checklist_id', $checklistId)->get();

        return response()->json([$checklistItem]);
    }
}
