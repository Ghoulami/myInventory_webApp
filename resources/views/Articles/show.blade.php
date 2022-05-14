@extends('layout.layout')

@section('content')
<div class="row">
    <div class="col-12 list">
        <div class="mb-3">
            <h1>{{ $article->name }}</h1>
            <div class="float-sm-right text-zero">
                <div class="btn-group">
                    <a href="{{ route('articles.edit', $article) }}" class="btn btn-outline-success">Modifier l'article</a>
                </div>
                <div class="btn-group">

                    <button type="submit" class="btn btn-outline-danger" data-toggle="modal" data-target="#confirmDeleteModal">Supprimer l'article</button>

                    {{-- <form action="{{ route('articles.destroy', $article) }}" method="post">
                        @method('delete')
                        @csrf
                        <button type="submit" class="btn btn-outline-danger">Supprimer l'article</button>
                    </form> --}}
                </div>
            </div>
        </div>

        <div class="separator mb-5"></div>
    </div>

    <div class="col-lg-4 col-12 mb-4">
        <div class="card">
            <div class="position-relative">
                <img class="card-img-top" src="{{ asset( $article->image_path) }}" alt="Card image cap">
                @if (isset($article->category))
                    <span class="badge badge-pill badge-secondary position-absolute badge-top-left-2">{{$article->category->groupeName}}</span>
                @endif
            </div>

            <div class="card-body">
                <div class="border">
                    <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                        plus de details...
                    </button>

                    <div id="collapseOne" class="collapse" data-parent="#accordion" style="">
                        <div>
                            <p class="mb-1">Poids: {{ $article->weight }} Kg</p>
                            <p class="mb-1">Volume: {{ $article->volume }} l</p>
                        </div>
                    </div>
                </div>
                <footer>
                    <p class="text-muted text-small mb-0 font-weight-light">{{ $article->created_at->format('m/d/Y') }}</p>
                </footer>
            </div>
        </div>
    </div>

    <div class="card col-lg-8 col-12">
        <div class="card-body">
            <p class="text-muted mb-2">Description</p>
            <p class="mb-3">{{ $article->description }}</p>

            <p class="text-muted mb-2">Prix</p>
            <p class="mb-3">{{ $article->price }} Dhs</p>

            <p class="text-muted mb-2">Taxes</p>
            <p class="mb-3">TVA : {{ $article->taxes }} %</p>

            <p class="text-muted mb-2">Qte dans le stock</p>
            <span class="badge badge-pill {{ $article->qteInStock > 0 ? ($article->qteInStock <= 5 ? 'badge-warning' : 'badge-primary') : 'badge-danger' }} text-small">{{ (int)$article->qteInStock }} Unité</span>
        </div>
    </div>
</div>

<div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">confirmation de l'opération suppression</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                voulez vous vraiment supprimer ce Article ?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Quiter</button>
                <form action="{{ route('articles.destroy', $article) }}" method="post">
                    @method('delete')
                    @csrf
                    <button type="submit" class="btn btn-outline-danger">Supprimer</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
