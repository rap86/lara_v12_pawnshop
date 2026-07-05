<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BackupsController extends Controller
{
    public function download_database()
    {
        // 1. Establish structural paths on local filesystem
        $directoryName = 'C:/pawnshopDatabase/' . date('Y-m-d');
        $fileName      = $directoryName . '/' . date('Y-m-d') . '.sql';

        // 2. Trigger the local engine to parse metrics and write files
        $this->backupDatabaseToLocalDrive($directoryName, $fileName);

        // 3. Clean redirect back to the page with a status notification (No browser download)
        return redirect()->back()->with('flash_success', 'Database backup saved successfully to ' . $fileName);
    }

    private function backupDatabaseToLocalDrive($directoryName, $fileName)
    {
        $mysqlHostName = env('DB_HOST', '127.0.0.1');
        $mysqlUserName = env('DB_USERNAME', 'root');
        $mysqlPassword = env('DB_PASSWORD', '');
        $DbName        = env('DB_DATABASE', 'lara_v12_pawnshop');

        $connect = new \PDO(
            "mysql:host=$mysqlHostName;dbname=$DbName;charset=utf8",
            $mysqlUserName,
            $mysqlPassword,
            array(\PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'")
        );

        // Fetch all existing tables dynamically from active database footprint
        $get_all_table_query = "SHOW TABLES";
        $statement = $connect->prepare($get_all_table_query);
        $statement->execute();
        $fetched_tables = $statement->fetchAll(\PDO::FETCH_COLUMN);

        if (empty($fetched_tables)) {
            return;
        }

        $output = '';
        foreach($fetched_tables as $table)
        {
            $show_table_query = "SHOW CREATE TABLE " . $table;
            $statement = $connect->prepare($show_table_query);
            $statement->execute();
            $show_table_result = $statement->fetchAll();

            foreach($show_table_result as $show_table_row)
            {
                $output .= "\n\n" . $show_table_row["Create Table"] . ";\n\n";
            }

            $select_query = "SELECT * FROM " . $table;
            $statement = $connect->prepare($select_query);
            $statement->execute();
            $total_row = $statement->rowCount();

            for($count = 0; $count < $total_row; $count++)
            {
                $single_result = $statement->fetch(\PDO::FETCH_ASSOC);
                $table_column_array = array_keys($single_result);

                $table_value_array = array_map(function($value) {
                    if (is_null($value)) return 'NULL';
                    return addslashes($value);
                }, array_values($single_result));

                $output .= "\nINSERT INTO $table (" . implode(", ", $table_column_array) . ") VALUES (";

                $values_string = implode("', '", $table_value_array);
                $values_string = str_replace("'NULL'", "NULL", $values_string);

                $output .= "'" . $values_string . "');\n";
            }
        }

        // Create directory nested array if not present on current load
        if(!is_dir($directoryName)){
            mkdir($directoryName, 0755, true);
        }

        // Open local system file pointer and stream structural contents
        $file_handle = fopen($fileName, 'w+');
        fwrite($file_handle, $output);
        fclose($file_handle);
    }
}
