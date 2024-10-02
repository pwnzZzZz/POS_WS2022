<?php 
class Book {
    private $id;
    private $title;
    private $price;
    private $stock;
  
    public function __construct($id, $title, $price, $stock) {
    $this->setId($id);
    $this->setTitle($title);
    $this->setPrice($price);
    $this->setStock($stock);
    }
  
    public function getId() {
      return $this->id;
    }
  
    public function getTitle() {
      return $this->title;
    }
  
    public function getPrice() {
      return $this->price;
    }
  
    public function getStock() {
      return $this->stock;
    }

public static function getBookById($id){

}
public static function getAllBooks(): array{
    $book_string = file_get_contents(('jsonstuff/PHP-23 bookdata.json'),true);
		$book_objekte = json_decode($book_string);

		$bookArray = array();

		foreach($book_objekte as $key => $value){
			$book = new Book($value->id, $value->title, $value->price, $value->stock);
			$bookArray[] = $book;
		}

		return $bookArray;



		//var_dump($book_objekte);


}

  
	/**
	 * @param mixed $id 
	 * @return self
	 */
	public function setId($id): self {
		$this->id = $id;
		return $this;
	}
	
	/**
	 * @param mixed $title 
	 * @return self
	 */
	public function setTitle($title): self {
		$this->title = $title;
		return $this;
	}
	
	/**
	 * @param mixed $price 
	 * @return self
	 */
	public function setPrice($price): self {
		$this->price = $price;
		return $this;
	}
	
	/**
	 * @param mixed $stock 
	 * @return self
	 */
	public function setStock($stock): self {
		$this->stock = $stock;
		return $this;
	}
}
?>