@extends('layouts.app')

@section('title', 'Data Karyawan')
@section('menuManagerUser', 'active')

@section('content')
    @livewire('manager.user.index')
@endsection