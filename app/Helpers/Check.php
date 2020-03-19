<?php

namespace App\Helpers;
use Request;
use Illuminate\Support\Facades\DB;

class Check
{
    public static function fileExist($url , $fullURL = false) {
        if(!$fullURL){
            $url = url('/') . $url;
        }
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_NOBODY, true);
        curl_exec($ch);
        $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    
        if ($code == 200) {
            $status = true;
        } else {
            $status = false;
        }
        curl_close($ch);
        return $status;
    }

    public static function taskStatus($task_id)
    {
        $task = \App\Task::findOrFail($task_id);
        // dd($task);
        if (!$task) {
            return null;
        }

        if ($task->status == 2) {
            return [
                'status'=>$task->status,
                'status_en'=>'done',
                'status_th'=> 'ทำเสร็จแล้ว',
                'badge'=>'success',
                'percent'=> 100,
                'icon'=> 'fas fa-check'
            ];
        }

        if ( $task->start_date > date('Y-m-d H:i:s') ) {
            return [
                'status'=>$task->status,
                'status_en'=>'todo',
                'status_th'=> 'ที่จะทำ',
                'badge'=>'info',
                'percent'=> 0,
                'icon'=> 'fas fa-water'
            ];
        }

        // echo "Start => ".$task->start_date."<br>";
        // echo "Present => ". date('Y-m-d H:i:s');
        // dd($task->start_date <= date('Y-m-d H:i:s'));

        if ( $task->start_date <= date('Y-m-d H:i:s') && $task->end_date >= date('Y-m-d H:i:s') ) {
            return [
                'status'=>$task->status,
                'status_en'=>'inprogress',
                'status_th'=> 'กำลังทำ',
                'badge'=>'warning',
                'percent'=> 50,
                'icon'=> 'fas fa-tasks'
            ];
        }

        if (  date('Y-m-d H:i:s') > $task->end_date ) {
            return [
                'status'=>$task->status,
                'status_en'=>'late',
                'status_th'=> 'เกินกำหนดเวลา',
                'badge'=>'danger',
                'percent'=> 50,
                'icon'=> 'fas fa-clock'
            ];
        }

        return [
            'status'=>$task->status,
            'status_en'=>'no condition',
            'status_th'=> 'ไม่รู้สถานะ',
            'badge'=>'primary',
            'percent'=> 0,
            'icon'=> 'fas fa-not-equal'
        ];
    }

}

