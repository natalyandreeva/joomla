<?php
/**
 * CSVI Analyzer
 *
 * Tool to analyze a CSV file
 *
 * @author		RolandD Cyber Produksi
 * @link		http://www.csvimproved.com
 * @copyright 	Copyright (C) 2012 RolandD Cyber Produksi
 * @license 	GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 * @version 	$Id: csvi_cutter.php 999 2009-09-17 08:01:20Z Suami $
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-gb" lang="en-gb" dir="ltr">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<title>CSVI Analyzer</title>
	<style type="text/css">
		.data_table {
			border-collapse: collapse;
		}
		
		.data_table thead {
			background-position: left bottom;
			background-repeat: repeat-x;
			border-bottom: 2px solid #3E8CBC;
			color: #333333;
			font-size: 18px;
			font-weight: bold;
			height: 25px;
			padding-bottom: 6px;
			padding-top: 8px;
			table-layout: fixed;
			text-align: center;
		}
		
		.data_table tbody td {
			border-right: 1px solid #FF0000;
			border-bottom: 1px solid #CECECE;
			/* border: 2px solid #FFFFFF; */
			margin: 2px;
			padding: 6px;
			text-align: left;
			vertical-align: middle;
		}
		
		.notice {
			color: #385439;
		}
		
		.title {
			color: #4C55FF;
			font-size: 20px;
			margin-left: 15px;
		}
		
		.top {
			font-size: 12px;
		}
		
		#title,#logo {
			display: block;
			font-size: 30px;
			font-weight: bold;
			text-align: center;
		}
		
		label {
			width: 12em;
			float: left;
			text-align: right;
			margin-right: 0.5em;
			display: block
		}
		
		.submit {
			margin-left: 12.5em;
		}
		
		input {
			color: #0C609C;
			font-weight: bold;
			background: #FFCD8B;
			border: 1px solid #0C609C;
		}
		
		.submit input {
			color: #000000;
			background: #FFCD8B;
			border: 2px outset #d7b9c9;
		}
		
		li {
			padding: 5px;
		}
		
		.error {
			font-size: 20px;
			color: #FF0000;
			font-weight: bold;
		}
		
		.msgbox {
			margin-top: 25px;
			border-top: 2px solid;
			border-left: 5px solid;
			padding: 10px;
		}
		
		.bold {
			font-weight: bold;
		}
		
		.footer {
			float: right;
			font-size: 10px;
		}
	</style>
