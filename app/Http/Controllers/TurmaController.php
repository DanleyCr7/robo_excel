<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\TurmasImport;
use App\Imports\MensalidadesImport;
use App\Imports\MensalidadesAcordoImport;

use App\Models\Turma;

use DB;

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
        // Excel::import(new TurmasImport, $request->file('file')->store('temp'));
        Excel::import(new MensalidadesImport, $request->file('file')->store('temp'));
        // Excel::import(new MensalidadesAcordoImport, $request->file('file')->store('temp'));
        exit;
        return back();
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function fileExport() 
    {
        return Excel::download(new UsersExport, 'users-collection.xlsx');
    }   

    public function limparDados(){
        $responsavels = DB::table('responsavels')->get();
        
        foreach ($responsavels as $key => $responsavel) {
            $resp = DB::table('responsavels')->find($responsavel->id);
            $resp->CEP = str_replace( ['"'] ,'', $resp->CEP);

            $matUpdate = DB::table('responsavels')->where('id', $resp->id)->update(['CEP'=> null ]);
        }
    }
}
