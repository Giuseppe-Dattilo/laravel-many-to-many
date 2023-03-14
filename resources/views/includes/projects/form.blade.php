@if ($project->exists)
  <form action="{{ route('admin.projects.update', $project->id) }}" method="POST" enctype="multipart/form-data">
    @method('PUT')
  @else
   <form action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data">
@endif

@csrf
    <div class="row">
        <div class="col-md-6">
            <div class="mb-3">
                <label for="name" class="form-label">Nome</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $project->name) }}">
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @else
                    <div class="text-muted">Inserisci il Nome</div>
                @enderror
            </div>    
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="mb-3">
                <label for="description" class="form-label">Contenuto</label>
                <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="10">{{ old('description', $project->description) }}"</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror 
            </div>
        </div> 
    </div> 
    <div class="row">
        <div class="col-md-4">
            <label for="type_id" class="form-label">Tipo</label>
            <select class="form-select @error('type_id') is-invalid @enderror" name="type_id" id="type_id">
                <option value="">Nessun tipo</option>
                @foreach ($types as $type)
                <option @if(old('type_id', $project->type_id) == $type->id) selected @endif value="{{ $type->id }}">{{ $type->label }}</option> 
                @endforeach
              </select>
              @error('type_id')
                    <div class="invalid-feedback">{{ $message }}</div>
              @enderror
        </div>
        <div class="col-md-7">
            <div class="mb-3">
                <label for="image" class="form-label">Immagine</label>
                <input type="file" class="form-control @if($project->image) d-none @endif" id="image" name="image">
                  
                <div class="input-group mb-3 @if(!$project->image) d-none @endif" id="previous-image">
                    <button class="btn btn-outline-secondary" type="button" id="change-image-button">Cambia immagine</button>
                    <input type="text" class="form-control" value=" {{ $project->image }}" disabled>
                  </div>
            </div>
        </div>  
        <div class="col-md-1 d-flex align-items-center mb-1">
            <img class="img-fluid" id="img-preview" src="{{ $project->image ? asset('storage/' . $project->image) : 'https://marcolanci.it/utils/placeholder.jpg' }}" alt="">
        </div>
    </div> 
    <div class="row align-items-center">
        <div class="col-10">
            @foreach ($technologies as $technology)
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" id="tag-{{ $technology->label }}" value="{{ $technology->id }}" name="technologies[]" @if(in_array($technology->id, old('technologies', $project_technologies ?? []))) checked @endif>
                <label class="form-check-label" for="tag-{{$technology->label}}">{{ $technology->label }}</label>
              </div>
            @endforeach
            @error('technologies')
                <small class="invalid-feedback d-block">{{ $message }}</small>
            @enderror
        </div>
        <div class="col-2 d-flex justify-content-end">
            <div class="form-check form-switch my-4">
                <input class="form-check-input" type="checkbox" role="switch" id="is_published" name="is_published" 
                 @if (old('is_published', $project->is_published)) checked @endif>
                <label class="form-check-label" for="is_published">Pubblicato</label>
              </div>
        </div>
    </div>
    <div class="d-flex justify-content-end">
        <a href="{{ route('admin.projects.index')}}" class="btn btn-outline-secondary me-2"><i class="fas fa-arrow-left me-2"></i>Indietro</a>    
        <button type="submit" class="btn btn-outline-secondary"><i class="fas fa-floppy-disk me-2"></i>Salva</button>    
    </div>  
  </form>
  
  @section('scripts')
  {{-- preview img --}}
  <script>

    const placeholder = 'https://marcolanci.it/utils/placeholder.jpg';

    const imageInput = document.getElementById('image');
    const imagePreview = document.getElementById('img-preview');

    imageInput.addEventListener('change', () => {
        if(imageInput.files && imageInput.files[0]) {
            const reader = new FileReader();
            reader.readAsDataURL(imageInput.files[0]);

            reader.onload = e => {
                imagePreview.src = e.target.result;
            }
        }
        else imagePreview.src = placeholder;
    });
  </script>
  
   
  <script>
    const previousImageField = document.getElementById('previous-image');
    const changeImageButton = document.getElementById('change-image-button');


    const showFileInput = () => {
        imageInput.classList.remove('d-none');
        previousImageField.classList.add('d-none');
        imagePreview.setAttribute('src', placeholder);
        imageInput.click();
    }

    changeImageButton.addEventListener('click',showFileInput);
  </script>
  @endsection