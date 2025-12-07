@extends('layouts.app')

@section('title', 'Approval')
@section('menuManagerApproval', 'active')

@section('content')
    @livewire('manager.approval.index')
@endsection