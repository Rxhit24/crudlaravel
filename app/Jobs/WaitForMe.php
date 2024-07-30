<?php

namespace App\Jobs;

// use App\Models\Student;
use App\Models\Student;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class WaitForMe implements ShouldQueue
{

    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        //-------------------------------------------
        // column Header
        $content = implode("," , ['Sr No.','Name','Course','Email','Phone']) . "\n";
        $id = 1;
        $start = microtime(true);

        
        $handle = fopen(public_path('sample8.csv'), 'w');
        fputcsv($handle, ['Sr No.','Name','Course','Email','Phone','Stream']);
        //column body
        Student::join('qualification','students.qualification_id','=', 'qualification.id')->select('qualification.stream','students.*')->chunk(5000, function($student) use($handle, $id){
            foreach($student->toArray() as $stu){
                // $content .= implode(',', array($id,$stu['name'],$stu['course'],$stu['email'],$stu['phone'],)). "\n";
                // $id = $id + 1;
                $data = array($id,$stu['name'],$stu['course'],$stu['email'],$stu['phone'],$stu['stream']);
                fputcsv($handle, $data);
                $id = $id+1;
            }
                //  Define the file name
            // $fileName = 'sample4Chunk.csv';

            // // Store the file in the local disk (storage/app directory)
            // Storage::disk('local')->put($fileName, $content);
        });
        
        fclose($handle);
        $end = microtime(true);
        error_log($end - $start);
        //-------------------------------------------
        

        // 
        // $content = 'my content its should be replaced by oiur program and a csv file is stored';
        // //  Define the file name
        //  $fileName = 'sample3Chunk.csv';

        //  // Store the file in the local disk (storage/app directory)
        //  Storage::disk('local')->put($fileName, $content);
 
         // Check if the file exists and return a response
        //  if (Storage::disk('local')->exists($fileName)) {
        //      return response()->json(['message' => 'File stored successfully'], 200);
        //  } else {
        //      return response()->json(['message' => 'Failed to store the file'], 500);
        //  }

        // //-------------------------------------------
        // $start = microtime(true);
        // // error_log($this->students);
        // $handle1 = fopen(public_path('sample9.csv'), 'w');
        // // fputcsv($handle1, ['Sr No.','Name','Course','Email','Phone','Stream']);
        // $id = 1;
        // foreach($this->students as $stu){
        //     $data = array($id,$stu['name'],$stu['course'],$stu['email'],$stu['phone'],$stu['stream']);
        //     $id = $id + 1;
        //     fputcsv($handle1, $data);
        // }

        // fclose($handle1);
        // $end = microtime(true);
        // error_log($end - $start);
    }
}
