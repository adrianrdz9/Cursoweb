<?php

use Illuminate\Database\Seeder;

class ModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (['javascript', 'bases de datos', 'diseño', 'seguridad'] as $module) {
            $module = App\Module::firstOrCreate([
                'name' => $module,
                'hours' => random_int(15, 40),
                'description' => "Lorem ipsum dolor sit amet consectetur, adipisicing elit. Eos similique placeat enim velit itaque neque animi vel voluptatibus, ex voluptatum, necessitatibus sapiente eligendi perspiciatis dolore excepturi. Dicta eveniet eos ullam!",
                'evaluation' => "Lorem ipsum dolor sit amet consectetur, adipisicing elit. Eos similique placeat enim velit itaque neque animi vel voluptatibus, ex voluptatum, necessitatibus sapiente eligendi perspiciatis dolore excepturi. Dicta eveniet eos ullam!"
            ]);

            foreach (App\User::role('admin')->get() as $user) {
                App\ModuleTeacher::create([
                    'module_id' => $module->id,
                    'teacher_id' => $user->id
                ]);
            }

        }
    }
}
