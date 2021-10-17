<?php

namespace App\Imports;

use App\Models\Turma;
use Maatwebsite\Excel\Concerns\ToModel;

class TurmasImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Turma([
            'CIDADE' => !empty($row[0]) ? $this->tirarAcentos($row[0]) : null ,
            'BAIRRO' => !empty($row[1]) ? $this->tirarAcentos($row[1]) : null ,
            'COMPLEMENTO' => !empty($row[2]) ? $this->tirarAcentos($row[2]) : null ,
            'NUMERO' => !empty($row[3]) ? $this->tirarAcentos($row[3]) : null ,
            'ENDERECO' => !empty($row[4]) ? $this->tirarAcentos($row[4]) : null ,
            'NOME_DA_MAE' => !empty($row[5]) ? $this->tirarAcentos($row[5]) : null ,
            'NOME_DO_PAI' => !empty($row[6]) ? $this->tirarAcentos($row[6]) : null ,
            'ESTADO_ IDENTIDADE' => !empty($row[7]) ? $this->tirarAcentos($row[7]) : null ,
            'DATA_EXPEDICAO' => !empty($row[8]) ? $this->tirarAcentos($row[8]) : null ,
            'ORGAO_EXP' => !empty($row[9]) ? $this->tirarAcentos($row[9]) : null ,
            'NUM_DE_IDENTIDADE' => !empty($row[10]) ? $this->tirarAcentos($row[10]) : null ,
            'CPF' => !empty($row[11]) ? $this->tirarAcentos($row[11]) : null ,
            'EMAIL' => !empty($row[12]) ? $this->tirarAcentos($row[12]) : null ,
            'TELEFONES' => !empty($row[13]) ? $this->tirarAcentos($row[13]) : null ,
            'NATURALIDADE' => !empty($row[14]) ? $this->tirarAcentos($row[14]) : null ,
            'TURNO' => !empty($row[15]) ? $this->tirarAcentos($row[15]) : null ,
            'PERIODO' => !empty($row[16]) ? $this->tirarAcentos($row[16]) : null ,
            'CURSO' => !empty($row[17]) ? $this->tirarAcentos($row[17]) : null ,
            'NASCIMENTO' => !empty($row[18]) ? $this->tirarAcentos($row[18]) : null ,
            'TURMA' => !empty($row[19]) ? $this->tirarAcentos($row[19]) : null ,
            'SITUACAO_PERIODO' => !empty($row[20]) ? $this->tirarAcentos($row[20]) : null ,
            'NOME' => !empty($row[21]) ? $this->tirarAcentos($row[21]) : null ,
            'MATRICULA' => !empty($row[22]) ? $this->tirarAcentos($row[22]) : null ,
        ]);
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
