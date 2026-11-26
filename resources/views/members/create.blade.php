@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Tambah Anggota</h3>

    <form action="{{ route('members.store') }}" method="POST">
        @csrf
        @include('members._form')
    </form>
</div>
@endsection