<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreContactRequest;
use App\Models\Contact;
use Illuminate\Auth\Access\Response as AccessResponse;
use Illuminate\Http\Client\Response as ClientResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response as HttpResponse;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Response;
use Spatie\FlareClient\Http\Response as FlareClientHttpResponse;

class ContactController extends Controller
{
  
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $contacts = auth()
                    ->user()
                    ->contacts()
                    ->orderBy('name', 'desc')
                    ->paginate(5);
        // dd($contacts);
        return view('contacts.index', ['contacts' => $contacts]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('contacts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreContactRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('profile_picture')) {
            $path = $request->file('profile_picture')->store('profiles', 'public');
            $data['profile_picture'] = $path;
        }

        $contact = auth()->user()->contacts()->create($data);

        Cache::forget(auth()->id());

        return redirect('home')->with('alert', [
            'message' => "Contact $contact->name successfully saved",
            'type' => 'success',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Contact $contact)
    {
        $this->authorize('view', $contact);
        return view('contacts.show', ['contact' => $contact]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Contact $contact)
    {
        $this->authorize('update', $contact);

        return view('contacts.edit', compact('contact'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreContactRequest $request, Contact $contact)
    {
        $this->authorize('update', $contact);

        $data = $request->validated();

        if ($request->hasFile('profile_picture')) {
            $path = $request->file('profile_picture')->store('profiles', 'public');
            $data['profile_picture'] = $path;
        }

        $contact->update($data);

        Cache::forget(auth()->id());

        return redirect('home')->with('alert', [
            'message' => "Contact $contact->name successfully updated",
            'type' => 'success',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contact $contact)
    {
        $this->authorize('delete', $contact);

        $contact->delete();  

        return back()->with('alert', [
            'message' => "Contact $contact->name successfully delete",
            'type' => "danger"
        ]);
    }
}
