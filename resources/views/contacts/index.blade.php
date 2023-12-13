@extends('layouts.app')

@section('content')
<div class="container">
    @forelse ($contacts as $contact)
    <div class="d-flex justify-content-between bg mb-3 rounded px-4 py-2">
       
          <a href="{{ route('contacts.show', $contact->id) }}">
            <img class="profile-picture" src="/img/logo.png
            " >
          </a>

        <div class="d-flex align-items-center">
            <p class="me-2 mb-0">{{ $contact->name }}</p>
            <p class="me-2 mb-0 d-none d-md-block">
              <a href="mailto:{{ $contact->email }}">
                {{ $contact->email }}
              </a>
            </p>
            <p class="me-2 mb-0 d-none d-md-block">
              <a href="tel:{{ $contact->phone_number }}">
                {{ $contact->phone_number }}
              </a>
            </p>

            

          <a class="btn btn-secondary mb-0 me-2 p-1 px-2"
          href="{{ route('contacts.edit', $contact->id) }}">
          <x-icon icon="pencil" />
        </a>

          <form action="{{ route('contacts.destroy', $contact->id) }}"
            method="POST">
            @csrf
            @method("DELETE")
            <button type="submit" class="btn btn-danger mb-0 p-1 px-2">
              <x-icon icon="trash" />
            </button>
          </form>
        </div>



    </div>
  
   
    @empty
    
    @endforelse
</div>
@endsection

            {{-- {{ Storage::url($contact->profile_picture) }} --}}