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
namespace Lof\Frontend2FA\Controller\Adminhtml\Authenticator;

use Lof\Frontend2FA\Model\SecretFactory;
use Magento\Backend\App\Action;

class Reset extends \Magento\Backend\App\Action
{
    /**
     * @var SecretFactory
     */
    public $secretFactory;

    /**
     * Reset constructor.
     *
     * @param Action\Context $context
     * @param SecretFactory  $secretFactory
     */
    public function __construct(
        Action\Context $context,
        SecretFactory $secretFactory
    ) {
        parent::__construct($context);
        $this->secretFactory = $secretFactory;
    }

    public function execute()
    {
        $customerId = $this->getRequest()->getParam('customer_id');
        $secret = $this->secretFactory->create()->load($customerId, 'customer_id');
        if ($secret->getId()) {
            $secret->delete();
            $this->messageManager->addSuccessMessage(__('Frontend 2FA for customer has been reset.'));
        } else {
            $this->messageManager->addNoticeMessage(__('Frontend 2FA for customer has never been set.'));
        }
        $this->_redirect('customer/index/edit', ['id' => $customerId]);
    }
}
