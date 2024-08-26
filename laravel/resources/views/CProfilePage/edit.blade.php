@extends('layouts.Clubmajor', ['page' => __('Profile'), 'pageSlug' => 'profile'])

@section('content')
    <div class="row">
        <div class="col-md-8">
            @if (session('alert'))
                <div class="alert alert-{{ session('alert')['type'] }}" role="alert" style="margin-bottom: 15px;">
                    {{ session('alert')['message'] }}
                </div>
            @endif
            <div class="card">
                <div class="card-header">
                    <h5 class="title">{{ __('Edit Profile') }}</h5>
                </div>
                <form method="post" action="{{route('CProfilePage.updateProfile')}}" autocomplete="off">
                    <div class="card-body">
                            @csrf
                            @method('put')

                            <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                <label>{{ __('Name') }}</label>
                                <input type="text" name="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ __('Name') }}" value="{{ old('name', auth()->user()->name) }}">
                                {{-- @include('alerts.feedback', ['field' => 'name']) --}}
                            </div>

                            <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                                <label>{{ __('Email address') }}</label>
                                <input type="email" name="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{ __('Email address') }}" value="{{ old('email', auth()->user()->email) }}">
                                {{-- @include('alerts.feedback', ['field' => 'email']) --}}
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-fill btn-primary">{{ __('Save') }}</button>
                    </div>
                </form>
            </div>

            <div class="card">
                <div class="card-header">
                    <h5 class="title">{{ __('Password') }}</h5>
                </div>
                <form method="post" action="{{route('CProfilePage.updatePassword')}}" autocomplete="off">
                    <div class="card-body">
                        @csrf
                        @method('put')

                        <div class="form-group{{ $errors->has('old_password') ? ' has-danger' : '' }}">
                            <label>{{ __('Current Password') }}</label>
                            <input type="password" name="old_password" class="form-control{{ $errors->has('old_password') ? ' is-invalid' : '' }}" placeholder="{{ __('Current Password') }}" value="" required>
                            {{-- @include('alerts.feedback', ['field' => 'old_password']) --}}
                            @if ($errors->has('old_password'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('old_password') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                            <label>{{ __('New Password') }}</label>
                            <input type="password" name="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="{{ __('New Password') }}" value="" required>
                            {{-- @include('alerts.feedback', ['field' => 'password']) --}}
                            @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label>{{ __('Confirm New Password') }}</label>
                            <input type="password" name="password_confirmation" class="form-control" placeholder="{{ __('Confirm New Password') }}" value="" required>
                            @if ($errors->has('password_confirmation'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                                </span>
                            @endif
                        </div>

                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-fill btn-primary">{{ __('Change password') }}</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card card-user">
                <div class="card-body">
                    <p class="card-text">
                        <div class="author">
                            <div class="block block-one"></div>
                            <div class="block block-two"></div>
                            <div class="block block-three"></div>
                            <div class="block block-four"></div>
                            <a id="modalBtn" href="#">
                                @if(auth()->user()->club->club_picture)
                                    <img class="avatar" src="{{ asset('picture/club/' . auth()->user()->club->club_picture)}}" alt="">
                                @else
                                    <img class="avatar" src="{{ asset('ForDesign/resources/assets/img/anime3.png') }}" alt="">
                                @endif
                                <h5 class="title">{{ auth()->user()->name }}</h5>
                            </a>
                            {{-- <p class="description">
                                {{ __('2022821504') }}
                            </p> --}}
                        </div>
                    </p>
                    <form method="post" action="{{route('CProfilePage.updateDetail')}}" autocomplete="off">
                        @csrf
                        @method('put')

                        <div class="form-group">
                            <label>{{ __('Phone Number') }}</label>
                            <input type="text" name="club_phone_number" class="form-control" placeholder="" value="{{old('club_phone_number', auth()->user()->club->club_phone_number ?? '')}}" required>
                            @error('club_phone_number')
                                <span class="text-danger text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="card-footer text-center">
                            <button type="submit" class="btn btn-fill btn-primary">{{ __('Save') }}</button>
                        </div>
                    </form>
                    {{-- <div class="card-description">
                        {{ __('Do not be scared of the truth because we need to restart the human foundation in truth And I love you like Kanye loves Kanye I love Rick Owens’ bed design but the back is...') }}
                    </div> --}}
                </div>
                <div class="card-footer">
                    {{-- <div class="button-container">
                        <button class="btn btn-icon btn-round btn-facebook">
                            <i class="fab fa-facebook"></i>
                        </button>
                        <button class="btn btn-icon btn-round btn-twitter">
                            <i class="fab fa-twitter"></i>
                        </button>
                        <button class="btn btn-icon btn-round btn-google">
                            <i class="fab fa-google-plus"></i>
                        </button>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Picture</h5>
                </div>
                <form method="post" action="{{route('CProfilePage.updatePicture')}}" autocomplete="off" enctype="multipart/form-data">
                    <div class="modal-body">
                        @csrf
                        @method('put')
                        {{-- <img class="avatar" src="{{ asset('ForDesign/resources/assets/img/QR_Eusoff .PNG') }}" alt=""> --}}
                        <div class="ps-2">
                            <label style="color: black">Submit New Picture</label>
                            <div class="input-group">
                                <input style="color: black" type="file" name="club_picture">
                            </div>
                            @error('club_picture')
                                <span class="text-danger text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn-close btn bg-gradient-dark" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn bg-gradient-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Get the modal
        var modal = document.getElementById('exampleModal');

        // Get the button that opens the modal
        var btn = document.getElementById("modalBtn");

        // When the user clicks the button, open the modal
        btn.addEventListener("click", function() {
            modal.style.display = "block";
        });

        // When the user clicks on <span> (x), close the modal
        modal.querySelector(".btn-close").addEventListener("click", function() {
            modal.style.display = "none";
        });

        // When the user clicks anywhere outside of the modal, close it
        window.addEventListener("click", function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        });
    </script>
@endsection
