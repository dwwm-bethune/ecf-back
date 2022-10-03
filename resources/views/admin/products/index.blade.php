@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Produits</h1>
    <a class="btn btn-primary" href="{{ route('admin.products.create') }}">Créer un produit</a>
</div>

<div>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Image</th>
                <th scope="col">Nom</th>
                <th scope="col">Prix</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
            <tr>
                <th scope="row">{{ $product->id }}</th>
                <td>
                    <img width="80" src="{{ $product->image }}" alt="">
                </td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->price_formatted }}</td>
                <td>
                    <a class="btn btn-primary" href="{{ route('admin.products.edit', $product) }}">Modifier</a>
                    <form action="{{ route('admin.products.update', $product) }}" method="post" class="d-inline">
                        @csrf @method('delete')
                        <button class="btn btn-danger">Supprimer</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
