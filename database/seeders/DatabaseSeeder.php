<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Company;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run()
    {

        // Criar companies
        $company1 = Company::create([
            'cnpj' => '12345678901234',
            'corporate_name' => 'Company 1',
            'status' => 'A',
        ]);

        // Criar departments
        $departmentRH1 = $company1->departments()->create([
            'name' => 'RH',
        ]);

        $departmentDiretoria1 = $company1->departments()->create([
            'name' => 'Diretoria',
        ]);

        $userRH1 = $company1->users()->create([
            'department_id' => $departmentRH1->id,
            'name' => 'Usuário RH 1',
            'email' => 'user_rh1@example.com',
            'password' => Hash::make('password'),
        ]);

        $userDiretoria1 = $company1->users()->create([
            'department_id' => $departmentDiretoria1->id,
            'name' => 'Usuário Diretoria 1',
            'email' => 'user_diretoria1@example.com',
            'password' => Hash::make('password'),
        ]);


        $company2 = Company::create([
            'cnpj' => '98765432109876',
            'corporate_name' => 'Company 2',
            'status' => 'A',
        ]);


        $departmentRH2 = $company2->departments()->create([
            'name' => 'RH',
        ]);

        $departmentDiretoria2 = $company2->departments()->create([
            'name' => 'Diretoria',
        ]);

        $userRH2 = $company2->users()->create([
            'department_id' => $departmentRH2->id,
            'name' => 'Usuário RH 2',
            'email' => 'user_rh2@example.com',
            'password' => Hash::make('password'),
        ]);

        $userDiretoria2 = $company2->users()->create([
            'department_id' => $departmentDiretoria2->id,
            'name' => 'Usuário Diretoria 2',
            'email' => 'user_diretoria2@example.com',
            'password' => Hash::make('password'),
        ]);

    }
}
