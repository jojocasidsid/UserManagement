@extends('layouts.app')

@section('content')






<header class="header">

  <img class="card-img-top img-fit"
    src="{{$account->cover == "" ?  url('storage/images/0/hello.jpg'):url('storage/'.$account->cover) }}"
    height="300px">
  <div class="card-body text-center">
    <img class="avatar rounded-circle" src="{{
              $account->picture == ""? url('storage/images/0/hi.png'):url('storage/'.$account->picture) }}"
    >
    <h4 class="card-title"><strong>{{$account->name}}</strong></h4>
    <h6 class="card-subtitle mb-2 text-muted"> {{$account->currentRole == ""? "None":$account->currentRole}}
    </h6>
    <p class="card-text"><i class="fa fa-user fa-fw"></i> {{$account->roles}} </p>

    <a href="mailto:{{$account->email}}" class="btn btn-outline-danger"><i class="fa fa-envelope-o"></i> Send
      Email</a>

  </div>

</header>


<div class="container-fluid">

    @include('layouts.errors')


  <div class="row">
    <div class="col-md-4 sticky-navbar">


      <div class="py-3 " id="sticky">
        <div class="card">
          <div class="card-header">
            <h5><i class="fa fa-info-circle fa-fw"></i>Personal Information</h5>
          </div>
          <div class="card-body">
            <div class="col-12">

              <h6> <b>Phone</b> {{$account->phone == ""? "None":$account->phone}}
              </h6>

              <h6> <b>College:</b> {{$account->college == ""? "None":$account->college}} </h6>

              <h6> <b>Gender:</b>
                {{$account->sex == ""? "Not defined":$account->sex}}</h6>

              <h6>
                <b>Age:</b>
                {{$account->age == ""? "Not defined":$account->age}}
              </h6>

              <div class="social text-center">


                  <div class="social-icons">
                    @if($account->linkedin != "")
                    <a href="{{$account->linkedin}}">
                      <span class="fa-stack">
                        <i class="fa fa-circle fa-stack-2x"></i>
                        <i class="fa fa-linkedin fa-stack-1x fa-inverse"></i>
                      </span></a>
                    @endif
                    @if($account->linkedin != "")
                    <a href="{{$account->instagram}}">
                      <span class="fa-stack">
                        <i class="fa fa-circle fa-stack-2x"></i>
                        <i class="fa fa-instagram fa-stack-1x fa-inverse"></i>
                      </span></a>
                    @endif
                    @if($account->linkedin != "")
                    <a href="{{$account->facebook}}">
                      <span class="fa-stack">
                        <i class="fa fa-circle fa-stack-2x"></i>
                        <i class="fa fa-facebook fa-stack-1x fa-inverse"></i>
                      </span></a>
                    @endif

                  </div>
                </div>


                <br>

              <div class="d-flex">
              


                <div class="ml-auto">
                  <div class="button pull-right pl-3">
              
                  </div>
                </div>

              </div>
            </div>
          </div>
        </div>


      </div>



    </div>
    <div class="col-md-8">


      <div class="col-12 py-3">
        <div class="card">
          <div class="card-header">
            <h5><i class="fa fa-user fa-fw"></i>Biography</h5>
          </div>
          <div class="card-body">


            {{$account->biography == ""? "None":$account->biography}}


          </div>
        </div>
      </div>


      <div class="col-12 py-3">


        <div class="row justify-content-center">

          <div class="col-md-12">
            <div class="card">
              <div class="card-header">



                <div class="d-flex">
                  <div>
                    Profiles
                  </div>
                  @if(Auth::user()->roles=="administrator")
                  <div class="ml-auto">
                    <a href="/users/add/" class="btn btn-light  ml-1  btn-text ">Add User
                    </a>

                  </div>
                  @endif
                </div>

              </div>





              <div class="card-body">
                @if (session('status'))
                <div class="alert alert-success">
                  {{ session('status') }}
                </div>
                @endif

                @if(isset($users))

                <div class="row">
                    @foreach ($users as $user)
                  <div class="col-md-4 pb-4 pr-3 pl-3">

                  
                <div class="card">
                    <img class="card-img-top" src="{{$user->cover == "" ?  url('storage/images/0/hello.jpg') : url('storage/'.$user->cover) }}">
                    <div class="card-body text-center">
                      <img class="avatar rounded-circle" src="{{
                        $user->picture == ""? url('storage/images/0/hi.png'):url('storage/'.$user->picture) }}" alt="Bologna">
                      <h4 class="card-title">{{$user->name}}</h4>
                      <h6 class="card-subtitle mb-2">{{$user->currentRole}}</h6>
                      <h6 class="card-subtitle mb-2">{{$user->college}}</h6>
                      <br>

                     
                      <h6 class="card-subtitle mb-2 text-muted">User</h6>
                      <br>
                      <br>
             
                      <a href="/users/view/{{$user->id}}" class="btn btn-primary pull-right ml-2">View</a>
                  
                      @if(Auth::user()->roles=="administrator")
                      <a href="/users/edit/{{$user->id}}"><button id="{{ $user->id }}"
                          class="btn btn-outline-success pull-right ml-4">Edit</button></a>
              

                      <button id="{{ $user->id }}" class="btn btn-outline-danger pull-right ml-2" type="submit"
                          data-toggle="modal" data-target="#delete" data-fileid="{{$user->id}}
                                            " data-fileName="{{$user->id}}, {{$user->name}}">Delete</button>


                                            @endif
                    </div>
                  </div>


                  </div>


                  @endforeach
                </div>



          

  


              </div>

              <div class="card-footer ">


                  <div class="justify-content-center">
                    {!! $users->appends(request()->except('page'))->render() !!}


                  </div>
                  @endif

                </div>
            </div>
          </div>
        </div>


      </div>





    </div>





  </div>
</div>





@if(Auth::user()->roles=="administrator")
<div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <form action="/users/delete" method="POST">


        {{csrf_field()}}

        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Delete Confirmation!</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body">
          <h6>Are you sure you want to delete this record?</h6>
          <h6 id="title_id"></h6>
          <input type="hidden" name="document_id" id="document_id" value="">

        </div>

        <div class="modal-footer">
          <button type="submit" class="btn btn-danger">Delete Record</button>
          <button type="button" class="btn btn-secondary px-4" data-dismiss="modal">Close</button>
        </div>

      </form>
    </div>
  </div>
</div>
@endif










@endsection


@section('script')

<script>
  $('#delete').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget)
  var document_id = button.data('fileid')
  var filename = button.data('filename')

  
  
  var modal = $(this)
  
  modal.find('.modal-body #document_id').val(document_id);
  modal.find('.modal-body #title_id').html(filename);
  

  })


</script>


@endsection