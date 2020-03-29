<?php
namespace App\Http\Controllers;

use App\Libs\App;
use App\Models;
use App\Models\TAXNote;

class NoteController extends Controller
{

    use App;

    public function index()
    {
    }

    public function create()
    {
    }

    public function store()
    {
        $note                = new TAXNote();
        $note->tax_record_id = request()->get('tax_record_id');
        $note->note_by       = \Auth::user()->id;
        $note->note          = request()->get('note');
        $note->save();

        return redirect()->to('tax/' . request()->get('tax_record_id') . '?tab=4')
            ->with('success', 'Note has been added.');
    }

    public function edit($id)
    {
    }

    public function update($id)
    {
        $note                = TAXNote::find($id);
        $note->note          = request()->get('note');
        $note->save();

        return redirect()->to('tax/' . $note->tax_record_id . '?tab=4')
            ->with('success', 'Note has been update.');
    }

    public function show($id)
    {
    }

    public function destroy($id)
    {
        try {
            $note  = Models\TAXNote::find($id);
            $taxId = $note->tax_record_id;
            $note->delete();

            return redirect()->to('tax/' . $taxId . '?tab=4')->with('success', 'Note has been deleted');
        } catch (\Exception $ex) {
            return redirect()->to('tax/' . $taxId . '?tab=4')->with('success', 'Error on deleted that record');
        }
    }
}
