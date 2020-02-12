@extends('layouts.app')

@section('content')




<div class="container py-3">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Register A User</div>

                <div class="card-body">
                        @include('layouts.errors')

                    <form method="POST" action="/users/store/">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-8">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-8">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-8">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-8">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row">
                                <label for="age" class="col-md-4 col-form-label text-md-right">Age</label>
    
                                <div class="col-md-8">
                                    <input id="age" type="number" class="form-control" name="age" value=""  >
                                </div>
                            </div>

                            
                            <div class="form-group row">
                                <label for="job" class="col-md-4 col-form-label text-md-right">Job</label>
    
                                <div class="col-md-8">
                                    <input id="job" type="text" class="form-control" name="currentRole" value=""  >
                                </div>
                            </div>


                            <div class="form-group row">
                                <label for="univ" class="col-md-4 col-form-label text-md-right">University</label>
    
                                <div class="col-md-8">
                                    <input id="univ" type="text" class="form-control" name="college" value=""  >
                                </div>
                            </div>


                            
                            <div class="form-group row">
                                <label for="phone" class="col-md-4 col-form-label text-md-right">Phone Number</label>
    
                                <div class="col-md-8">
                                    <input id="phone" type="number" class="form-control" name="phone" value=""  >
                                </div>
                            </div>



                            
                            <div class="form-group row">
                                    <label for="sexState" class="col-md-4 col-form-label text-md-right">Sex</label>
                                    <div class="col-md-8">
                                        <select id="sexState" class="form-control" name="sex" >

                                            <option value="">No input</option>

                                            <option value="Male" >Male</option>
                                            <option value="Female" >Female
                                            </option>

                                        </select>
                                    </div>
                                </div>



                                <div class="form-group row">
                                    <label for="url-input" class="col-md-4 col-form-label text-md-right">Facebook Profile Url</label>
                                    <div class="col-md-8">
                                      <input class="form-control" type="url" name="facebook"  id="url-input" value="">
                                    </div>
                                  </div>


                                  <div class="form-group row">
                                      <label for="url-input-instagram" class="col-md-4 col-form-label text-md-right">Instagram Profile Url</label>
                                      <div class="col-md-8">
                                        <input class="form-control" type="url"   name="instagram"   id="url-input-instagram" value="">
                                      </div>
                                    </div>


                                    <div class="form-group row">
                                        <label for="url-input-linkedin" class="col-md-4 col-form-label text-md-right">Linkedin Profile Url</label>
                                        <div class="col-md-8">
                                          <input class="form-control" type="url"  name="linkedin"   id="url-input-linkedin" value="">
                                        </div>
                                      </div>






                        <div class="form-group row">
                                <label for="exampleTextarea" class="col-md-4 col-form-label text-md-right">Biography</label>
                                <div class="col-md-8">
                                        <textarea class="form-control "  rows="10" id="editor" name="biography" ></textarea>
                                </div>
                       
                              </div>



                    



                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4 text-md-right">
                                <button type="submit" class="btn btn-primary">
                                    Add User
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection


@section('script')

<script>



</script>


@endsection