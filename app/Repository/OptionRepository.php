<?php

namespace App\Repository;

use App\Models\Option;

class OptionRepository
{
    public function all()
    {
        return Option::all();
    }

    public function find($id)
    {
        return Option::findOrFail($id);
    }

    public function create(array $data)
    {
        return Option::create($data);
    }

    public function update(Option $option, array $data)
    {
        $option->update($data);
        return $option;
    }

    public function delete(Option $option)
    {
        $option->delete();
    }
}
