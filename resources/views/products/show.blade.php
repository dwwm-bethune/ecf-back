@extends('layouts.base')

@section('content')
    <section class="jumbotron text-center">
        <div class="container">
            <h1 class="jumbotron-heading">{{ $product->name }}</h1>
            <p class="lead text-muted mb-0">{{ $product->description }}</p>
        </div>
    </section>

    <div class="container">
        <div class="row">
            <div class="col">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('sweet-home') }}">Accueil</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('categories.show', [$product->category, $product->category->slug]) }}">{{ $product->category->name }}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $product->name }}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <!-- Modal image -->
    <div class="modal fade" id="productModal" tabindex="-1" role="dialog" aria-labelledby="productModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="productModalLabel">{{ $product->name }}</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <img class="img-fluid" src="{{ $product->image }}" />
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <!-- Image -->
            <div class="col-12 col-lg-6">
                <div class="card bg-light mb-3">
                    <div class="card-body">
                        <a href="" data-bs-toggle="modal" data-bs-target="#productModal">
                            <img class="img-fluid" src="{{ $product->image }}" />
                            <p class="text-center">Zoom</p>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Add to cart -->
            <div class="col-12 col-lg-6 add_to_cart_block">
                <div class="card bg-light mb-3">
                    <div class="card-body">
                        <p class="price">{{ $product->promo }}</p>
                        @if ($product->promo)
                        <p class="price_discounted">{{ $product->price_formatted }}</p>
                        @endif
                        <form method="get" action="cart.html">
                            <div class="mb-3">
                                <label for="colors">Couleur</label>
                                <select class="form-select" id="colors">
                                    <option selected>Choisir</option>
                                    @foreach ($product->colors as $color)
                                    <option value="{{ $color }}">{{ $color }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label>Quantité :</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <button type="button" class="quantity-left-minus btn btn-danger btn-number"  data-type="minus" data-field="">
                                            <i class="fa fa-minus"></i>
                                        </button>
                                    </div>
                                    <input type="text" class="form-control"  id="quantity" name="quantity" min="1" max="100" value="1">
                                    <div class="input-group-append">
                                        <button type="button" class="quantity-right-plus btn btn-success btn-number" data-type="plus" data-field="">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <a href="cart.html" class="btn btn-success btn-lg w-100 text-uppercase">
                                <i class="fa fa-shopping-cart"></i> Ajouter
                            </a>
                        </form>
                        <div class="product_rassurance">
                            <ul class="list-inline">
                                <li class="list-inline-item"><i class="fa fa-truck fa-2x"></i><br/>Livraison rapide</li>
                                <li class="list-inline-item"><i class="fa fa-credit-card fa-2x"></i><br/>Paiement sécurisé</li>
                                <li class="list-inline-item"><i class="fa fa-phone fa-2x"></i><br/> {{ config('services.info.phone') }}</li>
                            </ul>
                        </div>
                        <div class="reviews_product p-3 mb-2 ">
                            {{ $product->reviews->count() }} avis
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            ({{ $product->reviews->avg('note') }}/5)
                            <a class="pull-right" href="#reviews">Voir tous les avis</a>
                        </div>
                        <div class="datasheet p-3 mb-2 bg-info text-white">
                            <a href="" class="text-white"><i class="fa fa-file-text"></i> Télécharger la fiche produit</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Description -->
            <div class="col-12">
                <div class="card border-light mb-3">
                    <div class="card-header bg-primary text-white text-uppercase"><i class="fa fa-align-justify"></i> Description</div>
                    <div class="card-body">
                        <p class="card-text">
                            {!! Str::markdown($product->description) !!}
                        </p>
                    </div>
                </div>
            </div>

            <!-- Reviews -->
            <div class="col-12" id="reviews">
                <div class="card border-light mb-3">
                    <div class="card-header bg-primary text-white text-uppercase"><i class="fa fa-comment"></i> Avis</div>
                    <div class="card-body">
                        @foreach ($product->reviews as $review)
                        <div class="review">
                            <span class="glyphicon glyphicon-calendar" aria-hidden="true"></span>
                            <meta itemprop="datePublished" content="{{ $review->created_at->translatedFormat('d-m-Y') }}">{{ $review->created_at->translatedFormat('d F Y') }}

                            @for ($i = 0; $i < $review->note; $i++)
                            <span class="fa fa-star"></span>
                            @endfor
                            par {{ $review->name }}
                            <p class="blockquote">
                                <p class="mb-0">{{ $review->message }}</p>
                            </p>
                            <hr>
                        </div>
                        @endforeach

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('reviews.store', $review) }}" method="post">
                            @csrf

                            <div class="mb-3">
                                <label for="name">Nom</label>
                                <input type="text" name="name" class="form-control" id="name" value="{{ optional(Auth::user())->name }}">
                            </div>

                            <div class="mb-3">
                                <label for="note">Note</label>
                                <select name="note" class="form-select" id="note">
                                    @for ($i = 0; $i <= 5; $i++)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="message">Message</label>
                                <textarea name="message" id="message" class="form-control"></textarea>
                            </div>

                            <button class="btn btn-primary">Envoyer</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
