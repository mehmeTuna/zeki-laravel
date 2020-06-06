<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateWorkerRequest;
use App\Http\Requests\WorkerCreateRequest;
use App\Worker;
use Illuminate\Http\Request;

class WorkerController extends Controller
{
    public function loginPage()
    {
        return view('worker.login');
    }
    public function login(Request $request)
    {
        $worker = Worker::where('email', $request['email'])->first();

        if(!password_verify($request->password, $worker->password)){
            return redirect('/admin/giris');
        }

        session()->push('workerId', $worker->id);
        return redirect('calisan');
    }

    public function index()
    {
        return view('worker.index');
    }

    public function create(WorkerCreateRequest $request)
    {
        $authority = [0, 1, 2];
        if(!in_array($request['authority'], $authority)){
            return response()->json(['status' => 'tanimlanmayan yetki']);
        }
        $calisan = Worker::create([
            'email' => $request['email'],
            'password' => password_hash($request['password'], PASSWORD_DEFAULT),
            'name' => $request['name'],
            'm_date' => time(),
            'ip' => $request->getClientIp(),
            'authority' => $request['authority'],
            'store_id' => $request['storeId']
        ]);
        return response()->json(['status' => 'ok']);
    }

    public function update(UpdateWorkerRequest $request)
    {
        $authority = [0, 1, 2];
        if(isset($request['authority'])){
            if(!in_array($request['authority'], $authority)){
                return response()->json(['status' => 'tanimlanmayan yetki']);
            }
        }
        $worker = Worker::where('id', $request['id'])->update(['authority' => $request['authority'] ]);
        return response()->json(['status' => 'ok']);
    }

    public function delete(Request $request)
    {
        $calisan = Worker::where('id', $request['id'])->delete();
        return response()->json(['status' => 'ok']);
    }

    public function list()
    {
        $worker = Worker::with('store')->get();
        return response()->json($worker);
    }

}
