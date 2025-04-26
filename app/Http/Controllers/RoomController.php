<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Repositories\RoomRepositoryInterface;
use App\Http\Requests\StoreRoomRequest;
use App\Http\Requests\UpdateRoomRequest;

class RoomController extends Controller
{
    protected $roomRepository;

    public function __construct(RoomRepositoryInterface $roomRepository ){

        $this->roomRepository = $roomRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
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
        return redirect()->route('rooms.index')->with('success', 'Room deleted successfully');
    }
}
