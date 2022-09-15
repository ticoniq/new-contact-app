<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ContactRequest;
use App\Models\Contact;
use App\Models\Company;
use App\Models\User;

class ContactController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }
    
    public function index() {
        $user = auth()->user();
        $companies = Company::userCompanies();
        $contacts = $user->contacts()->with('company')->latestFirst()->paginate(10);
        return view('contacts.index', compact('contacts', 'companies'));
    }

    public function create() {
        $companies = Company::userCompanies();
        return view('contacts.create', compact('companies'));
    }

    public function store(ContactRequest $request) {
        $request->user()->contacts()->create($request->all());
        return redirect()->route('contacts.index')->with('message', 'Contact created sucessfully');
    }

    public function edit(Contact $contact) {
        $companies = Company::userCompanies();
        return view('contacts.edit', compact('contact', 'companies'));
    }

    public function update(Contact $contact, ContactRequest $request) {
        $contact->update($request->all());
        return redirect()->route('contacts.index')->with('message', 'Contact updated sucessfully');
    }

    public function destroy(Contact $contact) {
        $contact->delete();
        return redirect()->route('contacts.index')->with('message', 'Contact deleted successfully');
    }

    public function show(Contact $contact) {
        return view('contacts.show', compact('contact'));
    }
}
