@extends('layouts.app')
@section('title', 'Technologies')
    
@section('content')
<header class="d-flex align-items-center justify-content-between">
    <h1 class="mt-5">Technologies</h1>
    <div class="d-flex align-items-center justify-content-end mt-5">
      <a href="{{ route('admin.technologies.create') }}" class="btn btn-success ms-3"><i class="fas fa-plus me-2"></i>Crea nuovo</a>
    </div>
</header>
<hr>
<table class="table">
    <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Label</th>
          <th scope="col">Colore</th>
          <th scope="col">Creato</th>
          <th scope="col">Aggiornato</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        @forelse($technologies as $technology)
        <tr>
            <th scope="row">{{ $technology->id }}</th>
            <td>{{ $technology->label }}</td>
            <td style="background-color: {{ $technology->color }}"width="10px"></td>
            <td>{{ $technology->created_at }}</td>
            <td>{{ $technology->updated_at }}</td>
            <td class="d-flex justify-content-end align-items-center">
                <a class="btn btn-outline-warning ms-2 btn-sm" href="{{ route('admin.technologies.edit', $technology->id) }}"><i class="fas fa-pencil"></i></a>
                <form method="POST" action="{{ route('admin.technologies.destroy', $technology->id) }}" class="delete-form" data-name="tipo">
                  @csrf
                  @method('DELETE')
                  <button class=" ms-2 btn btn-sm btn-outline-danger" type="submit"><i class="fas fa-trash"></i></button>
                </form>
            </td>
          </tr>
        @empty
        <tr>
            <th scope="row" colspan="5" class="text-center">Non ci sono tipi</th>
        </tr>
        @endforelse
      </tbody>
</table>
<div class="d-flex justify-content-end">
  @if( $technologies->hasPages())
  {{ $technologies->links()}}
  @endif
</div>
<hr>

@endsection