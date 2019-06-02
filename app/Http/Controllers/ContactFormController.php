<?php

namespace App\Http\Controllers;

use App\ContactForm;
use App\Http\Requests\ContactFormRequest;
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
        $contact_forms = ContactForm::latest()->get();

        return view('contact.index', [
            'contact_forms' => $contact_forms,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        session()->reflash();
        return redirect(route('contact'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ContactFormRequest $request)
    {
        $contact_form = ContactForm::create($request->validated());

        session()->flash('success_message', __('portfolio.contact_form.success_message'));
        return redirect(route('contact-form.create', $contact_form->id));
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
