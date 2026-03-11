{{-- resources/views/components/ui/chart-radar.blade.php --}}
@props([
    'id' => 'chart-radar-' . uniqid(),
    'height' => '300px',
    'labels' => [],
    'datasets' => [],
    'title' => null,
])

<div class="card p-4">
    @if($title)
        <h3 class="mb-4 text-sm font-semibold text-foreground">{{ $title }}</h3>
    @endif
    <div style="height: {{ $height }}">
        <canvas id="{{ $id }}"></canvas>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const ctx = document.getElementById('{{ $id }}');
        if (!ctx) return;

        const theme = window.getChartTheme();
        const datasets = @json($datasets);

        const coloredDatasets = datasets.map((dataset, index) => {
            const colors = [theme.colors.primary, theme.colors.success, theme.colors.warning, theme.colors.danger];
            const softColors = [theme.colors.primarySoft, 'rgba(16, 185, 129, 0.3)', 'rgba(245, 158, 11, 0.3)', 'rgba(239, 68, 68, 0.3)'];

            return {
                ...dataset,
                borderColor: dataset.borderColor ?? colors[index % colors.length],
                backgroundColor: dataset.backgroundColor ?? softColors[index % softColors.length],
                pointBackgroundColor: dataset.pointBackgroundColor ?? colors[index % colors.length],
                pointBorderColor: dataset.pointBorderColor ?? theme.colors.background,
                pointHoverRadius: dataset.pointHoverRadius ?? 6,
            };
        });

        window.createChart(ctx, {
            type: 'radar',
            data: {
                labels: @json($labels),
                datasets: coloredDatasets,
            },
            options: {
                scales: {
                    r: {
                        grid: { color: theme.grid.color },
                        angleLines: { color: theme.grid.color },
                        pointLabels: {
                            color: theme.colors.muted,
                            font: theme.fonts,
                        },
                        ticks: {
                            color: theme.colors.muted,
                            backdropColor: 'transparent',
                        },
                    },
                },
            },
        });
    });
</script>
@endpush
