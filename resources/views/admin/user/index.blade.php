@extends('layouts.app')

@section('title', 'Data Karyawan')
@section('menuAdminUser', 'active')

@section('content')
    @livewire('admin.user.index')
@endsection