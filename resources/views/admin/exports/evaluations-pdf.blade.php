<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8" />
        <title>Liste des évaluations</title>
        <style>
            * {
                box-sizing: border-box;
            }

            body {
                margin: 0;
                padding: 32px;
                font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
                font-size: 11px;
                color: #0f172a;
                background: #f8fafc;
            }

            h1 {
                font-size: 18px;
                margin: 0 0 8px;
            }

            p {
                margin: 0;
            }

            .meta {
                font-size: 10px;
                color: #64748b;
                margin-bottom: 24px;
            }

            table {
                width: 100%;
                border-collapse: collapse;
                margin-top: 12px;
            }

            th,
            td {
                padding: 6px 8px;
                border-bottom: 1px solid #e2e8f0;
                text-align: left;
            }

            th {
                font-size: 10px;
                text-transform: uppercase;
                letter-spacing: 0.08em;
                color: #64748b;
                background: #e5e7eb;
            }

            tr:nth-child(even) td {
                background: #f9fafb;
            }
        </style>
    </head>
    <body>
        <h1>Liste des évaluations</h1>
        <p class="meta">
            Export généré le {{ now()->format('d/m/Y à H:i') }} – {{ $evaluations->count() }} dernières évaluations.
        </p>

        <table>
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Étudiant</th>
                    <th>Enseignant</th>
                    <th>Matière</th>
                    <th>Période</th>
                    <th>Moyenne</th>
                    <th>Commentaire</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($evaluations as $evaluation)
                    <tr>
                        <td>{{ $evaluation->created_at?->format('d/m/Y H:i') ?? '' }}</td>
                        <td>{{ $evaluation->etudiant?->user?->name ?? '' }}</td>
                        <td>{{ $evaluation->enseignant?->user?->name ?? '' }}</td>
                        <td>{{ $evaluation->matiere?->nom ?? '' }}</td>
                        <td>{{ $evaluation->periodeEvaluation?->nom ?? '' }}</td>
                        <td>{{ number_format($evaluation->moyenne, 2) }}</td>
                        <td>{{ $evaluation->commentaire_general ?? '' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </body>
</html>

