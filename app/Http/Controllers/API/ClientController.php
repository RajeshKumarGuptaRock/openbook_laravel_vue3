<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Contact;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Client::with('contact')->get();
        $response = [
            'success' => true,
            'data' => $data,
            'message' => "Client fetch successfully"
        ];

        return response()->json($response, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validator here...
        $validator = Validator::make($request->all(), [
            'company_name' => 'required',
            'address' => 'required',
            'cmp_phone' => 'required',
            'client_name' => 'required',
            'client_email' => 'required',
            'client_phone' => 'required',
        ]);
        if ($validator->fails()) {
            $response = [
                'success' => false,
                'message' => $validator->errors()
            ];
            return response()->json($response, 400); //Status code 400 for validation error
        }

        $input = $request->all();
        $client = new Client();
        $client->company_name = $request['company_name'];
        $client->address = $request['address'];
        $client->cmp_phone = $request['cmp_phone'];
        $client->save();

        $contact = new Contact();
        $contact->name = $request['client_name'];
        $contact->email = $request['client_email'];
        $contact->phone = $request['client_phone'];
        $contact->client_id = $client->client_id;

        $contact->save();

        $response = [
            'success' => true,
            'data' => $input,
            'message' => "Client added successfully"
        ];
        return response()->json($response, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //validator here...
        $validator = Validator::make($request->all(), [
            'company_name' => 'required',
            'address' => 'required',
            'cmp_phone' => 'required',
        ]);
        if ($validator->fails()) {
            $response = [
                'success' => false,
                'message' => $validator->errors()
            ];
            return response()->json($response, 400); //Status code 400 for validation error
        }

        $client = Client::find($id);
        $client->company_name = $request['company_name'];
        $client->address = $request['address'];
        $client->cmp_phone = $request['cmp_phone'];
        $client->save();

        $contact = Contact::where('client_id', $id)->first();
        $contact->name = $request['client_name'];
        $contact->email = $request['client_email'];
        $contact->phone = $request['client_phone'];
        $contact->save();

        $input = $request->all();

        $response = [
            'success' => true,
            'data' => $input,
            'message' => "Client updated successfully"
        ];

        return response()->json($response, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Client::find($id)->delete();
        $response = [
            'success' => true,
            'data' => $id,
            'message' => "Client deleted successfully"
        ];
        return response()->json($response, 200);
    }

    public function search($name)
    {
        $result = Client::with('contact')->where('address', 'LIKE', '%'. $name. '%')->get();
        if(count($result)){
            $response = [
                'success' => true,
                'message' => "success",
                'data' => $result
            ];
            return response()->json($response, 200);
         
        }
        else
        {
            $response = [
                'success' => false,
                'message' => "No data found..",
            ];
            return response()->json($response, 200);
      }
    }
}
