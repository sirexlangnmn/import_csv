<?php

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
// use PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Reader\IReader;
use PhpOffice\PhpSpreadsheet\Writer\IWriter;
use PhpOffice\PhpSpreadsheet\Helper\Sample;

defined('BASEPATH') or exit('No direct script access allowed');

class Import extends CI_Controller
{

	public function index()
	{
			$this->load->view('include/header');
			$this->load->view('import');
			$this->load->view('include/script');
    }

    public function import_csv()
    {
        $data = [];
        if (isset($_FILES["input_csv"])) {
            $input_csv_tmp_name = $_FILES["input_csv"]["tmp_name"];
            $input_csv_file = $_FILES["input_csv"];
        }

        //* extract record in CSV file and save to database
        $input_csv_tmp_name = fopen($input_csv_tmp_name, 'r');
        $row = fgetcsv($input_csv_tmp_name);

        if (!array($row)) {
            $data = [
                'type' => 'error',
                'title' => 'Invalid CSV Uploader.',
            ];
        }
        $total_row = (count($row) - 1);
        if ($row[0] == "Job Name") {
            $count = 0;
            while ($row = fgetcsv($input_csv_tmp_name)) {
                $new_arr = array_splice($row, 0);

                $job_name = trim($new_arr[0]);
                $job_preview_link = $new_arr[1];
                $company = trim($new_arr[2]);
                $location = $new_arr[3];
                $salary = trim($new_arr[4]);
                $summary = $new_arr[5];
                $easily_apply = $new_arr[6];
                $urgently_hiring = $new_arr[7];
                $responsive_employer = $new_arr[8];
                $new = $new_arr[9];
                $job_description1 = $new_arr[10];
                $job_description2 = $new_arr[11];

                // if ($salary) {
                //     $replace = array("PHP", "-");
                //     $salary = str_replace($replace, " ", $salary);
                //     $pieces = explode(" ", $salary);
                //     $min_salary = $pieces[0];
                //     $max_salary = $pieces[1];
                //     $replace = array("PHP", "-", " ", ",", "amonth");
                //     $min_salary = str_replace($replace, "", $min_salary);
                //     $max_salary = str_replace($replace, "", $max_salary);
                // } else {
                //     $min_salary = "";
                //     $max_salary = "";
                // }


                $job_exist = NULL;
                $check_company = $this->import->getCompanyName($company);
                if ($check_company->num_rows() > 0) {
                    $cmp = $check_company->row_array();
			        $company_code = $cmp['company_code'];
                    $company_name = $cmp['company_name'];

                    // $check_job = $this->import->getJob($company_code, $job_name);
                    // $job_exist = ($check_job->num_rows() > 0) ? TRUE : FALSE;
                } else {
                    $company_code = $this->global->generateID('CMP');
			        $company_name = $company;
                }

                // if ($job_exist !== TRUE) {
                    $job_code = $this->global->generateID('JOB');

                    $indeed_company_data = [
                        "company_code" => $company_code,
                        "company_name" => $company_name,
                    ];

                    $indeed_job_data = [
                        "job_code" => $job_code,
                        "company_code" => $company_code,
                        "title" => $job_name,
                        "job_link" => $job_preview_link,
                        "min_salary" => $salary,
                        // "max_salary" => $max_salary,
                        "job_description" => $job_description2,
                        // "location" => $location,
                        // "summary" => $summary,
                        // "easily_apply" => $easily_apply,
                        // "urgently_hiring" => $urgently_hiring,
                        // "responsive_employer" => $responsive_employer,
                        // "new" => $new,
                        // "job_description1" => $job_description1,
                    ];

                    $this->db->insert('company', $indeed_company_data);
                    $this->db->insert('job_post', $indeed_job_data);
                //}
                $count ++;

                if ($count === $total_row) {
                    $data = ['title' => 'Import save successfully', 'type' => 'success'];
                }
            }
        }
        else {
            $data = [ 'type' => 'error', 'title' => 'Invalid CSV Uploader.' ];
        }

        $this->output
			->set_content_type('application/json')
			->set_output(json_encode($data));


    }


}
