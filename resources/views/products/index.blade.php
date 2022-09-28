@extends('layouts.base')

@section('content')
    <section class="jumbotron text-center">
        <div class="container">
            <h1 class="jumbotron-heading">Produits</h1>
            <p class="lead text-muted mb-0">Lorem ipsum dolor sit amet consectetur adipisicing elit. Molestiae, veniam, eius aliquam quidem rem sunt nam quaerat facilis ex error placeat ipsa illo sed inventore soluta ipsum cumque atque ea?</p>
        </div>
    </section>

    <div class="container">
        <div class="row">
            <div class="col">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('sweet-home') }}">Accueil</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Produits</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-12 col-md-3">
                <div class="card bg-light mb-3">
                    <div class="card-header bg-primary text-white text-uppercase"><i class="fa fa-list"></i> Filtres</div>
                    <form action="" method="get">
                        <ul class="list-group">
                            @foreach ($colors as $color)
                            <li class="list-group-item">
                                <div class="form-check">
                                    <input type="checkbox" name="color[]" value="{{ $color->name }}" class="form-check-input" id="color-{{ $color->id }}">
                                    <label class="form-check-label" for="color-{{ $color->id }}">{{ $color->name }}</label>
                                </div>
                            </li>
                            @endforeach
                            <li class="list-group-item">
                                <button class="btn btn-primary w-100">Filtrer</button>
                            </li>
                        </ul>
                    </form>
                </div>
                <div class="card bg-light mb-3">
                    <div class="card-header bg-primary text-white text-uppercase"><i class="fa fa-list"></i> Catégories</div>
                    <ul class="list-group category_block">
                        @foreach ($categories as $category)
                        <li class="list-group-item"><a href="{{ route('categories.show', [$category, $category->slug]) }}">{{ $category->name }}</a></li>
                        @endforeach
                    </ul>
                </div>
                <div class="card bg-light mb-3">
                    <div class="card-header bg-success text-white text-uppercase">Dernier produit</div>
                    <div class="card-body">
                        <img class="img-fluid" src="{{ $lastProduct->image }}" />
                        <h5 class="card-title mt-3">{{ $lastProduct->name }}</h5>
                        <p class="card-text">{{ $lastProduct->description_truncated }}</p>

                        <div class="row">
                            <div class="col">
                                <p class="btn btn-danger w-100">{{ $lastProduct->price_formatted }}</p>
                            </div>
                            <div class="col">
                                <a href="{{ route('products.show', [$lastProduct, $lastProduct->slug]) }}" class="btn btn-success w-100">Voir</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="row">
                    @foreach ($products as $product)
                    <div class="col-12 col-md-6 col-lg-4 mb-4">
                        <div class="card">
                            <img class="card-img-top" src="{{ $product->image }}" alt="{{ $product->name }}">
                            <div class="card-body">
                                <h4 class="card-title"><a href="{{ route('products.show', [$product, $product->slug]) }}" title="View Product">{{ $product->name }}</a></h4>
                                <p class="card-text">{{ $product->description_truncated }}</p>
                                <div class="row">
                                    <div class="col">
                                        <p class="btn btn-danger w-100">{{ $product->price_formatted }}</p>
                                    </div>
                                    <div class="col">
                                        <a href="cart.html" class="btn btn-success w-100">Ajouter</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    <div class="col-12">
                        {{ $products->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
