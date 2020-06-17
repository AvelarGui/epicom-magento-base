<?php
namespace Activated\ShippingAddress\Plugin\Checkout\Block\Checkout\AttributeMerger;

class Plugin
{
  public function afterMerge(\Magento\Checkout\Block\Checkout\AttributeMerger $subject, $result)
  {
    if (array_key_exists('street', $result)) {
      $result['street']['children'][0]['label'] = __('Rua');
      $result['street']['children'][1]['label'] = __('Número');
      $result['street']['children'][2]['label'] = __('Complemento');
      $result['street']['children'][3]['label'] = __('Bairro');
    }

    return $result;
  }
}
