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
namespace Lof\Frontend2FA\Model;

use Lof\Frontend2FA\Model\ResourceModel\Secret as SecretResourceModel;
use Lof\Frontend2FA\Model\ResourceModel\Secret\Collection as SecretCollection;

/**
 * @method SecretResourceModel getResource()
 * @method SecretCollection getCollection()
 */
class Secret extends \Magento\Framework\Model\AbstractModel implements
    \Lof\Frontend2FA\Api\Data\SecretInterface,
    \Magento\Framework\DataObject\IdentityInterface
{
    const CACHE_TAG = 'lof_frontend2fa_secret';
    protected $_cacheTag = 'lof_frontend2fa_secret';
    protected $_eventPrefix = 'lof_frontend2fa_secret';

    protected function _construct()
    {
        $this->_init('Lof\Frontend2FA\Model\ResourceModel\Secret');
    }

    /**
     * @return array|string[]
     */
    public function getIdentities()
    {
        return [self::CACHE_TAG.'_'.$this->getId()];
    }
}
