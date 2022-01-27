<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

use App\Models\Franquia;
use App\Models\Aluno;
use App\Models\Turma;
use App\Models\Matricula;
use Exception;

class ImportarVinculoAluno extends Command
{
    
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'importar:acordo {filename}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Importar dados do vinculo do aluno pelo TXT';

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
        ini_set('upload_max_filesize', '20M');
        ini_set('post_max_size', '10M');
        ini_set('memory_limit', '-1');

        $this->filename = $this->argument('filename');

        $fileContent = fopen(Storage::path('inep/files/importacao/' . $this->filename), 'r');
        $count = 0;
        while (!feof($fileContent)) {
            $line = fgets($fileContent);
            $this->processarLinha($line);
        }
        fclose($fileContent);
        // dd($this->turmas);
        $this->salvarMatricula();
    }

    public function processarLinha($linha)
    {
         // verificando linha
         if (str_contains($linha, '|')) {
            $dados = array_filter(explode('|', str_replace(["\r", "\n", "\t", "\v"], ' ', $linha)), function ($item) {
                return !empty($item);
            });
            
            if($dados[0] == '60') {
                $this->dados->push([
                    'codigo_inep' => !empty($dados[3]) ? (int) $dados[3] : null,
                    'codigo_turma' => !empty($dados[5]) ? (int) $dados[5] : null,
                ]);
             }
        }
       
    }

    public function salvarMatricula()
    {

        $this->info("------ Salvando alunos ------");
        foreach ($this->dados as $key => $dado) {
            $turma = Turma::where('codigo', $dado['codigo_turma'])
                    ->first();
            $dado['turma_id'] = $turma->id;
            $dado['ano_id'] = 1;
            $dado['aluno_id'] = 1;
            try{
                Matricula::updateOrCreate(
                    ['codigo_inep' => $dado['codigo_inep']],
                    $dado
                );
                $this->info('Matricula: ' . $dado['codigo_inep']);
                $this->info('Turma: ' . $dado['turma_id']);
            } catch (Exception $e) {
                dump($e->getMessage());
            }
        }
        
    }

    
}
