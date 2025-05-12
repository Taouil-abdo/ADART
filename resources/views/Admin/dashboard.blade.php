<x-layouts.app>
    <x-slot:title>Dashboard - DAR TALIB</x-slot:title>

    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
        <h1 class="text-xl sm:text-2xl font-bold text-gray-800">Dashboard Overview</h1>
        <div>
            <select id="time-period" class="w-full bg-white border border-gray-300 rounded-md px-3 py-2 text-sm">
                <option value="7">Last 7 days</option>
                <option value="30">Last 30 days</option>
                <option value="month">This month</option>
                <option value="quarter">Last quarter</option>
            </select>
        </div>
    </div>

    <!-- <div class="bg-white flex flex-col p-2"> -->
        <!-- Charts Grid Layout -->
        <div class="grid grid-cols-1 xs:grid-cols-2 md:grid-cols-4 gap-3 md:gap-4 mb-6">
            <div class="bg-blue-100 hover:bg-blue-500 p-3 rounded-md border border-blue-100 shadow-2xl transition duration-300 ease-in-out transform hover:scale-105">
                <p class="text-xs sm:text-sm text-blue-600 hover:text-white font-medium">Total Residents</p>
                <h3 class="text-xl sm:text-2xl font-bold text-gray-800 hover:text-white mt-1">{{$totalResidents}}</h3>
            </div>

            <div class="bg-amber-100 p-3 rounded-md border border-amber-100 shadow-2xl">
                <p class="text-xs sm:text-sm text-amber-600 font-medium">Total Rooms</p>
                <h3 class="text-xl sm:text-2xl font-bold text-gray-800 mt-1">{{$totalRooms}}</h3>
                <p class="text-xs text-green-600 mt-1">{{$totalAvailbaleRooms}} Available Rooms</p>
            </div>

            <div class="bg-green-100 p-3 rounded-md border border-green-100 shadow-2xl">
                <p class="text-xs sm:text-sm text-green-600 font-medium">Total Supplier</p>
                <h3 class="text-xl sm:text-2xl font-bold text-gray-800 mt-1">{{$totalSuppliers}}</h3>
            </div>
            
            <div class="bg-purple-100 p-3 rounded-md border border-purple-100 shadow-2xl">
                <p class="text-xs sm:text-sm text-purple-600 font-medium">Stock Condition</p>
                <h3 class="text-xl sm:text-2xl font-bold text-gray-800 mt-1">24.8%</h3>
            </div>
            
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6 mb-6">
            <!-- Residents Chart -->
            <div class="bg-white rounded-lg shadow-lg p-4 md:p-6">
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-4 gap-3">
                    <h2 class="text-lg sm:text-xl font-bold text-gray-800">Residents Analytics</h2>
                    <div class="flex flex-wrap gap-2">
                        <button data-chart="residents" data-period="monthly"
                            class="period-btn px-2 sm:px-3 py-1 bg-blue-600 text-white text-xs sm:text-sm rounded-md hover:bg-blue-700">Monthly</button>
                        <button data-chart="residents" data-period="quarterly"
                            class="period-btn px-2 sm:px-3 py-1 bg-gray-200 text-gray-700 text-xs sm:text-sm rounded-md hover:bg-gray-300">Quarterly</button>
                        <button data-chart="residents" data-period="yearly"
                            class="period-btn px-2 sm:px-3 py-1 bg-gray-200 text-gray-700 text-xs sm:text-sm rounded-md hover:bg-gray-300">Yearly</button>
                    </div>
                </div>

                <div class="h-[250px] md:h-[300px] relative">
                    <canvas id="residentsChart"></canvas>
                </div>
            </div>

            <!-- Rooms Chart -->
            <div class="bg-white rounded-lg shadow-lg p-4 md:p-6">
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-4 gap-3">
                    <h2 class="text-lg sm:text-xl font-bold text-gray-800">Rooms Analytics</h2>
                    <div class="flex flex-wrap gap-2">
                        <button data-chart="rooms" data-period="status"
                            class="room-btn px-2 sm:px-3 py-1 bg-blue-600 text-white text-xs sm:text-sm rounded-md hover:bg-blue-700">Status</button>
                        <button data-chart="rooms" data-period="capacity"
                            class="room-btn px-2 sm:px-3 py-1 bg-gray-200 text-gray-700 text-xs sm:text-sm rounded-md hover:bg-gray-300">Capacity</button>
                        <button data-chart="rooms" data-period="gender"
                            class="room-btn px-2 sm:px-3 py-1 bg-gray-200 text-gray-700 text-xs sm:text-sm rounded-md hover:bg-gray-300">By
                            Gender</button>
                    </div>
                </div>

                <div class="h-[250px] md:h-[300px] relative">
                    <canvas id="roomsChart"></canvas>
                </div>
            </div>
        </div>


    <!-- </div> -->


    <div class="overflow-x-auto">
        <x-table title="Last registered residents">
            <x-slot:header>
                <tr class="bg-gray-100 text-gray-600 uppercase text-xs sm:text-sm leading-normal">
                    <th class="py-2 px-2 sm:px-4 text-center">ID</th>
                    <th class="py-2 px-2 sm:px-4 text-center">Full Name</th>
                    <th class="py-2 px-2 sm:px-4 text-center">Age</th>
                    <th class="py-2 px-2 sm:px-4 text-center">gender</th>
                    <th class="py-2 px-2 sm:px-4 text-center">School Level</th>
                    <th class="py-2 px-2 sm:px-4 text-center">School</th>
                    <th class="py-2 px-2 sm:px-4 text-center">Status</th>
                    <th class="py-2 px-2 sm:px-4 text-center">room</th>
                </tr>
            </x-slot:header>

            <x-slot:body>
                @if($lastResindent)
                @foreach ($lastResindent as $resident)
                <tr class="border-b border-gray-200 hover:bg-gray-100 text-gray-600 text-xs sm:text-sm font-light">
                    <td class="py-2 px-2 sm:px-4 text-center">
                        {{ $resident->id }}
                    </td>
                    <td class="py-2 px-2 sm:px-4 text-center">
                        {{ $resident->fullname }}
                    </td>
                    <td class="py-2 px-2 sm:px-4 text-center">
                        {{ $resident->age }}
                    </td>
                    <td class="py-2 px-2 sm:px-4 text-center">
                        {{ $resident->gender }}
                    </td>
                    <td class="py-2 px-2 sm:px-4 text-center">
                        {{ $resident->school_level }}
                    </td>
                    <td class="py-2 px-2 sm:px-4 text-center">
                        {{ $resident->school }}
                    </td>
                    <td class="py-2 px-2 sm:px-4 text-center">
                        <span class="
                                    {{ $resident->status == 'Active' ? 'bg-green-200 text-green-600' : 'bg-red-200 text-red-600' }}  
                                    py-1 px-2 sm:px-3 rounded-full text-xs">
                            {{ $resident->status }}
                        </span>
                    </td>
                    <td class="py-2 px-2 sm:px-4 text-center">
                        {{ $resident->room->roomNumber }}
                    </td>
                </tr>
                @endforeach
                @else
                <tr class="border-b border-gray-200 hover:bg-gray-100">
                    <td colspan="8" class="py-3 px-2 sm:px-6 text-center text-gray-500">No residents found.</td>
                </tr>
                @endif
            </x-slot:body>
        </x-table>
    </div>

    <x-slot:scripts>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Chart instances
            let residentsChart = null;
            let roomsChart = null;

            // Default periods
            let residentsPeriod = 'monthly';
            let roomsView = 'status';

            // Load initial charts
            loadResidentsChart(residentsPeriod);
            loadRoomsChart(roomsView);

            // Time period selector for all charts
            document.getElementById('time-period').addEventListener('change', function() {
                loadResidentsChart(residentsPeriod);
            });

            // Residents chart period buttons
            document.querySelectorAll('.period-btn').forEach(button => {
                button.addEventListener('click', function() {
                    // Update active button
                    document.querySelectorAll('.period-btn').forEach(btn => {
                        btn.classList.remove('bg-blue-600', 'text-white');
                        btn.classList.add('bg-gray-200', 'text-gray-700');
                    });
                    this.classList.remove('bg-gray-200', 'text-gray-700');
                    this.classList.add('bg-blue-600', 'text-white');

                    // Update chart
                    residentsPeriod = this.dataset.period;
                    loadResidentsChart(residentsPeriod);
                });
            });

            // Rooms chart view buttons
            document.querySelectorAll('.room-btn').forEach(button => {
                button.addEventListener('click', function() {
                    // Update active button
                    document.querySelectorAll('.room-btn').forEach(btn => {
                        btn.classList.remove('bg-blue-600', 'text-white');
                        btn.classList.add('bg-gray-200', 'text-gray-700');
                    });
                    this.classList.remove('bg-gray-200', 'text-gray-700');
                    this.classList.add('bg-blue-600', 'text-white');

                    // Update chart
                    roomsView = this.dataset.period;
                    loadRoomsChart(roomsView);
                });
            });

            // Function to load residents chart
            function loadResidentsChart(period) {
                const timePeriod = document.getElementById('time-period').value;

                fetch(`/dashboard/residents-chart-data?period=${period}&timeRange=${timePeriod}`)
                    .then(response => response.json())
                    .then(data => {
                        if (residentsChart) {
                            residentsChart.destroy();
                        }

                        const ctx = document.getElementById('residentsChart').getContext('2d');
                        residentsChart = new Chart(ctx, {
                            type: period === 'yearly' ? 'bar' : 'line',
                            data: {
                                labels: data.labels,
                                datasets: data.datasets
                            },
                            options: {
                                responsive: true,
                                maintainAspectRatio: false,
                                plugins: {
                                    legend: {
                                        position: 'top',
                                        labels: {
                                            boxWidth: 10,
                                            font: {
                                                size: window.innerWidth < 768 ? 10 : 12
                                            }
                                        }
                                    },
                                    title: {
                                        display: true,
                                        text: data.title,
                                        font: {
                                            size: window.innerWidth < 768 ? 12 : 14
                                        }
                                    }
                                },
                                scales: {
                                    x: {
                                        ticks: {
                                            autoSkip: true,
                                            maxTicksLimit: window.innerWidth < 768 ? 6 : 12,
                                            font: {
                                                size: window.innerWidth < 768 ? 8 : 10
                                            }
                                        }
                                    },
                                    y: {
                                        ticks: {
                                            font: {
                                                size: window.innerWidth < 768 ? 8 : 10
                                            }
                                        }
                                    }
                                }
                            }
                        });
                    })
                    .catch(error => {
                        console.error('Error fetching residents chart data:', error);
                    });
            }

            // Function to load rooms chart
            function loadRoomsChart(view) {
                fetch(`/dashboard/rooms-chart-data?view=${view}`)
                    .then(response => response.json())
                    .then(data => {
                        if (roomsChart) {
                            roomsChart.destroy();
                        }

                        const ctx = document.getElementById('roomsChart').getContext('2d');

                        // Determine chart type based on view
                        const chartType = view === 'capacity' ? 'bar' : 'doughnut';

                        // Define fixed colors based on the view
                        let backgroundColors = [];

                        if (view === 'status') {
                            // Fixed colors for status view
                            backgroundColors = [
                                'rgba(75, 192, 192, 0.8)', // Available - Teal
                                'rgba(255, 99, 132, 0.8)', // Occupied - Pink
                                'rgba(255, 159, 64, 0.8)', // Maintenance - Orange
                                'rgba(54, 162, 235, 0.8)' // Reserved - Blue
                            ];
                        } else if (view === 'gender') {
                            // Fixed colors for gender view
                            backgroundColors = [
                                'rgba(54, 162, 235, 0.8)', // Male - Blue
                                'rgba(255, 99, 132, 0.8)', // Female - Pink
                            ];
                        } else {
                            // Default colors for other views
                            backgroundColors = [
                                'rgba(54, 162, 235, 0.8)', // Blue
                                'rgba(75, 192, 192, 0.8)', // Teal
                                'rgba(255, 99, 132, 0.8)', // Pink
                                'rgba(255, 159, 64, 0.8)', // Orange
                                'rgba(153, 102, 255, 0.8)', // Purple
                                'rgba(201, 203, 207, 0.8)' // Grey
                            ];
                        }

                        // Make sure we have enough colors
                        while (backgroundColors.length < data.labels.length) {
                            backgroundColors = backgroundColors.concat(backgroundColors);
                        }

                        // Slice to match the number of data points
                        backgroundColors = backgroundColors.slice(0, data.labels.length);

                        // Override the dataset colors
                        data.datasets[0].backgroundColor = backgroundColors;
                        data.datasets[0].borderColor = 'white';
                        data.datasets[0].borderWidth = 1;

                        // Create chart options
                        const options = {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                legend: {
                                    position: window.innerWidth < 768 ? 'bottom' : 'top',
                                    labels: {
                                        usePointStyle: true,
                                        pointStyle: 'circle',
                                        boxWidth: 8,
                                        padding: window.innerWidth < 768 ? 10 : 15,
                                        font: {
                                            size: window.innerWidth < 768 ? 10 : 12
                                        }
                                    }
                                },
                                title: {
                                    display: true,
                                    text: data.title,
                                    font: {
                                        size: window.innerWidth < 768 ? 12 : 14
                                    }
                                }
                            }
                        };

                        // Add specific options for bar charts
                        if (chartType === 'bar') {
                            options.scales = {
                                y: {
                                    beginAtZero: true,
                                    ticks: {
                                        font: {
                                            size: window.innerWidth < 768 ? 8 : 10
                                        }
                                    }
                                },
                                x: {
                                    ticks: {
                                        font: {
                                            size: window.innerWidth < 768 ? 8 : 10
                                        }
                                    }
                                }
                            };
                        }

                        // Create the chart
                        roomsChart = new Chart(ctx, {
                            type: chartType,
                            data: {
                                labels: data.labels,
                                datasets: data.datasets
                            },
                            options: options
                        });

                        // Log the chart data to console for debugging
                        console.log('Room chart data with colors:', data);
                    })
                    .catch(error => {
                        console.error('Error fetching rooms chart data:', error);
                    });
            }

            // Add resize event listener to update charts
            window.addEventListener('resize', function() {
                if (residentsChart) {
                    loadResidentsChart(residentsPeriod);
                }
                if (roomsChart) {
                    loadRoomsChart(roomsView);
                }
            });
        });
        </script>
    </x-slot:scripts>
</x-layouts.app>