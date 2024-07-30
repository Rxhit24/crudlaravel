<?php

namespace App\Http\Controllers;

use App\Models\Qualification;
use Illuminate\Http\Request;

class QualificatioControllern extends Controller
{
   public function store(Request $request){
        $data = [
            'stream' => $request->stream
        ];
        $success = Qualification::insert($data);
        if ($success)
        {
            return response()->json([
                'status' => 200,
                'message' => 'Addedd Succesfully'
            ], 200);
        }
        else
        {
            return response()->json([
                'status' => 422,
                'message' => 'Something went Wrong'
            ]);
        }
   }
}
