<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: Arial, sans-serif; background-color: #f8f9fa; padding: 20px; }
        .container { background: white; border-radius: 10px; padding: 30px; max-width: 600px; margin: auto; }
        h2 { color: #ff6b35; }
        .badge { background-color: #28a745; color: white; padding: 6px 14px; border-radius: 20px; font-size: 14px; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th { background-color: #ff6b35; color: white; padding: 8px; }
        td { padding: 8px; border-bottom: 1px solid #ddd; }
        .total { font-weight: bold; font-size: 16px; margin-top: 10px; }
    </style>
</head>
<body>
<div class="container">
    <h2>🍔 ISI Burger - Votre commande est prête !</h2>

    <p>Bonjour <strong>{{ $commande->user->name }}</strong>,</p>

    <p>
        Bonne nouvelle ! Votre commande <strong>#{{ $commande->id }}</strong>
        est <span class="badge"> PRÊTE</span> et vous attend.
    </p>

    <table>
        <thead>
            <tr>
                <th>Burger</th>
                <th>Quantité</th>
                <th>Prix unitaire</th>
                <th>Sous-total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($commande->lignesCommande as $ligne)
                <tr>
                    <td>{{ $ligne->burger->nom }}</td>
                    <td>{{ $ligne->quantite }}</td>
                    <td>{{ number_format($ligne->prix_unitaire, 0, ',', ' ') }} FCFA</td>
                    <td>{{ number_format($ligne->prix_unitaire * $ligne->quantite, 0, ',', ' ') }} FCFA</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <p class="total">Total : {{ number_format($commande->montant_total, 0, ',', ' ') }} FCFA</p>

    <p>Votre facture est disponible en pièce jointe (PDF).</p>
    <p>Passez récupérer votre commande dès que possible. Bon appétit ! </p>
    <p><em>L'équipe ISI Burger</em></p>
</div>
</body>
</html>
