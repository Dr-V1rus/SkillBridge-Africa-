<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4">
        <h2 class="text-2xl font-bold text-center mb-6">Live Platform Activity</h2>
        <div class="max-w-2xl mx-auto bg-gray-50 rounded-xl p-6">
            <div id="realActivityFeed" class="space-y-3">
                <div class="text-center text-gray-500">Loading activity...</div>
            </div>
        </div>
    </div>
</section>

<script>
    function loadRealActivity() {
        fetch('{{ route("activity.feed") }}')
            .then(response => response.json())
            .then(data => {
                const container = document.getElementById('realActivityFeed');
                if (data.activities && data.activities.length > 0) {
                    container.innerHTML = data.activities.map(activity => `
                        <div class="bg-white p-3 rounded-lg shadow-sm flex items-center gap-3">
                            <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                            </svg>
                            <span class="text-sm text-gray-700">${activity.message}</span>
                            <span class="text-xs text-gray-400 ml-auto">${activity.time}</span>
                        </div>
                    `).join('');
                } else {
                    container.innerHTML = '<div class="text-center text-gray-500">No recent activity</div>';
                }
            });
    }
    
    loadRealActivity();
    setInterval(loadRealActivity, 10000);
</script>
