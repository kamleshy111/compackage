<?php

namespace App\Http\Helpers;

use App\Http\Controllers\Controller;

class CSVHelper extends Controller {

    private $file = null;

    /**
     * Constructor
     */
    public function __construct( $file ) {
        $this->file = $file;
    }

    /**
     * @param File
     * @return count
     */
    public function csvRowCount()
    {
        ini_set('auto_detect_line_endings', TRUE);
        $row_count = 0;
        if (($handle = fopen($this->file, "r")) !== FALSE) {
            /** Patch to read UTF-8 CSV files. */
            $firstthreebytes = fread($handle,3);
            if($firstthreebytes !== "\xef\xbb\xbf")
            {
                rewind($handle);
            }

            while (($row_data = fgetcsv($handle, 2000, ",")) !== FALSE) { // && ! empty($row_data[1])
                $row_count++;
            }
            fclose($handle);
            // Exclude the headings.
            $row_count--;
            return $row_count;
        }
    }

    /**
     * @param
     * 2. Start count
     * 3. End count
     */
    public function csvSlice($start, $desired_count)
    {
        $row = 0;
        $count = 0;
        $rows = array();
        if (($handle = fopen($this->file, "r")) === FALSE) {
            return FALSE;
        }
        /** Patch to read UTF-8 CSV files. */
        $firstthreebytes = fread($handle,3);
        if($firstthreebytes !== "\xef\xbb\xbf")
        {
            rewind($handle);
        }

        while (($row_data = fgetcsv($handle)) !== FALSE) {
            // Grab headings.
            if ($row == 0) {
                $headings = $row_data;
                $row++;
                continue;
            }

            // Not there yet.
            if ($row++ < $start) {
                continue;
            }
            
            // Skip empty rows if first three columns does not have the data
            if( empty( $row_data[0] ) && empty( $row_data[1] ) && empty( $row_data[2] ) ) {
                continue;
            }

            //dd($headings);
            if (count($headings) > count($row_data)) {
                $row_data = array_pad($row_data, count($headings), null);
            }

            $rows[] = (object) array_combine($headings, $row_data);
            $count++;
            if ($count == $desired_count) {
                fclose($handle);
                return $rows;
            }
        }
        fclose($handle);
        return $rows;
    }

    /**
     * @param $rownumber
     * @return Specific Row
     */
    public function readASpecificRow($myrownumber)
    {
        $f = fopen($this->file, "r");

        $i = 0;
        $myrownumber = (int) $myrownumber; // ensure it's actually a number.
        $matched_row = array();
        /** Patch to read UTF-8 CSV files. */
            $firstthreebytes = fread($f,3);
            if($firstthreebytes !== "\xef\xbb\xbf")
            {
                rewind($f);
            }
        // $match_found = false;

        while (($line = fgetcsv($f)) !== false)
        {
            if ($i == 0) {
                $headings = $line;
                $i++;
                continue;
            }
            if ($line[1] != $myrownumber) { 
                // if( $match_found ) {
                //     // Break if all matched shipping address filled. It will reduce the ajax run time.
                //     $match_found = false;
                //     break;
                // }
                continue; 
            } else {
                $matched_row[] = (object) array_combine($headings, $line);
                // $match_found = true;
            }
            $i++;
        }
        fclose($f);
        return $matched_row;
    }

    /**
     * @param File
     * @return Headings
     */
    public function csvHeadings()
    {
        $row = 0;
        $count = 0;
        $rows = array();
        if (($handle = fopen($this->file, "r")) === FALSE) {
            return FALSE;
        }
        /** Patch to read UTF-8 CSV files. */
        $firstthreebytes = fread($handle,3);
        if($firstthreebytes !== "\xef\xbb\xbf")
        {
            rewind($handle);
        }

        if( ($headings = fgetcsv($handle, 2000, ",")) !== FALSE ) {
            fclose($handle);
            return $headings;
        }
    }
}