@extends('layouts.master')

@section('title', 'QR Code')

@section('content')
    {{ QrCode::gradient(102, 255, 216, 38, 184, 227, 'diagonal')->generate('https://www.google.com/') }}

@endsection
