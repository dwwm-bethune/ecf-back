@extends('layouts.base')

@section('content')
<section class="jumbotron text-center">
    <div class="container">
        <h1 class="jumbotron-heading">Panier</h1>
     </div>
</section>

<div class="container mb-4">
    <div class="row">
        <div class="col-12">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col"> </th>
                            <th scope="col">Produit</th>
                            <th scope="col">Couleur</th>
                            <th scope="col" class="text-center">Quantité</th>
                            <th scope="col" class="text-right">Prix</th>
                            <th> </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach (session('cart', []) as $item)
                        <tr>
                            <td><img width="75" src="{{ $item->product->image }}" /></td>
                            <td>{{ $item->product->name }}</td>
                            <td>{{ optional($item->color)->name }}</td>
                            <td><input class="form-control" type="text" value="{{ $item->quantity }}" /></td>
                            <td class="text-right">
                                {{ $item->product->price($item->quantity) }}
                                ({{ $item->product->promo }})
                            </td>
                            <td class="text-right">
                                <form action="{{ route('cart.destroy', $item->product) }}" method="post">
                                    @csrf @method('delete')
                                    <button class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>Sous-Total</td>
                            <td class="text-right">{{ $subtotal }}</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>Frais de port</td>
                            <td class="text-right">{{ $delivery }}</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td><strong>Total</strong></td>
                            <td class="text-right"><strong>{{ $total }}</strong></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col mb-2">
            <div class="row">
                <div class="col-sm-12  col-md-6">
                    <button class="btn w-100 btn-light">Continuer vos achats</button>
                </div>
                <div class="col-sm-12 col-md-6 text-right">
                    <button class="btn btn-lg w-100 btn-success text-uppercase">Commander</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
