<div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                      <div class="row">
                          <div class="col-12">
                              <h3 style="float: left">Users</h3>
                              <button class="btn btn-primary" style="float: right;" data-bs-toggle="modal" data-bs-target="#exampleModal">add new user</button>
                          </div>

                          <div class="col-12">
                              <input type="text" name="" id="" class="from-control" style="float: left;" wire:model="search" /> &nbsp; &nbsp;
                              <button class="btn btn-primary" style="float: left;" data-bs-toggle="modal" data-bs-target="#exampleModal">add new user</button>

                          </div>
                      </div>


                    </div>
                    <div class="card-body">

                    @if (session()->has('message'))
                            <div class="alert alert-success text-center">{{ session('message') }}</div>
                    @endif

                    <table class="table">
                        <thead>
                            <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col" style="text-align: center;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        @if($users->count() > 0)
                                @foreach($users as $val)
                                    <tr>
                                        <th scope="row">{{ $val->id }}</th>
                                        <td>{{$val->name}}</td>
                                        <td>{{$val->email}}</td>
                                        <td style="text-align: center;">
                                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editexampleModal" wire:click="edit_user({{$val->id}})">edit</button>
                                            <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete_exampleModal" wire:click="delete_user({{$val->id}})">Delete</button>

                                        </td>
                                    </tr>
                                @endforeach
                        @endif

                        </tbody>
                     </table>

                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- start Modal -->

<!-- Modal -->
<div wire:ignore.self class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Add User</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
          <form wire:submit.prevent="save_user">
              <div wire:loading >loading ...</div>
                <div class="form-group row">
                    <label for="username">User Name</label>
                    <input type="text" name="username" id="username" class="form-control" wire:model.defer="username"/>
                    @error('username')
                        <span class="text-danger" style="font-size:11px;">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group row">
                    <label for="email">email</label>
                    <input type="email" name="email" id="email" class="form-control" wire:model.defer="email"/>
                    @error('email')
                        <span class="text-danger" style="font-size:11px;">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group row">
                    <label for="password">password</label>
                    <input type="password" name="password" id="password" class="form-control" wire:model.defer="password"/>
                    @error('password')
                        <span class="text-danger" style="font-size:11px;">{{ $message }}</span>
                    @enderror
                </div>
          <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Save changes</button>
              <button type="button" hidden class="btn btn-secondary" id="close" data-bs-dismiss="modal">Close</button>
      </form>
      </div>


    </div>
  </div>
</div>
<!-- End Modal -->

    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="editexampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit User</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <form wire:submit.prevent="edit_user_data">
                        <div class="form-group row">
                            <label for="username">User Name</label>
                            <input type="hidden" name="username" id="user_id" class="form-control" wire:model="user_id"/>
                            <input type="text" name="username" id="username" class="form-control" wire:model="username"/>
                            @error('username')
                            <span class="text-danger" style="font-size:11px;">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group row">
                            <label for="email">email</label>
                            <input type="email" name="email" id="email" class="form-control" wire:model="email"/>
                            @error('email')
                            <span class="text-danger" style="font-size:11px;">{{ $message }}</span>
                            @enderror
                        </div>

{{--                        <div class="form-group row">--}}
{{--                            <label for="password">password</label>--}}
{{--                            <input type="password" name="password" id="password" class="form-control" wire:model="password" value=""/>--}}
{{--                            @error('password')--}}
{{--                            <span class="text-danger" style="font-size:11px;">{{ $message }}</span>--}}
{{--                            @enderror--}}
{{--                        </div>--}}
                        <hr>
                        <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Edit</button>
                        <button type="button" hidden class="btn btn-secondary" id="close" data-bs-dismiss="modal">Close</button>
                    </form>
                </div>


            </div>
        </div>
    </div>
    <!-- End Modal -->

    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="delete_exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Delete User</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <form wire:submit.prevent="delete_user_data">
                        <div class="form-group row">
                            <label for="username">User Name</label>
                            <input type="hidden" name="username" id="user_id" class="form-control" wire:model="user_id"/>
                            <input type="text" name="username" id="username" class="form-control" wire:model="username" disabled/>
                            @error('username')
                            <span class="text-danger" style="font-size:11px;">{{ $message }}</span>
                            @enderror
                        </div>



                        <hr>
                        <button type="submit" class="btn btn-danger" data-bs-dismiss="modal">Delete</button>
                        <button type="button" hidden class="btn btn-secondary" id="close" data-bs-dismiss="modal">Close</button>
                    </form>
                </div>


            </div>
        </div>
    </div>
    <!-- End Modal -->

</div>

@push('scripts')
    <script>
            // window.addEventListener('close-modal')
            // {
            //     $('#exampleModal').modal('hide');
            // }


            var myModalEl = document.getElementById('exampleModal');
            myModalEl.addEventListener('hidden.bs.modal', function (event) {
                myModalEl.hide();
            })

            setTimeout(function () {
               document.getElementsByClassName('alert').style.display = "none";
            },2000)
    </script>
@endpush
