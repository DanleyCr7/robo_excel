<?php

namespace App\Imports;

use App\Models\Turma;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Schema;
use DB;
use Carbon\Carbon;

class MensalidadesImport implements ToModel
{

    public function processarLinha($linha)
    {
    // verificando linha
    if (str_contains($linha, ',')) {
        $dados = array_filter(explode(',', str_replace(["\r", "\n", "\t", "\v"], ' ', $linha)), function ($item) {
        return !empty($item);
    });

    
        DB::table('responsavels')->insert(
        array(
              "idResponsavel" => !empty($dados[0]) ? $dados[0] : null,
              "Nome" => !empty($dados[1]) ? $dados[1] : null,
              "RG" => !empty($dados[2]) ? str_replace( ['"'] ,'', $dados[2]) : null,
              "CPF" => !empty($dados[3]) ? str_replace( ['"'] ,'', $dados[3]) : null,
              "Profissao" => !empty($dados[4]) ? str_replace( ['"'] ,'', $dados[4]) : null,
              "foneTrabalho" => !empty($dados[5]) ? $dados[5] : null,
              "idAluno" => !empty($dados[7]) ? str_replace(['"'] ,'', $dados[7]) : null,
              "Celular" => !empty($dados[9]) ? $dados[9] : null,
              "Endereco" => !empty($dados[10]) ? $dados[10] : null,
              "Bairro" => !empty($dados[11]) ? $dados[11] : null,
              "CEP" => !empty($dados[12]) ? str_replace( ['"'] ,'', $dados[12]) : null,
              "UF" => !empty($dados[15]) ? $dados[15] : null,
              "Naturalidade" => !empty($dados[18]) ? $dados[18] : null,
              "Nacionalidade" => !empty($dados[19]) ? $dados[19] : null,
              "idVinculo" => !empty($dados[23]) ? $dados[23] : null,
              "Email" => !empty($dados[24]) ? $dados[24] : null,
              "dataNascimento" => !empty($dados[25]) ? $dados[25] : null,
              "Pai" => !empty($dados[30]) ? $dados[30] : null,
              "Mae" => !empty($dados[31]) ? $dados[31] : null,
              "idRaca" => !empty($dados[32]) ? $dados[32] : null,
              "idCor" => !empty($dados[33]) ? $dados[33] : null,
              "Sexo" => !empty($dados[34]) ? $dados[34] : null,
              "Complemento" => !empty($dados[35]) ? $dados[35] : null,
              "tipoPessoaResponsavel" => !empty($dados[44]) ? $dados[44] : null,
       ));

    }

    }

    public function model(array $row)
    {        
        //    dd($row);
        //    exit;
        //   \Schema::create('responsavels', function ($table) use ($row) {
        //     $table->increments('id');
        //     $table->text($row[0], 150)->nullable();
        //     $table->text($row[1], 150)->nullable();
        //     $table->text($row[2],150)->nullable();
        //     $table->text($row[3],150)->nullable();
        //     $table->text($row[4],150)->nullable();
        //     $table->text($row[5],150)->nullable();
        //     $table->text($row[7],150)->nullable();
        //     $table->text($row[9],150)->nullable();
        //     $table->text($row[10],150)->nullable();
        //     $table->text($row[11],150)->nullable();
        //     $table->text($row[12],150)->nullable();
        //     $table->text($row[15],150)->nullable();
        //     $table->text($row[18],150)->nullable();
        //     $table->text($row[19],150)->nullable();
        //     $table->text($row[23],150)->nullable();
        //     $table->text($row[24],150)->nullable();
        //     $table->text($row[25],150)->nullable();
        //     $table->text($row[30],150)->nullable();
        //     $table->text($row[31],150)->nullable();
        //     $table->text($row[32],150)->nullable();
        //     $table->text($row[33],150)->nullable();
        //     $table->text($row[34],150)->nullable();
        //     $table->text($row[35],150)->nullable();
        //     $table->text($row[44],150)->nullable();
        //   });
        $this->processarLinha($row[0]);
        
    }

    public function matriculas(array $row)
    {
        dd($row);
        exit;
        // \Schema::create('responsavels', function ($table) use ($row) {
        // $table->increments('id');
        // $table->text($row[0], 150)->nullable();
        // $table->text($row[1], 150)->nullable();
        // $table->text($row[2],150)->nullable();
        // $table->text($row[3],150)->nullable();
        // $table->text($row[4],150)->nullable();
        // $table->text($row[5],150)->nullable();
        // $table->text($row[7],150)->nullable();
        // $table->text($row[9],150)->nullable();
        // $table->text($row[10],150)->nullable();
        // $table->text($row[11],150)->nullable();
        // $table->text($row[12],150)->nullable();
        // $table->text($row[15],150)->nullable();
        // $table->text($row[18],150)->nullable();
        // $table->text($row[19],150)->nullable();
        // $table->text($row[23],150)->nullable();
        // $table->text($row[24],150)->nullable();
        // $table->text($row[25],150)->nullable();
        // $table->text($row[30],150)->nullable();
        // $table->text($row[31],150)->nullable();
        // $table->text($row[32],150)->nullable();
        // $table->text($row[33],150)->nullable();
        // $table->text($row[34],150)->nullable();
        // $table->text($row[35],150)->nullable();
        // $table->text($row[44],150)->nullable();
        // });
        $this->processarLinha($row[0]);

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
