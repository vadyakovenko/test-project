<?php

namespace App\Http\Controllers\API;

use App\Models\Record;
use Illuminate\Http\Request;

class RecordController
{
    public function search(Request $request)
    {
        $query = Record::query();
        $search = trim($request->get('search'));

        if (!empty($search)) {
            $query->where('id', 'LIKE', "%{$search}%")
                ->orWhere('title', 'LIKE', "%{$search}%")
                ->orWhere('notes', 'LIKE', "%{$search}%");
        }

        $records = $query->paginate(20);

        return response()->json($records);
    }
}
