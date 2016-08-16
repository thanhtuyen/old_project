<?php

class PHPExcel_Writer_CSV_CODING extends PHPExcel_Writer_CSV
{
        protected $_coding = 'UTF-8';

        public function setCoding($coding)
        {
            $this->_coding = $coding;
        }

        public function getCoding()
        {
            return $this->_coding;
        }

/*=======================*/

    /**
     * PHPExcel object
     *
     * @var PHPExcel
     */
    private $_phpExcel;

    /**
     * Delimiter
     *
     * @var string
     */
    private $_delimiter = ',';

    /**
     * Enclosure
     *
     * @var string
     */
    private $_enclosure = '"';

    /**
     * Line ending
     *
     * @var string
     */
    private $_lineEnding    = PHP_EOL;

    /**
     * Sheet index to write
     *
     * @var int
     */
    private $_sheetIndex    = 0;

    /**
     * Whether to write a BOM (for UTF8).
     *
     * @var boolean
     */
    private $_useBOM = false;

    /**
     * Whether to write a fully Excel compatible CSV file.
     *
     * @var boolean
     */
    private $_excelCompatibility = false;


    public function __construct(PHPExcel $phpExcel) {
        $this->_phpExcel    = $phpExcel;
    }

    public function save($pFilename = null) {
        // Fetch sheet
        $sheet = $this->_phpExcel->getSheet($this->_sheetIndex);

        $saveDebugLog = PHPExcel_Calculation::getInstance($this->_phpExcel)->getDebugLog()->getWriteDebugLog();
        PHPExcel_Calculation::getInstance($this->_phpExcel)->getDebugLog()->setWriteDebugLog(FALSE);
        $saveArrayReturnType = PHPExcel_Calculation::getArrayReturnType();
        PHPExcel_Calculation::setArrayReturnType(PHPExcel_Calculation::RETURN_ARRAY_AS_VALUE);

        // Open file
        $fileHandle = fopen($pFilename, 'wb+');
        if ($fileHandle === false) {
            throw new PHPExcel_Writer_Exception("Could not open file $pFilename for writing.");
        }
        $fileHandleTmp = fopen('php://temp', 'r+b');



        //  Identify the range that we need to extract from the worksheet
        $maxCol = $sheet->getHighestDataColumn();
        $maxRow = $sheet->getHighestDataRow();

        // Write rows to file
        for($row = 1; $row <= $maxRow; $row++) {
            // Convert the row to an array...
            $cellsArray = $sheet->rangeToArray('A'.$row.':'.$maxCol.$row,'', $this->_preCalculateFormulas);

            // ... and write to the file
            // $this->_writeLine($fileHandle, $cellsArray[0]);

            $result = $cellsArray[0];

            if(is_array($result)){

            } elseif(is_string($result)) {

            } else {
                throw new \Exception("unknow type", 1);
            }

            fputcsv($fileHandleTmp, $result, $this->getDelimiter(), $this->getEnclosure());

        }
        rewind($fileHandleTmp);
        $tmp = str_replace(PHP_EOL, $this->getLineEnding(), stream_get_contents($fileHandleTmp));
        $content =  mb_convert_encoding($tmp, $this->getCoding(), 'UTF-8');

        fwrite($fileHandle, $content);
        // Close file
        fclose($fileHandle);
        PHPExcel_Calculation::setArrayReturnType($saveArrayReturnType);
        PHPExcel_Calculation::getInstance($this->_phpExcel)->getDebugLog()->setWriteDebugLog($saveDebugLog);
    }
}