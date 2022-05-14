@if($article->exists)
<form method="POST" enctype="multipart/form-data" action="{{ route('articles.update',$article) }}">
    @method('put')
    <input type="text" name="hideImage" value="{{$article->image_path}}" hidden>
@else
<form  method="POST" action="{{ route('articles.store') }}" enctype="multipart/form-data">
@endif
    @csrf
   <div class="card mb-4">
       <div class="card-body">
           <h5 class="mb-4">Image</h5>
           <div class="form-row">
               <div class=" input-group col-md-10 mb-3">
                   <div class="input-group-prepend">
                       <span class="{{ $errors->has('image_path') ? 'invalid' : '' }} input-group-text">Télécharger</span>
                   </div>
                   <div class="custom-file">
                       <input type="file"  accept="image/*" class="custom-file-input" id="image" name="image_path">
                       <label class="{{ $errors->has('image_path') ? 'invalid' : '' }} custom-file-label" for="image" id='imageLabel'>Sélectionner une image</label>
                    </div>
                    @error('image_path')
                         <div class="invalid-flag">
                             {{ $message }}
                         </div>
                     @enderror
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
                   <input type="text" class="{{ $errors->has('name') ? 'invalid' : '' }} form-control" id="name" name="name" value="{{ old('name', $article->name ) }}" placeholder="Nom article">
                   @error('name')
                        <div class="invalid-flag">
                            {{ $message }}
                        </div>
                    @enderror
               </div>
           </div>
           <div class="form-row">
               <div class="col-md-6 mb-3">
                   <label for="price">Prix unitaire (DH)</label>
                   <input type="number" step="1.0" class="{{ $errors->has('price') ? 'invalid' : '' }} form-control" id="price" name="price" value="{{ old('price', $article->price ) }}" placeholder="0.00">
                   @error('price')
                        <div class="invalid-flag">
                            {{ $message }}
                        </div>
                    @enderror
               </div>
               <div class="col-md-6 mb-3">
                   <label for="taxes">TVA (%)</label>
                   <input type="number" step="1.0" class="{{ $errors->has('taxes') ? 'invalid' : '' }} form-control" id="taxes" name="taxes" value="{{ old('taxes', $article->taxes ) }}" placeholder="0.00">
                   @error('taxes')
                        <div class="invalid-flag">
                            {{ $message }}
                        </div>
                    @enderror
               </div>
           </div>
           <div class="form-row">
               <div class="col-md-6 mb-3">
                   <label for="qte">Qte dans le Stock</label>
                   <input type="number" step="1" class="{{ $errors->has('qteInStock') ? 'invalid' : '' }} form-control" id="qteInStock" name="qteInStock" value="{{ old('qteInStock', $article->qteInStock ) }}" placeholder="0">
                   @error('qteInStock')
                        <div class="invalid-flag">
                            {{ $message }}
                        </div>
                    @enderror
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
                   <input type="number" step="1.0" class="form-control" id="weight" value="0" value="{{ old('weight', $article->weight ) }}" name="weight" placeholder="0.00">
               </div>
               <div class="col-md-6 mb-3">
                   <label for="volume">Volume (L)</label>
                   <input type="number" step="1.0" value="0" class="form-control" id="volume" name="volume" value="{{ old('volume', $article->volume ) }}" placeholder="0.00">
               </div>
           </div>
           <div class="form-row">
               <div class="col-md-12 mb-3">
                   <label for="category">Categorie</label>
                   <select id="category" name="category" class="form-control">
                       <option value="">Séléctioner...</option>
                       @foreach ($categories as $cateory)
                        <option {{ isset($article->category) && ($cateory->id ==  $article->category->id) ? 'selected' : ''}} value="{{ $cateory->id }}">{{ $cateory->groupeName }}</option>
                       @endforeach
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
