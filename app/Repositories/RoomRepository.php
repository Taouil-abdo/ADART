<?php

namespace App\Repositories;

use App\Models\Room;

class RoomRepository implements RoomRepositoryInterface
{
    /**
     * Create a new class instance.
     */
        public function search(String $search){

            return Room::where('roomStatus', 'like', "%$search%")
                ->orWhere('capacity', 'like', "%$search%")
                ->orWhere('block', 'like', "%$search%")
                ->orWhere('roomNumber', 'like', "%$search%")
                ->get();
        }
    
        public function all(){

            return Room::paginate(5);
        }

        public function create(array $data){
            return Room::create($data);
        }

        public function find($id){

            return Room::find($id);
        }

        public function update($id, array $data){

              $result = Room::find($id);
              $result->update($data);
              return $result;
        }

        public function delete($id)
        {
            $room = Room::find($id);
            if (!$room) {
              return response()->json(['message' => 'Room not found.'], 404);
            }else{
              $room->delete();
            }
          
        }
    
}
