
<form method="post" action="{{route('adminDoDropClientList')}}">
    @csrf
<table class="table table-hover">
    <tbody>
    <tr>
        <th>Sel.</th>
        <th>N° CNI</th>
        <th>Nom </th>
        <th>Date de naissance </th>
        <th>Contact</th>
        <th>Pseudo</th>
        <th>Etat</th>
        <th>Plus...</th>
        <th>Retirer</th>
        <th>Mot de passe</th>
    </tr>
    @isset($clients)
        @foreach($clients as $clientEntry)
            <tr>
                <td><input type="checkbox" name="clients-slugs[]" value="{{$clientEntry->slug}}"> </td>
                <td>{{$clientEntry->clientCni}}</td>
                <td>{{$clientEntry->clientName}}</td>
                <td>{{$clientEntry->clientBirthDate}}</td>
                <td>{{$clientEntry->clientContact}}</td>
                <td>{{$clientEntry->login}}</td>
                <td>{!!  ((int)$clientEntry->actif)==1 ? '<b style="color:green">Actif</b>' : '<b style="color:red">Inactif</b>'!!}</td>
                <td><a href="{{route('adminClientCard',['slug'=>$clientEntry->slug])}}" class="btn btn-info">Voir fiche</a></td>
                <td><a href="{{route('adminDoDropClient',['slug'=>$clientEntry->slug])}}" class="btn btn-danger">Désinscrire</a></td>
                <td><a href="{{route('adminDoZeroPassword',['slug'=>$clientEntry->slug])}}" class="btn btn-info">Réinitiat. mot de passe</a></td>
            </tr>
        @endforeach
    @endisset
    </tbody></table>
    <button type="submit" class="btn btn-danger">Supprimer la sélection</button>
</form>