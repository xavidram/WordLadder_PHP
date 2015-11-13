<?php

	class edge{
		public $letter;					//character for letter in the edge;
		public $child;					//child vertex pointer

		function __construct(){
			$child = NULL;
			$letter = NULL;
		}

		function __construct1($X){
			$child = NULL;
			$letter = $X;
		}

	}

?>