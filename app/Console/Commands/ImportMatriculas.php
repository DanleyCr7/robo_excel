<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use DB;

class ImportMatriculas extends Command
{
    protected $model = 'matriculas';

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'importar:matriculas {filename}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import matriculas';

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
                'aluno_id' => !empty($dados[2]) ? (int) $this->limparAspas($dados[2]) : null,
                'matricula_id' => !empty($dados[3]) ? (int) $this->limparAspas($dados[3]) : null,
                'turma_id' => !empty($dados[6]) ? (int) $this->limparAspas($dados[6]) : null,
                'id_antigo' => !empty($dados[21]) ? $this->limparAspas($dados[21]) : null,
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
