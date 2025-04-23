<?php

namespace App\Repositories;

use App\Models\Room;

class RoomRepository implements RoomRepositoryInterface
{
    /**
     * Create a new class instance.
     */
    
        public function all(){

            return Room::paginate(5);

        }

        public function create(array $data){

            return Room::create($data);

        }

        public function find($id){

            return Room::findOrFaild($id);

        }

        public function update($id, array $data){

              $result = Room::findOrFail($id);
              $result->update($data);
              return $result;

        }

        public function delete($id){

            return Room::destroy($id);
            
        }
    
}
