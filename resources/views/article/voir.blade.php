
@extends('layout')
  @section('css')
  @parent
  <link rel="stylesheet" href="{{asset('css/voirArticle.css')}}">
  @endsection


@section('content')

<div class="col-xs-9 col-xs-offset-1">
<table class="table table-bordered table-hover">
  <tr>
    <td>Titre</td>
    <td>{{ $article->titre }}</td>
  </tr>
  <tr>
  <td>Créer par</td>
  <td>{{ App\Article::articleAutCat($article->id)->prenom }}</td>
  </tr>
  <tr>
  <td>Catégorie</td>
  <td>{{ App\Article::articleAutCat($article->id)->cat_titre }}</td>
  </tr>
  <tr>
  <td>Résumé</td>
  <td>{{ $article->resume }}</td>
  </tr>
  <tr>
  <td>Description</td>
  <td>{{ $article->description }}</td>
  </tr>
  <tr>
  <td>Image</td>
  <td><img src="{{ $article->image }}" alt="" /></td>
  </tr>
  <tr>
    <td>Note</td>
    <td>{{ $article->note }} / 20</td>
  </tr>
  <tr>
  <td>Année publication</td>
  <td>{{ $article->date_publication }}</td>
  </tr>
  <tr>
  <td>Date de création</td>
  <td>{{ $article->created_at }}</td>
  </tr>
  <tr>
  <tr>
  <td>PDF</td>
  <td>
    <a href="{{ route('article.pdf', ['id' => $article->id]) }}"><i class="fa fa-file-pdf-o" aria-hidden="true"></i>
  </a>
</td>
  </tr>
  </table>
  {{-- On appel la class pour paginer avecla methode overRender et la page en argument --}}
</div>

@endsection
