<?php

use App\Project;
use Illuminate\Database\Seeder;

// @phpcs:ignore PSR1.Classes.ClassDeclaration.MissingNamespace
class ProjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Project::class, 10)->create();
    }
}
