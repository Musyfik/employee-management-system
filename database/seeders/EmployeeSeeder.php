<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\Division;
use Illuminate\Database\Seeder;

class EmployeeSeeder extends Seeder
{
    public function run(): void
    {
        $employees = [
            ['full_name' => 'Ahmad Fauzi', 'email' => 'ahmad.fauzi@company.com', 'phone_number' => '081234567890', 'division' => 'Engineering', 'position' => 'Senior Software Engineer', 'address' => 'Jl. Sudirman No. 12, Jakarta Pusat'],
            ['full_name' => 'Siti Rahayu', 'email' => 'siti.rahayu@company.com', 'phone_number' => '081234567891', 'division' => 'Human Resources', 'position' => 'HR Manager', 'address' => 'Jl. Gatot Subroto No. 5, Jakarta Selatan'],
            ['full_name' => 'Budi Santoso', 'email' => 'budi.santoso@company.com', 'phone_number' => '081234567892', 'division' => 'Marketing', 'position' => 'Marketing Specialist', 'address' => 'Jl. Kuningan No. 8, Jakarta Selatan'],
            ['full_name' => 'Dewi Lestari', 'email' => 'dewi.lestari@company.com', 'phone_number' => '081234567893', 'division' => 'Finance', 'position' => 'Finance Analyst', 'address' => 'Jl. Thamrin No. 22, Jakarta Pusat'],
            ['full_name' => 'Rizky Pratama', 'email' => 'rizky.pratama@company.com', 'phone_number' => '081234567894', 'division' => 'Engineering', 'position' => 'Frontend Developer', 'address' => 'Jl. Rasuna Said No. 3, Jakarta Selatan'],
            ['full_name' => 'Nur Indah', 'email' => 'nur.indah@company.com', 'phone_number' => '081234567895', 'division' => 'Design', 'position' => 'UI/UX Designer', 'address' => 'Jl. Pemuda No. 15, Jakarta Timur'],
            ['full_name' => 'Hendra Wijaya', 'email' => 'hendra.wijaya@company.com', 'phone_number' => '081234567896', 'division' => 'Sales', 'position' => 'Sales Manager', 'address' => 'Jl. Mangga Dua No. 7, Jakarta Barat'],
            ['full_name' => 'Rina Susanti', 'email' => 'rina.susanti@company.com', 'phone_number' => '081234567897', 'division' => 'Operations', 'position' => 'Operations Lead', 'address' => 'Jl. Kemang Raya No. 20, Jakarta Selatan'],
            ['full_name' => 'Fajar Nugroho', 'email' => 'fajar.nugroho@company.com', 'phone_number' => '081234567898', 'division' => 'Product', 'position' => 'Product Manager', 'address' => 'Jl. Kebayoran Baru No. 11, Jakarta Selatan'],
            ['full_name' => 'Maya Anggraini', 'email' => 'maya.anggraini@company.com', 'phone_number' => '081234567899', 'division' => 'Engineering', 'position' => 'Backend Developer', 'address' => 'Jl. Cilandak No. 6, Jakarta Selatan'],
            ['full_name' => 'Doni Setiawan', 'email' => 'doni.setiawan@company.com', 'phone_number' => '082234567890', 'division' => 'Marketing', 'position' => 'Digital Marketing Lead', 'address' => 'Jl. Pluit No. 9, Jakarta Utara'],
            ['full_name' => 'Lia Permata', 'email' => 'lia.permata@company.com', 'phone_number' => '082234567891', 'division' => 'Human Resources', 'position' => 'HR Recruiter', 'address' => 'Jl. Kelapa Gading No. 4, Jakarta Utara'],
            ['full_name' => 'Arif Rahman', 'email' => 'arif.rahman@company.com', 'phone_number' => '082234567892', 'division' => 'Finance', 'position' => 'Senior Accountant', 'address' => 'Jl. Cempaka Putih No. 18, Jakarta Pusat'],
            ['full_name' => 'Wulan Sari', 'email' => 'wulan.sari@company.com', 'phone_number' => '082234567893', 'division' => 'Design', 'position' => 'Graphic Designer', 'address' => 'Jl. Menteng No. 25, Jakarta Pusat'],
            ['full_name' => 'Yusuf Hidayat', 'email' => 'yusuf.hidayat@company.com', 'phone_number' => '082234567894', 'division' => 'Engineering', 'position' => 'DevOps Engineer', 'address' => 'Jl. Tebet No. 13, Jakarta Selatan'],
        ];

        foreach ($employees as $data) {
            $division = Division::where('name', $data['division'])->first();
            if ($division) {
                Employee::create([
                    'full_name'    => $data['full_name'],
                    'email'        => $data['email'],
                    'phone_number' => $data['phone_number'],
                    'division_id'  => $division->id,
                    'position'     => $data['position'],
                    'address'      => $data['address'],
                    'photo'        => null,
                ]);
            }
        }
    }
}
