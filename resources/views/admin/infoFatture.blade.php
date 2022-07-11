@extends('dashboard')
@section('title', 'Invoices')
@section('content')
    <table class="table table-striped mt-5">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Data</th>
            <th scope="col">Import</th>
            <th scope="col">Product</th>
            <th scope="col">pdf</th>
        </tr>
        </thead>
        <tbody>
        @foreach($invoices as $item)
            <tr>
                <th scope="row">{{$item->id}}</th>
                <th>{{$item->created}}</th>
                <td>$ {{number_format($item->amount_paid / 100, 2, ',', '.')}}</td>
                <td>{{$item->lines->data[0]->price->product}}</td>
                <td><a href="{{$item->invoice_pdf}}" class="btn btn-success">download</a></td>
            </tr>
        @endforeach
        </tbody>
    </table>
@stop
