@extends('layouts.app')

@section('title', 'Data Karyawan')
@section('menuAdminrUser', 'active')

@section('content')
    @livewire('admin.user.index')
@endsection