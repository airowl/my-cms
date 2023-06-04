<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Models\LocalTranslation;
use App\Http\Requests\StoreLocalTranslationRequest;
use App\Http\Requests\UpdateLocalTranslationRequest;
use App\Models\Language;

class LocalTranslationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $translations = LocalTranslation::all();
        $datas = null;
        foreach ($translations as $data) {
            $datas[] = $data->getSummery();
        }
        $languages = Language::all();
        return Inertia::render('TranslationsView', [
            'listLanguages' => $datas,
            'languages' => $languages
        ]);
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
        $currentRequest = (object)$request->validated();
        $localTranslation = new LocalTranslation();
        $localTranslation->translation = $currentRequest->translation;
        $language = Language::where('languageCode', $currentRequest->languageCode)->get();
        $localTranslation->local_language_id = $language[0]->id;
        $localTranslation->save();

        return to_route('translations');
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
    public function update(UpdateLocalTranslationRequest $request)
    {
        $currentRequest = (object)$request->validated();
        $localTranslation = LocalTranslation::findOrFail($currentRequest->id);
        $localTranslation->translation = $currentRequest->translation;
        $localTranslation->save();

        return to_route('translations');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $localTranslation = LocalTranslation::findOrFail($id);
        $success = $localTranslation->delete();
        return to_route('translations');
    }
}
