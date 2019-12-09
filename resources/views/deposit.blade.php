{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
        <div class="card card-primary">
            <div class="card-header">
            <h3 class="card-title">Depositar</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form role="form" action="{{ route('deposit.store') }}" method="POST">
                {{ csrf_field() }}
                {{ method_field("POST") }}

                <div class="card-body">
                    <div class="form-group {{ $errors->any('value') ? 'is-invalid' : '' }}">
                        <label for="value">Valor</label>
                        <input type="number" class="form-control" id="value" name="value" placeholder="Enter a value" value="{{ old('value') }}">
                        <p class="text-danger">{{ $errors->first('value') }}</p>
                    </div>
                </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
            </form>
        </div>
        </div>
    </div>
@stop