<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function test(){
        function getDistance($latitude1, $longitude1, $latitude2, $longitude2)
        {
            $earthRadius = 6371; // Earth radius in kilometers

            // Convert degrees to radians
            $latFrom = deg2rad($latitude1);
            $lonFrom = deg2rad($longitude1);
            $latTo = deg2rad($latitude2);
            $lonTo = deg2rad($longitude2);

            // Difference in coordinates
            $latDiff = $latTo - $latFrom;
            $lonDiff = $lonTo - $lonFrom;

            // Haversine formula
            $a = sin($latDiff / 2) * sin($latDiff / 2) +
                 cos($latFrom) * cos($latTo) *
                 sin($lonDiff / 2) * sin($lonDiff / 2);

            $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

            // Distance in kilometers
            $distance = $earthRadius * $c;

            return $distance;
        }

        // Coordinates for your location
        $latitude1 = 23.6161;
        $longitude1 = 88.8263;

        // Coordinates for Paris (can be replaced with another location)
        $latitude2 = 23.8052;
        $longitude2 = 88.6724;

        // Calculate the distance
        $distance = getDistance($latitude1, $longitude1, $latitude2, $longitude2);

        echo "The distance is " . $distance . " kilometers.";

    }



    public function get_current_distance_of_user(){
        return view('user-location');
    }


    public function index(){

        $machine_type = [
            [
                'machine_type' => 'NVD Software',
                'total_machine_active' => 100,
            ],
            [
                'machine_type' => 'SVd Software',
                'total_machine_active' => 43,
            ],
        ];

        $year = "Jan-2024";
        $total_days_in_month = 31;

        echo '

        <style>
            .red-col {
                background-color: #e7bbbb !important;
            }
            .green-col {
                background-color: #c8e6f7 !important;
            }
            .tbl-wrapper {
                width: 100%;
                overflow-x: auto; /* This allows horizontal scrolling on smaller screens */
                margin: 20px 0;
            }

            .tbl {
                width: 100%;
                border-collapse: collapse; /* Ensures borders are collapsed for a clean look */
                margin: 10px 0;
                font-family: Arial, sans-serif;
            }

            .tbl th, .tbl td {
                padding: 5px;
                text-align: left;
                border: 1px solid #a5a5a5; /* Adds a light gray border around the table cells */
                font-size: 11px;
            }

            .tbl th {
                background-color: #f2f2f2; /* Light gray background for header */
                font-weight: normal;
            }


            table .txt-center{
                text-align: center;
            }
            table .txt-right{
                text-align: right;
            }

            /* Responsive styling */
            @media (max-width: 768px) {
                .tbl {
                    font-size: 12px; /* Smaller font size for mobile devices */
                }

                .tbl th, .tbl td {
                    padding: 5px; /* Less padding for smaller screens */
                }
            }

            @media (max-width: 480px) {
                .tbl {
                    font-size: 10px; /* Even smaller font size on very small screens */
                }

                .tbl th, .tbl td {
                    padding: 5px; /* Minimal padding on small screens */
                }

                .tbl-wrapper {
                    overflow-x: scroll; /* Ensure horizontal scroll works for small devices */
                }
            }
        </style>


        <div class="tbl-wrapper">

            <table class="tbl">
                <thead>
                    <tr>
                        <th class="txt-center" rowspan="4">No</th>
                        <th class="txt-center" rowspan="4">Machine Type</th>
                        <th class="txt-center" rowspan="4">Total <br> Active Machine</th>
                    </tr>
                    <tr>
                        <th class="txt-center" colspan="100">'. $year .'</th>
                    </tr>
                    <tr>';

                    for ($day = 1; $day <= $total_days_in_month; $day++) {

                        $class="";
                        if($day == 1 || $day == $total_days_in_month){
                            $class="red-col";
                        }
                        if($day == 10 || $day == 20){
                            $class="green-col";
                        }

                        echo '<th class="txt-center '.$class.'" colspan="2">' . $day . '</th>';
                    }
                        
                    echo '</tr>
                    <tr>';

                    for ($day = 1; $day <= $total_days_in_month; $day++) {

                        $class="";
                        if($day == 1 || $day == $total_days_in_month){
                            $class="red-col";
                        }
                        if($day == 10 || $day == 20){
                            $class="green-col";
                        }

                        echo '<th class="'. $class .'">R</th>
                        <th  class="'. $class .'">S</th>';
                    }

                    echo '</tr>
                </thead>
                <tbody>';

                foreach ($machine_type as $index => $machine) {
                    echo '<tr>';
                    echo '<td class="txt-right">' . ($index + 1) . '</td>'; 
                    echo '<td>' . $machine['machine_type'] . '</td>';
                    echo '<td class="txt-right">' . $machine['total_machine_active'] . '</td>';

                    for ($day = 1; $day <= $total_days_in_month; $day++) {

                        $class="";
                        if($day == 1 || $day == $total_days_in_month){
                            $class="red-col";
                        }
                        if($day == 10 || $day == 20){
                            $class="green-col";
                        }

                        echo '<td class="'. $class .'">' . rand(1, 10) . '</td><td class="'. $class .'">' . rand(1, 10) . '</td>';
                    }

                    echo '</tr>';
                }

                    echo '
                </tbody>
            </table>

        </div>';

    }
}
