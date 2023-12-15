<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use App\Models\Student;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Throwable;

class YourImportClass implements ToModel, WithHeadingRow, WithBatchInserts, SkipsOnError, SkipsOnFailure
{
    use SkipsErrors, SkipsFailures;

public function model(array $row)
{
    try {
        // Validate and clean the data before creating the model instance
        $student = new Student([
            'student_name' => $row['name'], // Assuming 'name' corresponds to the 'student_name' column
            'student_email' => $row['email'],
            'student_gender' => $row['gender'],
            'collage_id' => $row['collage'],
            'course_id' => $row['course'],
           // Assuming 'email' corresponds to the 'student_email' column
            // Add more columns as needed
        ]);

        // Save the student
        $student->save();

        return $student;
    } catch (Throwable $e) {
        // Log or handle the error as per your requirement
        $this->onError($e);
        // Rethrow the exception to prevent halting the import process
        throw $e;
    }
}


    public function onError(Throwable $e)
    {
        // Handle errors that occur during the import process
        // You can log, throw an exception, or handle the error in a specific way
    }

    public function batchSize(): int
    {
        // Set the batch size for inserting records (modify as per your needs)
        return 1000;
    }
}
