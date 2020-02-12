@extends('layouts.app')

@section('content')

<div class="container py-3">

    <div class="col-12">

        <div class="row">


            <div class="col-md-6">

                <div class="col-12 py-3">

                    <div class="card">
                        <div class="card-header">
                            <h5><i class="fa fa-cog"></i> Two Factor Authentication</h5>
                        </div>

                        <div class="card-body">

                            <h6><b> Enable/Disable Two Factor Authentication</b></h6>
                            <br>


                            <p>Two factor authentication (2FA) strengthens access security by requiring two methods
                                (also referred to as factors) to verify your identity. Two factor authentication
                                protects against phishing, social engineering and password brute force attacks and
                                secures your logins from attackers exploiting weak or stolen credentials.</p>

                            <br>



                            <div class="d-flex">
                                <div class="ml-auto">
                                    <a href="/2fa" class="btn btn-primary  ml-1  btn-text ">Enable/Disable 2FA
                                    </a>

                                </div>
                            </div>


                        </div>

                    </div>
                </div>


            </div>


            <div class="col-md-6">
                <div class="col-12 py-3">

                    <div class="card">
                        <div class="card-header">
                            <h5><i class="fa fa-cog"></i> Settings</h5>
                        </div>
                        <div class="card-body">
                            <h6 class=""> <b>User Profile</b></h6>
                            <br>

                            <div class="col-12">
                                    @include('layouts.errors')
                                    @if (session('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                      @endif
                      
                                </div>


                                <h6>Change your Email</h6>
                                <div class="button">
                                        <a href="#" class="btn btn-primary btn"  type="submit"
                                        data-toggle="modal" data-target="#editEmail" >Update Email <i class="fa fa-pencil"></i></a>
                                      </div>


                                <br>



                            <h6>Password should be updated in a regular basis</h6>
                            <div class="button">
                                    <a href="#" class="btn btn-warning btn"  type="submit"
                                    data-toggle="modal" data-target="#editPass" >Update Password <i class="fa fa-pencil"></i></a>
                                  </div>
                            <br>

                       
                        </div>
                    </div>
                </div>

            </div>

        </div>


    </div>



</div>







<div class="modal fade" id="editPass" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <form action="/Settings/Update" method="POST" enctype="multipart/form-data">
      
      
              {{csrf_field()}}
      
              <div class="modal-header">
                <h5 class="modal-title" id="">Update Password</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
      
              <div class="modal-body">
                
                            @csrf

                            <div class="form-group">
                                    <label for="password" class=" col-12 col-form-label">Current Password</label>
                            
                                    <div class="col-md-12">
                                        <input id="password" type="password" class="form-control"
                                            name="current_password" autocomplete="current-password">
                                    </div>
                                </div>
                            
                                <div class="form-group">
                                    <label for="password" class=" col-12  col-form-label">New Password</label>
                            
                                    <div class="col-md-12">
                                        <input id="new_password" type="password" class="form-control"
                                            name="new_password" autocomplete="current-password">
                                    </div>
                                </div>
                            
                                <div class="form-group">
                                    <label for="password" class="col-form-label  col-12 ">New Confirm
                                        Password</label>
                            
                                    <div class="col-md-12">
                                        <input id="new_confirm_password" type="password" class="form-control"
                                            name="new_confirm_password" autocomplete="current-password">
                                    </div>
                                </div>
    
              </div>
      
              <div class="modal-footer">
             
                <button type="button" class="btn btn-secondary px-4" data-dismiss="modal">Close</button>
    
                <button type="submit" class="btn btn-warning">Update Password</button>
              </div>
      
            </form>
          </div>
        </div>
      </div>
      
      






      <div class="modal fade" id="editEmail" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
              <div class="modal-content">
                <form action="/Settings/Email" method="POST" enctype="multipart/form-data">
          
          
                  {{csrf_field()}}
          
                  <div class="modal-header">
                    <h5 class="modal-title" id="">Update Email</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
          
                  <div class="modal-body">
                    
                                @csrf
                                <div class="form-group">
                                        <label for="email"
                                            class="col-form-label  col-12 ">{{ __('E-Mail Address') }}</label>
                                        <div class="col-md-12">
                                            <input id="email" type="email"
                                                class="form-control @error('email') is-invalid @enderror" name="email"
                                                value="{{ Auth::user()->email }}" required autocomplete="email">
                                
                                            @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                
                             
                  </div>
          
                  <div class="modal-footer">
                 
                    <button type="button" class="btn btn-secondary px-4" data-dismiss="modal">Close</button>
        
                    <button type="submit" class="btn btn-warning">Update Email</button>
                  </div>
          
                </form>
              </div>
            </div>
          </div>
          
          
    
    
    
    
{{-- 

<form method="POST" action="/Settings/Update/">
    @csrf
  



    <br>


    <div class="form-group">
        <div class="col-md-8 offset-md-4 text-md-right">
            <button type="submit" class="btn btn-warning">
                Update Settings
            </button>
        </div>
    </div>
</form> --}}


@endsection