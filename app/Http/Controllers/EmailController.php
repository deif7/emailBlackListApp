<?php

namespace App\Http\Controllers;

use App\Email;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class EmailController extends Controller
{

    public function index()
    {

    }

    public function store(Request $request)
    {
        logger('testRequest', [$request->all()]);

        $requestData = [
            'email' => $request['bounce']['bouncedRecipients'][0]['emailAddress'],
            'type' => $request['bounce']['bounceType'],
            'status' => $request['bounce']['bouncedRecipients'][0]['status'],
            'timestamp' => $request['bounce']['timestamp']
        ];

        Email::create($requestData);

        return response('Success', '201');
    }


    public function show(Email $email)
    {
        $data = $email->where('email', request('email'))
        ->first();
        return [
            'email' => request('email'),
            'is_blacklisted' => isset($data['email'])
        ];
    }


    public function destroy(Request $request)
    {

        $data = Email::all()->firstWhere('email', request('email'));

        if (!isset($data['email'])) {
            return 'There is no such email.';
        }

        Email::destroy($data->id);

        return [
            'email' => request('email'),
            'deleted' => isset($data['email'])
        ];
    }
}
