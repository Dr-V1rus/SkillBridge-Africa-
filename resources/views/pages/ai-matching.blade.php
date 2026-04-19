<section class="py-20 bg-gray-50 text-center">
    <h2 class="text-3xl font-bold mb-6">AI-Powered Skill Matching</h2>
    <p class="mb-10 text-gray-600">Real-time matching based on your skills and internship requirements</p>
    
    <div class="max-w-4xl mx-auto bg-white shadow-xl rounded-2xl p-6">
        @auth
            <div id="aiMatchingContent">
                <div class="text-left mb-6">
                    @if(auth()->user()->role === 'student')
                        <h3 class="font-semibold text-lg mb-2">Your Skills: {{ auth()->user()->skills ?? 'Not specified' }}</h3>
                        <p class="text-sm text-gray-600">Finding the best matches for you...</p>
                    @elseif(auth()->user()->role === 'business')
                        <h3 class="font-semibold text-lg mb-2">Your Internship Requirements</h3>
                        <p class="text-sm text-gray-600">Finding students that match your needs...</p>
                    @endif
                </div>
            </div>
            <div id="matchResults" class="mt-6"></div>
        @else
            <div class="text-center py-8">
                <p class="text-gray-600 mb-4">Login to see your AI-powered matches</p>
                <a href="{{ route('login') }}" class="bg-blue-600 text-white px-6 py-2 rounded-lg">Login</a>
            </div>
        @endauth
    </div>
</section>

@auth
<script>
    function loadAIMatches() {
        fetch('{{ route("ai.matches") }}')
            .then(response => response.json())
            .then(data => {
                const container = document.getElementById('matchResults');
                if (data.matches && data.matches.length > 0) {
                    let html = '<div class="space-y-4">';
                    
                    if (data.role === 'student') {
                        html += '<h4 class="font-semibold text-left">Top Matched Internships</h4>';
                        data.matches.forEach(match => {
                            html += `
                                <div class="border rounded-lg p-4 text-left">
                                    <div class="flex justify-between items-start">
                                        <div>
                                            <h5 class="font-bold">${match.internship.title}</h5>
                                            <p class="text-sm text-gray-600">${match.business_name}</p>
                                            <div class="flex flex-wrap gap-1 mt-2">
                                                ${match.matched_skills.map(skill => `<span class="bg-green-100 text-green-700 text-xs px-2 py-1 rounded">${skill}</span>`).join('')}
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <span class="text-2xl font-bold text-blue-600">${match.match_percentage}%</span>
                                            <p class="text-xs text-gray-500">Match</p>
                                            <a href="/internships/${match.internship.id}" class="bg-blue-600 text-white px-3 py-1 rounded text-sm mt-2 inline-block">View</a>
                                        </div>
                                    </div>
                                </div>
                            `;
                        });
                    } else {
                        html += '<h4 class="font-semibold text-left">Top Matched Students</h4>';
                        data.matches.forEach(match => {
                            html += `
                                <div class="border rounded-lg p-4 text-left">
                                    <div class="flex justify-between items-start">
                                        <div>
                                            <h5 class="font-bold">${match.student.name}</h5>
                                            <p class="text-sm text-gray-600">Skills: ${match.student.skills || 'Not specified'}</p>
                                            <p class="text-xs text-gray-500">${match.applications_count} application(s) sent</p>
                                            <div class="flex flex-wrap gap-1 mt-2">
                                                ${match.matched_skills.map(skill => `<span class="bg-green-100 text-green-700 text-xs px-2 py-1 rounded">${skill}</span>`).join('')}
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <span class="text-2xl font-bold text-blue-600">${match.match_percentage}%</span>
                                            <p class="text-xs text-gray-500">Match</p>
                                        </div>
                                    </div>
                                </div>
                            `;
                        });
                    }
                    
                    html += '</div>';
                    container.innerHTML = html;
                } else {
                    container.innerHTML = '<p class="text-gray-500">No matches found yet. Update your skills or post more internships!</p>';
                }
            })
            .catch(error => {
                console.error('Error loading matches:', error);
            });
    }
    
    loadAIMatches();
</script>
@endauth
