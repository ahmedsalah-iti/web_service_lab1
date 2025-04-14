<form method="GET" class="space-y-6">
    <div>
        <label for="country" class="block text-sm font-semibold text-gray-800 mb-2">Choose a Country</label>
        <select id="country" name="country" class="w-full border border-gray-200 rounded-xl p-4 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-gray-50 transition duration-300">
            <option value="">Select a country</option>
            <option value="Egypt">🇪🇬 Egypt</option>
            <?php foreach ($allCountries as $country): ?>
                <option value="<?php echo htmlspecialchars($country['name']); ?>">
                    <?php echo htmlspecialchars($country['unicodeFlag']) . ' ' . htmlspecialchars($country['name']); ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
    <button type="submit" class="btn w-full text-white font-semibold py-3 rounded-xl shadow-lg transition duration-300">Get Cities</button>
</form>