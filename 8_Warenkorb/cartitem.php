<?php
require_once("book.php");

class Cartitem
{
    private $book;
    private $count;

    public function __construct($book, $count){
        $this->book = $book;
        $this->count = $count;
    }

	/**
	 * @return mixed
	 */
	public function getBook() {
		return $this->book;
	}
	
	/**
	 * @param mixed $book 
	 * @return self
	 */
	public function setBook($book): self {
		$this->book = $book;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getCount() {
		return $this->count;
	}
	
	/**
	 * @param mixed $count 
	 * @return self
	 */
	public function setCount($count): self {
		$this->count = $count;
		return $this;
	}

    public function getTotalPrice() {
        return $this->book->getPrice() * $this->count;
    }
}

?>
