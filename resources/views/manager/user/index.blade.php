@extends('layouts.app')

@section('title', 'Data Department')
@section('menuManagerUser', 'active')

@section('content')
    @livewire('manager.user.index')
@endsection