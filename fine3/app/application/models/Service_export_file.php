<?php
require_once APPPATH."/third_party/MyPHPExcel/Writer/CSV_coding.php";
class Service_export_file extends CI_Model
{

    private $_result;
    private $_format;
    private $_header;

    public function export($header, $result, $format)
    {
        $this->_result = $result;
        $this->_format = $format;
        $this->_header = $header;

        $data = $this->get_file_data();

        $file_path = $this->get_file_path();

        if (strtolower( $this->_format ) == 'csv' ) {
            $obj_csv = new PHPExcel_Writer_CSV_CODING($data);
            $obj_csv->setCoding('SJIS-win');
             $obj_csv->setDelimiter(',')
                                            ->setEnclosure('"')
                                            ->setLineEnding("\r\n")
                                            ->setSheetIndex(0)
                                            ->save($file_path);
             return $file_path;
        }



    }


    private function get_file_data()
    {
        $objPHPExcel = new PHPExcel();

        $cell_colunms = [];
        $keys = array_keys($this->_header);
        while (list(, $key) = each($keys)) {
                $cell_colunms[$key] = array_column($this->_result, $key);
        }

        $that = $objPHPExcel->setActiveSheetIndex(0);
        list($x, $y) = [65, 1];
        foreach ($this->_header as $key => $title) {
            $that->setCellValue(chr($x).$y, $title);
            foreach ($cell_colunms[$key] as $value) {
                $y ++;
                $that->setCellValue(chr($x).$y, $value);
            }
            $y = 1;
            $x ++;
        }

      return $objPHPExcel;

    }



    private function get_suffix()
    {
        return ('csv' == strtolower($this->_format)) ? 'csv' : 'xlsx';
    }

    private function get_filename()
    {
        return $this->uri->segment(2).'-'.date("Y-m-d-H-i-s", time());
    }

    private function get_file_path()
    {
        return '/tmp/'.$this->get_filename().'.'.$this->get_suffix();
    }
}