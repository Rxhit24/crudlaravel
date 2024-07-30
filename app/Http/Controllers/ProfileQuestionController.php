<?php

namespace App\Http\Controllers;

use App\Models\QuestionSet;
use Illuminate\Http\Request;

class ProfileQuestionController extends Controller
{
    public function storeQuestionSet(Request $request){
        $data = $request->all();

        $create = QuestionSet::create([
        'title' => $data['title'],
        'icon' => $data['icon'],
        'reward' => $data['reward'],

        ]);

        if($create){
            return response([
                'success' => true,
                'message' => 'Added Successfully'
            ],200);
        } else {
            return response([
                'success' => false,
                'message' => 'Something Went wrong'
            ],401);
        }

    }
    public function getQuestionSet(){
        $data = QuestionSet::get();
        return response([
            'success' => true,
            'questionSet' => $data
        ],200);

    }
}
