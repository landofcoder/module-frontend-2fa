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

use Endroid\QrCode\QrCode;

class GoogleAuthenticatorService extends \Neyamtux\Authenticator\Lib\PHPGangsta\GoogleAuthenticator
{
    /**
     * Get QR Code Image.
     *
     * @param string      $name
     * @param string      $secret
     * @param int         $size
     * @param string|null $issuer
     *
     * @return string
     */
    public function getQrCodeEndroid($name, $secret, $title = null, $params = [])
    {
        $size = !empty($params['size']) && (int) $params['size'] > 0 ? (int) $params['size'] : 200;
        $level = !empty($params['level']) && array_search($params['level'], ['L', 'M', 'Q', 'H']) !== false ? $params['level'] : 'M';

        $text = sprintf('otpauth://totp/%s?secret=%s', $name, $secret);
        if (true === is_string($title)) {
            $text = sprintf('%s&issuer=%s', $text, $title);
        }
        $qrCode = new QrCode($text);
        $qrCode->setSize($size);
        $qrCode->setWriterByName('png');
        $qrCode->setMargin(0);
        $qrCode->setEncoding('UTF-8');
        $qrCode->setSize($size);
        $qrCode->setText($text);

        return $qrCode->writeString();
    }
}
