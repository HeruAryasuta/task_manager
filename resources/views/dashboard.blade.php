@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="px-4 py-6 sm:px-6 lg:px-8">
    <!-- Header -->
    <div class="mb-6">
        <h1 class="text-2xl sm:text-3xl lg:text-4xl font-bold text-gray-900">Dashboard</h1>
        <p class="mt-1 text-sm text-gray-600">Welcome back! Here's your overview.</p>
    </div>

    <!-- Weather Widget - Responsive -->
    <div id="weather-widget" class="bg-gradient-to-r from-blue-400 to-blue-600 rounded-lg shadow-lg p-4 sm:p-6 mb-4 sm:mb-6 text-white">
        <div id="weather-loading" class="text-center py-4">
            <svg class="animate-spin h-8 w-8 text-white mx-auto mb-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            <p class="text-base sm:text-lg">Loading weather...</p>
        </div>
        <div id="weather-content" class="hidden">
            <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                <div class="flex-1">
                    <h2 class="text-xl sm:text-2xl lg:text-3xl font-bold" id="weather-city"></h2>
                    <p class="text-sm sm:text-base lg:text-lg mt-1" id="weather-description"></p>
                </div>
                <div class="text-left sm:text-right">
                    <p class="text-4xl sm:text-5xl lg:text-6xl font-bold" id="weather-temp"></p>
                    <p class="text-xs sm:text-sm mt-1" id="weather-feels"></p>
                </div>
            </div>
            <div class="mt-4 grid grid-cols-3 gap-2 sm:gap-4 text-xs sm:text-sm">
                <div class="bg-white bg-opacity-20 rounded-lg p-2 sm:p-3">
                    <p class="opacity-75 text-xs">Humidity</p>
                    <p class="font-semibold text-sm sm:text-base" id="weather-humidity"></p>
                </div>
                <div class="bg-white bg-opacity-20 rounded-lg p-2 sm:p-3">
                    <p class="opacity-75 text-xs">Wind</p>
                    <p class="font-semibold text-sm sm:text-base" id="weather-wind"></p>
                </div>
                <div class="bg-white bg-opacity-20 rounded-lg p-2 sm:p-3">
                    <p class="opacity-75 text-xs">Pressure</p>
                    <p class="font-semibold text-sm sm:text-base" id="weather-pressure"></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats - Responsive Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 sm:gap-6 mb-4 sm:mb-6">
        <div class="bg-white rounded-lg shadow p-4 sm:p-6 hover:shadow-lg transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-gray-500 text-xs sm:text-sm font-medium uppercase tracking-wider">Total Tasks</h3>
                    <p class="text-2xl sm:text-3xl font-bold text-gray-900 mt-2">{{ $tasksCount }}</p>
                </div>
                <div class="p-3 bg-blue-100 rounded-full">
                    <svg class="w-6 h-6 sm:w-8 sm:h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                    </svg>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow p-4 sm:p-6 hover:shadow-lg transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-gray-500 text-xs sm:text-sm font-medium uppercase tracking-wider">Completed</h3>
                    <p class="text-2xl sm:text-3xl font-bold text-green-600 mt-2">{{ $completedCount }}</p>
                </div>
                <div class="p-3 bg-green-100 rounded-full">
                    <svg class="w-6 h-6 sm:w-8 sm:h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow p-4 sm:p-6 hover:shadow-lg transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-gray-500 text-xs sm:text-sm font-medium uppercase tracking-wider">Pending</h3>
                    <p class="text-2xl sm:text-3xl font-bold text-yellow-600 mt-2">{{ $pendingCount }}</p>
                </div>
                <div class="p-3 bg-yellow-100 rounded-full">
                    <svg class="w-6 h-6 sm:w-8 sm:h-8 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions - Responsive -->
    <div class="bg-white rounded-lg shadow p-4 sm:p-6">
        <h2 class="text-lg sm:text-xl font-bold text-gray-900 mb-4">Quick Actions</h2>
        <div class="flex flex-col sm:flex-row gap-3 sm:gap-4">
            <a href="{{ route('tasks.create') }}" 
               class="flex-1 bg-blue-500 hover:bg-blue-600 text-white px-4 sm:px-6 py-3 rounded-md font-medium text-center transition-colors">
                <span class="flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Create New Task
                </span>
            </a>
            <a href="{{ route('tasks.index') }}" 
               class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 sm:px-6 py-3 rounded-md font-medium text-center transition-colors">
                <span class="flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                    </svg>
                    View All Tasks
                </span>
            </a>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    async function fetchWeather() {
        try {
            const response = await axios.get('/weather');
            const data = response.data;
            
            document.getElementById('weather-loading').classList.add('hidden');
            document.getElementById('weather-content').classList.remove('hidden');
            
            document.getElementById('weather-city').textContent = data.name;
            document.getElementById('weather-description').textContent = 
                data.weather[0].description.charAt(0).toUpperCase() + data.weather[0].description.slice(1);
            document.getElementById('weather-temp').textContent = Math.round(data.main.temp) + '°C';
            document.getElementById('weather-feels').textContent = 'Feels like ' + Math.round(data.main.feels_like) + '°C';
            document.getElementById('weather-humidity').textContent = data.main.humidity + '%';
            document.getElementById('weather-wind').textContent = data.wind.speed + ' m/s';
            document.getElementById('weather-pressure').textContent = data.main.pressure + ' hPa';
        } catch (error) {
            document.getElementById('weather-loading').innerHTML = 
                '<p class="text-center text-red-200">Unable to load weather data</p>';
            console.error('Weather fetch error:', error);
        }
    }

    fetchWeather();
</script>
@endsection