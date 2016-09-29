@extends('layout_email')

@section('content')
  <table cellpadding="0" cellspacing="0" border="0" align="center" width="600">
    <tr>
      <td width="100%" colspan="3" align="center" style="padding-bottom:10px;padding-top:25px;">
        <div class="contentEditableContainer contentTextEditable">
          <div class="contentEditable" >
            <h1>Rappel {{ $user->nom }} ! </h1>
          </div>
        </div>
      </td>
    </tr>
    <tr>
      <td width="100">&nbsp;</td>
      <td width="400" align="center" style="padding-bottom:5px;">
        <div class="contentEditableContainer contentTextEditable">
          <div class="contentEditable" >
            <p> Veuillez interagir avec la communauté en lâchant des commentaires </p>
            </div>
        </div>
      </td>
      <td width="100">&nbsp;</td>
    </tr>
  </table>
@endsection
