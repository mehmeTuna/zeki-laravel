<?php

namespace App\Http\Controllers;

use App\Http\Requests\KuryeCreateRequest;
use App\Kurye;
use Illuminate\Http\Request;
use PDF;

class KuryeController extends Controller
{
    public function create(KuryeCreateRequest $request)
    {
        $kurye = Kurye::create([
            'firstname' => $request['firstname'],
            'lastname' => $request['lastname'],
            'username' => $request['username'],
            'date' => time(),
            'password' => password_hash($request['password'], PASSWORD_DEFAULT)
        ]);

        return response()->json(['status' => 'ok']);
    }

    public function delete(Request $request)
    {
        $kurye = Kurye::where('id', $request['id'])->update(['active' => 0]);

        return response()->json(['status' => 'ok']);
    }

    public function pdfList()
    {
        $allKurye = [];
        $kurye = Kurye::all();

        foreach ($kurye as $key => $value){
            $allKurye[$key]['active'] = $kurye[$key]['active'];
            $allKurye[$key]['name'] = $kurye[$key]['firstname'].' '.$kurye[$key]['lastname'];
            $allKurye[$key]['dayOrderCount'] = $kurye[$key]->dayOrderCount->count();
            $allKurye[$key]['monthOrderCount'] = $kurye[$key]->monthOrderCount->count();
            $allKurye[$key]['yearOrderCount'] = $kurye[$key]->yearOrderCount->count();
        }

        $pdf = PDF::loadView('pdfTemplate.kuryeList', ['kurye' => $allKurye],[], [
            'mode' => 'utf-8',
            "default_font_size"=>10,
        ]);
        return $pdf->stream('kuryeList.pdf');
    }

    public function list()
    {
        $kuryeList = [];
        $kurye = Kurye::where('active', 1)->get();
        foreach ($kurye as $key => $value){
            $data = [];
            $data['id'] = $value['id'];
            $data['name'] = $value['firstname'].' '.$value['lastname'];
            $data['count'] = $value->orderCount();
            $kuryeList[] = $data;
        }

        return response()->json($kuryeList);
    }
}
