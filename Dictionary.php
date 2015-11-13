<?php

require_once("TrieTree.php");

class Dictionary{
	public $TrieTable = array(); 
	//try it out first with a text file


	function Dictionary(){
		$File = fopen("largedictionary.txt","r");
		$initLine = " ";

		if(!$File)
			print("Could Not Open File largedictionary.txt");
		else{
			/*
				I know this is a lot of preprocessing but it
				does help with organizing this. this will get
				the size of the largest word.
			*/
			while(!feof($File)){
				$line = fgets($File);
				if(strlen($initLine) < strlen($line))
					$initLine = $line;
			}
				fclose($File);
			//size up the Table of Trie trees
			$TrieTable= array_pad($TrieTable,(strlen($initLine) + 1), new Trie());
			$File = fopen("largedictionary.txt","r");
			//start inserting words
				while(!feof($File)){
					insert(fgets($File));
				}

		}

	}



	function insert($word){
		$TrieTable[strlen($word)].insert($word);
	}


	/*Find the Shortest Path.*/
	function WordLadderCompute($StringX, $StringY){

		//if string sizes do not match then you can not
		//compute the word ladder
		if(strlen($StringX) == strlen($StringY)){
			print("Incorrect/Mismach word sizes");
			return;
		}
		else
			$TrieTable[strlen($StringX)].findPath($StringX, $StringY);
	}

}

?>