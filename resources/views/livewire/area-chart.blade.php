<div class="shadow rounded p-4 border bg-white" style="height: 32rem;">
    <livewire:livewire-line-chart
        key="{{ $lineChartModel->reactiveKey() }}"
        :line-chart-model="$lineChartModel"
    />
</div>
