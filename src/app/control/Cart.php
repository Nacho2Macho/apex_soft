<?php
    namespace project\control;

    use project\control\parent\Page;
    use project\control\interfaces\iCart;
    use project\model\Cart as model_Cart;

    class Cart extends Page implements iCart {
        public function __construct() {
            $this->constructor();
        }

        public function view(): void {
            (new model_Cart)->getAllProducts($this->login);
            $product_amount_mark = true;
            $classname = __CLASS__;
            $class_array = explode('\\', $classname);
            $class = end($class_array);
            require_once __DIR__ . '/../view/pages/' . lcfirst($class) . '.php';
        }

        public function setProductAmount(array $args): void {
            $product_id = (int)$args[0];
            $amount = (int)$args[1];
            (new model_Cart)->setProductAmount($this->login, $product_id, $amount);
        }

        public function deleteProduct(array $args): void {
            $product_id = (int)$args[0];
            (new model_Cart)->deleteProduct($this->login, $product_id);
        }
    }