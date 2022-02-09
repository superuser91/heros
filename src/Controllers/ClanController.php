<?php

namespace Vgplay\Heros\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Vgplay\Heros\Actions\CreateClan;
use Vgplay\Heros\Actions\UpdateClan;
use Vgplay\Heros\Models\Clan;

class ClanController
{
    use AuthorizesRequests;

    public function index(Request $request)
    {
        $this->authorize('viewAny', Clan::class);

        $clans = Clan::all();

        return view('vgplay::clans.index', compact('clans'));
    }

    public function create()
    {
        $this->authorize('create', Clan::class);

        return view('vgplay::clans.create');
    }

    public function store(Request $request, CreateClan $creater)
    {
        $this->authorize('create', Clan::class);

        try {
            $creater->create($request->all());
            session()->flash('status', 'Thêm thành công');
            return redirect(route('clans.index'));
        } catch (ValidationException $e) {
            session()->flash('status', $e->validator->errors()->first());
            return back()->withInput()->withErrors($e->validator);
        } catch (\Exception $e) {
            session()->flash('status', $e->getMessage());
            return back()->withInput();
        }
    }

    public function edit(Request $request, $id)
    {
        $clan = Clan::findOrFail($id);

        $this->authorize('update', $clan);

        return view('vgplay::clans.edit', compact('clan'));
    }

    public function update(Request $request, UpdateClan $updater, $id)
    {
        $clan = Clan::findOrFail($id);

        $this->authorize('update', $clan);

        try {
            $updater->update($clan, $request->all());
            session()->flash('status', 'Cập nhật thành công');
            return redirect(route('clans.index'));
        } catch (ValidationException $e) {
            session()->flash('status', $e->validator->errors()->first());
            return back()->withInput()->withErrors($e->validator);
        } catch (\Exception $e) {
            session()->flash('status', $e->getMessage());
            return back()->withInput();
        }
    }

    public function destroy($id)
    {
        $clan = Clan::findOrFail($id);

        $this->authorize('delete', $clan);

        try {
            $clan->delete();
            session()->flash('status', 'Xóa thành công');
            return redirect(route('clans.index'));
        } catch (\Exception $e) {
            session()->flash('status', $e->getMessage());
            return back()->withInput();
        }
    }
}
