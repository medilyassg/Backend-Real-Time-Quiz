<?php

namespace App\Http\Controllers;

use App\Http\Requests\OptionRequest;
use App\Http\Resources\OptionResource;
use App\Repository\OptionRepository;
use Illuminate\Http\Request;

class OptionController extends Controller
{
    protected $optionRepository;

    public function __construct(OptionRepository $optionRepository)
    {
        $this->optionRepository = $optionRepository;
    }

    /**
     * Display a listing of the options.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $options = $this->optionRepository->all();
        return OptionResource::collection($options);
    }


    /**
     * Display the specified option.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $option = $this->optionRepository->find($id);
        return new OptionResource($option);
    }

    /**
     * Store a newly created option in storage.
     *
     * @param  \App\Http\Requests\OptionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OptionRequest $request)
    {
        $option = $this->optionRepository->create($request->validated());
        return new OptionResource($option);
    }

    /**
     * Update the specified option in storage.
     *
     * @param  \App\Http\Requests\OptionRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(OptionRequest $request, $id)
    {
        $option = $this->optionRepository->find($id);

        // Validate the request data
        $validatedData = $request->validated();

        // Update the option
        $option = $this->optionRepository->update($option, $validatedData);

        return new OptionResource($option);
    }

    /**
     * Remove the specified option from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $option = $this->optionRepository->find($id);
        $this->optionRepository->delete($option);

        return response()->json(['message' => 'Option deleted successfully']);
    }
}
