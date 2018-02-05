<?php

namespace App\Http\Controllers;

use Storage;
use Illuminate\Http\Request;
use App\Http\Requests\StoreProperty;

class BatchPropertyUploadController extends Controller
{
    public function create()
    {
        return view('batch.upload');
    }

	/**
	 * @param Request $request
	 *
	 * @return array|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
	 */
	public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:csv,txt'
        ]);

        $storedFile = new \SplFileObject(storage_path('app/'.Storage::putFile('batch', $request->file)));
        $storedFile->setFlags(\SplFileObject::READ_CSV);

        $header = $storedFile->fgetcsv();
        $imported_count=0;
        session(['imported' => $imported_count ]);
        while ($row = $storedFile->fgetcsv()) {
            if ($row[0] == null) {
                continue;
            }

            session(['importing' => 1 ]);
            (new StoreProperty)->store([
                'team_id' => $request->team_id ?: auth()->user()->currentTeam->id,
                'name' => '',
                'address' => $row[0],
                'address_2' => $row[1],
                'city' => $row[2],
                'state' => $row[3],
                'zip' => $row[5],
                'country' => $row[4]
            ]);
            $imported_count++;
            session(['imported' => $imported_count ]);
        }

        session(['importing' => 0 ]);

        if($request->is('onboard/*')) {
            return [
                'message' => 'Success!'
             ];
        }
        return redirect('home');
    }

    public function api()
    {
        $imported_count=0;
        session(['importing' => 1 ]);
        foreach(request()->all() as $address){
            (new StoreProperty)->store([
                'team_id' => request()->team_id ?: auth()->user()->currentTeam->id,
                'name' => '',
                'address' => $address['street'],
                'address_2' => '',
                'city' => $address['city'],
                'state' => $address['state'],
                'zip' => $address['zip'],
                'country' => 'US'
            ]);
            $imported_count++;
            session(['imported' => $imported_count ]);
        }
        session(['importing' => 0 ]);

        return [
            'message' => 'Success!'
        ];
    }
}
