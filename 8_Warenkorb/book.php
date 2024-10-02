<?php

class Book
{
    private $id;
    private $title;
    private $price;
    private $stock;


    public function __construct($id, $title, $price, $stock)
    {
        $this->id = $id;
        $this->title = $title;
        $this->price = $price;
        $this->stock = $stock;
    }



    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }



    /**
     * Get the value of title
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set the value of title
     *
     * @return  self
     */
    public function setTitle($title)
    {
        if($title != null && strlen($title) > 1){
            $this->title = $title;
        }
        return $this;
    }

    /**
     * Get the value of price
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set the value of price
     *
     * @return  self
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get the value of stock
     */
    public function getStock()
    {
        return $this->stock;
    }

    /**
     * Set the value of stock
     *
     * @return  self
     */
    public function setStock($stock)
    {
        $this->stock = $stock;

        return $this;
    }

    public static function getAll(){
        $lines = file_get_contents('C:\xampp\htdocs\pos_ms_ws2022\8_Warenkorb\PHP-23 bookdata.json');

        $json = json_decode($lines, true);
        $books = [];
        foreach($json as $key => $book) {
            array_push($books, new Book($book['id'], $book['title'], $book['price'], $book['stock']));
        }
        return $books;   
    }

    public static function getById($id){
        $books = Book::getAll();

        foreach($books as $line_num => $book){
            if($book->getId() == $id){
                return $book;
            }
        }  
    }




}
