<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Car;

class CarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Start importing the Standard cars
            foreach (\File::files(public_path('storage/assets/cars/Default')) as $car) {
                Car::create([
                    'name' => pathinfo($car->getRelativePathname(), PATHINFO_FILENAME),
                    'image' => $car->getRelativePathname(),
                    'source' => null,
                    'dlc' => null,
                ]);
            }
        // End importing the Standard cars

        // Start importing the DLC cars
        $dlcs = [];

        foreach (\File::directories(public_path('storage/assets/cars')) as $directory) {
            $exploded = explode('/', $directory);

            if (end($exploded) !== "Default") {
                $dlcs[] = [
                    "name" => end($exploded),
                    "directory" => $directory,
                ];
            }
        }

        foreach ($dlcs as $dlc) {
            foreach (\File::files($dlc['directory']) as $car) {
                Car::create([
                    'name' => pathinfo($car->getRelativePathname(), PATHINFO_FILENAME),
                    'image' => $car->getRelativePathname(),
                    'source' => null,
                    'dlc' => $dlc["name"],
                ]);
            }
        }
        // End importing the DLC cars
    }

}
