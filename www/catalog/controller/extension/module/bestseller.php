<?php
class ControllerExtensionModuleBestSeller extends Controller {
	public function index($setting) {
		$this->load->language('extension/module/bestseller');

		$this->load->model('catalog/product');

		$this->load->model('tool/image');

		$data['products'] = array();

        $data['review_status'] = $this->config->get('config_review_status');

		$results = $this->model_catalog_product->getBestSellerProducts($setting['limit']);

		if ($results) {
            function in_array_r($needle, $haystack, $strict = false) {
                foreach ($haystack as $item) {
                    if (($strict ? $item === $needle : $item == $needle) || (is_array($item) && in_array_r($needle, $item, $strict))) {
                        return true;
                    }
                }

                return false;
            }
			foreach ($results as $result) {
                $show = NULL;
                $product_categories = $this->model_catalog_product->getCategoryNames($result['product_id']);

                if(!in_array_r("ГНОТИ ДЛЯ СВІЧОК", $product_categories)){
                    $show = "Y";
                }
                if($show == "Y"){
                    $data['reviews'][] = array(
                        'author' => $result['author'],
                        'text' => nl2br($result['text']),
                        'rating' => (int)$result['rating'],
                        'date_added' => date($this->language->get('date_format_short'), strtotime($result['date_added']))
                    );
                    $data['rating'] = (int)$product_info['rating'];
                    if ($result['image']) {
                        $image = $this->model_tool_image->resize($result['image'], $setting['width'], $setting['height']);
                    } else {
                        $image = $this->model_tool_image->resize('placeholder.png', $setting['width'], $setting['height']);
                    }

                    if ($this->customer->isLogged() || !$this->config->get('config_customer_price')) {
                        $price = $this->currency->format($this->tax->calculate($result['price'], $result['tax_class_id'], $this->config->get('config_tax')), $this->session->data['currency']);
                    } else {
                        $price = false;
                    }

                    if ((float)$result['special']) {
                        $special = $this->currency->format($this->tax->calculate($result['special'], $result['tax_class_id'], $this->config->get('config_tax')), $this->session->data['currency']);
                    } else {
                        $special = false;
                    }

                    if ($this->config->get('config_tax')) {
                        $tax = $this->currency->format((float)$result['special'] ? $result['special'] : $result['price'], $this->session->data['currency']);
                    } else {
                        $tax = false;
                    }
                    if ($this->config->get('config_review_status')) {
                        $rating = $result['rating'];
                    } else {
                        $rating = false;
                    }

                    $data['options'] = array();

                    foreach ($this->model_catalog_product->getProductOptions($result['product_id']) as $option) {
                        $product_option_value_data = array();

                        foreach ($option['product_option_value'] as $option_value) {
                            if (!$option_value['subtract'] || ($option_value['quantity'] > 0)) {
                                if ((($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) && (float)$option_value['price']) {
                                    $price = $this->currency->format($this->tax->calculate($option_value['price'], $product_info['tax_class_id'], $this->config->get('config_tax') ? 'P' : false), $this->session->data['currency']);
                                } else {
                                    $price = false;
                                }

                                $product_option_value_data[] = array(
                                    'product_option_value_id' => $option_value['product_option_value_id'],
                                    'option_value_id' => $option_value['option_value_id'],
                                    'name' => $option_value['name'],
                                    'image' => $this->model_tool_image->resize($option_value['image'], 50, 50),
                                    'price' => $price,
                                    'price_prefix' => $option_value['price_prefix']
                                );
                            }
                        }

                        $data['options'][$result['product_id']][] = array(
                            'product_option_id' => $option['product_option_id'],
                            'product_option_value' => $product_option_value_data,
                            'option_id' => $option['option_id'],
                            'name' => $option['name'],
                            'type' => $option['type'],
                            'value' => $option['value'],
                            'required' => $option['required']
                        );
                    }
                    $data['products'][] = array(
                        'product_id' => $result['product_id'],
                        'thumb' => $image,
                        'quantity' => $result['quantity'],
                        'options' => $data['options'][$result['product_id']],
                        'name' => $result['name'],
                        'description' => utf8_substr(trim(strip_tags(html_entity_decode($result['description'], ENT_QUOTES, 'UTF-8'))), 0, $this->config->get('theme_' . $this->config->get('config_theme') . '_product_description_length')) . '..',
                        'price' => round($result['price'], 0) . ' грн.',
                        'special' => $special,
                        'tax' => $tax,
                        'reviews' => $result['reviews'],
                        'rating' => $rating,
                        'href' => $this->url->link('product/product', 'product_id=' . $result['product_id'])
                    );
                }
            }

			return $this->load->view('extension/module/bestseller', $data);
		}
	}
}
