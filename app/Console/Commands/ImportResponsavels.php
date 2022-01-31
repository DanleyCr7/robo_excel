<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

use App\Models\Turma;
use DB;

class ImportResponsavels extends Command
{
    protected $model = 'responsavels';

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'importar:responsavels {filename}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Importar dados dos responsavel';

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
                'responsavel_id' => !empty($dados[0]) ? (int) $this->limparAspas($dados[0]) : null,
                'descricao' => !empty($dados[1]) ?  trim($dados[1]) : null,
                'rg' => !empty($dados[2]) ? $this->limparAspas($dados[2]) : null,
                'cpf' => !empty($dados[3]) ? $this->limparAspas($dados[3]) : null,
                'profissao' => !empty($dados[4]) ? $this->limparAspas($dados[4]) : null,
                'aluno_id' => !empty($dados[7]) ? $this->limparAspas($dados[7]) : null,
                'logradouro' => !empty($dados[10]) ? trim($dados[10]) : null,
                'cep' => !empty($dados[12]) ? $this->limparAspas($dados[12]) : null,
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
