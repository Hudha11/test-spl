@extends('layouts.app')

@section('title', 'Approval')
@section('menuAdminApproval', 'active')

@section('content')
    @livewire('admin.approval.index')
@endsection