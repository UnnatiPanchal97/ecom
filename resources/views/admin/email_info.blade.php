<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    @include('admin.header_links')
    <link rel="stylesheet" href="{{ asset('admin/assets/css/custom.css') }}">
</head>
<div class="container-scroller">
<body>
        <!-- partial:partials/_sidebar.html -->
        @include('admin.sidebar')
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_navbar.html -->
            @include('admin.header')
            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">
                    <h1 class="email_heading">Send Email to {{ $order->email }}</h1>
                    <div class="col-md-6 offset-3 mt-5">
                        <form action="{{ url('send_user_email',$order->id) }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="greeting">Email Greeting : </label>
                                <input type="text" class="form-control font_white" name="greeting">
                            </div>
                            <div class="form-group">
                                <label for="firstline">Email First Line : </label>
                                <input type="text" class="form-control font_white" name="firstline">
                            </div>
                            <div class="form-group">
                                <label for="body">Email Body : </label>
                                <input type="text" class="form-control font_white" name="body">
                            </div>
                            <div class="form-group">
                                <label for="button">Email Button name : </label>
                                <input type="text" class="form-control font_white" name="button">
                            </div>
                            <div class="form-group">
                                <label for="url">Email Url : </label>
                                <input type="text" class="form-control font_white" name="url">
                            </div>
                            <div class="form-group">
                                <label for="lastline">Email Last Line : </label>
                                <input type="text" class="form-control font_white" name="lastline">
                            </div>
                            <div class="form-group">
                                <input type="submit" class="btn btn-outline-primary" value="Send Email">
                            </div>
                        </form>
                    </div>
                </div>
                @include('admin.footer')
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    @include('admin.script')
</body>
</html>
