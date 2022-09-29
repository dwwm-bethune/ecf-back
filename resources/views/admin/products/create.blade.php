@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Ajouter un produit</h1>
    <a class="btn btn-primary" href="{{ route('admin.products') }}">Retour à la liste</a>
</div>

<div>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.products') }}" method="post" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="name">Nom</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}">
        </div>

        <div class="mb-3">
            <label for="description">Description</label>
            <textarea name="description" id="description" class="form-control">{{ old('description') }}</textarea>
        </div>

        <div class="mb-3">
            <label for="price">Prix</label>
            <input type="number" name="price" id="price" class="form-control" value="{{ old('price') }}">
        </div>

        <div class="mb-3">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="favorite" name="favorite" value="1" @checked(old('favorite'))>
                <label class="form-check-label" for="favorite">
                    Coup de coeur ?
                </label>
            </div>
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Image</label>
            <input class="form-control" type="file" id="image" name="image">
        </div>

        <div class="mb-3">
            <label for="discount">Promotion</label>
            <input type="number" name="discount" id="discount" class="form-control" value="{{ old('discount') }}">
        </div>

        <div class="row">
            <div class="col-lg-6">
                <div class="mb-3">
                    <label>Catégorie</label>
                    @foreach ($categories as $category)
                        <div class="form-check">
                            <input class="form-check-input" type="radio" id="category-{{ $category->id }}" name="category" value="{{ $category->id }}" @checked($category->id == old('category'))>
                            <label class="form-check-label" for="category-{{ $category->id }}">
                                {{ $category->name }}
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="col-lg-6">
                <div class="mb-3">
                    <label>Couleurs</label>
                    @foreach ($colors as $color)
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="color-{{ $color->id }}" name="colors[]" value="{{ $color->id }}" @checked(in_array($color->id, old('colors', [])))>
                            <label class="form-check-label" for="color-{{ $color->id }}">
                                {{ $color->name }}
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <button class="btn btn-primary">Ajouter</button>
    </form>
</div>
@endsection
