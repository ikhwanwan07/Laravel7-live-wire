<?php

namespace App\Http\Livewire;

use App\Contact;
use Livewire\Component;
use Livewire\WithPagination;

class ContactIndex extends Component
{

    public $statusUpdate = false;
    public $paginate = 5;
    public $search;


    protected $listeners = [
        'contactStored' => 'handleStored',
        'contactUpdate' => 'handleUpdate'
    ];
    protected $updatesQueryString = ['search'];

    public function mount()
    {
        $this->search = request()->query('search', $this->search);
    }
    public function render()
    {

        return view('livewire.contact-index', [
            'contact' => $this->search === 'null' ?
                Contact::latest()->paginate($this->paginate) :
                Contact::latest()->where('name', 'like', '%' . $this->search . '%')->paginate($this->paginate)
        ]);
    }



    public function getContact($id)
    {
        $this->statusUpdate = true;
        $contact = Contact::find($id);
        $this->emit('getContact', $contact);
    }

    public function delete($id)
    {
        if ($id) {
            $contact = Contact::find($id);
            $contact->delete();
            session()->flash('message', 'Contact  telah di hapus');
        }
    }

    public function handleStored($contact)
    {
        //dd($contact);
        session()->flash('message', 'Contact ' . $contact['name'] . ' telah ditambah');
    }
    public function handleUpdate($contact)
    {
        //dd($contact);
        session()->flash('message', 'Contact ' . $contact['name'] . ' telah diupdate');
    }
}
