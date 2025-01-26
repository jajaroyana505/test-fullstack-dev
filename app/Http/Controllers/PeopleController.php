<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\PeopleCreateRequest;
use App\Http\Requests\PeopleUpdateRequest;
use App\Models\People;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class PeopleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        if ($request->query()) {
            $peoples = $this->search($request);
        } else {
            $peoples = People::orderBy('updated_at', 'desc')->paginate(10);
        }
        return Inertia::render('Peoples/ListPeople', [
            'status' => session('status'),
            'peoples' => $peoples,
            'query' => $request->query() ? $request->query() : ''
        ]);
    }

    public function search(Request $request)
    {

        $query = People::query();
        if ($request->key) {
            $searchableColumns = [
                'first_name',
                'last_name',
                'dob',
                'state',
                'street',
                'city',
                'postal_code',
                'phone',
                'email'
            ];
            $query->where(function ($query) use ($searchableColumns, $request) {
                foreach ($searchableColumns as $column) {
                    $query->orWhere($column, 'like', '%' . $request->key . '%');
                }
            });
        }
        if ($request->filter) {
            $query->where('gender', $request->filter);
        }

        return $query->paginate(10)->appends($request->query());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Peoples/CreatePeople', [
            'status' => session('status'),
        ]);
    }

    public function store(PeopleCreateRequest $people)
    {
        $peopleData = $people->validated();
        People::insert($peopleData);
        return Redirect::route('peoples.index')->with('success', 'People has been added successfully');
    }


    public function show(People $people)
    {
        return Inertia::render('Peoples/ShowPeople', [
            'people' => $people,
        ]);
    }

    public function edit(
        People $people
    ) {
        return Inertia::render('Peoples/EditPeople', [
            'people' => $people,
        ]);
    }

    public function update(PeopleUpdateRequest $request, People $people)
    {
        $newData = $request->validated();
        $people->update($newData);
        return Redirect::route('peoples.index', $people->id)->with('success', 'People has been updated successfully');
    }

    public function destroy(People $people)
    {
        $people->delete();
        return to_route('peoples.index')->with('success', 'People has been deleted successfully');
    }
}
