@extends('components.layouts.app')
@section('content')

<div class="container m-3">
    @if(session()->has('success_message'))
        <div class="alert alert-success" role="alert">
            {{ session('success_message') }}
        </div>
    @endif

    @livewire('product.list-product')

    @section('script')
        <script>
            document.addEventListener('livewire:load', function () {
                Livewire.on('productCreated', function () {
                    Livewire.emit('refreshComponent');
                });
            });
        </script>
    @endsection
</div>

@endsection
