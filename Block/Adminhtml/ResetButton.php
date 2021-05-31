<?php
/**
 * Landofcoder
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Landofcoder.com license that is
 * available through the world-wide-web at this URL:
 * https://landofcoder.com/terms
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade this extension to newer
 * version in the future.
 *
 * @category   Landofcoder
 * @package    Lof_Frontend2FA
 * @copyright  Copyright (c) 2021 Landofcoder (https://www.landofcoder.com/)
 * @license    https://landofcoder.com/terms
 */
namespace Lof\Frontend2FA\Block\Adminhtml;

use Lof\Frontend2FA\Model\SecretFactory;
use Magento\Backend\Model\UrlInterface;
use Magento\Customer\Block\Adminhtml\Edit\GenericButton;
use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

class ResetButton extends GenericButton implements ButtonProviderInterface
{
    const ADMIN_AUTHENTICATOR_RESET_PATH = 'frontend2fa/authenticator/reset';
    /**
     * @var SecretFactory
     */
    public $secretFactory;

    /**
     * ResetButton constructor.
     *
     * @param \Magento\Backend\Block\Widget\Context $context
     * @param \Magento\Framework\Registry           $registry
     * @param UrlInterface                          $urlBuilder
     * @param SecretFactory                         $secretFactory
     */
    public function __construct(
        \Magento\Backend\Block\Widget\Context $context,
        \Magento\Framework\Registry $registry,
        UrlInterface $urlBuilder,
        SecretFactory $secretFactory
    ) {
        parent::__construct($context, $registry);
        $this->urlBuilder = $urlBuilder;
        $this->secretFactory = $secretFactory;
    }

    /**
     * @return array
     */
    public function getButtonData()
    {
        $data = [];
        $secret = $this->secretFactory->create()->load($this->getCustomerId(), 'customer_id');

        if ($secret->getId()) {
            $url = $this->urlBuilder->getUrl(self::ADMIN_AUTHENTICATOR_RESET_PATH, [
                'customer_id' => $this->getCustomerId(),
            ]);
            $data = [
                'label'      => __('Reset frontend 2FA'),
                'on_click'   => sprintf('location.href = "%s";', $url),
                'class'      => 'add',
                'sort_order' => 40,
            ];
        }

        return $data;
    }
}
