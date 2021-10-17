<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\TurmasImport;
use App\Models\Turma;


class TurmaController extends Controller
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function fileImportExport()
    {
       return view('importar_turmas');
    }

    
    
    public function automatizarInsercao()
    {
        $alunos = Turma::all();

        foreach ($alunos as $key => $aluno) {
            dd($aluno['NOME']);
        }
    }
   
    /**
    * @return \Illuminate\Support\Collection
    */
    public function fileImport(Request $request) 
    {
        Excel::import(new TurmasImport, $request->file('file')->store('temp'));
        return back();
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function fileExport() 
    {
        return Excel::download(new UsersExport, 'users-collection.xlsx');
    }    
}
