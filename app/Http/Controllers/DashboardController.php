<?php

namespace App\Http\Controllers;

use App\Models\Resident;
use App\Models\Room;
use App\Models\Supplier;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $totalResidents = Resident::count();
        $totalRooms = Room::count();
        $totalAvailbaleRooms = Room::where('roomStatus', 'Available')->count();
        $totalSuppliers = Supplier::count();
        $lastResindent = Resident::with('room')->latest()->take(5)->get();

        return view('Admin.dashboard', compact(
            'totalResidents',
            'totalRooms',
            'totalAvailbaleRooms',
            'totalSuppliers',
            'lastResindent'
        ));
    }

    public function getResidentsChartData(Request $request)
    {
        $period = $request->input('period', 'monthly');
        $timeRange = $request->input('timeRange', '30');
        
        // Set the date range based on the selected time period
        $endDate = Carbon::now();
        $startDate = match($timeRange) {
            '7' => Carbon::now()->subDays(7),
            '30' => Carbon::now()->subDays(30),
            'month' => Carbon::now()->startOfMonth(),
            'quarter' => Carbon::now()->subMonths(3),
            default => Carbon::now()->subDays(30),
        };
        
        // Format and group data based on the selected period
        switch ($period) {
            case 'monthly':
                return $this->getMonthlyResidentsData($startDate, $endDate);
            case 'quarterly':
                return $this->getQuarterlyResidentsData();
            case 'yearly':
                return $this->getYearlyResidentsData();
            default:
                return $this->getMonthlyResidentsData($startDate, $endDate);
        }
    }
    
    private function getMonthlyResidentsData($startDate, $endDate)
    {
        // Get residents joined by day
        $residents = Resident::select(
            DB::raw('DATE(date_joined) as date'),
            DB::raw('COUNT(*) as count'),
            'gender'
        )
        ->whereBetween('date_joined', [$startDate, $endDate])
        ->groupBy('date', 'gender')
        ->get();
        
        // Prepare data structure
        $dates = [];
        $maleData = [];
        $femaleData = [];
        
        // Generate all dates in the range
        $currentDate = clone $startDate;
        while ($currentDate <= $endDate) {
            $dateString = $currentDate->format('Y-m-d');
            $dates[] = $currentDate->format('M d');
            
            // Find data for this date or default to 0
            $maleCount = $residents->where('date', $dateString)->where('gender', 'Male')->first();
            $femaleCount = $residents->where('date', $dateString)->where('gender', 'Female')->first();
            
            $maleData[] = $maleCount ? $maleCount->count : 0;
            $femaleData[] = $femaleCount ? $femaleCount->count : 0;
            
            $currentDate->addDay();
        }
        
        return [
            'title' => 'Monthly Resident Registration',
            'labels' => $dates,
            'datasets' => [
                [
                    'label' => 'Male',
                    'data' => $maleData,
                    'borderColor' => 'rgba(54, 162, 235, 1)',
                    'backgroundColor' => 'rgba(54, 162, 235, 0.2)',
                    'fill' => true
                ],
                [
                    'label' => 'Female',
                    'data' => $femaleData,
                    'borderColor' => 'rgba(255, 99, 132, 1)',
                    'backgroundColor' => 'rgba(255, 99, 132, 0.2)',
                    'fill' => true
                ]
            ]
        ];
    }
    
    private function getQuarterlyResidentsData()
    {
        // Get data for the last 4 quarters
        $quarters = [];
        $currentQuarter = Carbon::now()->quarter;
        $currentYear = Carbon::now()->year;
        
        for ($i = 0; $i < 4; $i++) {
            $quarter = $currentQuarter - $i;
            $year = $currentYear;
            
            if ($quarter <= 0) {
                $quarter += 4;
                $year -= 1;
            }
            
            $quarters[] = [
                'quarter' => $quarter,
                'year' => $year,
                'label' => "Q$quarter $year"
            ];
        }
        
        // Sort quarters chronologically
        $quarters = array_reverse($quarters);
        
        // Prepare data structure
        $labels = [];
        $activeData = [];
        $inactiveData = [];
        
        foreach ($quarters as $quarter) {
            $labels[] = $quarter['label'];
            
            // Calculate start and end dates for the quarter
            $startDate = Carbon::create($quarter['year'], ($quarter['quarter'] - 1) * 3 + 1, 1, 0, 0, 0);
            $endDate = Carbon::create($quarter['year'], $quarter['quarter'] * 3, 1, 0, 0, 0)->endOfMonth();
            
            // Count active and inactive residents for this quarter
            $active = Resident::where('status', 'Active')
                ->whereBetween('date_joined', [$startDate, $endDate])
                ->count();
                
            $inactive = Resident::where('status', '!=', 'Active')
                ->whereBetween('date_joined', [$startDate, $endDate])
                ->count();
                
            $activeData[] = $active;
            $inactiveData[] = $inactive;
        }
        
        return [
            'title' => 'Quarterly Resident Status',
            'labels' => $labels,
            'datasets' => [
                [
                    'label' => 'Active',
                    'data' => $activeData,
                    'borderColor' => 'rgba(75, 192, 192, 1)',
                    'backgroundColor' => 'rgba(75, 192, 192, 0.2)',
                    'fill' => true
                ],
                [
                    'label' => 'Inactive',
                    'data' => $inactiveData,
                    'borderColor' => 'rgba(255, 159, 64, 1)',
                    'backgroundColor' => 'rgba(255, 159, 64, 0.2)',
                    'fill' => true
                ]
            ]
        ];
    }
    
    private function getYearlyResidentsData()
    {
        // Get data for the last 5 years
        $years = [];
        $currentYear = Carbon::now()->year;
        
        for ($i = 0; $i < 5; $i++) {
            $years[] = $currentYear - $i;
        }
        
        // Sort years chronologically
        $years = array_reverse($years);
        
        // Prepare data structure
        $schoolLevels = Resident::select('school_level')->distinct()->pluck('school_level')->toArray();
        $datasets = [];
        
        // Generate a color for each school level
        $colors = [
            'rgba(75, 192, 192, 1)',
            'rgba(54, 162, 235, 1)',
            'rgba(255, 99, 132, 1)',
            'rgba(255, 159, 64, 1)',
            'rgba(153, 102, 255, 1)',
            'rgba(201, 203, 207, 1)',
        ];
        
        // Create a dataset for each school level
        foreach ($schoolLevels as $index => $level) {
            $data = [];
            
            foreach ($years as $year) {
                $startDate = Carbon::createFromDate($year, 1, 1);
                $endDate = Carbon::createFromDate($year, 12, 31);
                
                $count = Resident::where('school_level', $level)
                    ->whereBetween('date_joined', [$startDate, $endDate])
                    ->count();
                    
                $data[] = $count;
            }
            
            $colorIndex = $index % count($colors);
            
            $datasets[] = [
                'label' => $level,
                'data' => $data,
                'backgroundColor' => $colors[$colorIndex],
                'borderColor' => $colors[$colorIndex],
                'borderWidth' => 1
            ];
        }
        
        return [
            'title' => 'Yearly Residents by School Level',
            'labels' => $years,
            'datasets' => $datasets
        ];
    }

    public function getRoomsChartData(Request $request)
    {
        $view = $request->input('view', 'status');
        
        switch ($view) {
            case 'status':
                return $this->getRoomsByStatus();
            case 'capacity':
                return $this->getRoomsByCapacity();
            case 'gender':
                return $this->getRoomsByGender();
            default:
                return $this->getRoomsByStatus();
        }
    }
    
    private function getRoomsByStatus()
{
    // Get rooms grouped by status
    $rooms = Room::select('roomStatus', DB::raw('count(*) as count'))
        ->groupBy('roomStatus')
        ->get();
        
    $labels = $rooms->pluck('roomStatus')->toArray();
    $data = $rooms->pluck('count')->toArray();
    
    // Define colors for each status - using more vibrant colors
    $backgroundColors = [
        'Available' => 'rgba(75, 192, 192, 0.8)',  // Teal
        'Occupied' => 'rgba(255, 99, 132, 0.8)',   // Pink
        'Maintenance' => 'rgba(255, 159, 64, 0.8)', // Orange
        'Reserved' => 'rgba(54, 162, 235, 0.8)',    // Blue
    ];
    
    // Create colors array based on the status labels
    $colors = [];
    foreach ($labels as $label) {
        $colors[] = $backgroundColors[$label] ?? 'rgba(201, 203, 207, 0.8)';
    }
    
    return [
        'title' => 'Rooms by Status',
        'labels' => $labels,
        'datasets' => [
            [
                'data' => $data,
                'backgroundColor' => $colors,
                'borderColor' => array_map(function($color) {
                    // Create darker border colors by reducing transparency
                    return str_replace('0.8)', '1)', $color);
                }, $colors),
                'borderWidth' => 1
            ]
        ]
    ];
}
    
    private function getRoomsByCapacity()
    {
        // Get rooms grouped by capacity
        $rooms = Room::select('capacity', DB::raw('count(*) as count'))
            ->groupBy('capacity')
            ->orderBy('capacity')
            ->get();
            
        $labels = $rooms->pluck('capacity')->map(function($item) {
            return $item . ' Person' . ($item > 1 ? 's' : '');
        })->toArray();
        
        $data = $rooms->pluck('count')->toArray();
        
        return [
            'title' => 'Rooms by Capacity',
            'labels' => $labels,
            'datasets' => [
                [
                    'label' => 'Number of Rooms',
                    'data' => $data,
                    'backgroundColor' => 'rgba(54, 162, 235, 0.6)',
                    'borderColor' => 'rgba(54, 162, 235, 1)',
                    'borderWidth' => 1
                ]
            ]
        ];
    }
    
    private function getRoomsByGender()
    {
        // Count residents in rooms by gender
        $maleCount = Resident::where('gender', 'Male')
            ->whereNotNull('room_id')
            ->count();
            
        $femaleCount = Resident::where('gender', 'Female')
            ->whereNotNull('room_id')
            ->count();
        
        // Get total occupied rooms
        $occupiedRooms = Room::where('roomStatus', 'Occupied')->count();
        
        // Calculate rooms with mixed gender or no residents
        $otherRooms = $occupiedRooms - ($maleCount + $femaleCount);
        if ($otherRooms < 0) $otherRooms = 0;
        
        // Get available rooms
        $availableRooms = Room::where('roomStatus', 'Available')->count();
        
        return [
            'title' => 'Rooms by Gender Occupancy',
            'labels' => ['Male Only', 'Female Only'],
            'datasets' => [
                [
                    'data' => [$maleCount, $femaleCount, $otherRooms, $availableRooms],
                    'backgroundColor' => [
                        'rgba(54, 162, 235, 0.6)', 
                        'rgba(255, 99, 132, 0.6)', 
                    ],
                    'borderColor' => 'rgba(255, 255, 255, 1)', 
                    'borderWidth' => 2 
                ]
            ]
        ];
    }
}