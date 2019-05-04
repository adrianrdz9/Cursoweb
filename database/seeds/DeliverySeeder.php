<?php

use Illuminate\Database\Seeder;

class DeliverySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $usersIds = App\User::role('student')->get();
        foreach ($usersIds as $i => $user) {
            $usersIds[$i] = $user->id;
        }

        $assignmentsIds = App\Assignment::all();
        foreach ($assignmentsIds as $i => $assignment) {
            $assignmentsIds[$i] = $assignment->id;
        }
        
        for ($i=0; $i < 100; $i++) { 
            $base = [
                'user_id' => $usersIds[rand(0, count($usersIds)-1)],
                'assignment_id' => $assignmentsIds[rand(0, count($assignmentsIds)-1)]
            ];

            $delivery = App\Delivery::where($base);

            if(!$delivery->exists()){
                $delivery = App\Delivery::create(array_merge(
                    $base,
                    [
                        'comment' => "Lorem ipsum, dolor sit amet consectetur adipisicing elit. Soluta atque ut dolores sequi, dolor expedita. Officiis consectetur labore qui eveniet ea vel fuga atque voluptas, debitis natus numquam sunt eaque.",                       
                        'link' => 'example.org'
                    ]
                    ));
            }else{
                $delivery = $delivery->first();
            }

            if(random_int(0, 10) > 4){
                $delivery->mark = random_int(0, 10);
                $delivery->save();
            }
        }
    }
}
