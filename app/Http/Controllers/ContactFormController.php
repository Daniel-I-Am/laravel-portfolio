<?php

namespace App\Http\Controllers;

use App\ContactForm;
use Illuminate\Http\Request;

class ContactFormController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return redirect(route('contact'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated_data = $request->validate([
            'email' => 'required|email|max:191',
            'name' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        $contact_form = new ContactForm();

        $contact_form->email = $validated_data['email'];
        $contact_form->name = $validated_data['name'];
        $contact_form->message = $validated_data['message'];

        $contact_form->save();

        return redirect(route('contact-form.show', $contact_form->id));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ContactForm  $contactForm
     * @return \Illuminate\Http\Response
     */
    public function show(ContactForm $contactForm)
    {
        //
    }
}
