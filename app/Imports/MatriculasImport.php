<?php

namespace App\Imports;

use App\Models\Turma;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Schema;
use DB;
use Carbon\Carbon;

class MatriculasImport implements ToModel
{

    public function processarLinha($linha)
    {
    // verificando linha
    if (str_contains($linha, ',')) {
        $dados = array_filter(explode(',', str_replace(["\r", "\n", "\t", "\v"], ' ', $linha)), function ($item) {
        return !empty($item);
    });

        DB::table('matriculas')->insert(
        array(
              "DataMatricula" => !empty($dados[0]) ? $dados[0] : null,
              "idUsuario" => !empty($dados[1]) ? $dados[1] : null,
              "idAluno" => !empty($dados[2]) ? str_replace( ['"'] ,'', $dados[2]) : null,
              "Matricula" => !empty($dados[3]) ? str_replace( ['"'] ,'', $dados[3]) : null,
              "idTurma" => !empty($dados[6]) ? str_replace( ['"'] ,'', $dados[6]) : null,
              "ordemAluno" => !empty($dados[7]) ? $dados[7] : null,
              "id_antigo" => !empty($dados[21]) ? str_replace(['"'] ,'', $dados[21]) : null,         
        ));

    }

    }

    public function model(array $row)
    {    
        //   \Schema::create('matriculas', function ($table) use ($row) {
        //     $table->increments('id');
        //     $table->text($row[0], 150)->nullable();
        //     $table->text($row[1], 150)->nullable();
        //     $table->text($row[2],150)->nullable();
        //     $table->text($row[3],150)->nullable();
        //     $table->text($row[6],150)->nullable();
        //     $table->text($row[7],150)->nullable();
        //     $table->text($row[21],150)->nullable();
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
