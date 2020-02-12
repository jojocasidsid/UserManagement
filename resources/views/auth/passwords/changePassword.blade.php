@extends('layouts.app')

@section('content')



<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Settings</div>

                <div class="card-body">
                        @include('layouts.errors')

                    <form method="POST" action="/MustChangePass/change">
                        @csrf


                        <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">Temporary Password</label>
      
                                <div class="col-md-8">
                                    <input id="password" type="password" class="form-control" name="current_password" autocomplete="current-password">
                                </div>
                            </div>
      
                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">New Password</label>
      
                                <div class="col-md-8">
                                    <input id="new_password" type="password" class="form-control" name="new_password" autocomplete="current-password">
                                </div>
                            </div>
      
                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">New Confirm Password</label>
        
                                <div class="col-md-8">
                                    <input id="new_confirm_password" type="password" class="form-control" name="new_confirm_password" autocomplete="current-password">
                                </div>
                            </div>

                            

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4 text-md-right">
                                <button type="submit" class="btn btn-warning">
                                    Update Settings
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
