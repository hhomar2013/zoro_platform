<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class UsersComponent extends Component
{


    public $username , $email , $password ,$user_id;

    public $search;

    protected $queryString = ['search'];

    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'username'=>'required',
            'email'=>'required|email',
            'password'=>'required|min:5',
        ]);
    }
    public function empty()
    {
        $this->user_id ='';
        $this->username = '';
        $this->email = '';
        $this->password='';
    }

    public function save_user()
    {
        $this->validate([
            'username'=>'required',
            'email'=>'required|email',
            'password'=>'required|min:5'
        ]);

      $users = User::query()->create([
           'name'=>$this->username,
           'email'=>$this->email,
           'password'=>bcrypt($this->password),
        ]);
      if ($users){
        session()->flash('message', 'Done save User'. $this->username);
        $this->empty();
      }
        $this->dispatchBrowserEvent('close-modal');
    }

    public function edit_user($id)
    {
        $this->empty();
        $user = User::find($id);
        $this->user_id = $user->id;
        $this->username = $user->name;
        $this->email = $user->email;
    }

    public function edit_user_data()
    {
        $id = $this->user_id;
        $user = User::find($id);
        $user->update([
           'name'=>$this->username,
           'email'=>$this->email,
        ]);

        session()->flash('message', 'Done update User'. $this->username);
        $this->empty();
    }

    public function delete_user($id)
    {
        $this->empty();
        $user = User::find($id);
        $this->user_id = $user->id;
        $this->username = $user->name;
    }

    public function delete_user_data()
    {
        $id = $this->user_id;
        $user = User::findOrFail($id);
        $user->delete();
        session()->flash('message', 'Done delete User'. $this->username);
        $this->empty();
    }

    public function render()
    {
        $users = User::where('email','like','%'.$this->search.'%')->orwhere('name','like','%'.$this->search.'%')->paginate(3);
        return view('livewire.users-component',['users'=>$users])->layout('livewire.layouts.base');
    }

}
