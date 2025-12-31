<h2>Dashboard</h2>
<p>Welcome, <?= htmlspecialchars($user['fullName']) ?> (<?= htmlspecialchars($user['role']) ?>)</p>

<div id="dashboard-chart-row">
    <div class="chart-block">
        <h2>Inventory Overview</h2>
        <div id="inventory-pie-wrapper">
            <canvas id="inventoryPieChart"></canvas>

            <div id="inventory-pie-legend"></div>
        </div>
    </div>

    <div class="chart-block">
        <h2>Monthly Sales (Current Year)</h2>
        <div id="monthly-sales-wrapper">
            <canvas id="monthlySalesChart"></canvas>
        </div>
    </div>
</div>

<script>
    (function () {
        const dataFromPhp = <?= json_encode($analytics ?? [], JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT) ?>;

        if (!Array.isArray(dataFromPhp) || dataFromPhp.length === 0) {
            document.getElementById('inventory-pie-wrapper').innerHTML =
                '<p>No inventory data available.</p>';
        } else {
            const labels = dataFromPhp.map(item => item.category || 'Uncategorized');
            const values = dataFromPhp.map(item => Number(item.total_stock) || 0);

            const colors = [
                '#4f46e5', '#22c55e', '#f97316', '#e11d48',
                '#0ea5e9', '#a855f7', '#facc15', '#10b981'
            ];
            const bgColors = labels.map((_, i) => colors[i % colors.length]);

            const ctx = document.getElementById('inventoryPieChart').getContext('2d');

            const chart = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: labels,
                    datasets: [{
                        data: values,
                        backgroundColor: bgColors,
                        borderColor: '#ffffff',
                        borderWidth: 2
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            display: false
                        }
                    }
                }
            });

            const legendContainer = document.getElementById('inventory-pie-legend');
            legendContainer.innerHTML = labels.map((label, idx) => {
                const value = values[idx];
                const color = bgColors[idx];
                return `
                    <div class="pie-legend-item">
                        <span class="pie-legend-swatch" style="background-color:${color};"></span>
                        <span class="pie-legend-label">${label}</span>
                        <span class="pie-legend-value">${value}</span>
                    </div>
                `;
            }).join('');
        }

        const monthlySalesFromPhp = <?= json_encode($monthlySales ?? [], JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT) ?>;

        if (Array.isArray(monthlySalesFromPhp) && monthlySalesFromPhp.length > 0) {
            const salesLabels = monthlySalesFromPhp.map(item => item.ym || '');
            const salesValues = monthlySalesFromPhp.map(item => Number(item.total_qty) || 0);

            const salesCtx = document.getElementById('monthlySalesChart').getContext('2d');

            new Chart(salesCtx, {
                type: 'bar',
                data: {
                    labels: salesLabels,
                    datasets: [{
                        label: 'Quantity Sold',
                        data: salesValues,
                        backgroundColor: 'rgba(59, 130, 246, 0.7)',
                        borderColor: 'rgba(37, 99, 235, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    aspectRatio: 1,
                    scales: {
                        x: {
                            title: { display: true, text: 'Month (YYYY-MM)' }
                        },
                        y: {
                            beginAtZero: true,
                            title: { display: true, text: 'Quantity Sold' }
                        }
                    }
                }
            });
        } else {
            const wrapper = document.getElementById('monthly-sales-wrapper');
            if (wrapper) {
                wrapper.innerHTML = '<p>No sales data for this year.</p>';
            }
        }
    })();
</script>
