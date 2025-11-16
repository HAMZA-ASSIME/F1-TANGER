<?php

namespace Database\Seeders;

use App\Models\Team;
use App\Models\Driver;
use App\Models\Cars;
use App\Models\Race;
use App\Models\User;
use Illuminate\Database\Seeder;

class F1DataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get or create admin user for teams
        $adminUser = User::first() ?? User::create([
            'name' => 'Admin',
            'email' => 'admin@f1.com',
            'password' => bcrypt('password123'),
        ]);

        // Create Teams
        $ferrari = Team::create([
            'name' => 'Ferrari',
            'country' => 'Italy',
            'base_location' => 'Maranello, Italy',
            'team_principal' => 'Frédéric Vasseur',
            'chassis' => 'SF-23',
            'engine_supplier' => 'Ferrari',
            'founded_date' => '1947-01-01',
            'logo' => 'store/teams/ferrari_logo.png',
            'total_points' => 0,
            'user_id' => $adminUser->id,
        ]);

        $mercedes = Team::create([
            'name' => 'Mercedes-AMG Petronas',
            'country' => 'England',
            'base_location' => 'Brackley, England',
            'team_principal' => 'Toto Wolff',
            'chassis' => 'W14',
            'engine_supplier' => 'Mercedes',
            'founded_date' => '1954-01-01',
            'logo' => 'store/teams/mercedes_logo.png',
            'total_points' => 0,
            'user_id' => $adminUser->id,
        ]);

        $redbull = Team::create([
            'name' => 'Red Bull Racing',
            'country' => 'England',
            'base_location' => 'Milton Keynes, England',
            'team_principal' => 'Christian Horner',
            'chassis' => 'RB19',
            'engine_supplier' => 'Honda RBPT',
            'founded_date' => '2005-01-01',
            'logo' => 'store/teams/redbull_logo.png',
            'total_points' => 0,
            'user_id' => $adminUser->id,
        ]);

        $mclaren = Team::create([
            'name' => 'McLaren F1 Team',
            'country' => 'England',
            'base_location' => 'Woking, England',
            'team_principal' => 'Andrea Stella',
            'chassis' => 'MCL23',
            'engine_supplier' => 'Mercedes',
            'founded_date' => '1963-01-01',
            'logo' => 'store/teams/mclaren_logo.png',
            'total_points' => 0,
            'user_id' => $adminUser->id,
        ]);

        // Create Drivers
        $leclerc = Driver::create([
            'first_name' => 'Charles',
            'last_name' => 'Leclerc',
            'team_id' => $ferrari->id,
            'nationality' => 'Monegasque',
            'date_of_birth' => '1997-10-16',
            'total_points' => 290,
            'driver_img' => 'store/drivers/leclerc.jpg',
        ]);

        $sainz = Driver::create([
            'first_name' => 'Carlos',
            'last_name' => 'Sainz',
            'team_id' => $ferrari->id,
            'nationality' => 'Spanish',
            'date_of_birth' => '1994-09-01',
            'total_points' => 246,
            'driver_img' => 'store/drivers/sainz.jpg',
        ]);

        $hamilton = Driver::create([
            'first_name' => 'Lewis',
            'last_name' => 'Hamilton',
            'team_id' => $mercedes->id,
            'nationality' => 'British',
            'date_of_birth' => '1985-01-07',
            'total_points' => 481,
            'driver_img' => 'store/drivers/hamilton.jpg',
        ]);

        $russell = Driver::create([
            'first_name' => 'George',
            'last_name' => 'Russell',
            'team_id' => $mercedes->id,
            'nationality' => 'British',
            'date_of_birth' => '1998-02-15',
            'total_points' => 275,
            'driver_img' => 'store/drivers/russell.jpg',
        ]);

        $verstappen = Driver::create([
            'first_name' => 'Max',
            'last_name' => 'Verstappen',
            'team_id' => $redbull->id,
            'nationality' => 'Dutch',
            'date_of_birth' => '1997-12-31',
            'total_points' => 575,
            'driver_img' => 'store/drivers/verstappen.jpg',
        ]);

        $perez = Driver::create([
            'first_name' => 'Sergio',
            'last_name' => 'Pérez',
            'team_id' => $redbull->id,
            'nationality' => 'Mexican',
            'date_of_birth' => '1990-01-26',
            'total_points' => 305,
            'driver_img' => 'store/drivers/perez.jpg',
        ]);

        $norris = Driver::create([
            'first_name' => 'Lando',
            'last_name' => 'Norris',
            'team_id' => $mclaren->id,
            'nationality' => 'British',
            'date_of_birth' => '1999-11-13',
            'total_points' => 310,
            'driver_img' => 'store/drivers/norris.jpg',
        ]);

        $piastri = Driver::create([
            'first_name' => 'Oscar',
            'last_name' => 'Piastri',
            'team_id' => $mclaren->id,
            'nationality' => 'Australian',
            'date_of_birth' => '2001-04-06',
            'total_points' => 268,
            'driver_img' => 'store/drivers/piastri.jpg',
        ]);

        // Create Cars
        Cars::create([
            'car_number' => '16',
            'model' => 'SF-23',
            'brand' => 'Ferrari',
            'chassis' => '323',
            'team_id' => $ferrari->id,
            'driver_id' => $leclerc->id,
            'engine' => 'Ferrari 065/E Hybrid',
            'year' => 2023,
            'color' => 'Rosso Corsa',
            'horsepower' => 1050,
            'weight' => 798,
            'image' => 'store/cars/ferrari_sf23.jpg',
            'top_speed' => 370,
            'status' => 'available',
        ]);

        Cars::create([
            'car_number' => '55',
            'model' => 'SF-23',
            'brand' => 'Ferrari',
            'chassis' => '324',
            'team_id' => $ferrari->id,
            'driver_id' => $sainz->id,
            'engine' => 'Ferrari 065/E Hybrid',
            'year' => 2023,
            'color' => 'Rosso Corsa',
            'horsepower' => 1050,
            'weight' => 798,
            'image' => 'store/cars/ferrari_sf23_2.jpg',
            'top_speed' => 370,
            'status' => 'available',
        ]);

        Cars::create([
            'car_number' => '44',
            'model' => 'W14',
            'brand' => 'Mercedes',
            'chassis' => '1014',
            'team_id' => $mercedes->id,
            'driver_id' => $hamilton->id,
            'engine' => 'Mercedes-AMG F1 M14',
            'year' => 2023,
            'color' => 'Silver',
            'horsepower' => 1050,
            'weight' => 798,
            'image' => 'store/cars/mercedes_w14.jpg',
            'top_speed' => 368,
            'status' => 'available',
        ]);

        Cars::create([
            'car_number' => '63',
            'model' => 'W14',
            'brand' => 'Mercedes',
            'chassis' => '1015',
            'team_id' => $mercedes->id,
            'driver_id' => $russell->id,
            'engine' => 'Mercedes-AMG F1 M14',
            'year' => 2023,
            'color' => 'Silver',
            'horsepower' => 1050,
            'weight' => 798,
            'image' => 'store/cars/mercedes_w14_2.jpg',
            'top_speed' => 368,
            'status' => 'available',
        ]);

        Cars::create([
            'car_number' => '1',
            'model' => 'RB19',
            'brand' => 'Red Bull Racing',
            'chassis' => 'RB19-001',
            'team_id' => $redbull->id,
            'driver_id' => $verstappen->id,
            'engine' => 'Honda RBPT V6 Hybrid Turbo',
            'year' => 2023,
            'color' => 'Navy Blue',
            'horsepower' => 1050,
            'weight' => 798,
            'image' => 'store/cars/redbull_rb19.jpg',
            'top_speed' => 372,
            'status' => 'available',
        ]);

        Cars::create([
            'car_number' => '11',
            'model' => 'RB19',
            'brand' => 'Red Bull Racing',
            'chassis' => 'RB19-002',
            'team_id' => $redbull->id,
            'driver_id' => $perez->id,
            'engine' => 'Honda RBPT V6 Hybrid Turbo',
            'year' => 2023,
            'color' => 'Navy Blue',
            'horsepower' => 1050,
            'weight' => 798,
            'image' => 'store/cars/redbull_rb19_2.jpg',
            'top_speed' => 372,
            'status' => 'available',
        ]);

        Cars::create([
            'car_number' => '4',
            'model' => 'MCL23',
            'brand' => 'McLaren',
            'chassis' => 'MCL23-001',
            'team_id' => $mclaren->id,
            'driver_id' => $norris->id,
            'engine' => 'Mercedes-AMG F1 M14',
            'year' => 2023,
            'color' => 'Orange',
            'horsepower' => 1050,
            'weight' => 798,
            'image' => 'store/cars/mclaren_mcl23.jpg',
            'top_speed' => 365,
            'status' => 'available',
        ]);

        Cars::create([
            'car_number' => '81',
            'model' => 'MCL23',
            'brand' => 'McLaren',
            'chassis' => 'MCL23-002',
            'team_id' => $mclaren->id,
            'driver_id' => $piastri->id,
            'engine' => 'Mercedes-AMG F1 M14',
            'year' => 2023,
            'color' => 'Orange',
            'horsepower' => 1050,
            'weight' => 798,
            'image' => 'store/cars/mclaren_mcl23_2.jpg',
            'top_speed' => 365,
            'status' => 'available',
        ]);

        // Create Races
        Race::create([
            'name' => 'Bahrain Grand Prix',
            'location' => 'Bahrain',
            'date' => '2024-03-02',
            'start_time' => '14:00',
            'status' => 'completed',
            'price' => 200.00,
            'img' => 'store/races/bahrain.jpg',
        ]);

        Race::create([
            'name' => 'Saudi Arabian Grand Prix',
            'location' => 'Saudi Arabia',
            'date' => '2024-03-09',
            'start_time' => '19:00',
            'status' => 'completed',
            'price' => 220.00,
            'img' => 'store/races/saudi_arabia.jpg',
        ]);

        Race::create([
            'name' => 'Australian Grand Prix',
            'location' => 'Melbourne, Australia',
            'date' => '2024-03-24',
            'start_time' => '13:00',
            'status' => 'completed',
            'price' => 250.00,
            'img' => 'store/races/australia.jpg',
        ]);

        Race::create([
            'name' => 'Japanese Grand Prix',
            'location' => 'Suzuka, Japan',
            'date' => '2024-04-07',
            'start_time' => '12:00',
            'status' => 'completed',
            'price' => 280.00,
            'img' => 'store/races/japan.jpg',
        ]);

        Race::create([
            'name' => 'Chinese Grand Prix',
            'location' => 'Shanghai, China',
            'date' => '2024-04-21',
            'start_time' => '13:00',
            'status' => 'completed',
            'price' => 260.00,
            'img' => 'store/races/china.jpg',
        ]);

        Race::create([
            'name' => 'Monaco Grand Prix',
            'location' => 'Monaco',
            'date' => '2024-05-26',
            'start_time' => '14:00',
            'status' => 'scheduled',
            'price' => 350.00,
            'img' => 'store/races/monaco.jpg',
        ]);

        Race::create([
            'name' => 'Canadian Grand Prix',
            'location' => 'Montreal, Canada',
            'date' => '2024-06-09',
            'start_time' => '13:00',
            'status' => 'scheduled',
            'price' => 240.00,
            'img' => 'store/races/canada.jpg',
        ]);

        Race::create([
            'name' => 'British Grand Prix',
            'location' => 'Silverstone, England',
            'date' => '2024-07-07',
            'start_time' => '14:00',
            'status' => 'scheduled',
            'price' => 300.00,
            'img' => 'store/races/silverstone.jpg',
        ]);

        echo "\n✅ F1 Data seeded successfully!\n";
        echo "✅ Created 4 Teams\n";
        echo "✅ Created 8 Drivers\n";
        echo "✅ Created 8 Cars\n";
        echo "✅ Created 8 Races\n";
    }
}
