@extends("layout.layout")

@section("content")
    <div class="row">
        <div class="col-12">

            <div class="mb-3">
                <h1>Nouveau article</h1>
                <div class="float-sm-right text-zero">
                    <div class="btn-group">
                        <a href="{{ route('Articles.create') }}" class="btn btn-primary btn-lg text-white">ADD NEW</a>
                    </div>
                </div>
            </div>

            <div class="separator mb-5"></div>

            <form method="POST" action="{{ route('Articles.store') }}" class="needs-validation" enctype="multipart/form-data" novalidate>
                 @csrf
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="mb-4">Image</h5>
                        <div class="form-row">
                            <div class="input-group col-md-10 mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Télécharger</span>
                                </div>
                                <div class="custom-file">
                                    <input type="file"  accept="image/*" class="custom-file-input" id="image" name="image">
                                    <label class="custom-file-label" for="image">Sélectionner une image</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="mb-4">informations principales</h5>
                        <div class="form-row">
                            <div class="col-md-12 mb-3">
                                <label for="name">Nom de l'article</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Nom article" required>
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-6 mb-3">
                                <label for="price">Prix unitaire (DH)</label>
                                <input type="number" step="1.0" value="0" class="form-control" id="price" name="price" placeholder="0.00" required>
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="taxes">TVA (%)</label>
                                <input type="number" step="1.0" value="0" class="form-control" id="taxes" name="taxes" placeholder="0.00" required>
                                <div class="invalid-feedback">
                                    Please ....
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-6 mb-3">
                                <label for="qte">Qte dans le Stock</label>
                                <input type="number" step="1" value="0" class="form-control" id="qte" name="qte" placeholder="0" required>

                                <div class="invalid-feedback">
                                    Please provide a valid city.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="mb-4">Plus de détails</h5>
                        <div class="form-row">
                            <div class="col-md-6 mb-3">
                                <label for="weight">Poids (Kg)</label>
                                <input type="number" step="1.0" class="form-control" id="weight" value="0" name="weight" placeholder="0.00">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="volume">Volume (L)</label>
                                <input type="number" step="1.0" value="0" class="form-control" id="volume" name="volume" placeholder="0.00">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-12 mb-3">
                                <label for="category">Categorie</label>
                                <select id="category" name="category" class="form-control">
                                    <option value="">Séléctioner...</option>
                                    <option>...</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col-md-12 mb-3">
                                <label for="description">Description</label>
                                <textarea class="form-control" name="description" id="description" rows="5"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <button class="btn btn-primary" type="submit">Submit form</button>
            </form>
        </div>
    </div>
@endsection
