<?php

class ExcelController extends BaseController {

	protected $layout = "layouts.pages_main";


	public function getTest() {
		$this->layout->content = View::make('excel.test');
	}

	public function postTest() {
		$this->layout->content = "test" ;
		//loadToView(Input::file('excel')->getRealPath());
	}

	public function loadToView($inputFileName = 'test.xls', $sheetNumber = 0) {
		if(1)
		{
			Excel::load($inputFileName, function($reader){
				//get the sheet
				$sheet = $reader->all()->get(0);
				//print table
				echo "<table>";
				echo 	"<thead>";
				echo 		"<tr>";
				//print header
				$reader->noHeading()->first()->get(0)->each(function($header){
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
	public function load($inputFileName = 'test.xls'){		

		Excel::load($inputFileName,function($reader){
			echo "<pre>";
			/**get all sheets(sheet collection)**/
			$sheets = $reader->all();
			//echo print_r($sheets);

			/**select a sheet(row collection)**/
			 $sheet = $sheets->get(0);
			echo print_r($reader->first());
			//get sheet title
			$title = $sheet->getTitle();
			

			/**select a row(cell collection)**/
			$row = $sheet->get(0);

			//loop through all rows
	/*		$sheet->each(function($row) {
				echo $row->name.'<br>';
			});	*/
			/**get the headers of the sheet **/
	/*		$reader->noHeading()->first()->get(0)->each(function($header){
				echo $header."<br>";
			});*/

			echo "</pre>";
		});
	} 
}
?>