@php
    use App\Models\User;
    $user = User::find(auth()->id());
@endphp

@extends('layouts.base')

@section('content')
    <div class="container-xl px-4 mt-4">
        <hr class="mt-0 mb-4">
        <div class="row">
            <div class="col-xl-4">
                <div class="card mb-4 mb-xl-0">
                    <div class="card-header">Profile Picture</div>
                    <div class="card-body text-center">
                        <div class="profile-picture">
                            <div class="circle">{{ strtoupper(substr($user->name, 0, 1)) }}</div>
                        </div>
                        <div class="small font-italic text-muted mb-4">JPG or PNG no larger than 5 MB</div>
                        <button class="btn btn-primary" type="button">Upload new image</button>
                    </div>
                </div>
            </div>
            <div class="col-xl-8">
                <div class="card mb-4">
                    <div class="card-header">Account Details</div>
                    <div class="card-body">
                        <form>
                            <div class="mb-3">
                                <label class="small mb-1" for="inputUsername">Username (how your name will appear to other users on the site)</label>
                                <input class="form-control" id="inputUsername" type="text" placeholder="Enter your username" value={{User::find(auth()->id())->name}}>
                            </div>
                            <div class="mb-3">
                                <label class="small mb-1" for="inputName">Name</label>
                                <input class="form-control" id="inputName" type="text" placeholder="Enter your name" value="{{ $user->name }}">
                            </div>
                            <div class="cmb-3">
                                <label class="small mb-1" for="inputLocation">Location</label>
                                <input class="form-control" id="inputLocation" type="text" placeholder="Enter your location" value="San Francisco, CA">
                            </div>
                            <div class="row gx-3 mb-3">
                                <div class="col-md-6">
                                    <label class="small mb-1" for="inputEmailAddress">Email address</label>
                                    <input class="form-control" id="inputEmailAddress" type="email" placeholder="Enter your email address" value="name@example.com">
                                </div>
                                <div class="col-md-6">
                                    <label class="small mb-1" for="inputPhone">Phone number</label>
                                    <input class="form-control" id="inputPhone" type="tel" placeholder="Enter your phone number" value="555-123-4567">
                                </div>
                            </div>
                            <div class="row gx-3 mb-3">
                                <div class="col-md-6">
                                    <label class="small mb-1" for="inputStreet">Street</label>
                                    <input class="form-control" id="inputStreet" type="text" placeholder="Enter your street" value="123 Main St">
                                </div>
                                <div class="col-md-6">
                                    <label class="small mb-1" for="inputHouseNumber">House number</label>
                                    <input class="form-control" id="inputHouseNumber" type="text" placeholder="Enter your house number" value="456">
                                </div>
                            </div>
                            <div class="row gx-3 mb-3">
                                <div class="col-md-4">
                                    <label class="small mb-1" for="inputPostcode">Postcode</label>
                                    <input class="form-control" id="inputPostcode" type="text" placeholder="Enter your postcode" value="12345">
                                </div>
                                <div class="col-md-8">
                                    <label class="small mb-1" for="inputCity">City</label>
                                    <input class="form-control" id="inputCity" type="text" placeholder="Enter your city" value="San Francisco">
                                </div>
                            </div>
                            <div class="row gx-3 mb-3">
                                <div class="col-md-6">
                                    <label class="small mb-1" for="inputBirthday">Birthday</label>
                                    <input class="form-control" id="inputBirthday" type="text" name="birthday" placeholder="Enter your birthday" value="06/10/1988">
                                </div>
                            </div>
                            <button class="btn btn-primary" type="button">Save changes</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
