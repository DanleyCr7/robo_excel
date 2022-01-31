<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use DB;

class ImportMensalidades extends Command
{
    protected $model = 'mensalidades';
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'importar:mensalidades {filename}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Importar mensalidades';

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
                'nossonumero' => !empty($dados[0]) ? $this->limparAspas($dados[0]) : null,
                'ano_id' => !empty($dados[2]) ? (int) $this->limparAspas($dados[2]) : null,
                'numero' => !empty($dados[5]) ? (int) $this->limparAspas($dados[5]) : null,
                'referencia' => !empty($dados[6]) ? $this->formatarData($dados[6]) : null,
                'valor' => !empty($dados[7]) ? (float) $this->limparAspas($dados[7]) : null,
                'data_credito' => !empty($dados[12]) ? $this->formatarData($dados[12]) : null,
                'valorpago' => !empty($dados[13]) ? (float) $this->limparAspas($dados[13]) : null,
                'desconto' => !empty($dados[15]) ? $this->limparAspas($dados[15]) : null,
                'matricula_id' => !empty($dados[52]) ? $this->limparAspas($dados[52]) : null,
                'aluno_id' => !empty($dados[51]) ? (int) $this->limparAspas($dados[51]) : null,
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
        return str_replace( ['"', ' ', '\t', '\n'] ,'', $dado);
    }

    public function formatarData($dado)
    {   
        $dateFormat = $this->limparAspas($dado);

        return substr($dateFormat, 0, 10);
    }
}
