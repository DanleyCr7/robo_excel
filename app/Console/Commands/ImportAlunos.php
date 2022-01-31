<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

use DB;

class ImportAlunos extends Command
{
    protected $model = 'alunos';

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'importar:alunos {filename}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Importar alunos';

    /**
    * Create a new command instance.
    *
    * @return void
    */
    public function __construct()
    {
        parent::__construct();
        $this->dados = collect([]);
    }

    /**
    * Execute the console command.
    *
    * @return int
    */
    public function handle()
    {
        $this->filename = $this->argument('filename');
        $fileContent = fopen(Storage::path("import/" . $this->filename), 'r');
        $count = 0;
        while (!feof($fileContent)) {
            $line = fgets($fileContent);
            if($count != 0){
                $this->processarLinha($line);
            }
            $count++;
        }
        fclose($fileContent);
        $this->salvandoDados();
    }

    public function processarLinha($linha)
    {
        // verificando linha
        if (str_contains($linha, ',')) {
            $dados = array_filter(explode(',', str_replace(["\r", "\n", "\t", "\v"], ' ', $linha)), function ($item) {
            return !empty($item);
            });

            $this->dados->push([
                'nome' => !empty($dados[0]) ? $this->limparAspas($dados[0]) : null,
                'logradouro' => !empty($dados[1]) ? $this->limparAspas($dados[1]) : null,
                'cep' => !empty($dados[3]) ? $this->limparAspas($dados[3]) : null,
                'rg' => !empty($dados[5]) ? $this->limparAspas($dados[5]) : null,
                'orgao_exp' => !empty($dados[6]) ? $this->limparAspas($dados[6]) : null,
                'cpf' => !empty($dados[8]) ? $this->limparAspas($dados[8]) : null,
                'data_nasc' => !empty($dados[9]) ? $this->formatarData($dados[9]) : null,
                'sexo' => !empty($dados[20]) ? $this->limparAspas($dados[20]) : null,
                'aluno_id' => !empty($dados[31]) ? (int) $this->limparAspas($dados[31]) : null,
            ]);
        }
    }

    public function salvandoDados()
    {
        foreach($this->dados as $dado) {
            try{
                DB::table($this->model)->insert(
                    $dado
                );
                dump($dado);
            } catch (Exception $e) {
                dump($e->getMessage());
            }
        }
    }

    public function limparAspas($dado){
        return str_replace( ['"'] ,'', trim($dado));
    }

    public function formatarData($dado)
    {
        $dateFormat = $this->limparAspas($dado);

        return substr($dateFormat, 0, 10);
    }
}
