<?php

namespace App\Http\Controllers;

use App\Jobs\WaitForMe;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Validator;

class StudentController extends Controller
{
    public function index()
    {
        $start = microtime(true);

        $students = Student::join('qualification','students.qualification_id','=', 'qualification.id')->select('qualification.stream','students.*')->paginate(20);

        $end = microtime(true);
        error_log($end - $start);

        // if ($studentsCount <2000){
        //     WaitForMe::dispatch();
        //     return response()->json(['message' => 'File wiil be available in reports Tab'], 200);
        // }
        // else{
        //     $students = Student::join('qualification','students.qualification_id','=', 'qualification.id')->select('qualification.stream','students.*')->get();
        //     $content = implode(",", ['Sr No.', 'Name', 'Course', 'Email', 'Phone']) . "\n";
        //     $id = 1;
        //     foreach ($students as $stu){
        //         $content .= implode(',', array($id++, $stu['name'], $stu['course'], $stu['email'], $stu['phone'], )) . "\n";
        //     }
        //     $fileName = 'sample2.csv';

        //     // Store the file in the local disk (storage/app directory)
        //     Storage::disk('local')->put($fileName, $content);

        //     // Check if the file exists and return a response
        //     if (Storage::disk('local')->exists($fileName)){
        //         return response()->json(['message' => 'File stored successfully'], 200);
        //     }
        //     else{
        //         return response()->json(['message' => 'Failed to store the file'], 500);
        //     }
        // }

        if($students->count() < 10000){
            // WaitForMe::dispatch($students);
            return response()->json([
                'status' => 200,
                'students' => $students
            ]);
        } else{
            if (sizeof($students) > 0) {
                return response()->json([
                    'status' => 200,
                    'students' => $students
                ], 200);
            } else {
                return response()->json([
                    'status' => 404,
                    'students' => 'No record founds'
                ],404);
            }
        }
    }

    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|email',
            'course' => 'required|string',
            'phone' => 'required|max:10|min:10',
        ]);
        if ($validate->fails())
        {
            return response()->json([
                'status' => 422,
                'errors' => $validate->messages()
            ], 422);
        }
        else
        {
            $student = Student::create([
                'name' => $request->name,
                'course' => $request->course,
                'email' => $request->email,
                'phone' => $request->phone,
            ]);

            if ($student)
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
    // public function store(Request $request)
    // {
    //     $request -> validate(
    //         [
    //             'name' => 'required|string',
    //             'email' => 'required|email',
    //             'course' => 'required|string',
    //             'phone' => 'required|max:10|min:10',
    //         ]
    //     );

    //     $student = new Student;
    //     $student->name = $request['name'];
    //     $student->email = $request['email'];
    //     $student->course = $request['course'];
    //     $student->phone = $request['phone'];

    //     $student->create();
    // }
    public function findStudent($id)
    {
        $student = Student::find($id);
        if ($student)
        {
            return response()->json([
                'status' => 200,
                'students' => $student
            ], 200);
        }
        else
        {
            return response()->json([
                'status' => 404,
                'message' => 'No Student found'
            ], 404);
        }
    }

    public function edit(int $id)
    {
        $student = Student::find($id);

        if ($student)
        {
            return response()->json([
                'status' => 200,
                'students' => $student
            ], 200);
        }
        else
        {
            return response()->json([
                'status' => 404,
                'message' => "Not found Student"
            ], 404);
        }
    }

    public function update(Request $request, int $id)
    {
        $validate = Validator::make($request->all(), [
            'name' => 'required|string',
            'course' => 'required',
            'email' => 'required|email',
            'phone' => 'required|max:10|min:10'
        ]);



        if ($validate->fails())
        {
            return response()->json([
                'status' => 422,
                'erorrs' => $validate->messages()
            ], 422);

        }
        else
        {
            WaitForMe::dispatch();
            $student = Student::find($id);

            if ($student)
            {
                $student->update([
                    'name' => $request->name,
                    'course' => $request->course,
                    'email' => $request->email,
                    'phone' => $request->phone,
                ]);

                return response()->json([
                    'status' => 200,
                    'message' => 'Data Updated Succesfully'
                ], 200);
            }
            else
            {
                return response()->json([
                    'status' => 404,
                    'message' => 'Student Not Found update'
                ], 404);
            }
        }
    }
    public function delete($id)
    {
        $student = Student::find($id);
        if ($student)
        {
            $student->delete();
            return response()->json([
                'message' => 'Deleted Succesfully'
            ], 200);
        }
        else
        {
            return response()->json([
                'status' => 404,
                'message' => 'No Student Found to delete'
            ], 404);
        }
    }
}