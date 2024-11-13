<?php

namespace App\Controllers;

use App\Models\SeatModel;

class SeatAllocationController extends BaseController
{
    public function index()
    {
        // Show the grid of seats in the classroom
        $seatModel = new SeatModel();
        // Fetch seats from the database and sort them by seat_number
        $seats = $seatModel->orderBy('seat_number')->findAll();
        // Get all seat data

        return view('seat_grid', ['seats' => $seats]);
    }

    public function clearAllSeats()
    {
        $seatModel = new SeatModel();

        // Reset the seats by updating 'is_assigned' to 0 and clearing the roll number
        $seatModel->set('is_assigned', 0) // Mark all seats as unassigned
            ->set('roll_number', null) // Clear roll numbers
            ->set('updated_at', date('Y-m-d H:i:s')) // Update the timestamp
            ->where('is_assigned=1') // Apply to all rows
            ->update(); // Update all records

        // Redirect back with a success message
        return redirect()->to('/')->with('message', 'All seat assignments have been cleared, and the timestamp has been updated.');
    }

    public function allocateSeat()
    {
        $seatModel = new SeatModel();

        // Get roll number from user input
        $rollNumber = $this->request->getPost('roll_number');

        // Check if the roll number is even or odd
        $seatType = $rollNumber % 2 === 0 ? 0 : 1; // 0 for even, 1 for odd

        // Get the first available seat of the right type (even or odd)
        $availableSeat = $seatModel->getAvailableSeat($seatType);

        if ($availableSeat) {
            // Assign the seat to the student
            $seatModel->set('is_assigned', 1)
                ->set('roll_number', $rollNumber)
                ->set('updated_at', date('Y-m-d H:i:s')) // Update timestamp
                ->where('seat_number', $availableSeat['seat_number'])
                ->update();

            return redirect()->to('/')->with('message', "Roll number $rollNumber is assigned to seat number " . $availableSeat['seat_number']);
        } else {
            return redirect()->to('/')->with('message', "No available seats for roll number $rollNumber.");
        }
    }


}
