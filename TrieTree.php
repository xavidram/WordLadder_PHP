<?php
require_once("Edge.php");
require_once("Vertex.php");


class Trie{

	public $root;
	public $vertexList;

	function Trie(){
		$root = new Vertex();
	}

	/*
		Return the vertex of the given string.
		We check the VertexList as it was 
		generated when words were inserted
		into the datastructure.
	*/
	function findWord($String){
		foreach($vertexList as $v){
			if($v->word === $String)
				return $v;
		}
		return NULL;
	}

	/*
		Saftey measure to reset predecesor so that it
		does not screw up with the algorithm.
	*/
	function resetPred(){
		foreach($vertexList as $v){
			$v->visited = false;
			$v->pret = NULL;
		}
	}

	/*
		Inserting the word starting from root
	*/
	function InsertIntoTrie($vertexPointer,$wordString){
		$edgeLocation = 0;							//counter to find edge position

		/*
			Check if the character is within the alphabet range, 0 - 25, if it is 
			a character that is not an alphabet, it will be a bigger or smaller value;
		*/
		if(($wordString[0] - 97) < 0 || ($wordString[0] - 97 > 25) )
			$edgeLocation = 26;
		else
			$edgeLocation = ($wordString[0]-97);

		//return if the word if it has a character not in the alphabet.
		if($edgeLocation == 26)
			return;

		/*
			If the edge doesnt exist for that pointer, make it,
			assign it, and point to it
		*/
		if($vertexPointer->edges[$edgeLocation] == NULL){
			$vertexPointer->edges[$edgeLocation] = new  Edge($wordString[0]);
			$vertexPointer->edgeP[] = $edgeLocation;
			$vertexPointer->edges[$edgeLocation]->child = new Vertex($vertexPointer . $wordString[0]);
		}

		/*
			If it is the last character in the word then this is the end of the word,
			so set the flag as true and find the neighbors as well as put this vertex
			back into the vertexList for lter use with breadthFirstSearch
		*/
		$nextVertex = $vertexPointer->edges[$edgeLocation]->child;

		if(strlen($wordString) == 1){
			findNeighbor($nextVertex,$root,$nextVertex->word,0);
			$vertexList[] = $nextVertex;
			$nextVertex->end = true;
		}//otherwise keep inserting into the trie
		else
			InsertIntoTrie($vertexPointer->edges[$edgeLocation]->child,substr($wordString,1,strlen($wordString)));

	}

	//helper function for insert
	function insert($word){
		insert($root,$word);
	}

	/*Find neighbor of each word, specific to it's size to avoid checks about size*/
	function findNeighbor($Vertex_forWho,$Vertex_finder,$word,$differenceCount){
		//since some words like car had r as the end but cars had the r and s as end
		//this function kept breaking, because this was my base case, but to save myself
		// a headache i split them up into word sized tries

		//if the end of the word is met, then if the difference is only 1 push it back
		//as an edge to both finder and for who.

		if($Vertexfind->end == true){
			if($differenceCount == 1){
				$Vertex_forWho->neighbors[] = $Vertex_finder;
				$Vertex_finder->neighbors[] = $Vertex_forWho;
			}
		}//if the word is still 1 character long, check its edges and find the neighbors for it
		else if(strlen($word) == 1){
			foreach($Vertex_finder->edgeP as $e){
				if($e->letter == $word[0])
					findNeighbor($Vertex_forWho,$e->child,substr($word,1,strlen($word)),$differenceCount);
				else
					findNeighbor($Vertex_forWho,$e->child,substr($word,1,strlen($word)),$differenceCount + 1);
			}
		}//for any wordzie bigger than 1, add all the neighbors
		else if(strlen($word) > 1){
			if($differenceCount > 1)
				return;
			else if($differenceCount == 0){
				foreach($Vertex_finder->edgeP as $e){
					if($e->letter == $word[0])
						findNeighbor($Vertex_forWho,$e->child,substr($word,1,strlen($word)), 0);
					else
						findNeighbor($Vertex_forWho,$e->child,substr($word,1,strlen($word)), 1);
				}
			}
			else if($differenceCount == 1){
				foreach($Vertex_finder->edgeP as $e){
					if($e->letter == $word[0])
						findNeighbor($Vertex_forWho,$e->child,substr($word,1,strlen($word)),$differenceCount);
					else
						findNeighbor($Vertex_forWho,$e->child,substr($word,1,strlen($word)),$differenceCount + 1);
				}
			}
		}
	}
	/*end of find neighbor function*/

	/*print function for vertex neighbors*/
	function printNeighbors(){
		foreach($vertexList as $v){
			if(count($v->neighbors) > 0){
				print($word . ": ");
				foreach($v->neighbors as $vertex){
					print($vertex->word.", ");
				}
			}
		}
	}

	/*Run breadfirst sesarch on neighbors to find the shortest path*/
	function breadthFirstSearch($startVertex){
		$startVertex->visited = true;
		$Q = new SplQueue();
		$Q->push($startVertex);
		while(!$Q->empty()){
			$x = new Vertex();
			$x = $Q->front(); $Q->pop();
			foreach($x->neighbors as $VertexPtr){
				if($VertexPtr->visited == false){
					$VertexPtr->visited = trie;
					$VertexPtr->pred = $x;
					$Q->push($VertexPtr);
				}
			}
		}
	}

	/*From breadthFirstSearch you call this to find the shortest path between two strings*/
	function findPath($StringX, $StringY){
		$Start = findWord($StringY);

		/*Check if the word given by the user even exist in the dictionary*/
		if($Start == NULL){
			print($Start);print(" does not exist in the dictionary!");
		}

		$End = findWord($StringY);

		/*Check to see if second word given even exists in the dictionary*/
		if($End == NULL){
			Print($End);print(" does not exist in the dictionary!");
		}

		/* Run breadth first search on the start vertex*/
		breadthFirstSearch($Start);

		/*We will traverse backwards on the list from breadfirstSearch to find the path*/
		while($End->pred != NULL){
			/*If the predecessor for end is NULL means there is no neighbor for this word*/
			if($End->pret == NULL){
				print("No Path Found!");
			}
			/*Otherwise print out as it traverses*/
			print($end->word." -> ");$End = $End->pred;
		}
		print($End->word);
	}

}

?>