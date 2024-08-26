{{-- <x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div>
                <x-label for="name" :value="__('Name')" />

                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label for="password_confirmation" :value="__('Confirm Password')" />

                <x-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required />
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-button class="ml-4">
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout> --}}
<!-- Initial set by Command Prompt -->

<x-guest-layout>
    <main class="main-content  mt-0">
        <section>
            <div class="page-header min-vh-100">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="position-absolute w-40 top-0 start-0 h-100 d-md-block d-none">
                                <div class="oblique-image position-absolute d-flex fixed-top ms-auto h-100 z-index-0 bg-cover me-n8"
                                    style="background-image:url('ForAuth/assets/img/image-sign-up.jpg')">
                                    <div class="my-auto text-start max-width-350 ms-7">
                                        <h1 class="mt-3 text-white font-weight-bolder">Start your <br> new journey.</h1>
                                        <p class="text-white text-lg mt-4 mb-4">Do the experiment and enjoy them.</p>
                                    </div>
                                    <div class="text-start position-absolute fixed-bottom ms-7">
                                        <h6 class="text-white text-sm mb-5">Copyright © 2022 Corporate UI Design System
                                            by Creative Tim.</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 d-flex flex-column mx-auto">
                            <div class="card card-plain mt-8">
                                <div class="card-header pb-0 text-left bg-transparent">
                                    <h3 class="font-weight-black text-dark display-6">Sign up</h3>
                                    <p class="mb-0">Nice to meet you! Please enter your details.</p>
                                </div>
                                <div class="card-body">
                                    <form role="form" method="POST" action="{{ route('register') }}">
                                        @csrf
                                        <label>Name</label>
                                        <div class="mb-3">
                                            <input type="text" id="name" name="name" class="form-control"
                                                placeholder="Enter your name" value="{{old("name")}}" aria-label="Name"
                                                aria-describedby="name-addon">
                                            @error('name')
                                                <span class="text-danger text-sm">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <label>Email Address</label>
                                        <div class="mb-3">
                                            <input type="email" id="email" name="email" class="form-control"
                                                placeholder="Enter your email address" value="{{old("email")}}" aria-label="Email"
                                                aria-describedby="email-addon">
                                            @error('email')
                                                <span class="text-danger text-sm">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <label>Matric</label>
                                        <div class="mb-3">
                                            <input type="text" id="" name="student_matric" class="form-control"
                                                placeholder="Enter your matric" value="" aria-label="Matric"
                                                aria-describedby="matric-addon">
                                            @error('student_matric')
                                                <span class="text-danger text-sm">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <label>Course</label>
                                        <div class="mb-3">
                                            <select name="course_id" class="form-control">
                                                <option value="">-- Choose Course --</option>
                                                @foreach ($courses as $course)
                                                    @if ($course->id != 1)
                                                        <option value="{{$course->id}}">{{$course->course_name}}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                            @error('course_id')
                                                <span class="text-danger text-sm">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <label>Phone Number</label>
                                        <div class="mb-3">
                                            <input type="text" id="" name="student_phone_number" class="form-control"
                                                placeholder="Enter your phone number" value="" aria-label="Phone"
                                                aria-describedby="phone-addon">
                                            @error('student_phone_number')
                                                <span class="text-danger text-sm">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <label>Event Category Preferences</label>
                                        <div class="mb-3">
                                            <select name="eventcategory_id" class="form-control">
                                                <option value="">-- Choose Category --</option>
                                                @foreach($eventcategories as $eventcategory)
                                                    <option value="{{$eventcategory->id}}">{{$eventcategory->eventcategory_name}}</option>
                                                @endforeach
                                            </select>
                                            @error('eventcategory_id')
                                                <span class="text-danger text-sm">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <label>Hobby</label>
                                        <div class="mb-3">
                                            <select name="hobby_id" class="form-control">
                                                <option value="">-- Choose Hobby --</option>
                                                @foreach ($hobbies as $hobby)
                                                    <option value="{{$hobby->id}}">{{$hobby->hobby_name}}</option>
                                                @endforeach
                                            </select>
                                            @error('hobby_id')
                                                <span class="text-danger text-sm">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <label>Password</label>
                                        <div class="mb-3">
                                            <input type="password" id="password" name="password" class="form-control"
                                                placeholder="Create a password" aria-label="Password"
                                                aria-describedby="password-addon">
                                            @error('password')
                                                <span class="text-danger text-sm">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <label>Confirm Password</label>
                                        <div class="mb-3">
                                            <input type="password" id="password-confirmation" name="password_confirmation" class="form-control"
                                                placeholder="Create a password" aria-label="Password"
                                                aria-describedby="password-addon">
                                            @error('password')
                                                <span class="text-danger text-sm">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-dark w-100 mt-4 mb-3">Sign up</button>
                                            {{-- <button type="button" class="btn btn-white btn-icon w-100 mb-3">
                                                <span class="btn-inner--icon me-1">
                                                    <img class="w-5" src="{{ asset('ForAuth/assets/img/logos/google-logo.svg') }}"
                                                        alt="google-logo" />
                                                </span>
                                                <span class="btn-inner--text">Sign up with Google</span>
                                            </button> --}}
                                        </div>
                                    </form>
                                </div>
                                <div class="card-footer text-center pt-0 px-lg-2 px-1">
                                    <p class="mb-4 text-xs mx-auto">
                                        Already have an account?
                                        <a href="{{ route('login') }}" class="text-dark font-weight-bold">Sign in</a>
                                        or
                                        <a href="{{ url('/') }}" class="text-dark font-weight-bold">Back to Home</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

</x-guest-layout>
