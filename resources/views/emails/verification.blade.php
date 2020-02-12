@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h6>Activation Code</h6>
                </div>
                <form method="POST" action="/verify/user/{{$token}}">

                    {{ csrf_field() }}


                <div class="card-body">

                        @if (session('warning'))
                        <div class="alert alert-warning">
                            {{ session('warning') }}
                        </div>
                        @endif




                        <div class="form-group">
                                <label for="example">Enter the Activation Code</label>
                                <input type="" class="form-control" id="example" aria-describedby="" placeholder="Enter Activation code" name="activationCode">
                                <small id="emailHelp" class="form-text text-muted">You're one step away from logging in your account. We just need to make sure if it's really you</small>
                              </div>
               


                </div>

                <div class="card-footer">
                        <div class="d-flex">
                            <div class="ml-auto">
                                <button type="submit" class="btn btn-success">Submit</button>
                                <a class="btn btn-secondary" href="/">Close</a>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
@endsection
