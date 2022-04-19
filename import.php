composer require maatwebsite/excel

config/app.php
'providers' => [

	....

	Maatwebsite\Excel\ExcelServiceProvider::class,

],

'aliases' => [

	....

	'Excel' => Maatwebsite\Excel\Facades\Excel::class,
],

create a table by migration
php artisan make:migration create_students_table

now migrate
php artisan migrate

now create a model 
php artisan make:model Student

now create controller
php artisan make:controller StudentController

on route:-
Route::get('importExportView', [StudentController::class, 'importExportView']);
Route::get('export', [StudentController::class, 'export'])->name('export');
Route::post('import', [StudentController::class, 'import'])->name('import');

now run cmd
php artisan make:import StudentsImport --model=Student




go to app->import->StudentsImport
<?php
namespace App\Imports;

use App\Models\Student;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
class StudentsImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Student([
            'name'     => $row['name'],
            'email'    => $row['email'], 
            'password' => \Hash::make($row['password']),
        ]);
    }
}



on controller:
<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Exports\StudentsExport;
use App\Imports\StudentsImport;
use Maatwebsite\Excel\Facades\Excel;
class StudentController extends Controller
{
    public function importExportView()
    {
       return view('import');
    }

    public function import() 
    {
        Excel::import(new StudentsImport,request()->file('file'));  
	//Excel::selectSheets('sheet1')(new StudentsImport,request()->file('file'));   when you want select specific sheet from excel
        return back();
    }
}







