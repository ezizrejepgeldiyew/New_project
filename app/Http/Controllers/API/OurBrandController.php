<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\CreateOurBrandRequests;
use App\Repository\Admin\OurBrandRepository;
use App\Repository\API\BaseRepository;

class OurBrandController extends BaseRepository
{
    public function index(
        OurBrandRepository $ourbrand
    ) {
        return $this->sendResponse($ourbrand->get(), 'Ourbrand retrieved successfully!');
    }

    public function store(
        CreateOurBrandRequests $request,
        OurbrandRepository $ourbrand
    ) {
        if (!$request) {
            return $this->sendError('Validation error', 'error');
        }
        return $this->sendResponse($ourbrand->store($request), 'Ourbrand created successfully!');
    }

    public function show(
        $id,
        OurBrandRepository $ourbrand
    ) {
        if (is_null($ourbrand->find($id))) {
            return $this->sendError('Ourbrand not fount!');
        }
        return $this->sendResponse($ourbrand->find($id), 'Ourbrand retrieved successfully!');
    }

    public function update(
        $id,
        OurBrandRepository $ourbrand,
        CreateOurBrandRequests $request
    ) {
        return $this->sendResponse($ourbrand->update($request, $id), 'Ourbrand updated successfully!');
    }

    public function delete(
        $id,
        OurBrandRepository $ourbrand
    ) {
        return $this->sendResponse($ourbrand->destroy($id), 'Ourbrand deleted successfully!');
    }
}
