<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: Arial, sans-serif; background-color: #f8f9fa; padding: 20px; }
        .container { background: white; border-radius: 10px; padding: 30px; max-width: 600px; margin: auto; }
        h2 { color: #ff6b35; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th { background-color: #ff6b35; color: white; padding: 8px; }
        td { padding: 8px; border-bottom: 1px solid #ddd; }
    </style>
</head>
<body>
<div class="container">
    <h2> ISI Burger - Confirmation de commande</h2>

    <p>Bonjour <strong>{{ $commande->user->name }}</strong>,</p>
    <p>Votre commande <strong>#{{ $commande->id }}</strong> a bien été reçue et est en cours de traitement.</p>

    <table>
        <thead>
            <tr>
                <th>Burger</th>
                <th>Quantité</th>
                <th>Sous-total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($commande->lignesCommande as $ligne)
                <tr>
                    <td>{{ $ligne->burger->nom }}</td>
                    <td>{{ $ligne->quantite }}</td>
                    <td>{{ number_format($ligne->prix_unitaire * $ligne->quantite, 0, ',', ' ') }} FCFA</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <p style="margin-top:15px;">
        <strong>Total : {{ number_format($commande->montant_total, 0, ',', ' ') }} FCFA</strong>
    </p>

    <p>Nous vous notifierons dès que votre commande sera prête.</p>
    <p>Merci pour votre confiance ! </p>
    <p><em>L'équipe ISI Burger</em></p>
</div>
</body>
</html>
