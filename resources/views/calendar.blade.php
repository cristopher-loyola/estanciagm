@extends('layouts.app')

@section('title', 'Calendario')

@section('content')
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <h1 class="text-2xl font-semibold text-gray-900 mb-6">Calendario</h1>
        <div id="calendar" class="bg-white shadow-md rounded-lg p-6"></div> 
    </div>

    @vite(['resources/js/app.js'])
@endsection
