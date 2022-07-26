@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Create Order') }}</div>
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                            @if($formType == 'edit')
                                <form class="row g-3 needs-validation" novalidate action="{{route('orders.update',$category->id)}}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                            @elseif($formType === 'create')
                                <form class="row g-3 needs-validation" novalidate action="{{route('orders.store')}}" method="post" enctype="multipart/form-data">
                                @csrf
                            @endif
                        
                            {{csrf_field()}}
                            <div class="col-mb-4">
                                <label for="validationCustom01" class="form-label">Product Name</label>
                                <input type="text" class="form-control" id="validationCustom01"  required name="item_name" value="{{old('item_name',$order->item_name ?? '') }}">
                            </div>

                            <div class="col-mb-3">
                                <label for="validationCustom05" class="form-label">Code</label>
                                <input type="text" class="form-control" id="validationCustom05" required name="item_code" value="{{old('item_code',$order->item_code ?? '') }}">
                                <div class="invalid-feedback">
                                    Please provide a valid Price.
                                </div>
                            </div>
                            <div class="mb-4 mt-5" >
                                <h6 class=" text-uppercase">Pickup Address</h6>
                                <!-- Dashed divider -->
                                <hr class="dashed">
                            </div>
                            <div class="form-group">
                                <label for="inputAddress">Name</label>
                                <input type="text" class="form-control" id="validationCustom05" required name="pickup_name" value="{{old('pickup_name',$order->pickup_name ?? '') }}">
                            </div>
                            <div class="form-group">
                                <label for="inputAddress">Address</label>
                                <input type="text" class="form-control" id="validationCustom05" required name="pickup_address" value="{{old('pickup_address',$order->pickup_address ?? '') }}">
                            </div>
                            <div class="form-group">
                                <label for="inputAddress2">Place</label>
                                <input type="text" class="form-control" id="validationCustom05" required name="pickup_place" value="{{old('pickup_place',$order->pickup_place ?? '') }}">
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputCity">City</label>
                                    <input type="text" class="form-control" id="validationCustom05" required name="pickup_district" value="{{old('pickup_district',$order->pickup_district ?? '') }}">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="inputState">State</label>
                                    <select id="inputState" class="form-control" name="pickup_state" required="">
                                        <option selected disabled>Choose...</option>
                                        <option value="kerala" {{ old('pickup_state') == 'kerala' ? 'selected' : '' }}>Kerala</option>
                                        <option value="tamilnadu" {{ old('pickup_state') == 'tamilnadu' ? 'selected' : '' }}>Tamilnadu</option>
                                        <option value="karnataka" {{ old('pickup_state') == 'karnataka' ? 'selected' : '' }}>Karnataka</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="inputZip">Pin</label>
                                    <input type="text" class="form-control" id="validationCustom05" required name="pickup_pin" value="{{old('pickup_pin',$order->pickup_pin ?? '') }}">
                                </div>
                            </div>

                            <div class="mb-4 mt-5" >
                                <h6 class=" text-uppercase">Delivery Address</h6>
                                <!-- Dashed divider -->
                                <hr class="dashed">
                            </div>
                            <div class="form-group">
                                <label for="inputAddress">Name</label>
                                <input type="text" class="form-control" id="validationCustom05" required name="delivery_name" value="{{old('delivery_name',$order->delivery_name ?? '') }}">
                            </div>
                            <div class="form-group">
                                <label for="inputAddress">Address</label>
                                <input type="text" class="form-control" id="validationCustom05" required name="delivery_address" value="{{old('delivery_address',$order->delivery_address ?? '') }}">
                            </div>
                            <div class="form-group">
                                <label for="inputAddress2">Place</label>
                                <input type="text" class="form-control" id="validationCustom05" required name="delivery_place" value="{{old('delivery_place',$order->delivery_place ?? '') }}">
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputCity">City</label>
                                    <input type="text" class="form-control" id="validationCustom05" required name="delivery_district" value="{{old('delivery_district',$order->delivery_district ?? '') }}">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="inputState">State</label>
                                    <select id="inputState" class="form-control" name="delivery_state" required="">
                                        <option selected disabled>Choose...</option>
                                        <option value="kerala" {{ old('delivery_state') == 'kerala' ? 'selected' : '' }}>Kerala</option>
                                        <option value="tamilnadu" {{ old('delivery_state') == 'tamilnadu' ? 'selected' : '' }}>Tamilnadu</option>
                                        <option value="karnataka" {{ old('delivery_state') == 'karnataka' ? 'selected' : '' }}>Karnataka</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="inputZip">Pin</label>
                                    <input type="text" class="form-control" id="validationCustom05" required name="delivery_pin" value="{{old('delivery_pin',$order->delivery_pin ?? '') }}">
                                </div>
                            </div>
                            <div class="col-12">
                                <button class="btn btn-primary" type="submit">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('custom-scripts')
    <script>
        // Example starter JavaScript for disabling form submissions if there are invalid fields
        (function () {
            'use strict'

            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.querySelectorAll('.needs-validation')

            // Loop over them and prevent submission
            Array.prototype.slice.call(forms)
                    .forEach(function (form) {
                        form.addEventListener('submit', function (event) {
                            if (!form.checkValidity()) {
                                event.preventDefault()
                                event.stopPropagation()
                            }

                            form.classList.add('was-validated')
                        }, false)
                    })
        })();

        function readURL(input,showEl) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $(showEl).attr('src', e.target.result);
                    $(showEl).show();
                };

                reader.readAsDataURL(input.files[0]);
            }else{
                $(showEl).attr('src', '');
                $(showEl).hide();
            }
        }

    </script>
@endsection