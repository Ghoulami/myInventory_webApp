@extends("layout.layout")
@section("metaSection")
    <meta name="csrf-token" content="{{ csrf_token() }}" />
@endsection

@section("content")
<div class="container-fluid disable-text-selection">
    <div class="row">
        <div class="col-12">
            <div class="mb-2">
                <h1>List des categories</h1>
                <div class="float-sm-right text-zero">
                    <div class="btn-group">
                        <button type="button" class="btn btn-outline-primary mb-2" data-toggle="modal" data-target="#exampleModalContent">Nouvelle catégorie</button>
                    </div>
                </div>

                <div class="modal fade" id="exampleModalContent" tabindex="-1" role="dialog" style="display: none;" aria-hidden="true">
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

            </div>
            <div class="separator mb-5"></div>
        </div>
    </div>

    <div class="row">
        <div class="col-12 list" id="dataset-list">

            <template id="dataset-row">
                <div class="card d-flex flex-row mb-3 active">
                    <div class="d-flex flex-grow-1 min-width-zero">
                        <div class="card-body align-self-center d-flex flex-column flex-md-row justify-content-between min-width-zero align-items-md-center">
                            <p class="list-item-heading m-1 truncate w-60 w-xs-100" href="Layouts.Details.html" id="CategoryName"></p>
                            <div class="w-20 m-1 w-xs-100">
                                <span class="badge badge-pill badge-secondary text-extra-small" id="nbrArticles"></span>
                            </div>
                            <a href="#" class="m-1 text-small w-20 w-xs-100">Afficher les articles</a>

                            <div class="w-10 w-xs-100">
                                <button type="button" class="btn btn-success btn-xs" data-toggle="modal" id="updateBtn" data-id="" data-target="#updateModalContent"><i class="glyph-icon simple-icon-pencil"></i></button>
                                <button type="button" class="btn btn-danger btn-xs" id="deleteBtn" data-id=""><i class="glyph-icon simple-icon-trash"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </template>

            <template>
                <nav class="mt-4 mb-3">
                    <ul class="pagination justify-content-center mb-0">
                        <li class="page-item ">
                            <a class="page-link first" href="#">
                                <i class="simple-icon-control-start"></i>
                            </a>
                        </li>
                        <li class="page-item ">
                            <a class="page-link prev" href="#">
                                <i class="simple-icon-arrow-left"></i>
                            </a>
                        </li>
                        <li class="page-item active">
                            <a class="page-link" href="#">1</a>
                        </li>
                        <li class="page-item ">
                            <a class="page-link" href="#">2</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="#">3</a>
                        </li>
                        <li class="page-item ">
                            <a class="page-link next" href="#" aria-label="Next">
                                <i class="simple-icon-arrow-right"></i>
                            </a>
                        </li>
                        <li class="page-item ">
                            <a class="page-link last" href="#">
                                <i class="simple-icon-control-end"></i>
                            </a>
                        </li>
                    </ul>
                </nav>
            </template>

            {{-- @foreach ($categories as $category)
                <div class="card d-flex flex-row mb-3 active">
                    <div class="d-flex flex-grow-1 min-width-zero">
                        <div class="card-body align-self-center d-flex flex-column flex-md-row justify-content-between min-width-zero align-items-md-center">
                            <p class="list-item-heading m-1 truncate w-60 w-xs-100" href="Layouts.Details.html">
                                {{ $category->groupeName }}
                            </p>
                            <div class="w-20 m-1 w-xs-100">
                                <span class="badge badge-pill badge-secondary text-extra-small">{{ $category->articles_count }} Peoduit</span>
                            </div>
                            <a href="#" class="m-1 text-small w-20 w-xs-100">Afficher les articles</a>

                            <div class="w-10 w-xs-100">
                                <button type="button" class="btn btn-success btn-xs"><i class="glyph-icon simple-icon-pencil"></i></button>
                                <button type="button" class="btn btn-danger btn-xs"><i class="glyph-icon simple-icon-trash"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach --}}


            <nav class="mt-4 mb-3 pagination justify-content-center mb-0">
                {{ $categories->links() }}
            </nav>
        </div>
    </div>
</div>
@endsection

@section("jsSection")
<script src="{{URL::asset('js/app.js')}}"></script>
@endsection
