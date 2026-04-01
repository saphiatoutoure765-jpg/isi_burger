<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Facture #{{ $commande->id }}</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 13px; color: #333; }
        .header { text-align: center; border-bottom: 3px solid #ff6b35; padding-bottom: 15px; margin-bottom: 20px; }
        .header h1 { color: #ff6b35; margin: 0; font-size: 28px; }
        .header p { margin: 3px 0; color: #666; }
        .info-block { display: flex; justify-content: space-between; margin-bottom: 20px; }
        .info-left, .info-right { width: 48%; }
        .info-right { text-align: right; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th { background-color: #ff6b35; color: white; padding: 10px; text-align: left; }
        td { padding: 8px 10px; border-bottom: 1px solid #ddd; }
        tr:nth-child(even) { background-color: #f9f9f9; }
        .total-row { background-color: #fff3cd !important; font-weight: bold; font-size: 15px; }
        .footer { text-align: center; margin-top: 30px; color: #888; font-size: 11px; border-top: 1px solid #ddd; padding-top: 10px; }
        .badge-statut { background-color: #28a745; color: white; padding: 4px 10px; border-radius: 12px; font-size: 12px; }
    </style>
</head>
<body>

    <div class="header">
        <h1> ISI BURGER</h1>
        <p>Restaurant ISI Burger - Dakar, Sénégal</p>
        <p>contact@isiburger.sn | +221 77 000 00 00</p>
    </div>

    <div class="info-block">
        <div class="info-left">
            <strong>Facturé à :</strong><br>
            {{ $commande->user->name }}<br>
            {{ $commande->user->email }}
        </div>
        <div class="info-right">
            <strong>Facture N° :</strong> #{{ $commande->id }}<br>
            <strong>Date :</strong> {{ $commande->created_at->format('d/m/Y') }}<br>
            <strong>Statut :</strong>
            <span class="badge-statut">{{ strtoupper($commande->statut) }}</span>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>Burger</th>
                <th>Prix unitaire</th>
                <th>Quantité</th>
                <th>Sous-total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($commande->lignesCommande as $ligne)
                <tr>
                    <td>{{ $ligne->burger->nom }}</td>
                    <td>{{ number_format($ligne->prix_unitaire, 0, ',', ' ') }} FCFA</td>
                    <td>{{ $ligne->quantite }}</td>
                    <td>{{ number_format($ligne->prix_unitaire * $ligne->quantite, 0, ',', ' ') }} FCFA</td>
                </tr>
            @endforeach
            <tr class="total-row">
                <td colspan="3" style="text-align:right;">TOTAL TTC</td>
                <td>{{ number_format($commande->montant_total, 0, ',', ' ') }} FCFA</td>
            </tr>
        </tbody>
    </table>

    <div class="footer">
        <p>Merci de votre confiance ! ISI Burger vous souhaite bon appétit </p>
        <p>Document généré automatiquement le {{ now()->format('d/m/Y à H:i') }}</p>
    </div>

</body>
</html>
