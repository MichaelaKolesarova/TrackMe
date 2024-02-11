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
                    <div class="card-body text-center " id="image">
                        @if($user->profile_picture == null)
                            <div class="profile-picture">
                                <div class="circle">{{ strtoupper(substr($user->name, 0, 1)) }}</div>
                            </div>
                            <div class="small font-italic text-muted mb-4">JPG or PNG no larger than 5 MB</div>
                            <input type="file" id="fileInput" name="profile_picture" style="display: none;" accept="image/png, image/jpeg">
                            <button class="btn btn-primary" type="button" id="uploadImageButton">Upload image</button>
                        @else
                            <div class="profile-picture">
                                <img src="data:image/jpeg;base64,{{ base64_encode($user->profile_picture) }}" alt="Profile Picture" class="center-image">
                            </div>
                            <input type="file" id="fileInput" name="profile_picture" style="display: none;" accept="image/png, image/jpeg">
                        <div>
                            <button class="btn btn-primary " type="button" id="uploadImageButton" style="margin-bottom: 20px">Upload new image</button>
                            <form action="{{ route('deletePicture') }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-primary" type="submit">Erase image</button>
                            </form>
                        </div>
                        @endif

                    </div>
                </div>
            </div>
            <div class="col-xl-8">
                <div class="card mb-4">
                    <div class="card-header">Account Details</div>
                    <div class="card-body">
                        <form action="{{ route('updateProfile') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label class="small mb-1" for="inputUsername">Username (how your name will appear to other users on the site)</label>
                                <input class="form-control" id="inputUsername" name="username" type="text" placeholder="Enter your username" value={{$user->username}}>
                            </div>
                            <div class="mb-3">
                                <label class="small mb-1" for="inputName">Name</label>
                                <input class="form-control" id="inputName" name="name" type="text" placeholder="Enter your name" value="{{ $user->name}}">
                            </div>
                            <div class="cmb-3">
                                <label class="small mb-1" for="inputLocation">Location</label>
                                <input class="form-control" id="inputLocation" name="location" type="text" placeholder="Enter your location" value="{{$user->location}}">
                            </div>
                            <div class="row gx-3 mb-3">
                                <div class="col-md-6">
                                    <label class="small mb-1" for="inputEmailAddress">Email address</label>
                                    <input class="form-control" id="inputEmailAddress" name="email" type="email" placeholder="Enter your email address" value="{{$user->email}}">
                                </div>
                                <div class="col-md-6">
                                    <label class="small mb-1" for="inputPhone">Phone number</label>
                                    <input class="form-control" id="inputPhone" name="phone_number" type="text" placeholder="Enter your phone number" value="{{$user->phone_number}}">
                                </div>
                            </div>
                            <div class="row gx-3 mb-3">
                                <div class="col-md-6">
                                    <label class="small mb-1" for="inputStreet">Street</label>
                                    <input class="form-control" id="inputStreet" name="street" type="text" placeholder="Enter your street" value="{{$user->street}}">
                                </div>
                                <div class="col-md-6">
                                    <label class="small mb-1" for="inputHouseNumber">House number</label>
                                    <input class="form-control" id="inputHouseNumber" name="house_number" type="text" placeholder="Enter your house number" value="{{$user->house_number}}">
                                </div>
                            </div>
                            <div class="row gx-3 mb-3">
                                <div class="col-md-4">
                                    <label class="small mb-1" for="inputPostcode">Postcode</label>
                                    <input class="form-control" id="inputPostcode" name="postcode" type="text" placeholder="Enter your postcode" value="{{$user->postcode}}">
                                </div>
                                <div class="col-md-8">
                                    <label class="small mb-1" for="inputCity">City</label>
                                    <input class="form-control" id="inputCity" name="city" type="text" placeholder="Enter your city" value="{{$user->city}}">
                                </div>
                            </div>
                            <div class="row gx-3 mb-3">
                                <div class="col-md-6">
                                    <label class="small mb-1" for="inputBirthday">Birthday</label>
                                    <input class="form-control" id="inputBirthday" type="text" name="birthday" placeholder="Enter your birthday (DD/MM/YYYY)" value="{{Carbon\Carbon::parse($user->birthday)->format('d/m/Y')}}">
                                </div>
                            </div>
                            <button class="btn btn-primary" type="submit">Save changes</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>





    <script>
        document.getElementById('inputBirthday').addEventListener('input', function (e) {
            let inputValue = e.target.value;

            inputValue = inputValue.replace(/\D/g, '');

            if (inputValue.length >= 2) {
                const day = inputValue.slice(0, 2);
                let month = inputValue.slice(2, 4);
                const year = inputValue.slice(4, 8);

                if (month.length === 1 && parseInt(month) > 1) {
                    month = '0' + month;
                }

                if (parseInt(month) > 12) {
                    month = '12';
                }
                inputValue = day + '/' + month + '/' + year;
            }

            e.target.value = inputValue;
        });
    </script>

    <script>
        document.getElementById('uploadImageButton').addEventListener('click', function () {
            document.getElementById('fileInput').click();
        });

        document.getElementById('fileInput').addEventListener('change', function () {
            const file = this.files[0];
            const maxSize = 0.5 * 1024 * 1024; // 5 MB in bytes

            if (file.size > maxSize) {
                alert('File size exceeds 5 MB. Please select a smaller file.');
                this.value = '';
            } else {
                const reader = new FileReader();

                reader.onload = function (e) {
                    const binaryData = e.target.result.split(',')[1];

                    const formData = new FormData();
                    formData.append('profile_picture', binaryData);

                    fetch('{{ route("updatePicture") }}', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: formData
                    })
                        .then(response => response.json())
                        .then(data => {
                            console.log(data);
                            location.reload();
                        })
                        .catch(error => {
                            console.error('Error:', error);
                        });
                };

                reader.readAsDataURL(file);
            }
        });


    </script>




@endsection
