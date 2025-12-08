@extends('layouts.app')

@section('title', 'Lembur')
@section('menuKaryawanLembur', 'active')

@section('content')
    @livewire('karyawan.lembur.index')
@endsection