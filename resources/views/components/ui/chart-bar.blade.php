{{-- resources/views/components/ui/chart-bar.blade.php --}}
@props([
    'id' => 'chart-bar-' . uniqid(),
    'height' => '300px',
    'labels' => [],
    'datasets' => [],
    'title' => null,
    'horizontal' => false,
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
        const isHorizontal = @json($horizontal);

        const coloredDatasets = datasets.map((dataset, index) => {
            const colors = [theme.colors.primary, theme.colors.success, theme.colors.warning, theme.colors.danger];
            const softColors = [theme.colors.primarySoft, 'rgba(16, 185, 129, 0.5)', 'rgba(245, 158, 11, 0.5)', 'rgba(239, 68, 68, 0.5)'];

            return {
                ...dataset,
                borderColor: dataset.borderColor ?? colors[index % colors.length],
                backgroundColor: dataset.backgroundColor ?? softColors[index % softColors.length],
                borderRadius: dataset.borderRadius ?? 6,
            };
        });

        window.createChart(ctx, {
            type: 'bar',
            data: {
                labels: @json($labels),
                datasets: coloredDatasets,
            },
            options: {
                indexAxis: isHorizontal ? 'y' : 'x',
            },
        });
    });
</script>
@endpush
