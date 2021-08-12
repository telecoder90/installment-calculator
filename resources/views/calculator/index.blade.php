@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Installment calculator</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('calculate') }}" id="calculationForm" autocomplete="off">
                        @csrf

                        <div class="form-group row">
                            <label for="object_price" class="col-md-4 col-form-label text-md-right">Object oriented price (UAH)</label>

                            <div class="col-md-6">
                                <input id="object_price" type="number" class="form-control" name="object_price" value="1000000" required autocomplete="off" >

                                <span id="object_price_feedback" class="invalid-feedback" role="alert">
                                    <strong></strong>
                                </span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="started_sum" class="col-md-4 col-form-label text-md-right">Started sum (UAH)</label>

                            <div class="col-md-6">
                                <input id="started_sum" type="number" class="form-control" name="started_sum" value="300000" required autocomplete="off" >

                                <span id="started_sum_feedback" class="invalid-feedback" role="alert">
                                    <strong></strong>
                                </span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="period_monthes" class="col-md-4 col-form-label text-md-right">Period (monthes)</label>

                            <div class="col-md-6">
                                <select id="period_monthes" class="form-control" name="period_monthes" required autocomplete="off" >
                                    <option value="12">12 Monthes</option>
                                    <option value="24">24 Monthes</option>
                                    <option value="36">36 Monthes</option>
                                </select>

                                <span id="period_monthes_feedback" class="invalid-feedback" role="alert">
                                    <strong></strong>
                                </span>
                            </div>
                        </div>

                        <div class="alert alert-success" role="alert" id="responseMessage" style="display: none;"></div>
                        <div class="form-group row" style="display: none;" id="responseData">
                            <label for="monthly_payment" class="col-md-4 col-form-label text-md-right">Monthly payment (UAH)</label>

                            <div class="col-md-6">
                                <input id="monthly_payment" readonly disabled type="number" class="form-control" name="monthly_payment" value="0" autocomplete="off" >
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="button" id="calculatorFormSubmit" class="btn btn-primary">
                                    CALCULATE
                                </button>
                            </div>
                        </div>
                    </form>

                    <br><hr><br>

                    <h2>Or leave your email and send an Inquiry!</h2>
                    <p>In the feedback, we will send the most hot propositions to you ;)</p>

                    <form method="POST" action="{{ route('inquiry') }}" id="inquiryForm" autocomplete="off">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="" required autocomplete="email" autofocus>

                                <span id="email_feedback" class="invalid-feedback" role="alert">
                                    <strong></strong>
                                </span>
                            </div>
                        </div>

                        <div class="alert alert-success" role="alert" id="responseInquiryMessage" style="display: none;"></div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="button" id="inquiryFormSubmit" class="btn btn-primary">
                                    SEND INQUIRY
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

@push('custom_scripts')
    <script>
        window.addEventListener("load", function(event) {
            $("#calculatorFormSubmit" ).bind( "click", function() {
                $('#responseMessage').hide();
                $('#responseData').hide();
                jQuery.ajax({
                    url: "/calculate",
                    type: "POST",
                    data: $('#calculationForm').serialize(),
                    success: function(resp, status){
                        $('#responseMessage').html(resp.message);
                        $('#monthly_payment').val(resp.monthly_payment);
                        $('#responseMessage').show();
                        $('#responseData').show();
                    },
                    error: function(resp, status){
                        $.each( resp.responseJSON.errors, function( key, err ) {
                            // console.log(key+' - '+ err);
                            $('#'+key).addClass('is-invalid');
                            $('#'+key + '_feedback strong').text(err);
                        });
                        $('#responseMessage').html("The given data was invalid.");
                    },
                    dataType: 'json'
                });   
            });

            $("#inquiryFormSubmit" ).bind( "click", function() {
                $('#responseInquiryMessage').hide();
                jQuery.ajax({
                    url: "/inquiry",
                    type: "POST",
                    data: $('#inquiryForm').serialize(),
                    success: function(resp, status){
                        $('#responseInquiryMessage').html(resp.message);
                        $('#responseInquiryMessage').show();
                    },
                    error: function(resp, status){
                        $.each( resp.responseJSON.errors, function( key, err ) {
                            // console.log(key+' - '+ err);
                            $('#'+key).addClass('is-invalid');
                            $('#'+key + '_feedback strong').text(err);
                        });
                        $('#responseInquiryMessage').html("The given data was invalid.");
                    },
                    dataType: 'json'
                });   
            });
        });
    </script>
@endpush