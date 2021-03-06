<?php

namespace App\Imports;

use App\Models\Turma;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Schema;
use DB;
use Carbon\Carbon;

class TurmasImport implements ToModel
{

    public function processarLinha($linha)
    {
        ini_set('memory_limit', '-1');
        ini_set('max_execution_time', '300');
    // verificando linha
    if (str_contains($linha, ',')) {
        $dados = array_filter(explode(',', str_replace(["\r", "\n", "\t", "\v"], ' ', $linha)), function ($item) {
        return !empty($item);
    });
    
    dump($dados[0]);
    dump((!empty($dados[1]) ? $dados[1] : '- - -'));
    dump('============');
    // DB::table('turmas')->insert(
    //     array(
    //         'idTurma' => !empty($dados[0]) ? (int) $dados[0] : null,
    //         'Descricao' => !empty($dados[1]) ? $dados[1] : null,
    //         'Status' => !empty($dados[2]) ? $dados[2] : null,
    //         'codTurmaNova_cpi' => !empty($dados[9]) ? $dados[9] : '',
    //    )
    // );

        // $table->string($row[0], 150);
        // $table->string($row[1],150);
        // $table->string($row[2],150);
        // $table->string($row[9],150);

    }

    }

    public function model(array $row)
    {
        ini_set('memory_limit', '-1');
        ini_set('max_execution_time', '300');

            // dd($row);
            // exit;
        //   \Schema::create('turmas', function ($table) use ($row) {
        //     $table->increments('id');
        //     $table->string($row[0], 150);
        //     $table->string($row[1],150);
        //     $table->string($row[2],150);
        //     $table->string($row[9],150);
        //   });

        $this->processarLinha($row[0]);
        
    }

   

    function tirarAcentos($string){
        $caracteres_sem_acento = array(
        'Š'=>'S', 'š'=>'s', 'Ð'=>'Dj',''=>'Z', ''=>'z', 'À'=>'A', 'Á'=>'A', 'Â'=>'A', 'Ã'=>'A', 'Ä'=>'A',
        'Å'=>'A', 'Æ'=>'A', 'Ç'=>'C', 'È'=>'E', 'É'=>'E', 'Ê'=>'E', 'Ë'=>'E', 'Ì'=>'I', 'Í'=>'I', 'Î'=>'I',
        'Ï'=>'I', 'Ñ'=>'N', 'Ń'=>'N', 'Ò'=>'O', 'Ó'=>'O', 'Ô'=>'O', 'Õ'=>'O', 'Ö'=>'O', 'Ø'=>'O', 'Ù'=>'U', 'Ú'=>'U',
        'Û'=>'U', 'Ü'=>'U', 'Ý'=>'Y', 'Þ'=>'B', 'ß'=>'Ss','à'=>'a', 'á'=>'a', 'â'=>'a', 'ã'=>'a', 'ä'=>'a',
        'å'=>'a', 'æ'=>'a', 'ç'=>'c', 'è'=>'e', 'é'=>'e', 'ê'=>'e', 'ë'=>'e', 'ì'=>'i', 'í'=>'i', 'î'=>'i',
        'ï'=>'i', 'ð'=>'o', 'ñ'=>'n', 'ń'=>'n', 'ò'=>'o', 'ó'=>'o', 'ô'=>'o', 'õ'=>'o', 'ö'=>'o', 'ø'=>'o', 'ù'=>'u',
        'ú'=>'u', 'û'=>'u', 'ü'=>'u', 'ý'=>'y', 'ý'=>'y', 'þ'=>'b', 'ÿ'=>'y', 'ƒ'=>'f',
        'ă'=>'a', 'î'=>'i', 'â'=>'a', 'ș'=>'s', 'ț'=>'t', 'Ă'=>'A', 'Î'=>'I', 'Â'=>'A', 'Ș'=>'S', 'Ț'=>'T',
        );

        $nova_string = strtr($string, $caracteres_sem_acento);

        return strtoupper($nova_string);
    }
    
}
