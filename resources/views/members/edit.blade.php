@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Edit Anggota</h3>

    <form action="{{ route('members.update', $member) }}" method="POST">
        @csrf
        @method('PUT')
        @include('members._form')
    </form>
</div>
@endsection