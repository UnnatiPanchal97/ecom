<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Stripe form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    @include('home.header_links')
</head>
<body>
    <div class="hero_area mb-4">
        <!-- header section strats -->
        <span class="header_font">@include('home.header')</span>
        <!-- end header section -->
        <div class="container">
            <div class="mt-3">
                <h1>Stripe form</h1>
                @if (\Session::has('error'))
                    <div class="alert alert-danger" role="alert">
                        {{ \Session::get('error') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="close">&times</button>
                    </div>
                @endif
                @if (\Session::has('success'))
                    <div class="alert alert-success" role="alert">
                        {{ \Session::get('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="close">&times</button>
                    </div>
                @endif
                <p class="lead">Total Amount: ₹{{ $totalPrice }}</p>
                <form method="post" action="{{ route('stripeSubmit') }}" class="row">
                    <input type="hidden" name="amount" value="{{ $totalPrice }}">
                    <input type="hidden" name="currency" value="INR">
                    @csrf
                    <div class="col-6">
                        <div class="mb-3 row">
                            <label for="name" class="col-sm-2 col-form-label">Name</label>
                            <div class="col-sm-10">
                                <input type="text" id="first_name" class="form-control" name="name">
                            </div>
                        </div>
                    </div>
                    {{-- <div class="col-6">
                        <div class="mb-3 row">
                            <label for="last_name" class="col-sm-2 col-form-label">Last name</label>
                            <div class="col-sm-10">
                                <input type="text" id="last_name" class="form-control" name="last_name">
                            </div>
                        </div>
                    </div> --}}
                    <div class="col-6">
                        <div class="mb-3 row">
                            <label for="email" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10">
                                <input type="text" id="email" class="form-control" name="email">
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mb-3 row">
                            <label for="phone" class="col-sm-2 col-form-label">Phone</label>
                            <div class="col-sm-10">
                                <input type="text" id="phone" class="form-control" name="phone">
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mb-3 row">
                            <label for="postal_code" class="col-sm-2 col-form-label">Postal code</label>
                            <div class="col-sm-10">
                                <input type="text" id="postal_code" class="form-control" name="postal_code">
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mb-3 row">
                            <label for="line1" class="col-sm-2 col-form-label">Address</label>
                            <div class="col-sm-10">
                                <input type="text" id="line1" class="form-control" name="line1">
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mb-3 row">
                            <label for="city" class="col-sm-2 col-form-label">City</label>
                            <div class="col-sm-10">
                                <input type="text" id="city" class="form-control" name="city">
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mb-3 row">
                            <label for="state" class="col-sm-2 col-form-label">State</label>
                            <div class="col-sm-10">
                                <input type="text" id="state" class="form-control" name="state">
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mb-3 row">
                            <label for="country" class="col-sm-2 col-form-label">Country</label>
                            <div class="col-sm-10">
                                <input type="text" id="country" class="form-control" name="country">
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mb-3 row">
                            <label for="card_no" class="col-sm-2 col-form-label">Card no</label>
                            <div class="col-sm-10">
                                <input type="text" id="card_no" class="form-control" name="card_no">
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mb-3 row">
                            <label for="exp_month" class="col-sm-2 col-form-label">Card Exp. month</label>
                            <div class="col-sm-10">
                                <input type="text" id="exp_month" class="form-control" name="exp_month">
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mb-3 row">
                            <label for="exp_year" class="col-sm-2 col-form-label">Card Exp. year</label>
                            <div class="col-sm-10">
                                <input type="text" id="exp_year" class="form-control" name="exp_year">
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mb-3 row">
                            <label for="cvc" class="col-sm-2 col-form-label">CVV</label>
                            <div class="col-sm-10">
                                <input type="text" id="cvc" class="form-control" name="cvc">
                            </div>
                        </div>
                    </div>
                    <input type="submit" name="Submit" class="btn btn-primary">
                </form>
            </div>
        </div>
    </div>
    @include('home.script')
</body>
</html>
