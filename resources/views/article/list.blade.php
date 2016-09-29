@extends('layout')

@section('css')
  @parent
  <style media="all">
      table td{
        max-width: 150px;
      }
  </style>

@endsection

@section('content')

@if(Session::has('success'))
    <div class="alert alert-success">
        {{ Session::get('success') }}
    </div>
@endif

<div class="pull-right">
  <ul class="nav">
    <li><a href="{{ route('langue', ['locale' => 'fr']) }}"><i class="fa fa-flag"></i> Français</a></li>
    <li><a href="{{ route('langue', ['locale' => 'en']) }}"><i class="fa fa-flag"></i> Anglais</a></li>
    <li><a href="{{ route('langue', ['locale' => 'es']) }}"><i class="fa fa-flag"></i> Espagnol</a></li>
    <li><a href="{{ route('langue', ['locale' => 'it']) }}"><i class="fa fa-flag"></i> Italien</a></li>
  </ul>
</div>


<table class="table">
  <thead>
    <th>
      Id
    </th>
    <th>
      @lang('messages.published_at')
    </th>
    <th>
      @lang('messages.titre')
    </th>

    <th>
      Description
    </th>
    <th>
      Image
    </th>
    <th>
      Note
    </th>
    <th>
      Visibilite
    </th>
    <th>
      Date de création
    </th>
    <th>
      Actions
    </th>
  </thead>
    <tbody>
        @forelse($articles as  $article)
          <tr>

            <td>
              <a href="{{ route('article.voir', ['id' => $article->id]) }}">
                {{ $article->id }}
              </a>
            </td>
            <td>
              @if (array_key_exists($article->id, session('likes', [])))
                <a href="{{ route('article.panier', ['id' => $article->id, 'action' => 'unlike']) }}">
                  <i class="fa fa-heart"></i>
                </a>
              @else
                <a href="{{ route('article.panier', ['id' => $article->id, 'action' => 'like']) }}">
                  <i class="fa fa-heart-o"></i>
                </a>
              @endif
            </td>
            <td>
              <i>{{ $article->date_publication }}</i>
            </td>

            <td>
              <p>{{ preg_replace('/\s+?(\S+)?$/', '', substr($article->titre, 0, 10))."..." }}</p>
            </td>

            <td style="font-size: 12px;">
              @if(strlen($article->description) > 2 )
              <p>{{ str_limit($article->description,150) }}</p>
              @else
                <p class="alert alert-danger">Aucune description</p>
              @endif
            </td>

            <td>
              <img class="img-responsive img-thumbnail"
              src="{{ $article->image }}" />
            </td>
            <td>
              <span class="label label-primary">{{ $article->note }} / 20</span>
            </td>
            <td style="text-align: center">
                <a href="{{ route('article.visibilite', ['id' => $article->id] ) }}">
                    @if($article->visibilite)
                        <i class="fa fa-check"></i>
                    @else
                        <i class="fa fa-times text-red"></i>
                    @endif
                </a>
            </td>
            <td>
            <span class="fa fa-clock-o"></span>  {{ date('d/m/Y à H:i', strtotime($article->date_creation)) }}
            </td>
            <td>
             <div class="delete">
               <a href="{{ route('article.delete', ['id' => $article->id]) }}"><i class="fa fa-trash-o fa-2x"></i></a>
             </div>
            </td>

          </tr>
        @empty
          <tr>
            <td>A pus....</td>
          </tr>
        @endforelse
    </tbody>
</table>
@endsection
