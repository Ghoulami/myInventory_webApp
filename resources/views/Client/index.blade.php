@extends("layout.layout")

@section("content")
<div class="container-fluid disable-text-selection">
    <div class="row">
        <div class="col-12">
            <div class="mb-2">
                <h1>List des client</h1>
                <div class="float-sm-right text-zero">
                    <div class="btn-group">
                        <button type="button" class="btn btn-outline-primary mb-2" data-toggle="modal" data-target="#addClientModalContent">Nouveau client</button>
                    </div>
                </div>
            </div>
            <div class="separator mb-5"></div>
        </div>
    </div>

    <div class="row">
        <div class="col-12 list" id="dataset-list">
            @foreach ($clients as $client)
                <div class="card d-flex flex-row mb-3 active">
                    <div class="d-flex flex-grow-1 min-width-zero">
                        <div class="card-body align-self-center d-flex flex-column flex-md-row justify-content-between min-width-zero align-items-md-center">
                            <a class="list-item-heading m-1 truncate w-50 w-xs-100" href="#">
                                {{ $client->name }}
                            </a>
                            <div class="w-25 m-1 w-xs-100">
                                {{$client->phone}}
                            </div>
                            <div class="w-25 m-1 w-xs-100">
                                {{$client->email}}
                            </div>
                            <div class="w-10 m-1 w-xs-100">
                                @if ($client->type == 1)
                                    <span class="badge badge-pill btn-info text-extra-small">Client actuel</span>
                                @elseif ($client->type == 0)
                                    <span class="badge badge-pill btn-success text-extra-small">Client fidèle</span>
                                @elseif ($client->type == 2)
                                    <span class="badge badge-pill btn-warning text-extra-small">Client ancien</span>
                                @endif
                            </div>

                            {{-- <div class="w-10 w-xs-100">
                                <button type="button" class="btn btn-success btn-xs updateBtn" data-toggle="modal" data-id="{{ $category->id }}"  data-target="#updateModalContent"><i class="glyph-icon simple-icon-pencil"></i></button>
                                <button type="button" class="btn btn-danger btn-xs deleteBtn" data-id="{{ $category->id }}" data-toggle="modal" data-target="#confirmDeleteModal"><i class="glyph-icon simple-icon-trash"></i></button>
                            </div> --}}
                        </div>
                    </div>
                </div>
            @endforeach

            <nav class="mt-4 mb-3 pagination justify-content-center mb-0">
                {{ $clients->links() }}
            </nav>

            <div class="modal fade modal-right" id="addClientModalContent" tabindex="-1" role="dialog" aria-labelledby="exampleModalRight" aria-hidden="true" style="display: none;">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Ajouter nouveau client</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <form method="post" action="{{ route('clients.store') }}">
                        @csrf
                            <div class="modal-body">
                                <div class="form-group">
                                    <label>Nom du client</label>
                                    <input type="text" value="{{ old('name') }}" class="{{ $errors->has('name') ? 'invalid' : '' }} form-control" name="name" placeholder="clien: xxx"/>
                                </div>
                                @error('name')
                                    <div class="invalid-flag mb-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <div class="form-group">
                                    <label>Num Telephone</label>
                                    <input  type="phone" value="{{ old('phone') }}" placeholder="06 xx xx xx xx" name="phone" class="form-control"/>
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input  type="email" value="{{ old('email') }}" placeholder="xxxxx@xxxxx.xxx" name="email" class="form-control"/>
                                </div>
                                <div class="form-group">
                                    <label>Adresse</label>
                                    <input  type="address" value="{{ old('adresse') }}" placeholder="adresse" name="adresse" class="form-control" >
                                </div>

                                <div class="form-group">
                                    <label>Client </label>
                                    <div class="custom-control custom-checkbox">
                                        <input type="radio" class="custom-control-input" name="type" value='1' id="actual" checked>
                                        <label class="custom-control-label" for="actual">Actual</label>
                                    </div>
                                    <div class="custom-control custom-checkbox">
                                        <input type="radio" class="custom-control-input" name="type" value="0" id="fidele">
                                        <label class="custom-control-label" for="fidele" >Fidèle</label>
                                    </div>
                                    <div class="custom-control custom-checkbox">
                                        <input type="radio" class="custom-control-input" name="type" value="2" id="ancien">
                                        <label class="custom-control-label" for="ancien">Ancien</label>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            {{-- <div class="modal fade" id="exampleModalContent" tabindex="-1" role="dialog" style="display: none;" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5>Ajouter une nouvelle catégorie</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="{{ route('categories.store') }}" id="categoryForm">
                                <div class="form-group">
                                    <label for="recipient-name" class="col-form-label">label:</label>
                                    <input type="text" class="form-control" id="groupeName" name="groupeName">
                                    @error('groupeName')
                                        <div class="invalid-flag">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" id="addSubmit" onclick="addCategorySubmit()" >Submit</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="updateModalContent" tabindex="-1" role="dialog" style="display: none;" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5>Modifier une catégorie</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="updateCategoryForm">
                                <div class="form-group">
                                    <label for="recipient-name" class="col-form-label">label:</label>
                                    <input type="text" class="form-control" id="groupeName" name="groupeName">
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-success" id="editSubmit" onclick="editCategorySubmit()">Modifier</button>
                        </div>
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
                            voulez vous vraiment supprimer cette categorie ?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Quiter</button>
                            <button type="button" class="btn btn-danger" onclick="confirmDeleteClicked()">Supprimer</button>
                        </div>
                    </div>
                </div>
            </div> --}}

        </div>
    </div>
</div>
@endsection
