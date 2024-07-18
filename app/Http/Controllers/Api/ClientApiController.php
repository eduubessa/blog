<?php

namespace App\Http\Controllers\Api;

use App\Helpers\Interfaces\UserInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\ClientStoreRequest;
use App\Http\Requests\ClientUpdateRequest;
use App\Models\Client;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ClientApiController extends Controller
{
    //
    public function index(Request $request)
    {
        return response()->json([
            'status' => 200,
            'phrase' => 'ok',
            'clients' => Client::with('user')->whereNull('deleted_at')->get()
        ]);
    }

    public function store(ClientStoreRequest $request)
    {
        if (!$request->validated()) {
            return back()->withInput()->withErrors($request->errors());
        }

        $user = new User();
        $user->avatar_id = 1;
        $user->firstname = encrypt_data($request->input('firstname'));
        $user->lastname = encrypt_data($request->input('lastname'));
        $user->email = $request->input('email');
        $user->mobile_phone = $request->input('mobile-phone');
        $user->birth_date = strtotime($request->input('date-birth')) ? date('Y-m-d', strtotime($request->input('date-birth'))) : $request->input('date-birth');
        $user->type = UserInterface::TYPE_CLIENT;
        $user->status = UserInterface::STATUS_ACTIVE;

        if(!$user->save()){
            Log::error('CLIENT | USER STORE | ERROR: '.$user->errors() .' | IP ADDRESS: ' . $request->ip());
            return back()->withInput()->withErrors($user->errors());
        }

        $client = Client::with('tags')->where('user_id', $user->id)->firstOrFail();
        $client->address_line_1 = encrypt_data($request->input('address-line-1'));
        $client->address_line_2 = encrypt_data($request->input('address-line-2'));
        $client->city = encrypt_data($request->input('city'));
        $client->state = encrypt_data($request->input('state'));
        $client->country = encrypt_data($request->input('country'));
        $client->postcode = encrypt_data($request->input('postcode'));

        if(!$user->client()->save($client)){
            Log::error('CLIENT | CLIENT STORE | ERROR: '.$client->errors() .' | IP ADDRESS: ' . $request->ip());
            return back()->withInput()->withErrors($client->errors());
        }

        return redirect()->route('clients.index')->with('success', 'Client created successfully');
    }

    public function update(ClientUpdateRequest $request, string $username)
    {
        if (!$request->validated()) {
            return back()->withInput()->withErrors($request->errors());
        }

        $user = User::where('username', $username)->firstOrFail();
        $user->avatar_id = 1;
        $user->firstname = encrypt_data($request->input('firstname'));
        $user->lastname = encrypt_data($request->input('lastname'));
        $user->email = $request->input('email');
        $user->mobile_phone = $request->input('mobile-phone');
        $user->birth_date = strtotime($request->input('date-birth')) ? date('Y-m-d', strtotime($request->input('date-birth'))) : $request->input('date-birth');
        $user->type = UserInterface::TYPE_CLIENT;
        $user->status = UserInterface::STATUS_ACTIVE;

        if(!$user->save()){
            Log::error('CLIENT | USER STORE | ERROR: '.$user->errors() .' | IP ADDRESS: ' . $request->ip());
            return back()->withInput()->withErrors($user->errors());
        }

        $client = Client::with('tags')->where('user_id', $user->id)->firstOrFail();
        $client->address_line_1 = encrypt_data($request->input('address-line-1'));
        $client->address_line_2 = encrypt_data($request->input('address-line-2'));
        $client->city = encrypt_data($request->input('city'));
        $client->state = encrypt_data($request->input('state'));
        $client->country = encrypt_data($request->input('country'));
        $client->postcode = encrypt_data($request->input('postcode'));

        if(!empty($request->input('tags'))){
            $tags = explode(';', $request->input('tags'));

            foreach($tags as $tag){
                Tag::where('slug', $tag)->firstOrFail()->clients()->attach($client->id);
            }
        }

        if(!$client->save()){
            Log::error('CLIENT | CLIENT UPDATE | ERROR: '.$client->errors() .' | IP ADDRESS: ' . $request->ip());
            return back()->withInput()->withErrors($client->errors());
        }

        return redirect()->route('clients.index')->with('success', 'Client created successfully');
    }
}

