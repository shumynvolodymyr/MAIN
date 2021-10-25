file path="catalog/controller/checkout/cart.php";
search position="before"
$this->cart->add($this->request->post['product_id'], $quantity, $option, $recurring_id);

add:

$curent_quantity = 0;
				foreach($this->cart->getProducts() as $pr) {
					if($pr['product_id'] == $product_id){
						$curent_quantity +=$pr['quantity'];
					}
				}

				if(($curent_quantity + $quantity) > $product_info['quantity']) {
					$quantity = $product_info['quantity'] - $curent_quantity;
					$json['message'] = sprintf($this->language->get('text_wwatc'), $product_info['name']);
				}

file path="catalog/language/****/checkout/cart.php";
search position="after"
// Error;

add if (**** === uk-ua):

$_['text_wwatc'] = 'В даний час немає в наявності необхідної кількості товарів для Вашого замовлення. Кількість товарів "%s" в Вашому кошику було зменшено до максимально допустимого.';

add if (**** === ru-ru):

$_['text_wwatc'] = 'В настоящее время нет в наличии необходимого количества товаров для Вашего заказа. Количество товаров "%s" в Вашей корзине было уменьшено до максимально допустимого.';

file path="catalog/view/theme/uni/js/common.js";
AND
file path="catalog/view/theme/uni/template/product/product.twig";
search position="before"
if (json['success']) {

add:

if (json['message']) {
uniFlyAlert('danger', json['message']);
}
