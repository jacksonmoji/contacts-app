<?php

namespace App\Http\Controllers;

use App\Contact;
use App\User;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('manage','App\Contact');
        $contacts = Contact::all();
        return view('contact.index', [
                'contacts' => $contacts
            ]);
    }

    public function getContacts(){

        $this->authorize('manage','App\Contact');
        $contacts = Contact::orderBy('display_order')->get();
        return ['success' => true, 'contacts' => Contact::all()];

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $contacts = new Contact();
        $contacts->First_name = "asdggfhgdh";
        $contacts->surname = "asdfsdgsadg";
        $contacts->country_code = "435345";
        $contacts->phone = 3424234253;
        $contacts->user_key = 1;
        $contacts->save();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, User $user)
    {

        $this->authorize('manage','App\Contact');
        $contacts = $request->post('contacts');
        Contact::updateOrCreate($contacts, ['user_key' => $user->id]);
        return ['success' => true, 'contacts' => Contact::all()];
       
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function show(Contact $contact)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function edit(Contact $contact)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $this->authorize('manage','App\Contact');
        $contacts = $request->post('contacts');
        foreach ($contacts as $contact) {
            Contact::updateOrCreate(['id' => $contact['id']], $contact);
        }
        return ['success' => true, 'contacts' => Contact::all()];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contact $contact)
    {
        $this->authorize('delete',$contact);
        $contact->delete();
        return  ['success' => true];
    }
}
