<?php

namespace App\Imports;

use App\Models\Turma;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Schema;
use DB;
use Carbon\Carbon;

class MensalidadesItensImport implements ToModel
{

    public function processarLinha($linha)
    {
    // verificando linha
    if (str_contains($linha, ',')) {
        $dados = array_filter(explode(',', str_replace(["\r", "\n", "\t", "\v"], ' ', $linha)), function ($item) {
        return !empty($item);
    });
    

    DB::table('acordo')->insert(
        array(
            'idAcordo' => !empty($dados[0]) ? (int) $dados[0] : null,
            'Data' => !empty($dados[1]) ? Carbon::createFromFormat('Y-m-d H:i:s', $dados[1]) : null,
            'Usuario' => !empty($dados[2]) ? $dados[2] : null,
            'ValorTotalNominal' => !empty($dados[3]) ? $dados[3] : null,
            'Juros' => !empty($dados[4]) ? $dados[4] : null,
            'Desconto' => !empty($dados[5]) ? $dados[5] : null,
            'ValorTotalPagar' => !empty($dados[6]) ? $dados[6] : null,
            'Observacao' => !empty($dados[7]) ? $dados[7] : null,
            'Situacao' => !empty($dados[8]) ? $dados[8] : null,
            'idAcordoRaiz' => !empty($dados[9]) ? $dados[9] : null,
            'idAluno' => !empty($dados[10]) ? $dados[10] : null,
            'Multa' => !empty($dados[11]) ? $dados[11] : null,
            'idFornecedor' => !empty($dados[12]) ? $dados[12] : null,
            'Acrescimo' => !empty($dados[13]) ? $dados[13] : null,
            'idInteressado' => !empty($dados[14]) ? (int) $dados[14] : null,
            'tipo' => !empty($dados[15]) ? $dados[15] : null,
            'parcelamento_id' => !empty($dados[16]) ? (int) $dados[16] : null,
            'idProfissional' => !empty($dados[17]) ? $dados[17] : null,
            'finalidade' => !empty($dados[18]) ? $dados[18] : null,
       ));

    }

    }

    public function model(array $row)
    {
        //   \Schema::create('acordo', function ($table) use ($row) {
        //     $table->increments('id');
        //     $table->string($row[0], 150);
        //     $table->string($row[1],150);
        //     $table->string($row[2],150);
        //     $table->string($row[3],150);
        //     $table->string($row[4],150);
        //     $table->string($row[5],150);
        //     $table->string($row[6],150);
        //     $table->string($row[7],150);
        //     $table->string($row[8],150);
        //     $table->string($row[9],150);
        //     $table->string($row[10],150);
        //     $table->string($row[11],150);
        //     $table->string($row[12],150);
        //     $table->string($row[13],150);
        //     $table->string($row[14],150);
        //     $table->string($row[15],150);
        //     $table->string($row[16],150);
        //     $table->string($row[17],150);
        //     $table->string($row[18],150);
        //   });
        dd($row);
        // $this->processarLinha($row[0]);
        
        // DB::table('acordo')->insert(
        // array(
        //     $row[0] => !empty($row[0]) ? $this->tirarAcentos($row[0]) : null ,
        //     $row[1] => !empty($row[1]) ? $this->tirarAcentos($row[1]) : null ,
        //     $row[2] => !empty($row[2]) ? $this->tirarAcentos($row[2]) : null ,
        //     $row[3] => !empty($row[3]) ? $this->tirarAcentos($row[3]) : null ,
        //     $row[4] => !empty($row[4]) ? $this->tirarAcentos($row[4]) : null ,
        //     $row[5] => !empty($row[5]) ? $this->tirarAcentos($row[5]) : null ,
        //     $row[6] => !empty($row[6]) ? $this->tirarAcentos($row[6]) : null ,
        //     $row[7] => !empty($row[7]) ? $this->tirarAcentos($row[7]) : null ,
        //     $row[8] => !empty($row[8]) ? $this->tirarAcentos($row[8]) : null ,
        //     $row[9] => !empty($row[9]) ? $this->tirarAcentos($row[9]) : null ,
        //     $row[10] => !empty($row[10]) ? $this->tirarAcentos($row[10]) : null ,
        //     $row[11] => !empty($row[11]) ? $this->tirarAcentos($row[11]) : null ,
        //     $row[12] => !empty($row[12]) ? $this->tirarAcentos($row[12]) : null ,
        //     $row[13] => !empty($row[13]) ? $this->tirarAcentos($row[13]) : null ,
        //     $row[14] => !empty($row[14]) ? $this->tirarAcentos($row[14]) : null ,
        //     $row[15] => !empty($row[15]) ? $this->tirarAcentos($row[15]) : null ,
        //     $row[16] => !empty($row[16]) ? $this->tirarAcentos($row[16]) : null ,
        //     $row[17] => !empty($row[17]) ? $this->tirarAcentos($row[17]) : null ,
        //     $row[18] => !empty($row[18]) ? $this->tirarAcentos($row[18]) : null
        // ));
    }

   

    function tirarAcentos($string){
        $caracteres_sem_acento = array(
        '??'=>'S', '??'=>'s', '??'=>'Dj','??'=>'Z', '??'=>'z', '??'=>'A', '??'=>'A', '??'=>'A', '??'=>'A', '??'=>'A',
        '??'=>'A', '??'=>'A', '??'=>'C', '??'=>'E', '??'=>'E', '??'=>'E', '??'=>'E', '??'=>'I', '??'=>'I', '??'=>'I',
        '??'=>'I', '??'=>'N', '??'=>'N', '??'=>'O', '??'=>'O', '??'=>'O', '??'=>'O', '??'=>'O', '??'=>'O', '??'=>'U', '??'=>'U',
        '??'=>'U', '??'=>'U', '??'=>'Y', '??'=>'B', '??'=>'Ss','??'=>'a', '??'=>'a', '??'=>'a', '??'=>'a', '??'=>'a',
        '??'=>'a', '??'=>'a', '??'=>'c', '??'=>'e', '??'=>'e', '??'=>'e', '??'=>'e', '??'=>'i', '??'=>'i', '??'=>'i',
        '??'=>'i', '??'=>'o', '??'=>'n', '??'=>'n', '??'=>'o', '??'=>'o', '??'=>'o', '??'=>'o', '??'=>'o', '??'=>'o', '??'=>'u',
        '??'=>'u', '??'=>'u', '??'=>'u', '??'=>'y', '??'=>'y', '??'=>'b', '??'=>'y', '??'=>'f',
        '??'=>'a', '??'=>'i', '??'=>'a', '??'=>'s', '??'=>'t', '??'=>'A', '??'=>'I', '??'=>'A', '??'=>'S', '??'=>'T',
        );

        $nova_string = strtr($string, $caracteres_sem_acento);

        return strtoupper($nova_string);
    }
    
}
