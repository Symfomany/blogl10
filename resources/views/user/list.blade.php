@extends('layout')


@section('content')

<table class="table">
  <thead>
    <th>
      Id
    </th>
    <th>
      Nom
    </th>
    <th>
      Prénom
    </th>
  </thead>
    <tbody>
        @foreach($users as  $user)
          <tr>
            <td>
              {{ $user->id }}
            </td>
            <td>
              {{ $user->nom }}
            </td>
            <td>
              {{ $user->prenom }}
            </td>
          </tr>
        @endforeach
    </tbody>
</table>
@endsection
