use App\Models\User;
use Illuminate\Support\Facades\Hash;

User::firstOrCreate(
    ['email' => 'admin@perpus.test'],
    ['name' => 'Admin', 'password' => Hash::make('password123'), 'role' => 'admin']
);

User::firstOrCreate(
    ['email' => 'petugas@perpus.test'],
    ['name' => 'Petugas', 'password' => Hash::make('password123'), 'role' => 'petugas']
);