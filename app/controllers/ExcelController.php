<?php

class ExcelController extends BaseController {

	protected $layout = "layouts.pages_main";

    /**
     * Spreadsheet reader
     * @var object
     */
    public $reader;

    /**
     * Spreadsheets object
     * @var object
     */
    public $sheets;

    /**
     * Spreadsheets array
     * @var object
     */
    public $sheetsArray;

    /**
     * Number of total sheets
     * @var integer
     */
    public $sheetsNumber = 1;

    /**
     * Titles of all sheets
     * @var integer
     */
    public $sheetsTitles = array();

    /**
     * Headers of all sheets
     * @var array
     */
    public $totalHeaders = array();

    /**
     * Index of selected sheet
     * @var integer
     */
    public $selectedSheetIndex = 0;

	/**
	* Get the number of total sheets
	* @return integer
	*/
	public function getSheetsNumber() {
		return $this->sheetsNumber;
	}

	/**
	* Get the headers of a sheet
	* @return array
	*/
	public function getTotalHeaders() {
		return $this->totalHeaders;
	}



	public function getTest() {
		$this->layout->content = View::make('excel.test');
		//return View::make('excel.test');
	}
/* price database*/
	public function getPriceDatabase(){
		$this->layout->content = View::make('excel.price-database');
	}


/* upload wizard*/
	public function getUploadWizard() {
		$this->layout->content = View::make('excel.upload-wizard');
	}
	//first step upload excel file
	public function postUploadFile() {
		$inputFilePath = $this->_getInputFilePath();
		if(is_null($inputFilePath))
		{
			return Redirect::to('excel/upload-wizard')->with('message','Invalid Excel File')->with('messageType','danger')->withInput();
		}
		elseif(!Input::has('table'))
		{
			return Redirect::to('excel/upload-wizard')->with('message','Please select a table')->with('messageType','info')->withInput();
		}
		else
		{
			$this->_init($inputFilePath);
			$excel = array(	'sheetsArray'	=>	$this->sheetsArray,
							'sheetsNumber'	=>	$this->sheetsNumber, 
							'sheetsTitles'	=>	$this->sheetsTitles,
							'totalHeaders'	=>	$this->totalHeaders);
			//skip the first and last two columns
			$columns = array_slice($this->_getTableColumnNames(Input::get('table')),1,-2);
			return Redirect::to('excel/upload-wizard')->with('tab', 2)->with('excel',$excel)->with('columns',$columns);
		}
	}
	//second step match excel fields and table columns
	public function postMatchField() {
		$data = Input::all();

		return Redirect::to('test')->with('data', $data);
	}
	public function postTest() {
		$inputFilePath = $this->_getInputFilePath();
		if(!is_null($inputFilePath))
		{
			$this->_init($inputFilePath);
			$data = array(	'sheetsArray'	=>	$this->sheetsArray,
							'sheetsNumber'	=>	$this->sheetsNumber, 
							'sheetsTitles'	=>	$this->sheetsTitles,
							'totalHeaders'	=>	$this->totalHeaders);
			$this->layout->content = View::make('excel.test', $data);	
		}
		else
		{
			$this->layout->content = 'invalid excel file';
		}
	}

	//get table column names
	public function _getTableColumnNames($tableName){
		switch ($tableName) {
			case 'sales':
				return Schema::getColumnListing('data_sales');
				break;
			case 'medassets':
				return Schema::getColumnListing('data_medassets');
				break;
			default:
				return null;
				break;
		}
	}

	//initialize excel data
	public function _init($inputFilePath) {
		//remember in cache for 10 minutes
		$this->reader = Excel::load($inputFilePath)->remember(10)->noHeading();
		//get all sheets
		$this->sheets = $this->reader->all();
		//sheets array with heading
		$this->sheetsArray = $this->sheets->toArray();
		//count the number of sheets
		$this->sheetsNumber = count($this->sheets);
		//store all sheets title and headers
		foreach ($this->sheets as $sheet) {
			array_push($this->sheetsTitles, $sheet->getTitle());
			array_push($this->totalHeaders, $sheet->get(0)->toArray());
		}
	}

	//input file validation
	public function _getInputFilePath() {
		//check if input file exist
		if(Input::hasFile('excel'))
		{
			$file = Input::file('excel');
			//check if input file valid
			if($file->isValid())
			{
				$ext = array('csv','xls','xlsx');
				//check if input file is excel file
				if(in_array($file->getClientOriginalExtension(), $ext))
				{
					return $file->getRealPath();
				}
				else
				{
					return NULL;
				}
			}
			else
			{
				return NULL;
			}
		}
		else
		{
			return NULL;
		}
	}

/*	public function postLoad(){

	}*/

	public function getLoadToView($inputFilePath = 'test.xls', $selectedSheetIndex = 0) {
		if(1)
		{
			Excel::load($inputFilePath, function($reader) use($selectedSheetIndex){
				//get the sheet
				$sheet = $reader->all()->get($selectedSheetIndex);
				//print table
				echo "<table>";
				echo 	"<thead>";
				echo 		"<tr>";
				//print header
				$reader->noHeading()->all()->get($selectedSheetIndex)->get(0)->each(function($header){
					echo 		"<th>".$header."</th>";
				});
				echo 		"</tr>";
				echo 	"</thead>";
				echo 	"<tbody>";
				//print each row
				$sheet->each(function($row){
					echo 	"<tr>";
						$row->each(function($cell){
						 echo 	"<td>".$cell."</td>";
						});
					echo 	"</tr>";
				});
				echo 	"</tbody>";
				echo "</table>";
			});
		}
		else
		{
			return '';
		}
	}

//test function
	public function getLoadtest($inputFilePath = 'PFBM07131A.xlsx',$selectedSheetIndex = 0){			
		echo "<pre>";

		$this->_init($inputFilePath);
		print_r($this->sheetsArray);

/*		$reader = Excel::load($inputFilePath)->remember(10)->noHeading();
		$sheets = $reader->all();
		print_r($sheets->toArray());
		//echo $sheets;
		$sheetsTitles = array();
		foreach ($sheets as $sheet) {
			$sheetsTitles[] = $sheet->getTitle();
			//print_r($sheet->get(0)->toArray());
			//print_r($sheet->toArray());
		}
		print_r($sheetsTitles);*/
		//$reader->get();
		//$sheets = $reader->all();
		//print_r($sheets->get(0));
		// $reader->noHeading()->all()->get(0)->toArray();
		 // print_r($reader->first());

		echo "</pre>";

/*		Excel::selectSheetsByIndex($selectedSheetIndex)->load($inputFilePath,function($reader) { 
			echo "<br><br><pre>";
			// get all sheets(sheet collection)
			$sheets = $reader->all();
			//echo print_r($sheets);
			echo count($sheets);

			// select a sheet(row collection)
			 $sheet = $sheets->get(0);
			//echo print_r($reader->first());
			//get sheet title
			$title = $sheet->getTitle();
			

			// select a row(cell collection)
			$row = $sheet->get(0);

			//loop through all rows
			$sheet->each(function($row) {
				echo $row->name.'<br>';
			});	
			// get the headers of the sheet 
			$reader->noHeading()->first()->get(0)->each(function($header){
				echo $header."<br>";
			});

			echo print_r($reader->all()->get(0)->get(0));
			echo $reader->all()->get(0)->get(0)->get('name');

			echo "</pre>";
		});	*/
	} 
}
?>