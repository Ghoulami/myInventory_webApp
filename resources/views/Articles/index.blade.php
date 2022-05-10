@extends("layout.layout")

@section("content")
<div class="row">
    <div class="col-12">

        <div class="mb-3">
            <h1>Liste des articles</h1>
            <div class="float-sm-right text-zero">
                <div class="btn-group">
                    <a href="{{ route('articles.create') }}" class="btn btn-primary btn-lg text-white">ADD NEW</a>
                </div>
            </div>
        </div>

        <div class="separator mb-5"></div>

        <div class="col-12 list" data-check-all="checkAll">
            <div class=" rounded card d-flex flex-row mb-3">
                <div class="pl-2 d-flex flex-grow-1 min-width-zero">
                    <div class="header-large card-body align-self-center d-flex flex-column flex-lg-row justify-content-between min-width-zero align-items-lg-center">
                        <h6 class="mb-1 w-10 w-sm-100 text-center">Image</h6>
                        <h6 class="mb-1 w-20 w-sm-100 text-center">Nom</h6>
                        <h6 class="mb-1 w-20 w-sm-100 text-center">Prix</h6>
                        <h6 class="mb-1 w-10 w-sm-100 text-center">Taxes</h6>
                        <h6 class="mb-1 w-15 w-sm-100 text-center">Qte dans le stock</h6>
                        <h6 class="mb-1 w-15 w-sm-100 text-center">Catégorie</h6>
                    </div>
                </div>
            </div>

            @foreach ($articles as $article)
                <div class="card d-flex flex-row mb-3">
                    <a class="d-flex w-10" href="{{ route('articles.show', $article ) }}">
                        <img src="{{ asset($article->image_path) }}" alt="Fat Rascal" class="list-thumbnail responsive border-0" />
                    </a>

                    <div class="pl-2 d-flex flex-grow-1 min-width-zero">
                        <div class="card-body align-self-center d-flex flex-column flex-lg-row justify-content-between min-width-zero align-items-lg-center">
                            <a href="{{ route('articles.show', $article ) }}" class="w-25 w-sm-100">
                                <p class="list-item-heading mb-1 truncate text-center">{{ $article->name }}</p>
                            </a>
                            <p class="mb-1 w-20 w-sm-100 text-center">{{ $article->price }} Dhs</p>
                            <p class="mb-1 w-15 w-sm-100 text-center">TVA: {{ $article->taxes }} %</p>
                            <div class="w-15 w-sm-100 text-center">
                                <span class="badge badge-pill {{ $article->qteInStock > 0 ? ($article->qteInStock <= 5 ? 'badge-warning' : 'badge-primary') : 'badge-danger' }} text-extra-small">{{ (int)$article->qteInStock }} Unité</span>
                            </div>
                            <p class="mb-1 w-15 w-sm-100 text-center">{{ isset($article->category) ? $article->category->groupeName : '-'  }}</p>
                        </div>

                        {{-- <div class="custom-control custom-checkbox pl-1 align-self-center pr-4">
                            <label class="custom-control custom-checkbox mb-0">
                                <input type="checkbox" class="custom-control-input">
                                <span class="custom-control-label"></span>
                            </label>
                        </div> --}}
                    </div>
                </div>
            @endforeach

            <nav class="mt-4 mb-3 pagination justify-content-center mb-0">
                {{ $articles->links() }}
            </nav>

        </div>
    </div>
</div>
{{-- <div class="col-12">
            <div class="mb-3">
                <h1>Liste des articles</h1>
                <div class="float-sm-right text-zero">
                    <a href="{{ route('Articles.create') }}" class="btn btn-primary top-right-button mr-1 text-white">ADD NEW</a>

                    <div class="btn-group">
                        <div class="btn btn-primary btn-lg pl-4 pr-0 check-button">
                            <label class="custom-control custom-checkbox mb-0 d-inline-block">
                                <input type="checkbox" class="custom-control-input" id="checkAll">
                                <span class="custom-control-label"></span>
                            </label>
                        </div>
                        <button type="button" class="btn btn-lg btn-primary dropdown-toggle dropdown-toggle-split pl-2 pr-2"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="#">Delete</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mb-2">
                <a class="btn pt-0 pl-0 d-inline-block d-md-none" data-toggle="collapse" href="#displayOptions"
                    role="button" aria-expanded="true" aria-controls="displayOptions">
                    Display Options
                    <i class="simple-icon-arrow-down align-middle"></i>
                </a>
            </div>
            <div class="separator mb-5"></div>
        </div> --}}
@endsection
