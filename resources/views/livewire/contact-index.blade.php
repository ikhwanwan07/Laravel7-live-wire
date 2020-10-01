<div>

    @if (session()->has('message'))
    <div class="alert alert-success">
        {{ session('message') }}
    </div>
        
    @endif
    
    @if ($statusUpdate)
    <livewire:contact-update></livewire:contact-update>
    @else
    <livewire:contact-create></livewire:contact-create>
    @endif
    <hr>
    <div class="row">
        <div class="col">
                <select  class="form-control form-control-sm w-auto">
                    <option value="5">5</option>
                    <option value="10">10</option>
                    <option value="15">15</option>
                    <option value="20">20</option>
                </select>
          
        </div>
   
  
        <div class="col">
    <input wire:model="search" type="text" class="form-control form-control-sm " placeholder="search">
        </div>
    </div>
  


    <hr>
    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th scope="col">No</th>
                <th scope="col">Name</th>
                <th scope="col">Phone</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php $no= 0; ?>
            @foreach ($contact as $contacts)
            <?php $no++; ?>
            <tr>
                <td>{{ $no }}</td>
                <td>{{ $contacts->name }}</td>
                <td>{{ $contacts->phone }}</td>
                <td>
                    <button wire:click="getContact({{ $contacts->id }})" type="submit" class="btn btn-info text-white">Edit</button>
                    <button wire:click="delete({{ $contacts->id }})" type="submit" class="btn btn-danger text-white">Hapus </button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $contact->links() }}
</div>
