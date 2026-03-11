{{-- resources/views/components/ui/table.blade.php --}}
@props([
    'striped' => false,
    'hoverable' => true,
])

<div class="overflow-hidden rounded-xl border border-borderColor/60 bg-surface">
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="border-b border-borderColor/60 bg-surface-muted/50">
                {{ $head }}
            </thead>
            <tbody
                @class([
                    'divide-y divide-borderColor/40',
                    '[&>tr:nth-child(odd]:bg-surface-muted/30' => $striped,
                ])
            >
                {{ $body }}
            </tbody>
        </table>
    </div>
</div>
