@extends('master')

@section('title', 'Оформить заказ')

@section('content')
    <h1>Approve order:</h1>
    <div class="container">
        <div class="row justify-content-center">
            <p>Full cost</p>
            <form action="" method="POST">
                <div>
                    <p>Personal Data:</p>

                    <div class="container">
                        <div class="form-group">
                            <label for="name" class="control-label col-lg-offset-3 col-lg-2">Name: </label>
                            <div class="col-lg-4">
                                <input type="text" name="name" id="name" value="" class="form-control">
                            </div>
                        </div>
                        <br>
                        <br>
                        <div class="form-group">
                            <label for="phone" class="control-label col-lg-offset-3 col-lg-2">Phone: </label>
                            <div class="col-lg-4">
                                <input type="text" name="phone" id="phone" value="" class="form-control">
                            </div>
                        </div>
                        <br>
                        <br>
                            <div class="form-group">
                                <label for="name" class="control-label col-lg-offset-3 col-lg-2">Email: </label>
                                <div class="col-lg-4">
                                    <input type="text" name="email" id="email" value="" class="form-control">
                                </div>
                            </div>
                    </div>
                    <br>
                    <input type="submit" class="btn btn-success" value="Approve order">
                </div>
            </form>
        </div>
    </div>
@endsection
