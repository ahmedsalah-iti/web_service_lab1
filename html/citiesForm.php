<?php
$country = new Country($_GET['country']);
$allCities = $country->getCities();
?>
<form method="GET" class="space-y-6">
    <div>
        <h2 class="text-xl font-semibold text-gray-800 mb-3"><?php echo htmlspecialchars($_GET['country']); ?></h2>
        <label for="city" class="block text-sm font-semibold text-gray-800 mb-2">Select a City</label>
        <select id="city" name="city" class="w-full border border-gray-200 rounded-xl p-4 text-sm bg-gray-50 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-300">
            <option value="">Choose a city</option>
            <?php foreach ($allCities as $city): ?>
                <option value="<?php echo htmlspecialchars($city); ?>">
                    <?php echo htmlspecialchars($city); ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
    <button type="submit" class="btn w-full text-white font-semibold py-3 rounded-xl shadow-lg transition duration-300">Get Weather</button>
</form>