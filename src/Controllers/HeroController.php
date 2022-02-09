<?php

namespace Vgplay\Heros\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Vgplay\Heros\Actions\CreateHero;
use Vgplay\Heros\Actions\UpdateHero;
use Vgplay\Heros\Models\Clan;
use Vgplay\Heros\Models\Hero;

class HeroController
{
    use AuthorizesRequests;

    public function index(Request $request)
    {
        $this->authorize('viewAny', Hero::class);

        $heros = Hero::all();

        return view('vgplay::heros.index', compact('heros'));
    }

    public function create()
    {
        $this->authorize('create', Post::class);

        $clans = Clan::fromCache()->all();

        $skillTemplate = '';
        foreach (config('vgplay.heros.skills') as $key => $display) {
            $skillTemplate .= sprintf("<input type='text' class='form-control my-1' name='skills[%s][]' placeholder='%s'>", $key, $display);
        }

        return view('vgplay::heros.create', compact('clans', 'skillTemplate'));
    }

    public function store(Request $request, CreateHero $creater)
    {
        $this->authorize('create', Hero::class);

        try {
            $creater->create($request->all());
            session()->flash('status', 'Thêm thành công');
            return redirect(route('heros.index'));
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
        $hero = Hero::findOrFail($id);

        $this->authorize('update', $hero);

        $clans = Clan::fromCache()->all();

        $skillTemplate = '';
        foreach (config('vgplay.heros.skills') as $key => $display) {
            $skillTemplate .= sprintf("<input type='text' class='form-control my-1' name='skills[%s][]' placeholder='%s'>", $key, $display);
        }

        return view('vgplay::heros.edit', compact('hero', 'clans', 'skillTemplate'));
    }

    public function update(Request $request, UpdateHero $updater, $id)
    {
        $hero = Hero::findOrFail($id);

        $this->authorize('update', $hero);

        try {
            $updater->update($hero, $request->all());
            session()->flash('status', 'Cập nhật thành công');
            return redirect(route('heros.index'));
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
        $hero = Hero::findOrFail($id);

        $this->authorize('delete', $hero);

        try {
            $hero->delete();
            session()->flash('status', 'Xóa thành công');
            return redirect(route('heros.index'));
        } catch (\Exception $e) {
            session()->flash('status', $e->getMessage());
            return back()->withInput();
        }
    }
}
