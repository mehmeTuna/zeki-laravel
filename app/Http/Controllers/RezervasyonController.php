<?php

namespace App\Http\Controllers;

use App\Rezervasyon;
use Illuminate\Http\Request;

class RezervasyonController extends Controller
{
    public function getRezervasyon()
    {
        $oneDayBeforeTime = time() - 24 * 60 * 60 ;
        $rezervasyon = Rezervasyon::where('time', '>=', $oneDayBeforeTime)->get();

        $data = [
            'wait' => 0, //0
            'success' => 0,//1
            'cancel' => 0,//2
            'waitList' => [],
            'successList' => [],
            'cancelList' => []
        ];
        if ($rezervasyon == null){
            return response()->json($data);
        }

        foreach ($rezervasyon as $key => $value){
            switch ($value->m_status){
                case 0:
                    $data['wait']++;
                    $data['waitList'][] = $value;
                    break;
                case 1:
                    $data['success']++;
                    $data['successList'][] = $value;
                    break;
                case 2:
                    $data['cancel']++;
                    $data['cancelList'][] = $value;
                    break;
            }
        }

        return response()->json([
            'status' => true,
            'data' => $data
        ]);
    }
    public function update(Request $request)
    {
        $rezerType = ['iptal', 'onay'];
        $updateData = [];
        if(in_array($request['status'], $rezerType)){
            switch ($request['status']){
                case 'onay':
                    $updateData['m_status']= 1;
                    break;
                case 'iptal':
                     $updateData['m_status'] = 2;
                     break;
            }
            $rezervasyon = Rezervasyon::where('id', $request['id'])->update($updateData);
            if($rezervasyon){
                return  response()->json(['status' => true , 'text' => 'basarili']);
            }
        }

        return response()->json(['status' => false , 'text' => 'gecersiz id']);
    }
}
