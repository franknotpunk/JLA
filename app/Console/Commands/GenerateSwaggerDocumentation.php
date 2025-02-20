<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use OpenApi\Generator;

class GenerateSwaggerDocumentation extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'swagger:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate Swagger API documentation';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {

        $openapi = Generator::scan([app_path('Http/Controllers/Api')]);
        if (!$openapi) {
            $this->error('Failed to generate Swagger documentation.');
            return;
        }

        $outputPath = storage_path('api-docs');
        if (!file_exists($outputPath)) {
            mkdir($outputPath, 0775, true);
        }
        $outputPath = storage_path('api-docs/swagger.json');
        file_put_contents($outputPath, $openapi->toJson());

        $this->info("Swagger documentation generated successfully at {$outputPath}");
    }
}
