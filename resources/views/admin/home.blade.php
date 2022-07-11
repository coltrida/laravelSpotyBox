@extends('dashboard')
@section('title', 'Dashboard')
@section('content')
        <h2>Balance: $ {{number_format($balance->available[0]->amount / 100, 2, ',', '.')}}</h2>
@stop
