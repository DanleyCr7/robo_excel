<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

use App\Models\Turma;
use DB;
class ImportTurmas extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'importar:turmas {filename}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Importar dados de turmas pelo TXT';

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

    public function handle()
    {
        $this->filename = $this->argument('filename');
        // dd(Storage::path('public/' . $this->filename));
        $fileContent = fopen(Storage::path("import/" . $this->filename), 'r');
        $count = 0;
        while (!feof($fileContent)) {
            $line = fgets($fileContent);
            $this->processarLinha($line);
        }
            fclose($fileContent);
            $this->salvandoDados();
    }

    public function processarLinha($linha)
    {
            // verificando linha
            if (str_contains($linha, '|')) {
                $dados = array_filter(explode(',', str_replace(["\r", "\n", "\t", "\v"], ' ', $linha)), function ($item) {
                return !empty($item);
            });

            $this->dados->push([
                'idTurma' => !empty($dados[0]) ? (int) $dados[0] : null,
                'Descricao' => !empty($dados[1]) ? $dados[1] : null,
                'Status' => !empty($dados[2]) ? $dados[2] : null,
                'codTurmaNova_cpi' => !empty($dados[9]) ? $dados[9] : null
            ]);
        }
    }

    public function salvandoDados()
    {
        foreach($this->dados as $dado) {
            try{
                DB::table('turmas')->insert(
                        $dado
                    );
                dump($dado);
            } catch (Exception $e) {
                dump($e->getMessage());
            }
        }
    }
}
