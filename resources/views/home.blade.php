@extends('layouts.app')

@section('content')






<header class="header">

  <img class="card-img-top img-fit"
    src="{{Auth::user()->cover == "" ?  url('storage/images/0/hello.jpg'):url('storage/'.Auth::user()->cover) }}"
    height="300px">
  <div class="card-body text-center">
    <img class="avatar rounded-circle" src="{{
              Auth::user()->picture == ""? url('storage/images/0/hi.png'):url('storage/'.Auth::user()->picture) }}"
    >
    <h4 class="card-title"><strong>{{Auth::user()->name}}</strong></h4>
    <h6 class="card-subtitle mb-2 text-muted"> {{Auth::user()->currentRole == ""? "None":Auth::user()->currentRole}}
    </h6>
    <p class="card-text"><i class="fa fa-user fa-fw"></i> {{Auth::user()->roles}} </p>

    <a href="mailto:{{Auth::user()->email}}" class="btn btn-outline-danger"><i class="fa fa-envelope-o"></i> Send
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

              <h6> <b>Phone</b> {{Auth::user()->phone == ""? "None":Auth::user()->phone}}
              </h6>

              <h6> <b>College:</b> {{Auth::user()->college == ""? "None":Auth::user()->college}} </h6>

              <h6> <b>Gender:</b>
                {{Auth::user()->sex == ""? "Not defined":Auth::user()->sex}}</h6>

              <h6>
                <b>Age:</b>
                {{Auth::user()->age == ""? "Not defined":Auth::user()->age}}
              </h6>

              <div class="social text-center">


                  <div class="social-icons">
                    @if(Auth::user()->linkedin != "")
                    <a href="{{Auth::user()->linkedin}}">
                      <span class="fa-stack">
                        <i class="fa fa-circle fa-stack-2x"></i>
                        <i class="fa fa-linkedin fa-stack-1x fa-inverse"></i>
                      </span></a>
                    @endif
                    @if(Auth::user()->linkedin != "")
                    <a href="{{Auth::user()->instagram}}">
                      <span class="fa-stack">
                        <i class="fa fa-circle fa-stack-2x"></i>
                        <i class="fa fa-instagram fa-stack-1x fa-inverse"></i>
                      </span></a>
                    @endif
                    @if(Auth::user()->linkedin != "")
                    <a href="{{Auth::user()->facebook}}">
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
                    <a href="#" class="btn btn-outline-success btn"  type="submit"
                    data-toggle="modal" data-target="#editProfile" >Edit Profile <i class="fa fa-pencil"></i></a>
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


            {{Auth::user()->biography == ""? "None":Auth::user()->biography}}


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




<div class="modal fade" id="editProfile" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <form action="/editProfile" method="POST" enctype="multipart/form-data">
  
  
          {{csrf_field()}}
  
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit Profile</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
  
          <div class="modal-body">
            
                        @csrf


                                         
                        <div class="form-group row">


                            <label for="name" class="col-md-4 col-form-label text-md-right">Cover Photo</label>
                            <div class="col-md-8">
                              <div class="col-12">
                                  <input type="file" class="custom-file-input form-control" id="customFile" name="cover" accept='image/*'>
                                  <label class="custom-file-label" for="customFile">Choose file</label>
                              </div>
                     
                            </div>
                            
                              </div>    



              
                        
                        <div class="form-group row">


                        <label for="name" class="col-md-4 col-form-label text-md-right">Profile Picture</label>
                        <div class="col-md-8">
                          <div class="col-12">
                              <input type="file" class="custom-file-input form-control" id="customFile" name="picture" accept='image/*'>
                              <label class="custom-file-label" for="customFile">Choose file</label>
                          </div>
                 
                        </div>
                        
                          </div>    




                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-8">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ Auth::user()->name }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

      


                        <div class="form-group row">
                                <label for="age" class="col-md-4 col-form-label text-md-right">Age</label>
    
                                <div class="col-md-8">
                                    <input id="age" type="number" class="form-control" name="age" value="{{ Auth::user()->age }}"  >
                                </div>
                            </div>

                            
                            <div class="form-group row">
                                <label for="job" class="col-md-4 col-form-label text-md-right">Job</label>
    
                                <div class="col-md-8">
                                    <input id="job" type="text" class="form-control" name="currentRole" value="{{ Auth::user()->currentRole }}"  >
                                </div>
                            </div>


                            <div class="form-group row">
                                <label for="univ" class="col-md-4 col-form-label text-md-right">University</label>
    
                                <div class="col-md-8">
                                    <input id="univ" type="text" class="form-control" name="college" value="{{ Auth::user()->college }}"  >
                                </div>
                            </div>


                            
                            <div class="form-group row">
                                <label for="phone" class="col-md-4 col-form-label text-md-right">Phone Number</label>
    
                                <div class="col-md-8">
                                    <input id="phone" type="number" class="form-control" name="phone" value="{{ Auth::user()->phone }}"  >
                                </div>
                            </div>



                            
                            <div class="form-group row">
                                    <label for="sexState" class="col-md-4 col-form-label text-md-right">Sex</label>
                                    <div class="col-md-8">
                                        <select id="sexState" class="form-control" name="sex" >

                                            <option value="" @if(Auth::user()->sex=="") selected @endif>No input</option>

                                            <option value="Male"  @if(Auth::user()->sex=="Male") selected @endif>Male</option>
                                            <option value="Female"  @if(Auth::user()->sex=="Female") selected @endif>Female
                                            </option>

                                        </select>
                                    </div>
                                </div>



                                <div class="form-group row">
                                    <label for="url-input" class="col-md-4 col-form-label text-md-right">Facebook Profile Url</label>
                                    <div class="col-md-8">
                                      <input class="form-control" type="url" name="facebook"  id="url-input" value="{{ Auth::user()->facebook}}">
                                    </div>
                                  </div>


                                  <div class="form-group row">
                                      <label for="url-input-instagram" class="col-md-4 col-form-label text-md-right">Instagram Profile Url</label>
                                      <div class="col-md-8">
                                        <input class="form-control" type="url"   name="instagram"   id="url-input-instagram" value="{{ Auth::user()->instagram}}">
                                      </div>
                                    </div>


                                    <div class="form-group row">
                                        <label for="url-input-linkedin" class="col-md-4 col-form-label text-md-right">Linkedin Profile Url</label>
                                        <div class="col-md-8">
                                          <input class="form-control" type="url"  name="linkedin"   id="url-input-linkedin" value="{{ Auth::user()->linkedin}}">
                                        </div>
                                      </div>






                        <div class="form-group row">
                                <label for="exampleTextarea" class="col-md-4 col-form-label text-md-right">Biography</label>
                                <div class="col-md-8">
                                        <textarea class="form-control "  rows="10" id="editor" name="biography" >{{ Auth::user()->biography }}</textarea>
                                </div>
                       
                              </div>
          </div>
  
          <div class="modal-footer">
         
            <button type="button" class="btn btn-secondary px-4" data-dismiss="modal">Close</button>

            <button type="submit" class="btn btn-success">Update Profile</button>
          </div>
  
        </form>
      </div>
    </div>
  </div>
  
  










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


$(".custom-file-input").on("change", function() {
  var fileName = $(this).val().split("\\").pop();
  $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
});

</script>


@endsection