</head>
<body>
	<?php

	class CsvAnalyzer {
		private $_file = null;
		private $_lines = 3;
		private $_columnheader = true;
		private $_bom = false;
		private $_errors = array();
		private $_messages = array();
		private $_recommend = array();
		private $_data = '';
		private $_text_enclosure = '"';
		private $_field_delimiter = null;
		private $_fields = array();
		private $_csvdata = array();

		public function __construct() {
			if (isset($_POST['process'])) {
				// Prepare
				$this->_prepare();
					
				// Read the file
				$handle = fopen($this->_file, "r");
				if ($handle) {
					// Get the first line
					$this->_data = fread($handle, 4096);

					// Check for Mac line-ending
					if ($this->_checkMac()) {
						// Reload the file
						fclose($handle);
						$handle = fopen($this->_file, "r");
						$this->_data = fread($handle, 4096);
					}

					// Check for BOM
					$this->_checkBom();

					// Find delimiters
					$this->_findDelimiters();

					// Find fields
					$this->_findFields($handle);

					// Find data
					for ($i=0; $i < $this->_lines; $i++) {
						$this->_findData($handle);
					}



					fclose($handle);
				}
				?>
	Index:
	<ol>
		<?php if (!empty($this->_errors)) { ?>
		<li><a href="#csverrors">Errors</a></li>
		<?php } ?>
		<?php if (!empty($this->_messages)) { ?>
		<li><a href="#csvmessages">Messages</a></li>
		<?php } ?>
		<?php if (!empty($this->_fields)) { ?>
		<li><a href="#csvfields">CSV fields</a></li>
		<?php } ?>
		<?php if (!empty($this->_csvdata)) { ?>
		<li><a href="#csvdata">CSV data</a></li>
		<?php } ?>
		<?php if (!empty($this->_recommend)) { ?>
		<li><a href="#csvrecommend">Recommendations</a></li>
		<?php } ?>
	</ol>
	<?php

	// Print out any errors
	if (!empty($this->_errors)) {
		?>
	<div class="msgbox">
		<a href="#top" class="top">Top</a> <a name="csverrors"
			class="title error">Errors</a>
		<div id="csverrors">
			<?php echo implode('<br />', $this->_errors); ?>
		</div>
	</div>
	<?php }

	// Print out any messages
			if (!empty($this->_messages)) { ?>
	<div class="msgbox">
		<a href="#top" class="top">Top</a> <a name="csvmessages" class="title">Messages</a>
		<div id="csvmessages">
			<?php echo implode('<br />', $this->_messages); ?>
		</div>
	</div>
	<?php }

	// Print out fields
			if (!empty($this->_fields)) { ?>
	<div class="msgbox">
		<a href="#top" class="top">Top</a> <a name="csvfields" class="title">CSV
			Fields</a>
		<div id="csvfields">
			<ol>
				<?php foreach ($this->_fields as $fields) { ?>
				<li><?php echo $fields; ?></li>
				<?php } ?>
			</ol>
		</div>
	</div>
	<?php }

	// Print out data
			if (!empty($this->_csvdata)) { ?>
	<div class="msgbox">
		<a href="#top" class="top">Top</a> <a name="csvdata" class="title">CSV
			Data</a>
		<div id="csvdata">
			<div class="notice">If you see any unreadable characters in this
				table, your file is not UTF-8 encoded. Make sure your file is UTF-8
				encoded so special characters like ë are imported correctly.</div>
			<table class="data_table">
				<thead>
					<tr>
						<?php for ($i = 0; $i < count($this->_csvdata[0]); $i++) { ?>
						<th><?php echo ($i+1); ?></th>
						<?php } ?>
					</tr>
				</thead>
				<tfoot></tfoot>
				<tbody>
					<?php foreach ($this->_csvdata as $data) { ?>
					<tr>
						<?php foreach ($data as $value) { ?>
						<td><?php echo $value; ?></td>
						<?php } ?>
					</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
	<?php }

	// Print out any recommendations
			if (!empty($this->_recommend)) { ?>
	<div class="msgbox">
		<a href="#top" class="top">Top</a> <a name="csvrecommend"
			class="title">Recommendations</a>
		<div id="csvrecommend">
			<?php echo implode('<br />', $this->_recommend); ?>
		</div>
	</div>
	<?php }
			}

		}

		private function _prepare() {
			// Assign the local values
			if (empty($_FILES['filename']['tmp_name'])) {
				$this->_errormsg[] = 'No input file specified.';
				return false;
			}
			else {
				$this->_file = $_FILES['filename']['tmp_name'];
				if (!isset($_POST['columnheader'])) $this->_columnheader = false;
				if (isset($_POST['lines'])) $this->_lines = $_POST['lines'];
			}
		}

		private function _checkMac() {
			$matches = array();
			// Check Windows first
			$total = preg_match('/\r\n/', $this->_data, $matches);
			if (!$total) {
				preg_match('/\r/', $this->_data, $matches);
				if (!empty($matches)) {
					$this->_errors['MACLINE'] = 'Mac line-ending found';
					$this->_recommend[] = 'Enable the option I\'m Mac or save your file with Windows or Unix line-endings';
					// Set auto detect to handle the rest of the file
					ini_set('auto_detect_line_endings', true);
					return true;
				}
			}
			return false;
		}

		private function _checkBom() {
			if (strlen($this->_data) > 3) {
				if (ord($this->_data{0}) == 239 && ord($this->_data{1}) == 187 && ord($this->_data{2}) == 191) {
					$this->_errors['BOM'] = 'BOM found';
					$this->_bom = true;
					$this->_data = substr($this->_data, 3, strlen($this->_data));
				}
			}
		}

		private function _findDelimiters() {
			// 1. Is the user using text enclosures
			$first_char = substr($this->_data, 0, 1);
			$pattern = '/[a-zA-Z0-9_]/';
			$matches = array();
			preg_match($pattern, $first_char, $matches);

			if (count($matches) == 0) {
				// User is using text delimiter
				$this->_text_enclosure = $first_char;
				$this->_messages[] = 'Text enclosure: '.$first_char;

				// 2. What field delimiter is being used
				$match_next_char = strpos($this->_data, $this->_text_enclosure, 1);
				$second_char = substr($this->_data, $match_next_char+1, 1);
				if ($first_char == $second_char) {
					$this->_errors['NOFIELD'] = 'Cannot find a field delimiter';
				}
				else {
					$this->_field_delimiter = $second_char;
					$this->_messages[] = 'Field delimiter: '.$second_char;
				}
			}
			else {
				// Check for tabs
				$tabs = preg_match('/\t/', $this->_data, $matches);
				if ($tabs) {
					$this->_field_delimiter = "\t";
					$this->_messages[] = 'Field delimiter: Tab';
				}
				else {
					$totalchars = strlen($this->_data);
					// 2. What field delimiter is being used
					for ($i = 0;$i <= $totalchars; $i++) {
						$current_char = substr($this->_data, $i, 1);
						preg_match($pattern, $current_char, $matches);
						if (count($matches) == 0) {
							$this->_field_delimiter = $current_char;
							$this->_messages[] = 'Field delimiter: '.$current_char;
							$i = $totalchars;
						}
					}
				}
				if (is_null($this->_field_delimiter)) $this->_errors['NOFIELD'] = 'Cannot find a field delimiter';
			}
		}

		private function _findFields($handle) {
			rewind($handle);
			$data = fgetcsv($handle, 1000, $this->_field_delimiter, $this->_text_enclosure);
			if ($this->_columnheader) {
				if ($data !== FALSE ) {
					if ($this->_bom) $data[0] = substr($data[0], 3, strlen($data[0]));
					$this->_fields = $data;

					// Check the fields for any _id fields
					foreach ($this->_fields as $field) {
						if (substr($field, -3) == '_id') {
							$this->_recommend[] = 'Found field <span class="bold">'.$field.'</span>: the use of fields ending with _id is not recommended. If your imported items are not showing up, this is most likely the reason. Remove this field to fix the issue.';
						}
					}
				}
				else $this->_errors['NOREAD'] = 'Cannot read CSV file correctly';
			}
		}

		private function _findData($handle) {
			$data = fgetcsv($handle, 4096, $this->_field_delimiter, $this->_text_enclosure);
			if ($data !== FALSE ) {
				if ($this->_columnheader) {
					if (count($this->_fields) > count($data)) {
						$this->_errors['NODATA'] = 'Data lines have more fields than the header';
						$this->_recommend[] = 'Check your CSV file not to have any extra field delimiters';
					}
					else if (count($this->_fields) < count($data)) {
						$this->_errors['NODATA'] = 'Data lines have less fields than the header';
						$this->_recommend[] = 'Check your CSV file enough field delimiters. Empty fields also require a field delimiter';
					}
				}
				$this->_csvdata[] = $data;
			}
			else {
				if (!feof($handle))	$this->_errors['NOREAD'] = 'Cannot read CSV file correctly';
			}
		}

	}

	?>


	<div id="title">
		<div id="logo">
			<img src="csvi_logo.png" alt="CSV Improved" /> CSVI Analyzer
		</div>
	</div>
	<br />
	<form name="csvcut" method="post" enctype="multipart/form-data">
		<label for="filename">Filename: </label> <input type="file"
			id="filename" name="filename" size="80" /><br /> <br /> <label
			for="columnheader">File has column headers: </label> <input
			type="checkbox" id="columnheader" name="columnheader" value="1"
			checked="checked" /><br /> <br /> <label for="lines">Lines to show: </label>
		<input type="text" id="lines" name="lines" value="3" size="2" /><br />
		<br />
		<div class="submit">
			<input type="submit" value="Analyze">
		</div>
		<input type="hidden" id="process" name="process" value="1" />
	</form>
	<br />
	<div class="footer">
		CSVI Analyzer 1.1 brought to you by <a href="http://www.csvimproved.com/" target="_new">CSV Improved</a>
	</div>
	<?php
	// Start the validator
	$analyzer = new CsvAnalyzer;
	?>
</body>
</html>
