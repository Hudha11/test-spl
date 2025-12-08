@extends('layouts.app')

@section('title', 'SPL Manager')
@section('menuManagerSpl', 'active')

@section('content')
    @livewire('manager.spl.index')
@endsection