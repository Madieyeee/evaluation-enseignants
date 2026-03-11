<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8" />
        <title>Liste des enseignants</title>
        <style>
            * {
                box-sizing: border-box;
            }

            body {
                margin: 0;
                padding: 32px;
                font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
                font-size: 12px;
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
                font-size: 11px;
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
                padding: 8px 10px;
                border-bottom: 1px solid #e2e8f0;
                text-align: left;
            }

            th {
                font-size: 11px;
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
        <h1>Liste des enseignants</h1>
        <p class="meta">
            Export généré le {{ now()->format('d/m/Y à H:i') }} – {{ $enseignants->count() }} enseignants.
        </p>

        <table>
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Département</th>
                    <th>Matières</th>
                    <th>Évaluations</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($enseignants as $enseignant)
                    <tr>
                        <td>{{ $enseignant->user->name }}</td>
                        <td>{{ $enseignant->user->email }}</td>
                        <td>{{ $enseignant->departement?->nom ?? '-' }}</td>
                        <td>{{ $enseignant->matieres->count() }}</td>
                        <td>{{ $enseignant->evaluations->count() }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </body>
</html>

