<?php

namespace App\Models;

use CodeIgniter\Model;

class SeatModel extends Model
{
    protected $table = 'seats';
    protected $primaryKey = 'seat_number';
    protected $allowedFields = ['seat_number', 'is_assigned', 'roll_number', 'assigned_at', 'updated_at'];

    protected $useTimestamps = true;
    protected $createdField  = 'assigned_at';
    protected $updatedField  = 'updated_at';

    // Method to get available seat (either odd or even)
    public function getAvailableSeat($type)
    {
        return $this->orderBy('seat_number')->where('MOD(seat_number, 2) =', $type)
            ->where('is_assigned', 0)
            ->first();
    }
    // Method to assign a seat to a student (roll number)
    public function assignSeat($seatNumber, $rollNumber)
    {
        return $this->update($seatNumber, [
            'is_assigned' => 1,
            'roll_number' => $rollNumber
        ]);
    }
}
