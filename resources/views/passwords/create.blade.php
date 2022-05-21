@extends('layouts.app')

@section('content')

    <div class="container">
        <h1>  </h1>

        <div class="card">
            <div class="card-body">

                <h5 class="card-title">
                    {{ (isset( $password )) ? 'Edit password': 'Adding new password'}}
                </h5>

                <form id="category-form" method="POST"
                      @if( isset( $isEdit ) && $isEdit == true )
                      action="{{ route('passwords.update', $password) }}"
                      @else
                      action="{{ route('passwords.store') }}"
                    @endif
                >
                    @csrf

                    @if( isset( $isEdit ) && $isEdit == true )
                        @method('PATCH')
                    @endif

                    <div class="row mb-3">

                        <label for="name" class="col-sm-2 col-form-label">Name:</label>
                        <div class="col-sm-10">
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name"
                                   @if( isset($password) )
                                   value="{{ $password->name }}"
                                   @else
                                   value="{{ old('name') }}"
                                @endif
                            >

                            @error('name')
                            <span class="invalid-feedback" role="alert"> {{ $message }} </span>
                            @enderror
                        </div>

                    </div>

                    <div class="row mb-3">

                        <label for="url" class="col-sm-2 col-form-label">URL:</label>
                        <div class="col-sm-10">
                            <input type="text" name="url" class="form-control @error('url') is-invalid @enderror" id="url"
                                   @if( isset($password) )
                                   value="{{ $password->url }}"
                                   @else
                                   value="{{ old('url') }}"
                                @endif
                            >

                            @error('url')
                            <span class="invalid-feedback" role="alert"> {{ $message }} </span>
                            @enderror
                        </div>

                    </div>

                    <div class="row mb-3">

                        <label for="username" class="col-sm-2 col-form-label">Username:</label>
                        <div class="col-sm-10">
                            <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" id="username"
                                   @if( isset($password) )
                                   value="{{ $password->username }}"
                                   @else
                                   value="{{ old('username') }}"
                                @endif
                            >

                            @error('username')
                            <span class="invalid-feedback" role="alert"> {{ $message }} </span>
                            @enderror
                        </div>

                    </div>

                    <div class="row mb-3">

                        <label for="password" class="col-sm-2 col-form-label">Password:</label>
                        <div class="col-sm-10">
                            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password"
                                   @if( isset($password)  )
                                   value="{{ Crypt::decrypt($password->password) }}"
                                   @else
                                   value="{{ old('password') }}"
                                @endif
                            >

                            @error('password')
                            <span class="invalid-feedback" role="alert"> {{ $message }} </span>
                            @enderror
                        </div>

                    </div>

                    <div class="row mb-3">

                        <label for="comment" class="col-sm-2 col-form-label">Comment:</label>
                        <div class="col-sm-10">
                            <input type="comment" name="comment" class="form-control @error('password') is-invalid @enderror" id="comment"
                                   @if( isset($password) )
                                   value="{{ $password->comment }}"
                                   @else
                                   value="{{ old('comment') }}"
                                @endif
                            >

                            @error('comment')
                            <span class="invalid-feedback" role="alert"> {{ $message }} </span>
                            @enderror
                        </div>

                    </div>

                    <div class="d-flex justify-content-end mb-3">
                        <div class="btn-group" role="group" aria-label="Cancel or submit form">
                            <a href="{{ route('passwords.index') }}" type="submit" class="btn btn-secondary"> Cancel </a>

                            <button type="submit" class="btn btn-primary">
                                @if( isset($password))
                                   Update
                                @else
                                    Add
                                @endif
                            </button>
                        </div>
                    </div>
                </form>

            </div>
        </div>

    </div>

@endsection
