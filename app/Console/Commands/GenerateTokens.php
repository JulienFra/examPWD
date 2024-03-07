<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use App\Models\Course;
use App\Models\Registered;

class GenerateTokens extends Command
{
    /**
     * La signature et la description de la commande artisan.
     *
     * @var string
     */
    protected $signature = 'generate:tokens';

    /**
     * Description de la commande artisan.
     *
     * @var string
     */
    protected $description = 'Génère des tokens pour chaque élève inscrit à des cours terminés depuis deux semaines.';

    /**
     * Exécute la commande artisan.
     *
     * @return int
     */
    public function handle()
    {
        $twoWeeksAgo = now()->subWeeks(2);
        $finishedCourses = Course::where('end_time', '<=', $twoWeeksAgo)->get();

        foreach ($finishedCourses as $course) {
            // Récupère tous les étudiants inscrits à ce cours en utilisant la relation many-to-many
            $students = $course->students;

            foreach ($students as $student) {
                $token = Str::random(10);
                Registered::create([
                    'token' => $token,
                    'course_id' => $course->id,
                ]);

                $this->info("Token généré pour l'élève {$student->name} dans le cours {$course->name}: $token");
            }
        }

        $this->info('Génération de tokens terminée.');
        return 0;
    }
}
