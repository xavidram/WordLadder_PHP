<?php

class vertex{
	public $neighbors;			//neighbors array
	public $edgeP;				//pointer for edges
	public $word;				//string that contains the current portion of the word
	public $endOfWord;			//flag for end of world vertex
	public $vertexPrev;			//pointer to previous edge
	public $edges;				//holds array of edges(0-26)
	public $visited;			//boolean for bfs to check if this vertex has been visited.

	function __construct(){
		$edges = array(26,NULL);
		$pred = NULL;
		$endOfWord = false;
		$visited = false;
	}

	function __construct1($X){
		$edges = array();
		$word = $X;
		$pred = NULL;
		$endOfWord = false;
		$visited = false;
	}

}

?>