<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;
use App\Http\Requests\StoreRoomRequest;
use App\Http\Requests\UpdateRoomRequest;
use App\Repositories\RoomRepositoryInterface;

class RoomController extends Controller
{
    protected $roomRepository;

    public function __construct(RoomRepositoryInterface $roomRepository ){

        $this->roomRepository = $roomRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if($request->ajax() || $request->wantsJson()){
            $search = $request->q ?? '';
            $rooms = $this->roomRepository->search($search);
            return response()->json(['rooms' => $rooms]);
        }
        $rooms = $this->roomRepository->all();
        return view('Admin.rooms.room',compact('rooms'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRoomRequest $request)
    {
        $this->roomRepository->create($request->validated());
        return redirect()->route('rooms.index')->with('success', 'Room created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Room $room)
    {
        return $this->roomRepository->find($room);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $room = $this->roomRepository->find($id);
        return view('Admin.rooms.room', compact('room'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRoomRequest $request, $id)
    {
        $this->roomRepository->update($id, $request->validated());
        return redirect()->route('rooms.index')->with('success', 'Room updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $this->roomRepository->delete($id);
        return response()->json([
            'message' => 'Room deleted successfully.'
        ]);
    }
}
