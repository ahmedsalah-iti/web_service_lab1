<?php
spl_autoload_register(function ($class_name) {
    require_once "./classes/".$class_name . '.php';
});

$allCountries = [];
$request = new Request("https://countriesnow.space/api/v0.1/countries/flag/unicode");
$request->send();
$response = $request->getResponse();

if ($response) {
    $response_json = json_decode($response, true);
    $countries = $response_json['data'];
    foreach ($countries as $country) {
        $allCountries[] = $country;
    }
}

$weatherData = null;
if (isset($_GET['city']) && !empty($_GET['city'])) {
    $cityName = $_GET['city'];
    $city = new City($cityName);
    $city->checkWeather();
    if ($city->hasWeather()) {
        $weatherData = [
            'description' => $city->getWeather()->getDescription(),
            'windSpeed' => $city->getWeather()->getWindSpeed(),
            'humidity' => $city->getWeather()->getHumidity(),
            'city' => $cityName
        ];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weather Forecast</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .dropdown-list::-webkit-scrollbar {
            width: 8px;
        }
        .dropdown-list::-webkit-scrollbar-thumb {
            background-color: #94a3b8;
            border-radius: 4px;
        }
        .weather-card {
            background: linear-gradient(135deg, #1e40af 0%, #3b82f6 100%);
        }
        .weather-card:hover {
            transform: scale(1.03);
            transition: transform 0.3s ease;
        }
        .fade-in {
            animation: fadeIn 0.7s ease-out;
        }
        @keyframes fadeIn {
            0% { opacity: 0; transform: translateY(12px); }
            100% { opacity: 1; transform: translateY(0); }
        }
        .container {
            background: linear-gradient(180deg, #f1f5f9 0%, #e5e7eb 100%);
        }
        .btn {
            background: linear-gradient(to right, #1e40af, #3b82f6);
        }
        .btn:hover {
            background: linear-gradient(to right, #1e3a8a, #2563eb);
        }
        .card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
        }
        .dropdown-list {
            max-height: 200px;
            overflow-y: auto;
            display: none;
            position: absolute;
            width: 100%;
            z-index: 10;
        }
        .dropdown-list.show {
            display: block;
        }
        .option:hover {
            background-color: #e0f2fe;
        }
    </style>
</head>
<body class="container min-h-screen flex items-center justify-center px-4 font-sans">
    <div class="card shadow-2xl rounded-3xl p-10 w-full max-w-md space-y-8">
        <h1 class="text-4xl font-extrabold text-center text-gray-900">🌤️ Weather Forecast</h1>
        <?php
        if ($weatherData) {
            include './html/weatherInfo.php';
        } elseif (isset($_GET['country']) && !empty($_GET['country'])) {
            include './html/citiesForm.php';
        } else {
            include './html/countriesForm.php';
        }
        ?>
    </div>
    <script>
        function setupDropdown(inputId, listId, hiddenInputId, options) {
            const input = document.getElementById(inputId);
            const list = document.getElementById(listId);
            const hiddenInput = document.getElementById(hiddenInputId);

            input.addEventListener('input', () => {
                const filter = input.value.toLowerCase();
                list.innerHTML = '';
                options.forEach(option => {
                    if (option.text.toLowerCase().includes(filter)) {
                        const div = document.createElement('div');
                        div.className = 'option px-4 py-2 text \ text-sm cursor-pointer';
                        div.innerHTML = option.display;
                        div.addEventListener('click', () => {
                            input.value = option.text;
                            hiddenInput.value = option.value;
                            list.className = 'dropdown-list bg-white border border-gray-200 rounded-b-xl shadow-lg';
                        });
                        list.appendChild(div);
                    }
                });
                list.className = 'dropdown-list bg-white border border-gray-200 rounded-b-xl shadow-lg show';
            });

            input.addEventListener('focus', () => {
                list.className = 'dropdown-list bg-white border border-gray-200 rounded-b-xl shadow-lg show';
                input.dispatchEvent(new Event('input'));
            });

            input.addEventListener('blur', () => {
                setTimeout(() => {
                    list.className = 'dropdown-list bg-white border border-gray-200 rounded-b-xl';
                }, 100);
            });
        }
    </script>
</body>
</html>