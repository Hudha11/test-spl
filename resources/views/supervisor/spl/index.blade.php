@extends('layouts.app')

@section('title', 'SPL Supervisor')
@section('menuSupervisorSpl', 'active')

@section('content')
    @livewire('supervisor.spl.index')
@endsection