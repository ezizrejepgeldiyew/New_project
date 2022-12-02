<?php

namespace App\Repository\Admin;

use App\Contracts\Admin\NoticesInterface;
use App\Http\Requests\NoticesRequest;
use App\Models\Notices;
use App\Repository\PhotoSettings;

class NoticesRepository implements NoticesInterface
{
    protected $PhotoFolder = "Notices";

    public function __construct(Notices $notices)
    {
        $this->notices = $notices;
    }

    public function get()
    {
        return Notices::get();
    }

    public function store(NoticesRequest $request)
    {
        $data = $request->all();
        $data['photo'] = PhotoSettings::StorePhoto($data['photo'], $this->PhotoFolder);
        return Notices::create($data);
    }

    public function update(NoticesRequest $request, $id)
    {
        $notices = $this->find($id);
        $data = $request->all();
        $data['photo'] = PhotoSettings::UpdatePhoto($data['photo'], $this->PhotoFolder, $notices['photo']);
        return $notices->update($data);
    }

    public function destroy($id)
    {
        $notices = $this->find($id);
        PhotoSettings::DestroyPhoto($notices['photo']);
        return $notices->delete();
    }

    private function find($id)
    {
        return Notices::find($id);
    }
}
