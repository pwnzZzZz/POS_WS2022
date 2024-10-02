<?php
require_once("cartitem.php");
class Cart
{

    private $cartitems = [];

    public function __construct()
    {
    }
    

    private function loadCookie()
    {
        if(isset($_COOKIE['Cartitems'])) {
            $this->cartitems =  unserialize($_COOKIE['Cartitems']);
        }
        
    }

    private function saveCookie()
    {
        setcookie("Cartitems", serialize($this->cartitems), time() + 3600);
    }

    public function add($book, $count)
    {
        $this->loadCookie();
        array_push($this->cartitems, new Cartitem($book, $count));
        $this->saveCookie();
    }

    public function remove($id, $count)
    {
        $this->loadCookie();
        foreach($this->cartitems as $line_num => $cartitem){
            if($cartitem->getBook()->getId() == $id) {
                if($cartitem->getCount() == 1) {
                    unset($this->cartitems[$line_num]);
                    break;
                } else if($cartitem->getCount() > 1) {
                    $cartitem->setCount($cartitem->getCount() - $count);
                }
                
            }
        }
        $this->saveCookie();

    }

    public function getTotalCount() {
        $this->loadCookie();

        $totalCount = 0;

        foreach($this->cartitems as $key => $cartitem) {
            $totalCount += $cartitem->getCount();
        }
        return $totalCount;
    }

	/**
	 * @return mixed
	 */
	public function getCartitems() {
		$this->loadCookie();
        return $this->cartitems;
	}

    public function getEndPrice() {
        $this->loadCookie();

        $endPrice = 0;

        foreach($this->cartitems as $key => $cartitem) {
            $endPrice += $cartitem->getTotalPrice();
        }

        return $endPrice;
    }
}
