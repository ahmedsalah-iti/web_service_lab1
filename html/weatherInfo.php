<div class="weather-card text-white p-8 rounded-2xl shadow-xl fade-in">
    <h2 class="text-2xl font-bold mb-6"><?php echo htmlspecialchars($weatherData['city']); ?> Weather</h2>
    <div class="space-y-5">
        <div class="flex items-center space-x-4">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.9 5.002 5.002 0 00-9.9 0A4 4 0 003 15z" />
            </svg>
            <p class="text-sm"><span class="font-medium">Condition:</span> <?php echo htmlspecialchars($weatherData['description']); ?></p>
        </div>
        <div class="flex items-center space-x-4">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <p class="text-sm"><span class="font-medium">Wind Speed:</span> <?php echo htmlspecialchars($weatherData['windSpeed']); ?> m/s</p>
        </div>
        <div class="flex items-center space-x-4">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
            </svg>
            <p class="text-sm"><span class="font-medium">Humidity:</span> <?php echo htmlspecialchars($weatherData['humidity']); ?>%</p>
        </div>
    </div>
</div>
<a href="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" class="block text-center text-blue-700 font-medium hover:text-blue-900 transition duration-200 mt-6">Back to Country Selection</a>