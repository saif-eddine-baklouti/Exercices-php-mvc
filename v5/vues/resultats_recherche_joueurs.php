<table>
    <tr>
        <th> Nom complet </th>
        
        <th> Equipe </th>
        

    </tr>
    
<?php 
    while($rangee = mysqli_fetch_assoc($resultatsRecherche))
    {
        ?> 
            <tr>
                <td><?= $rangee["prenom"] ?> <?= $rangee["nomJoueur"] ?> </td></br>
                
                <td><?= $rangee["nomEquipe"] ?> de <?= $rangee["ville"] ?></td>
            </tr>
            
        <?php 
    }
?>

</table>

