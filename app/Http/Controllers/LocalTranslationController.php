<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLocalTranslationRequest;
use App\Http\Requests\UpdateLocalTranslationRequest;
use App\Models\LocalTranslation;

class LocalTranslationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $datas = LocalTranslation::all();
        var_dump($datas->toArray());
        exit;
        // insert view inertia
        return $datas;
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
    public function store(StoreLocalTranslationRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(LocalTranslation $localTranslation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LocalTranslation $localTranslation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLocalTranslationRequest $request, LocalTranslation $localTranslation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LocalTranslation $localTranslation)
    {
        //
    }
}
